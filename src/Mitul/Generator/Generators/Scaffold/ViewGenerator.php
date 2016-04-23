<?php

namespace Mitul\Generator\Generators\Scaffold;

use Config;
use Illuminate\Support\Str;
use Mitul\Generator\CommandData;
use Mitul\Generator\FormFieldsGenerator;
use Mitul\Generator\Generators\GeneratorProvider;
use Mitul\Generator\Utils\GeneratorUtils;

class ViewGenerator implements GeneratorProvider
{
    /** @var  CommandData */
    private $commandData;

    /** @var string */
    private $path;

    /** @var string */
    private $path_lang;

    /** @var string */
    private $viewsPath;

    /** @var string */
    private $langsPath;

    public function __construct($commandData)
    {
        $this->commandData = $commandData;
        $this->path = Config::get('generator.path_views', base_path('resources/views')).'/'.$this->commandData->modelNamePluralCamel.'/';
        $this->path_lang = base_path('resources/lang/en').'/'.$this->commandData->modelNamePluralCamel.'/';
        $this->viewsPath = 'scaffold/views';
        $this->langsPath = 'scaffold/lang';
    }

    public function generate()
    {
        if (!file_exists($this->path)) {
            mkdir($this->path, 0755, true);
        }
        if (!file_exists($this->path_lang)) {
            mkdir($this->path_lang, 0755, true);
        }

        $this->commandData->commandObj->comment("\nViews created: ");
        $this->generateFields();
        $this->generateShowFields();
        $this->generateTable();
        $this->generateIndex();
        $this->generateShow();
        $this->generateCreate();
        $this->generateEdit();
    }

    private function generateFields()
    {
        $fieldTemplate = '';
        $fieldsStr = '';
        $fieldsLang = '';

        foreach ($this->commandData->inputFields as $field) {
            $fieldsLang .="'".$field['fieldName']."'=>'". Str::title(str_replace('_', ' ', $field['fieldName'])) ."',\n";
            switch ($field['type']) {
                case 'text':
                    $fieldTemplate = $this->commandData->templatesHelper->getTemplate('field.blade', $this->viewsPath);
                    $fieldsStr .= FormFieldsGenerator::text($fieldTemplate, $field)."\n\n";
                    break;
                case 'textarea':
                    $fieldTemplate = $this->commandData->templatesHelper->getTemplate('field.blade', $this->viewsPath);
                    $fieldsStr .= FormFieldsGenerator::textarea($fieldTemplate, $field)."\n\n";
                    break;
                case 'password':
                    $fieldTemplate = $this->commandData->templatesHelper->getTemplate('field.blade', $this->viewsPath);
                    $fieldsStr .= FormFieldsGenerator::password($fieldTemplate, $field)."\n\n";
                    break;
                case 'email':
                    $fieldTemplate = $this->commandData->templatesHelper->getTemplate('field.blade', $this->viewsPath);
                    $fieldsStr .= FormFieldsGenerator::email($fieldTemplate, $field)."\n\n";
                    break;
                case 'file':
                    $fieldTemplate = $this->commandData->templatesHelper->getTemplate('file.blade', $this->viewsPath);
                    $fieldsStr .= FormFieldsGenerator::file($fieldTemplate, $field)."\n\n";
                    break;
                case 'checkbox':
                    $fieldTemplate = $this->commandData->templatesHelper->getTemplate('checkbox.blade', $this->viewsPath);
                    $fieldsStr .= FormFieldsGenerator::checkbox($fieldTemplate, $field)."\n\n";
                    break;
                case 'radio':
                    $fieldTemplate = $this->commandData->templatesHelper->getTemplate('radio.blade', $this->viewsPath);
                    $fieldsStr .= FormFieldsGenerator::radio($fieldTemplate, $field)."\n\n";
                    break;
                case 'number':
                    $fieldTemplate = $this->commandData->templatesHelper->getTemplate('field.blade', $this->viewsPath);
                    $fieldsStr .= FormFieldsGenerator::number($fieldTemplate, $field)."\n\n";
                    break;
                case 'date':
                    $fieldTemplate = $this->commandData->templatesHelper->getTemplate('date.blade', $this->viewsPath);
                    $fieldsStr .= FormFieldsGenerator::date($fieldTemplate, $field)."\n\n";
                    break;
                case 'select':
                    $fieldTemplate = $this->commandData->templatesHelper->getTemplate('field.blade', $this->viewsPath);
                    $fieldsStr .= FormFieldsGenerator::select($fieldTemplate, $field)."\n\n";
                    break;
                case 'pointer':
                    $fieldTemplate = $this->commandData->templatesHelper->getTemplate('pointer.blade', $this->viewsPath);
                    $fieldsStr .= FormFieldsGenerator::pointer($fieldTemplate, $field)."\n\n";
                    break;
            }
        }

        $fieldsLang .="'save'=>'Save',\n";
        $fieldsLang .="'cancel'=>'Cancel',\n";

        $templateData = $this->commandData->templatesHelper->getTemplate('fields.blade', $this->viewsPath);

        $templateLang = $this->commandData->templatesHelper->getTemplate('fields', $this->langsPath);

        $templateData = str_replace('$FIELDS$', $fieldsStr, $templateData);

        $templateLang = str_replace('$FIELDS_LANG$', $fieldsLang, $templateLang);

        $templateData = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateData);

        $templateLang = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateLang);

        $fileName = 'fields.blade.php';

        $path = $this->path.$fileName;
        $pathLang = $this->path_lang.str_replace('.blade', '', $fileName);

        $this->commandData->fileHelper->writeFile($path, $templateData);
        $this->commandData->commandObj->info('field.blade.php created');

        $this->commandData->fileHelper->writeFile($pathLang, $templateLang);
        $this->commandData->commandObj->info('fields.php created');
    }

    private function generateShowFields()
    {
        $fieldTemplate = $this->commandData->templatesHelper->getTemplate('show_field.blade', $this->viewsPath);
        $fieldPointerTemplate = $this->commandData->templatesHelper->getTemplate('show_field_pointer.blade', $this->viewsPath);

        $fieldsStr = '';
        $fieldsLang = '';

        foreach ($this->commandData->inputFields as $field) {
            $fieldsLang .="'".$field['fieldName']."'=>'". Str::title(str_replace('_', ' ', $field['fieldName'])) ."',\n";
            if($field['type'] == 'pointer'){
                $arr = explode(',', $field['typeOptions']);
                if(count($arr) > 0){
                    $modelName = $arr[0];
                    $modelNameVal = $arr[1];

                    $singleFieldStr = str_replace('$POINTER_MODEL_CAMEL$', Str::camel($modelName), $fieldPointerTemplate);
                    $singleFieldStr = str_replace('$POINTER_FIELD_NAME$', $modelNameVal, $singleFieldStr);
                    $singleFieldStr = str_replace('$FIELD_NAME_TITLE$', Str::title(str_replace('_', ' ', $field['fieldName'])), $singleFieldStr);
                    $singleFieldStr = str_replace('$FIELD_NAME$', $field['fieldName'], $singleFieldStr);
                    $singleFieldStr = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $singleFieldStr);
                    $fieldsStr .= $singleFieldStr."\n\n";
                }
            }else{
                $singleFieldStr = str_replace('$FIELD_NAME_TITLE$', Str::title(str_replace('_', ' ', $field['fieldName'])), $fieldTemplate);
                $singleFieldStr = str_replace('$FIELD_NAME$', $field['fieldName'], $singleFieldStr);
                $singleFieldStr = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $singleFieldStr);

                $fieldsStr .= $singleFieldStr."\n\n";
            }
            
        }

        $templateLang = $this->commandData->templatesHelper->getTemplate('show_fields', $this->langsPath);
        $templateLang = str_replace('$SHOW_FIELDS_LANG$', $fieldsLang, $templateLang);

        $templateLang = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateLang);

        $fileName = 'show_fields.blade.php';
        $pathLang = $this->path_lang.str_replace('.blade', '', $fileName);

        $path = $this->path.$fileName;

        $this->commandData->fileHelper->writeFile($path, $fieldsStr);
        $this->commandData->commandObj->info('show-field.blade.php created');

        $this->commandData->fileHelper->writeFile($pathLang, $templateLang);
        $this->commandData->commandObj->info('show_fields.php created');
    }

    private function generateIndex()
    {
        
        $langStr ="'model_name'=>'".$this->commandData->modelNamePlural."',\n";
        $langStr .="'add_new'=>'Add New',\n";
        $langStr .="'no_model_found'=>'No ".$this->commandData->modelNamePlural." found.',\n";
        
        $templateData = $this->commandData->templatesHelper->getTemplate('index.blade', $this->viewsPath);
        $templateLang = $this->commandData->templatesHelper->getTemplate('index', $this->langsPath);

        if ($this->commandData->paginate) {
            $paginateTemplate = $this->commandData->templatesHelper->getTemplate('paginate.blade', 'scaffold/views');

            $paginateTemplate = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $paginateTemplate);

            $templateData = str_replace('$PAGINATE$', $paginateTemplate, $templateData);
        } else {
            $templateData = str_replace('$PAGINATE$', '', $templateData);
        }

        $templateLang = str_replace('$INDEX_LANG$', $langStr, $templateLang);

        $templateData = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateData);
        $templateLang = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateLang);

        $fileName = 'index.blade.php';

        $path = $this->path.$fileName;
        $pathLang = $this->path_lang.str_replace('.blade', '', $fileName);

        $this->commandData->fileHelper->writeFile($path, $templateData);
        $this->commandData->commandObj->info('index.blade.php created');

        $this->commandData->fileHelper->writeFile($pathLang, $templateLang);
        $this->commandData->commandObj->info('index.php created');
    }

    private function generateTable()
    {
        $fieldsLang = '';

        $templateData = $this->commandData->templatesHelper->getTemplate('table.blade', $this->viewsPath);
        $templateLang = $this->commandData->templatesHelper->getTemplate('table', $this->langsPath);

        $fileName = 'table.blade.php';

        $headerFields = '';

        foreach ($this->commandData->inputFields as $field) {
            $headerFields .= '<th>@lang(\'$MODEL_NAME_PLURAL_CAMEL$/table.'.$field['fieldName']."')</th>\n\t\t\t";
            $fieldsLang .="'".$field['fieldName']."'=>'". Str::title(str_replace('_', ' ', $field['fieldName'])) ."',\n";
        }

        $fieldsLang .="'action'=>'Action',\n";
        $fieldsLang .="'delete_confirm_message'=>'Are you sure wants to delete this ".$this->commandData->modelName."?',\n";

        $headerFields = trim($headerFields);

        $templateData = str_replace('$FIELD_HEADERS$', $headerFields, $templateData);
        $templateLang = str_replace('$TABLE_LANG$', $fieldsLang, $templateLang);

        $tableBodyFields = '';

        foreach ($this->commandData->inputFields as $field) {
            if($field['type'] == 'pointer'){
                $arr = explode(',', $field['typeOptions']);
                if(count($arr) > 0){
                    $modelName = $arr[0];
                    $modelNameVal = $arr[1];
                    $tableBodyFields .= '<td>{!! $'.$this->commandData->modelNameCamel.'->'.Str::camel($modelName).'->'.$modelNameVal." !!}</td>\n\t\t\t";
                }
            }
            else
                $tableBodyFields .= '<td>{!! $'.$this->commandData->modelNameCamel.'->'.$field['fieldName']." !!}</td>\n\t\t\t";

        }

        $tableBodyFields = trim($tableBodyFields);

        $templateData = str_replace('$FIELD_BODY$', $tableBodyFields, $templateData);

        $templateData = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateData);
        $templateLang = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateLang);

        $path = $this->path.$fileName;
        $pathLang = $this->path_lang.str_replace('.blade', '', $fileName);

        $this->commandData->fileHelper->writeFile($path, $templateData);
        $this->commandData->commandObj->info('table.blade.php created');

        $this->commandData->fileHelper->writeFile($pathLang, $templateLang);
        $this->commandData->commandObj->info('table.php created');
    }

    private function generateShow()
    {
        $langStr ="'model_detail'=>'".$this->commandData->modelName." Detail',\n";

        $templateData = $this->commandData->templatesHelper->getTemplate('show.blade', $this->viewsPath);
        $templateLang = $this->commandData->templatesHelper->getTemplate('show', $this->langsPath);

        $templateLang = str_replace('$SHOW_LANG$', $langStr, $templateLang);

        $templateData = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateData);
        $templateLang = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateLang);

        $fileName = 'show.blade.php';
        $pathLang = $this->path_lang.str_replace('.blade', '', $fileName);

        $path = $this->path.$fileName;

        $this->commandData->fileHelper->writeFile($path, $templateData);
        $this->commandData->commandObj->info('show.blade.php created');

        $this->commandData->fileHelper->writeFile($pathLang, $templateLang);
        $this->commandData->commandObj->info('show.php created');
    }

    private function generateCreate()
    {
        $langStr ="'new_model'=>'New ".$this->commandData->modelName."',\n";

        $templateData = $this->commandData->templatesHelper->getTemplate('create.blade', $this->viewsPath);
        $templateLang = $this->commandData->templatesHelper->getTemplate('create', $this->langsPath);

        $templateLang = str_replace('$CREATE_LANG$', $langStr, $templateLang);

        $templateData = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateData);
        $templateLang = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateLang);

        $fileName = 'create.blade.php';

        $path = $this->path.$fileName;
        $pathLang = $this->path_lang.str_replace('.blade', '', $fileName);

        $this->commandData->fileHelper->writeFile($path, $templateData);
        $this->commandData->commandObj->info('create.blade.php created');

        $this->commandData->fileHelper->writeFile($pathLang, $templateLang);
        $this->commandData->commandObj->info('create.php created');
    }

    private function generateEdit()
    {
        $langStr ="'edit_model'=>'Edit ".$this->commandData->modelName."',\n";

        $templateData = $this->commandData->templatesHelper->getTemplate('edit.blade', $this->viewsPath);
        $templateLang = $this->commandData->templatesHelper->getTemplate('edit', $this->langsPath);

        $templateLang = str_replace('$EDIT_LANG$', $langStr, $templateLang);

        $templateData = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateData);
        $templateData = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateData);

        $fileName = 'edit.blade.php';

        $path = $this->path.$fileName;
        $pathLang = $this->path_lang.str_replace('.blade', '', $fileName);

        $this->commandData->fileHelper->writeFile($path, $templateData);
        $this->commandData->commandObj->info('edit.blade.php created');

        $this->commandData->fileHelper->writeFile($pathLang, $templateLang);
        $this->commandData->commandObj->info('edit.php created');
    }
}
