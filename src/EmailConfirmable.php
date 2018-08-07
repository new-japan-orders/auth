<?php

namespace NewJapanOrders\Auth;

use NewJapanOrders\Auth\Notifications\ConfirmEmail as ConfirmEmailNotification;

trait EmailConfirmable
{
    /**
     * Send the password reset notification.
     *
     * @return void
     */
    public function sendEmailConfirmationNotification()
    {
        $this->notify(new ConfirmEmailNotification($this->confirmation_code));
    }
}