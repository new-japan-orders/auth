<?php

namespace NewJapanOrders\Auth\Contracts;

interface CanConfirmEmail
{
    /**
     * Send the password reset notification.
     *
     * @return void
     */
    public function sendEmailConfirmationNotification();
}