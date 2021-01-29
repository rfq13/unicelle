<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Customer;
use App\BusinessSetting;
use App\OtpConfiguration;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OTPVerificationController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Cookie;
use Session;
use Nexmo;
use Twilio\Rest\Client;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $validate = [
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|email',
            'gender' => 'required',
            'birth' => 'required',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6|confirmed',
        ];

        if (array_key_exists("user_type", $data)) {
            $validate = array_merge($validate, [
                'nama_instansi' => 'required|string|max:255',
                'alamat_instansi' => 'required|string|max:255',
                'izin' => 'required|string|max:255'
            ]);
        }
        // dd([$validate, $data]);



        return Validator::make($data, $validate);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $userid = 0;
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            

            $udata = [
                'name' => $data['nama_depan'] . " " . $data['nama_belakang'],
                'password' => Hash::make($data['password']),
                'user_type' => array_key_exists("user_type", $data) ? $data['user_type'] : "pasien reg",
                'email' => $data['email'],
                'gender' => $data['gender'],
                'birth' => $data['birth'],
                'phone' => $data['phone']




            ];
            // dd(substr($referral_code,strlen($referral_code)-6));


            $user = User::create($udata);
            $userid = $user->id;

            $customer = new Customer;
            $customer->user_id = $userid;
            $customer->save();

            $data['user_id'] = $userid;
            if (array_key_exists("user_type", $data)) {
                $this->instansi((object)$data);
            }
        } else {
            if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated) {
                $user = User::create([
                    'name' => $data['name'],
                    'phone' => '+' . $data['country_code'] . $data['phone'],
                    'password' => Hash::make($data['password']),
                    'verification_code' => rand(100000, 999999)
                ]);
                $userid = $user->id;

                $customer = new Customer;
                $customer->user_id = $userid;
                $customer->save();

                $data['user_id'] = $userid;
                if (array_key_exists("user_type", $data)) {
                    $this->instansi((object)$data);
                }

                $otpController = new OTPVerificationController;
                $otpController->send_code($user);
            }
        }
// ini diaaa

        if(\App\AffiliateOption::where('type', 'user_registration_first_purchase')->first() != null){
            $percentage = \App\AffiliateOption::where('type', 'user_registration_first_purchase')->first()->percentage;
            $status = \App\AffiliateOption::where('type', 'user_registration_first_purchase')->first()->status;
        }
        else {
            $percentage = 0;
        }

        if (Cookie::has('referral_code')) {
            $referral_code = Cookie::get('referral_code');
            $referred_by_user = User::where('referral_code', $referral_code)->first();
            if ($referred_by_user != null) {
                $user->referred_by = $referred_by_user->id;
                $user->save();
                // $referred_by_user->poin += $percentage;
                // $referred_by_user->save();
                // $point = new \App\ClubPoint;
                // $point->user_id = $referred_by_user->id;
                // $point->points = $percentage;
                // $point->convert_status = 0;
                // $point->save();
            }
        }

        return $user;
    }
    public function handleProviderCallbackOtp(Request $request)
    {
        // check if they're an existing user
        $existingUser = User::where('provider_id', $request->uid)->first();

        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $tlp = (int)str_replace("+62","0",$request->no_telepon);

            $datetime = new \DateTime();
            $nama_lengkap = $request->nama_depan.' '.$request->nama_belakang;
            $newUser                  = new User;
            $newUser->name            = $nama_lengkap;
            $newUser->gender          = $request->gender;
            $newUser->birth       = $request->birth;
            $newUser->user_type       = 'pasien reg';
            $newUser->phone           = $tlp;
            $newUser->email_verified_at = date('Y-m-d H:m:s');
            $newUser->provider_id     = $request->uid;
            if($request->email)
            {
                $checkUser = User::where("email",$request->email)->first();
                if ($checkUser != null) {
                    auth()->login($checkUser, true);
                    if(session('link') != null){
                        return redirect(session('link'));
                    }
                    else{
                        return redirect()->route('home');
                    }
                }

                $newUser->email = $request->email;
            }
            
            $newUser->save();

            $customer = new Customer;
            $customer->user_id = $newUser->id;
            $customer->save();

        
            auth()->login($newUser, true);
        }

        if(session('link') != null){
            // dd(session('link'));
            return redirect(session('link'));
        }

        return redirect()->route('home');
    }
    public function register(Request $request)
    {

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if (User::where('email', $request->email)->first() != null) {
                flash('Email atau Nomor Telepon telah terdaftar.')->error();
                return redirect()->back();
            }
        } elseif (User::where('phone', $request->phone)->first() != null) {
            flash(translate('Nomor Telepon telah terdaftar.'));
            return back();
        }


        $this->validator($request->all())->validate();

        if ($request->get('referral_code')) {
            $userRc = User::where('referral_code',$request->referral_code)->first();
            if($userRc != null){
                if ($request->user_type == "partner physician") {
                    flash(translate('Partner Physician tidak diperkenankan menggunakan kode referral'));
                    return back();
                }
                if ($userRc->user_type == "pasien reg") {
                    flash(translate('pasien regular tidak dapat memberikan kode referal'));
                    return back();
                }
                if ($userRc->user_type == $request->user_type) {
                    flash(translate('kode referral hanya bisa digunakan pada member yang berbeda'));
                    return back();
                }
            }
        }

        $user = $this->create($request->all());
        $userid = $user->id;

        if ($request->user_type == "regular physician") {
            $this->membership($userid);
        }

        $this->guard()->login($user);

        if ($user->email != null) {
            if (BusinessSetting::where('type', 'email_verification')->first()->value != 1) {
                $user->email_verified_at = date('Y-m-d H:m:s');
                $user->save();
                flash(translate('Pendaftaran Berhasil.'))->success();
            } else {
                event(new Registered($user));
                flash(translate('Registrasi Sukses. Mohon verifikasi email anda.'))->success();
            }
        }


        return $this->registered($request, $user)?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        if ($user->email == null) {
            return redirect()->route('verification');
            // return view('auth.verify');
        } else {

            return view('auth.verify');
        }
    }

    public function membership($user_id)
    {
        $member = \App\Member::orderBy("min")->first();
        $usr = \App\User::find($user_id);
        $usr->member_id = $member->id;
        $usr->save();

        $tgl_berakhir = app('\App\Http\Controllers\memberController')->ended_at($member);

        $userMember = new \App\userMember;
        $userMember->user_id = $user_id;
        $userMember->member_id = $member->id;
        $userMember->ended_at = $tgl_berakhir;
        $userMember->save();
    }

    public function instansi($data)
    {
        // dd($data);
        $instansi = new \App\instansi_physicianModel;
        $instansi->user_id = $data->user_id;
        $instansi->name = $data->nama_instansi;
        $instansi->address = $data->alamat_instansi;
        $instansi->izin = $data->izin;
        $instansi->fhoto = $data->fhoto->store('uploads/instansi');
        $instansi->save();

        // sekalian input data untuk diverifikasi dari admin
        $verify = new \App\physician_verificationModel;
        $verify->user_id = $data->user_id;
        $verify->verify = 0;
        $verify->save();
    }
}
