<?php

namespace Speil\BirthdayGreeter\Cron;

use XF\Entity\User;
use XF\Service\Thread\Replier;

class BirthdayPoster
{
    public static function run()
    {
        $options = \XF::options();
        $threadId = $options->birthdayGreeter_thread_id;
        $userId = $options->birthdayGreeter_user_id;
        $messageTemplate = $options->birthdayGreeter_message;

        $birthdayUsers = \XF::finder('XF:User')
            ->whereSql("DATE_FORMAT(FROM_UNIXTIME(dob_day), '%m-%d') = DATE_FORMAT(NOW(), '%m-%d')")
            ->fetch();

        foreach ($birthdayUsers as $user) {
            /** @var User $user */
            $message = str_replace('{username}', $user->username, $messageTemplate);

            /** @var Replier $replier */
            $replier = \XF::service('XF:Thread\Replier', $threadId);
            $replier->setUser(\XF::em()->find('XF:User', $userId));
            $replier->setMessage($message);
            $replier->save();
        }
    }
}
