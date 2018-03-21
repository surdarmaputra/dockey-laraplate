<?php

namespace Tests\Feature\Notifications;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Notifications\FirebaseNotif;
use DB;

class FirebaseNotificationTest extends TestCase
{
    use DatabaseTransactions;
    
    public function testFirebaseNotification()
    {
        $user = factory(\App\User::class)->create([
            'firebase_token' => 'axiuasdASFDA'
        ]);
        $title = 'Notification Title';
        $body = 'This is notification body.';
        $label = 'notification_test';
        $user->notify(new FirebaseNotif($title, $body, $label));
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $user->id,
            'notifiable_type' => 'App\User',
        ]);

        $expectedData = [
            'channel' => 'Firebase Cloud Messaging',
            'to' => $user->firebase_token,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
            'data' => [
                'label' => $label,
            ],
        ];
        $notification = DB::table('notifications')->where(['notifiable_id' => $user->id, 'notifiable_type' => 'App\User'])->first();
        $this->assertTrue($notification->data === json_encode($expectedData));
        $this->assertTrue($notification->push_notification_sent_at !== NULL);
    }

    public function testFirebaseNotificationWithData()
    {
        $user = factory(\App\User::class)->create([
            'username' => 'test',
            'email' => 'test@dockeylaraplate.io',
            'firebase_token' => 'axiuasdASFDA'
        ]);
        $title = 'Notification Title';
        $body = 'This is notification body.';
        $label = 'notification_test';
        $data = [
            'subject_id' => 1,
            'message' => 'test',
        ];
        $user->notify(new FirebaseNotif($title, $body, $label, $data));
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $user->id,
            'notifiable_type' => 'App\User',
        ]);

        $expectedData = [
            'channel' => 'Firebase Cloud Messaging',
            'to' => $user->firebase_token,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
            'data' => array_merge($data, [
                'label' => $label,
            ]),
        ];
        $notification = DB::table('notifications')->where(['notifiable_id' => $user->id, 'notifiable_type' => 'App\User'])->first();
        $this->assertTrue($notification->data === json_encode($expectedData));
        $this->assertTrue($notification->push_notification_sent_at !== NULL);
    }
}
