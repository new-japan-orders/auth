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

        event(new Registered($user));
        if (method_exists($user, 'sendEmailActivateNotification')) {
            $user->sendEmailConfirmNotification();
        }
        return view('auth::complete');
    }
}