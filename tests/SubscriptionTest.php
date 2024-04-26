<?php

use App\User;
use App\Gateway;
use App\Mailer;
use App\Subscription;
use PHPUnit\Framework\TestCase;

class SubscriptionTest extends TestCase{
    public function test_it_creates_a_strip_subscription(){
        
        $this->markTestSkipped();
    }

    public function test_creating_users_marks_them_as_subscribed(){
        $subscription = new Subscription($this->createMock(Gateway::class), $this->createMock(Mailer::class));
        $user = new User('Test Name');

        $this->assertFalse($user->isSubscribed());

        $subscription->create($user);

        $this->assertTrue($user->isSubscribed());

    }

    public function test_it_delivers_a_reciept()
    {
        $gateway = $this->createMock(Gateway::class);
        $gateway->method('create')->willReturn('reciept-stub');
        $deliver = $this->createMock(Mailer::class);
        $deliver
            ->expects($this->once())
            ->method('deliver')
            ->with('This is your reciept: reciept-stub');

        $subscription = new Subscription($gateway, $deliver);
        $subscription->create(new User('Test Name'));

    }
}