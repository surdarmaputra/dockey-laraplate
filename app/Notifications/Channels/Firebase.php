<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use App\ThirdParties\Firebase\FirebaseConnection;
use Carbon\Carbon;
use DB;

class Firebase
{
    public function send($notifiable, Notification $notification)
    {
        $pushNotification = $notification->toFirebase($notifiable);
        $connection = new FirebaseConnection();
        $connection->setBody($pushNotification->toArray());
        $result = $connection->send();

        $persistedNotification = DB::table('notifications')->where('id', $notification->id);
        if ($persistedNotification->first()) {
            $persistedNotification->update([
                'push_notification_result' => json_encode($result),
                'push_notification_sent_at' => Carbon::now(),
            ]);
        }
    }
}