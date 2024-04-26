<?php


namespace App;

use App\Mailer;
use App\User;
use App\Gateway;

class Subscription{
    public function __construct(protected Gateway $gateway, protected Mailer $mailer)
    {
        
    }
    public function create(User $user){
        
        $reciept = $this->gateway->create();
        $user->markAsSubscribed();

        $this->mailer->deliver('This is your reciept: ' . $reciept);
    }
}