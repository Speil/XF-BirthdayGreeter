<?php

namespace Speil\BirthdayGreeter;

class Listener
{
    public static function appSetup(\XF\App $app)
    {
        $app->cron->addJob('birthdayPoster', 'Speil\BirthdayGreeter\Cron\BirthdayPoster::run', [
            'runRules' => [
                'hour' => 0,
                'minute' => 0
            ]
        ]);
    }
}
