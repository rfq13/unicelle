<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use App\Admin_log;
use App\Customer;
use Illuminate\Http\Request;
use CoreComponentRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    /*protected $redirectTo = '/';*/


    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */

    public function bindUser(Request $request,$number)
    {
        $user = User::where('phone', $request->tlp)->first();
        if ($user != null && $user->count() > 0) {
            auth()->login($user->id, true);
            return "sukses";
        }
        else{
        return "user not found";
        }
    }

    public function regUser(User $user,$userData)
    {
        $referral_code = str_replace("=","",encrypt($user->id));
        $referral_code = substr($referral_code,strlen($referral_code)-10);


        $userData = json_decode($userData);

        $user->phone = $userData->phone;
        $user->name = $userData->name;
        $user->email_verified_at = date('Y-m-d H:m:s');
        $user->user_type = "pasien reg";
        $user->referral_code = $referral_code;
        if($user->save()){
            $uid=  $user->id;
            $cust = new \App\Customer;
            $cust->user_id = $uid;
            $cust->save();
            if($this->bindUser($userData->phone) == "sukses"){
                return "sukses";
            };
        }
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        try {
            if ($provider == 'twitter') {
                $user = Socialite::driver('twitter')->user();
            } else {
                $user = Socialite::driver($provider)->stateless()->user();
            }
        } catch (\Exception $e) {
            flash("Something Went wrong. Please try again.")->error();
            return redirect()->route('user.login');
        }

        // check if they're an existing user
        $existingUser = User::where('provider_id', $user->id)->orWhere('email', $user->email)->first();

        if ($existingUser) {
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->email_verified_at = date('Y-m-d H:m:s');
            $newUser->provider_id     = $user->id;

            // $extension = pathinfo($user->avatar_original, PATHINFO_EXTENSION);
            // $filename = 'uploads/users/'.Str::random(5).'-'.$user->id.'.'.$extension;
            // $fullpath = 'public/'.$filename;
            // $file = file_get_contents($user->avatar_original);
            // file_put_contents($fullpath, $file);
            //
            // $newUser->avatar_original = $filename;
            $newUser->save();

            $customer = new Customer;
            $customer->user_id = $newUser->id;
            $customer->save();

            auth()->login($newUser, true);
        }
        if (session('link') != null) {
            return redirect(session('link'));
        } else {
            return redirect()->route("home");
        }
    }
    
    protected function credentials(Request $request)
    {
        if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return $request->only($this->username(), 'password');
        }
        return ['phone' => $request->get('email'), 'password' => $request->get('password')];
    }

    /**
     * Check user's role and redirect user based on their role
     * @return
     */
    public function authenticated()
    {
        if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff') {
            // CoreComponentRepository::instantiateShopRepository();
            $log = new Admin_log;
            $log->user_id = auth()->user()->id;
            $log->order_id = '-';
            $log->konsumen = '-';
            $log->event = 'Login';
            $log->save();
            return redirect()->route('admin.dashboard');
        } else {
            auth()->guard()->logout();
            flash(translate('Invalid email or password'))->error();
            return redirect()->route('login.admin');
        }
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        flash(translate('Invalid email or password'))->error();
        return back();
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if (auth()->user() != null && (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')) {
            $redirect_route = 'login';
        } else {
            $redirect_route = 'user.login';
        }

        if ($request->session()->has('poin_use')) {
            $point = auth()->user()->poin;
            $point -= $request->session()->get('poin_use');
            auth()->user()->poin = $point;
            auth()->user()->save();
        }
        
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route($redirect_route);
    }

    public function user_login(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi',
            'email' => ':attribute harus berformat email',
            'min' => ':attribute harus diisi minimal :min karakter'
        ];
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ],$messages);

        $user = User::where("email",$request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                if ($user->user_type == "admin") {
                    flash("url login admin tidak sesuai")->error();
                    return redirect(route('user.login'));
                }
                auth()->login($user, true);
                return redirect(route('home'));
            }
            return redirect(route('user.login',['type'=>1,'msg'=>'password salah','email'=>$request->email]));
        }
        return redirect(route('user.login',['type'=>2,'msg'=>"user dengan email $request->email tidak ditemukan",'email' => $request->email]));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
