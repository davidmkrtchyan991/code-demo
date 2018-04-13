<?php

namespace App\Services;

use App\Mail\OrderRegistrationMail;
use App\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailService
{
    public function sendOrderRegistration(Order $order)
    {
        try {
//            Mail::to($order->user->email)->send(new OrderRegistrationMail($order));
        } catch (\Exception $exception) {
            Log::error("Failed to send email for oder registration." . $exception->getMessage());
        }
    }

}