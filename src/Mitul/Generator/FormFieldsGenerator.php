<?php

namespace Mitul\Generator;

use Illuminate\Support\Str;

class FormFieldsGenerator
{
    public static function generateLabel($field)
    {
        $label = Str::title(str_replace('_', ' ', $field['fieldName']));

        $template = "{!! Form::label('\$FIELD_NAME\$', '\$FIELD_NAME_TITLE\$:') !!}";

        $template = str_replace('$FIELD_NAME_TITLE$', $label, $template);
        $template = str_replace('$FIELD_NAME$', $field['fieldName'], $template);

        return $template;
    }

    private static function replaceFieldVars($textField, $field)
    {
        $label = Str::title(str_replace('_', ' ', $field['fieldName']));

        $textField = str_replace('$FIELD_NAME$', $field['fieldName'], $textField);
        $textField = str_replace('$FIELD_NAME_TITLE$', $label, $textField);
        $textField = str_replace('$FIELD_INPUT$', $textField, $textField);

        return $textField;
    }

    public static function text($templateData, $field)
    {
        //$textField = self::generateLabel($field);

        $textField = "\n\t\t\t{!! Form::text('\$FIELD_NAME\$', null, ['class' => 'form-control']) !!}";

        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function textarea($templateData, $field)
    {
        //$textareaField = self::generateLabel($field);

        $textareaField = "\n\t\t\t{!! Form::textarea('\$FIELD_NAME\$', null, ['class' => 'form-control']) !!}";

        $templateData = str_replace('$FIELD_INPUT$', $textareaField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function password($templateData, $field)
    {
        //$textField = self::generateLabel($field);

        $textField = "\n\t\t\t{!! Form::password('\$FIELD_NAME\$', ['class' => 'form-control']) !!}";

        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function email($templateData, $field)
    {
        //$textField = self::generateLabel($field);

        $textField = "\n\t\t\t{!! Form::email('\$FIELD_NAME\$', null, ['class' => 'form-control']) !!}";
        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function file($templateData, $field)
    {
        //$textField = self::generateLabel($field);

        $textField = "\n\t\t\t{!! Form::file('\$FIELD_NAME\$') !!}";

        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function checkbox($templateData, $field)
    {
        $textField = "<div class=\"checkbox\">\n";
        $textField .= "\t\t\t\t<label>";

        $textField .= "{!! Form::checkbox('\$FIELD_NAME\$', 1, true) !!}";
        $textField .= '<span>$FIELD_NAME_TITLE$</span>';

        $textField .= '</label>';
        $textField .= "\n\t\t\t</div>";

        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function radio($templateData, $field)
    {
        $textField = "";

        if (count($field['typeOptions']) > 0) {
            $arr = explode(',', $field['typeOptions']);

            foreach ($arr as $item) {
                $label = Str::title(str_replace('_', ' ', $item));

                $textField .= "\n\t\t\t<div class=\"radio-inline\">";
                $textField .= "\n\t\t\t\t\t\t<label>";

                $textField .= "\n\t\t\t\t\t\t\t\t\t{!! Form::radio('\$FIELD_NAME\$', '".$item."', null) !!} <span>$label</span>";

                $textField .= "\n\t\t\t\t\t\t</label>";
                $textField .= "\n\t\t\t</div>";
            }
        }

        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function number($templateData, $field)
    {
        //$textField = self::generateLabel($field);

        $textField = "\n\t\t\t{!! Form::number('\$FIELD_NAME\$', null, ['class' => 'form-control']) !!}";
        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function date($templateData, $field)
    {
        //$textField = self::generateLabel($field);

        $textField = "\n\t\t\t\t{!! Form::text('\$FIELD_NAME\$', null, ['class' => 'form-control']) !!}";
        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function select($templateData, $field)
    {
        //$textField = self::generateLabel($field);

        $textField = "\n\t\t\t{!! Form::select('\$FIELD_NAME\$', \$INPUT_ARR\$, null, ['class' => 'select2able']) !!}";
        $textField = str_replace('$FIELD_NAME$', $field['fieldName'], $textField);

        if (count($field['typeOptions']) > 0) {
            $arr = explode(',', $field['typeOptions']);
            $inputArr = '[';
            foreach ($arr as $item) {
                $inputArr .= " '$item' => '$item',";
            }

            $inputArr = substr($inputArr, 0, strlen($inputArr) - 1);

            $inputArr .= ' ]';

            $textField = str_replace('$INPUT_ARR$', $inputArr, $textField);
        } else {
            $textField = str_replace('$INPUT_ARR$', '[]', $textField);
        }

        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function pointer($templateData, $field)
    {
        if (count($field['typeOptions']) > 0) {

            $arr = explode(',', $field['typeOptions']);

            $templateData = str_replace('$POINTER_MODEL_NAME_CAMEL_PLURAL$', Str::camel(Str::plural($arr[0])), $templateData);

            $templateData = self::replaceFieldVars($templateData, $field);

        }

        return $templateData;
    }
}
