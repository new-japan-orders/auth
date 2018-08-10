<?php

namespace NewJapanOrders\Auth\Commands;

use Illuminate\Console\Command;
use NewJapanOrders\Stub\Stub;
use NewJapanOrders\Arguments\CompilableArguments;

class PublishMigrations extends Command
{
    use CompilableArguments;

    protected $signature = 'auth:publish:migration {model_name}';

        /** 
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->getArguments();
        $this->copyMigrations();
    }

    protected function copyMigrations()
    {
        $packagePath = __DIR__.'/../../';
        $stubPath = $packagePath . 'stubs/migrations/';
        
        $stubFilePath = $stubPath."2017_02_02_232450_add_confirmation.php.stub";
        $outputFileName = "2017_02_02_232450_add_confirmation_to_".$this->model->plural_snake."_table.php";
        $outputFilePath = base_path()."/database/migrations/".$outputFileName;

        if (file_exists($outputFilePath)) {
            $this->comment("[Warning]{$outputFilePath} file is already exists    ...skip");
        } else {
            file_put_contents(
                $outputFilePath,
                $this->compileStub($stubFilePath)
            );
        }
    }
}