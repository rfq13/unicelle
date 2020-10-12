<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\User;
use Carbon\Carbon;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        //$this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verification_confirmation($code)
    {
        $user = User::where('verification_code', $code)->first();
        if ($user != null) {
            $referral_code = encrypt($user->id);
            $referral_code = substr($referral_code,strlen($referral_code)-10);
            $user->email_verified_at = Carbon::now();
            $user->referral_code = $referral_code;
            $user->save();

            if ($user->physician_verification != null && $user->physician_verification->verify == 0) {
                flash('Email anda berhasil di verifikasi namun akun anda belum dapat digunakan, tunggu konfirmasi dari admin');
                return redirect()->route('logout');
            }
            flash(translate('Email anda berhasil di verifikasi'))->success();
        } else {
            flash(translate('Maaf, kami tidak dapat memverifikasi email anda. Silahkan di coba kembali'))->error();
        }

        return redirect()->route('home');
        // return redirect();
    }
}
