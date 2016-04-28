<?php

namespace Mitul\Generator\Generators\API;

use Config;
use Mitul\Generator\CommandData;
use Mitul\Generator\Generators\GeneratorProvider;
use Mitul\Generator\Utils\GeneratorUtils;
use Illuminate\Support\Str;

class APIControllerGenerator implements GeneratorProvider
{
    /** @var  CommandData */
    private $commandData;

    /** @var string  */
    private $path;

    public function __construct($commandData)
    {
        $this->commandData = $commandData;
        $this->path = Config::get('generator.path_api_controller', app_path('Http/Controllers/API/'));
    }

    public function generate()
    {
        $templateData = $this->commandData->templatesHelper->getTemplate('Controller', 'api');

        if ($this->commandData->pointerModel){
            $pointerRelationship = [];
            foreach ($this->commandData->inputFields as $field) {
                if($field['type'] == 'pointer'){
                    $arr = explode(',', $field['typeOptions']);
                    if(count($arr) > 0){
                        $modelName = $arr[0];
                        $pointerRelationship[] = "'".Str::camel($modelName)."'";
                    }

                }
            }
            $templateData = str_replace('$POINTER_MODELS_RELATIONSHIP$', "with([".implode(", ", $pointerRelationship)."])->", $templateData);
        }else{
            $templateData = str_replace('$POINTER_MODELS_RELATIONSHIP$', '', $templateData);
        }

        $templateData = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateData);

        $fileName = $this->commandData->modelName.'APIController.php';

        if (!file_exists($this->path)) {
            mkdir($this->path, 0755, true);
        }

        $path = $this->path.$fileName;

        $this->commandData->fileHelper->writeFile($path, $templateData);
        $this->commandData->commandObj->comment("\nAPI Controller created: ");
        $this->commandData->commandObj->info($fileName);
    }
}
