<?php

namespace DeinName\BirthdayGreeter;

class Listener
{
    public static function appSetup(\XF\App $app)
    {
        $app->cron->addJob('birthdayPoster', 'DeinName\BirthdayGreeter\Cron\BirthdayPoster::run', [
            'runRules' => [
                'hour' => 0,
                'minute' => 0
            ]
        ]);
    }
}
