<?php

namespace NewJapanOrders\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Auth\RedirectsUsers;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        $user->confirmation_code = str_random(30);
        $user->save();

        event(new Registered($user));
        if (method_exists($user, 'sendEmailConfirmationNotification')) {
            $user->sendEmailConfirmationNotification($user->confirmation_code);
        }

        return $this->registered($request, $user)
                        ?: view('auth::registered')->with('user', $user);
    }

    public function confirmEmail(Request $request, $confirmation_code)
    {
        $guard = $this->guard();

        $model = $this->guard()->getProvider()->createModel();
        $user = $model->whereConfirmationCode($confirmation_code)->firstOrFail();

        $user->confirmation_code = null;
        $user->confirmed_at = Carbon::now();
        $user->save();

        return $this->confirmed($request, $user)
                        ?: view('auth::confirmed')->with('user', $user);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }

    /**
     * The user has been confirmed email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function confirmed(Request $request, $user)
    {
        //
    }
}