<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeApiTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:apitest {name} {version=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make an API Test Case';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $apiVersion = $this->argument('version');
        $testCaseName = explode('/',$this->argument('name'));
        $testPath = base_path('tests/Feature/Api/V'.$apiVersion);
        $sampleTestCaseFile = $testPath.'/TestCaseExample.php.example';
        $targetTestCaseFile = $testPath.'/'.$this->argument('name').'.php';

        $testCaseClassName = array_pop($testCaseName);
        $testCaseNamespace = 'Tests\Feature\Api\V1';
        if (count($testCaseName) > 0) {
            $testCaseNamespace = $testCaseNamespace.'\\'.implode('\\', $testCaseName);
            $targetDirectory = $testPath.'/'.implode('/', $testCaseName);
            if (!is_dir($targetDirectory)) {
                mkdir($targetDirectory, 0755, TRUE);
            }
        }

        copy($sampleTestCaseFile, $targetTestCaseFile);
        
        $testCaseContent = file_get_contents($targetTestCaseFile);
        file_put_contents($targetTestCaseFile, str_replace('ExampleNamespace', $testCaseNamespace, str_replace('ExampleTest', $testCaseClassName, $testCaseContent)));
    }
}
