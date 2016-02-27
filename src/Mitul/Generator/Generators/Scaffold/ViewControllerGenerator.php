<?php

namespace Mitul\Generator\Generators\Scaffold;

use Config;
use Illuminate\Support\Str;
use Mitul\Generator\CommandData;
use Mitul\Generator\Generators\GeneratorProvider;
use Mitul\Generator\Utils\GeneratorUtils;

class ViewControllerGenerator implements GeneratorProvider
{
    /** @var  CommandData */
    private $commandData;

    /** @var string */
    private $path;

    public function __construct($commandData)
    {
        $this->commandData = $commandData;
        $this->path = Config::get('generator.path_controller', app_path('Http/Controllers/'));
    }

    public function generate()
    {
        if ($this->commandData->pointerModel)
            $templateData = $this->commandData->templatesHelper->getTemplate('PointerController', 'scaffold');
        else
            $templateData = $this->commandData->templatesHelper->getTemplate('Controller', 'scaffold');

        $templateData = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateData);

        if ($this->commandData->paginate) {
            $templateData = str_replace('$RENDER_TYPE$', 'paginate('.$this->commandData->paginate.')', $templateData);
        } else {
            $templateData = str_replace('$RENDER_TYPE$', 'all()', $templateData);
        }

        $templateData = $this->generatePointerModel($templateData);

        $fileName = $this->commandData->modelName.'Controller.php';

        $path = $this->path.$fileName;

        $this->commandData->fileHelper->writeFile($path, $templateData);
        $this->commandData->commandObj->comment("\nController created: ");
        $this->commandData->commandObj->info($fileName);
    }

    private function generatePointerModel($templateData){
        $templateImportModel         = [];
        $templatePointerModel        = [];
        $templatePointerModelArr     = [];
        foreach ($this->commandData->inputFields as $field) {
            if($field['type'] == 'pointer'){
                $arr = explode(',', $field['typeOptions']);
                if(count($arr) > 0){
                    $modelName = $arr[0];
                    $templateImportModel[]      = "use App\Models\\".$modelName.";";
                    $templatePointer            = $this->commandData->templatesHelper->getTemplate('Pointer', 'scaffold');
                    $templatePointer            = str_replace('$POINTER_MODEL_NAME$', $modelName, $templatePointer);
                    $templatePointer            = str_replace('$POINTER_MODEL_NAME_CAMEL$', Str::camel($this->modelName), $templatePointer);
                    $templatePointer            = str_replace('$POINTER_MODEL_NAME_CAMEL_PLURAL$', Str::camel(Str::plural($this->modelName)), $templatePointer);
                    $templatePointer            = str_replace('$POINTER__MODELVAL$', $arr[1], $templatePointer);
                    $templatePointerModel[]     = $templatePointer;
                    $templatePointerModelArr[]  = "'".Str::camel(Str::plural($this->modelName))."'=>$".Str::camel($modelName);
                }

            }
        }
        $templateData = str_replace('$USE_POINTER_MODELS$', implode("\n", $templateImportModel), $templateData);
        $templateData = str_replace('$POINTER_MODELS$', implode("\n", $templatePointerModel), $templateData);
        $templateData = str_replace('$POINTER_MODEL_ARR$', implode(", ", $templatePointerModelArr), $templateData);
        return $templateData;
    }
}
