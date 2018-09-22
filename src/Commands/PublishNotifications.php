<?php

namespace NewJapanOrders\Auth\Commands;

use Illuminate\Console\Command;
use NewJapanOrders\Stub\Stub;
use NewJapanOrders\Arguments\CompilableArguments;

class PublishNotifications extends Command
{
    use CompilableArguments;

    protected $signature = 'auth:publish:notifications {app_name}';

    protected $viewFiles = [
        "confirm_email.stub" => "confirm_email.blade.php",
        "reset_password.stub" => "reset_password.blade.php",
    ];

    protected $notificationFiles = [
        "ConfirmEmail.stub" => "ConfirmEmail.php",
    ];

    /** 
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->getArguments();
        $this->copyViews();
    }

    protected function copyViews()
    {
        $packagePath = __DIR__.'/../../';
        $stubPath = $packagePath . 'stubs/views/mails/';
        
        foreach ($this->viewFiles as $stubFile => $viewFile) {
            $stubFilePath = $stubPath.$stubFile;
            $viewFilePath = base_path()."/resources/views/".$this->app->singular_snake."/mails/".$viewFile;
            if (file_exists($viewFilePath)) {
                $this->comment("[Warning]{$viewFilePath} file is already exists    ...skip");
            } else {
                
                $viewDirPath = base_path()."/resources/views/".$this->app->singular_snake."/mails/";
                mkdir($viewDirPath);

                file_put_contents(
                    $viewFilePath,
                    $this->compileStub($stubFilePath)
                );
            }
        }
    }

    protected function copyNotifications()
    {
        $packagePath = __DIR__.'/../../';
        $stubPath = $packagePath . 'stubs/notifications/';
        
        foreach ($this->notificationFiles as $stubFile => $notificationFile) {
            $stubFilePath = $stubPath.$stubFile;
            $notificationFilePath = base_path().$this->app->singular_snake."/notifications/".$notificationFile;
            if (file_exists($notificationFilePath)) {
                $this->comment("[Warning]{$notificationFilePath} file is already exists    ...skip");
            } else {
                file_put_contents(
                    $notificationFilePath,
                    $this->compileStub($stubFilePath)
                );
            }
        }
    }
}