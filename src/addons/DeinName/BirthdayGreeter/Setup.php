<?php

namespace DeinName\BirthdayGreeter;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;

class Setup extends AbstractSetup
{
    use StepRunnerInstallTrait;
    use StepRunnerUninstallTrait;
    use StepRunnerUpgradeTrait;

    public function installStep1()
    {
        $this->schemaManager()->createTable('xf_birthday_greeter', function($table)
        {
            $table->addColumn('thread_id', 'int')->setDefault(3332);
            $table->addColumn('user_id', 'int')->setDefault(1);
            $table->addColumn('message', 'varchar', 255)->setDefault('Alles Gute zum Geburtstag {username}');
        });
    }

    public function uninstallStep1()
    {
        $this->schemaManager()->dropTable('xf_birthday_greeter');
    }
}
