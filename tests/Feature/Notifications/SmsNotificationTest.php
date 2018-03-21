<?php

namespace Tests\Feature\Notifications;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Notifications\SmsNotif;
use DB;

class SmsNotificationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSmsNotification()
    {
        $user = factory(\App\User::class)->create([
            'phone_number' => '+6281000111222',
        ]);
        $message = 'This is a message';
        $user->notify(new SmsNotif($message));
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $user->id,
            'notifiable_type' => 'App\User',
        ]);

        $expectedData = [
            'phone_number' => $user->phone_number,
            'message' => $message,
        ];
        $notification = DB::table('notifications')->where(['notifiable_id' => $user->id, 'notifiable_type' => 'App\User'])->first();
        $this->assertTrue($notification->data === json_encode($expectedData));
        $this->assertTrue($notification->sms_notification_sent_at !== NULL);
    }
}
