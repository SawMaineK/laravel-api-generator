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


        if ($this->commandData->paginate) {
            $templateData = str_replace('$RENDER_TYPE$', 'paginate('.$this->commandData->paginate.')', $templateData);
        } else {
            $templateData = str_replace('$RENDER_TYPE$', 'all()', $templateData);
        }

        $templateData = $this->generatePointerModel($templateData);
        $templateData = $this->generateFileUpload($templateData);

        
        $templateData = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateData);

        $fileName = $this->commandData->modelName.'Controller.php';

        $path = $this->path.$fileName;

        $this->commandData->fileHelper->writeFile($path, $templateData);
        $this->commandData->commandObj->comment("\nController created: ");
        $this->commandData->commandObj->info($fileName);
    }

    private function generateFileUpload($templateData){
        $templateFileUpload = [];
        $templateEditFileUpload = [];
        $templateDelFileUpload = [];
        foreach ($this->commandData->inputFields as $field) {
            if($field['type'] == 'file'){
                $fileUpload = $this->commandData->templatesHelper->getTemplate('FileUpload', 'scaffold');
                $editFileUpload = $this->commandData->templatesHelper->getTemplate('EditFileUpload', 'scaffold');
                $fileUpload = str_replace('$FIELD_NAME$', $field['fieldName'], $fileUpload);
                $editFileUpload = str_replace('$FIELD_NAME$', $field['fieldName'], $editFileUpload);
                $templateFileUpload[] = $fileUpload;
                $templateEditFileUpload[] = $editFileUpload;
                $templateDelFileUpload[] = "\t\t@unlink(public_path('/".$this->commandData->modelNamePluralCamel."/'.\$".$this->commandData->modelNameCamel."->".$field['fieldName']."));";
                $templateDelFileUpload[] = "\t\t@unlink(public_path('/".$this->commandData->modelNamePluralCamel."/x100/'.\$".$this->commandData->modelNameCamel."->".$field['fieldName']."));";
                $templateDelFileUpload[] = "\t\t@unlink(public_path('/".$this->commandData->modelNamePluralCamel."/x200/'.\$".$this->commandData->modelNameCamel."->".$field['fieldName']."));";
                $templateDelFileUpload[] = "\t\t@unlink(public_path('/".$this->commandData->modelNamePluralCamel."/x400/'.\$".$this->commandData->modelNameCamel."->".$field['fieldName']."));\n";
            }
        }
        if(count($templateFileUpload) > 0){
            $templateData = str_replace('$FILE_UPLOADS$', implode("\n", $templateFileUpload), $templateData);
            $templateData = str_replace('$EDIT_FILE_UPLOADS$', implode("\n", $templateEditFileUpload), $templateData);
            $templateData = str_replace('$DELETE_UPLOAD_FILES$', implode("\n", $templateDelFileUpload), $templateData);
        }
        else{
            $templateData = str_replace('$FILE_UPLOADS$', '', $templateData);
            $templateData = str_replace('$EDIT_FILE_UPLOADS$', '', $templateData);
            $templateData = str_replace('$DELETE_UPLOAD_FILES$', '', $templateData);
        }
        return $templateData;
    }

    private function generatePointerModel($templateData){
        $templatePointerRelationship = [];
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
                    $templatePointer            = str_replace('$POINTER_MODEL_NAME_CAMEL$', Str::camel($modelName), $templatePointer);
                    $templatePointer            = str_replace('$POINTER_MODEL_NAME_CAMEL_PLURAL$', Str::camel(Str::plural($modelName)), $templatePointer);
                    $templatePointer            = str_replace('$POINTER__MODELVAL$', $arr[1], $templatePointer);
                    $templatePointerModel[]     = $templatePointer;
                    $templatePointerModelArr[]  = "'".Str::camel(Str::plural($modelName))."'=>$".Str::camel(Str::plural($modelName));
                    $templatePointerRelationship[] = "'".Str::camel($modelName)."'";
                }

            }
        }
        $templateData = str_replace('$USE_POINTER_MODELS$', implode("\n", $templateImportModel), $templateData);
        $templateData = str_replace('$POINTER_MODELS$', implode("\n", $templatePointerModel), $templateData);
        $templateData = str_replace('$POINTER_MODEL_ARR$', implode(", ", $templatePointerModelArr), $templateData);
        $templatePointerModelArr[]  = '\'$MODEL_NAME_CAMEL$\'=>$$MODEL_NAME_CAMEL$';
        $templateData = str_replace('$POINTER_MODEL_EDITARR$', implode(", ", $templatePointerModelArr), $templateData);
        $templateData = str_replace('$POINTER_MODELS_RELATIONSHIP$', implode(", ", $templatePointerRelationship), $templateData);
        return $templateData;
    }
}
