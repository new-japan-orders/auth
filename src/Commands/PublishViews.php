<?php

namespace NewJapanOrders\Auth\Commands;

use Illuminate\Console\Command;
use NewJapanOrders\Stub\Stub;
use NewJapanOrders\Arguments\CompilableArguments;

class PublishViews extends Command
{
    use CompilableArguments;

    protected $signature = 'auth:publish:views {app_name}';

    protected $files = [
        "confirmed.stub" => "confirmed.blade.php",
        "registered.stub" => "registered.blade.php",
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
        $stubPath = $packagePath . 'stubs/views/';
        
        foreach ($this->files as $stubFile => $viewFile) {
            $stubFilePath = $stubPath.$stubFile;
            $viewFilePath = base_path()."/resources/views/".$this->app->singular_snake."/auth/".$viewFile;
            if (file_exists($viewFilePath)) {
                $this->comment("[Warning]{$viewFilePath} file is already exists    ...skip");
            } else {
                file_put_contents(
                    $viewFilePath,
                    $this->compileStub($stubFilePath)
                );
            }
        }
    }
}