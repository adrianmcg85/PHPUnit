<?php

namespace App;

class User{
    public $subscribed = false;
    public function __construct(protected $name){
        $this->name = $name;
    }

    public function isSubscribed():bool
    {
        return $this->subscribed;
    }
    public function markAsSubscribed()
    {
        $this->subscribed = true;
    }
}