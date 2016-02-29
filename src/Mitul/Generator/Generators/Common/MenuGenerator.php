<?php

namespace Mitul\Generator\Generators\Common;

use Mitul\Generator\CommandData;
use Mitul\Generator\Generators\GeneratorProvider;
use Mitul\Generator\Utils\GeneratorUtils;

class MenuGenerator implements GeneratorProvider
{
    /** @var  CommandData */
    private $commandData;

    /** @var string */
    private $path;

    public function __construct($commandData)
    {
        $this->commandData = $commandData;
        $this->path = base_path('resources/views/layouts/menus.blade.php');
    }

    public function generate()
    {
        $this->generateMenu();
    }

    private function generateMenu()
    {
        $menuContents = $this->commandData->fileHelper->getFileContents($this->path);

        $templateData = $this->commandData->templatesHelper->getTemplate('scaffold_menus', 'menus');

        $templateData = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateData);

        $menuContents .= "\n\n".$templateData;

        $this->commandData->fileHelper->writeFile($this->path, $menuContents);
        $this->commandData->commandObj->comment("\nmenus.blade.php modified:");
        $this->commandData->commandObj->info('"'.$this->commandData->modelNamePluralCamel.'" menu added.');
    }
}
