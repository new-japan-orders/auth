<?php

namespace NewJapanOrders\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers as BaseRegistersUsers;
use Illuminate\Support\Str;

trait RegistersUsers
{
    use BaseRegistersUsers;

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

        return view('auth::complete')
                ->with('user', $user);
    }

    public function confirmEmail($confirmation_code)
    {
        $test = \App\Models\User::where('confirmation_code', $confirmation_code)->first();
        dd($test);
    }
}