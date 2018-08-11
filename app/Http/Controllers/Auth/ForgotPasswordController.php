<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getResetToken(Request $request)
    {
        // $this->validate($request, ['email' => 'required|email']);
        // if ($request->wantsJson()) {
        //     $user = User::where('email', $request->input('email'))->first();
        //     if (!$user) {
        //         return response()->json( ['data' => '' , 'message' => trans('passwords.user')], 400);
        //     }
        //     $token = $this->broker()->createToken($user);
        //     return response()->json(['token' => $token]);
        // }

        $credentials = ['email' => $request->input('email')];
        $response = Password::sendResetLink($credentials, function (Message $message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                // return redirect()->back()->with('status', trans($response));
                return ['status'=> trans($response), 'message' => 'Reset password link sent to you email'];
            case Password::INVALID_USER:
                // return redirect()->back()->withErrors(['email' => trans($response)]);
                return ['status'=> trans($response), 'message' => 'Email not registered'];
        }
    }
}
