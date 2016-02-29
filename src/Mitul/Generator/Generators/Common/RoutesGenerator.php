<?php

namespace Mitul\Generator\Generators\Common;

use Config;
use Mitul\Generator\CommandData;
use Mitul\Generator\Generators\GeneratorProvider;
use Mitul\Generator\Utils\GeneratorUtils;

class RoutesGenerator implements GeneratorProvider
{
    /** @var  CommandData */
    private $commandData;

    /** @var string */
    private $path;

    /** @var string */
    private $apiPath;

    /** @var string */
    private $scaffoldPath;

    /** @var bool */
    private $useDingo;

    public function __construct($commandData)
    {
        $this->commandData = $commandData;
        $this->path = Config::get('generator.path_routes', app_path('Http/routes.php'));
        $this->apiPath = Config::get('generator.path_api_routes', app_path('Http/api_routes.php'));
        $this->scaffoldPath = Config::get('generator.path_scaffold_routes', app_path('Http/scaffold_routes.php'));
        $this->useDingo = Config::get('generator.use_dingo_api', false);
    }

    public function generate()
    {
        if ($this->commandData->commandType == CommandData::$COMMAND_TYPE_API) {
            $this->generateAPIRoutes();
        } elseif ($this->commandData->commandType == CommandData::$COMMAND_TYPE_SCAFFOLD) {
            $this->generateScaffoldRoutes();
        } elseif ($this->commandData->commandType == CommandData::$COMMAND_TYPE_SCAFFOLD_API) {
            $this->generateAPIRoutes();
            $this->generateScaffoldRoutes();
        }
    }

    private function generateAPIRoutes()
    {
        $routeContents = $this->commandData->fileHelper->getFileContents($this->apiPath);

        if ($this->useDingo) {
            $routeContents .= "\n\n".'$api->resource("'.$this->commandData->modelNamePluralCamel.'", "'.$this->commandData->modelName.'APIController");';
        } else {
            $routeContents .= "\n\n".'Route::resource("'.$this->commandData->modelNamePluralCamel.'", "'.$this->commandData->modelName.'APIController");';
        }

        $this->commandData->fileHelper->writeFile($this->apiPath, $routeContents);
        $this->commandData->commandObj->comment("\napi_routes.php modified:");
        $this->commandData->commandObj->info('"'.$this->commandData->modelNamePluralCamel.'" route added.');
    }

    private function generateScaffoldRoutes()
    {
        $routeContents = $this->commandData->fileHelper->getFileContents($this->scaffoldPath);

        $templateData = $this->commandData->templatesHelper->getTemplate('scaffold_route', 'routes');

        $templateData = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateData);

        $routeContents .= "\n\n".$templateData;

        $this->commandData->fileHelper->writeFile($this->scaffoldPath, $routeContents);
        $this->commandData->commandObj->comment("\nscaffold_routes.php modified:");
        $this->commandData->commandObj->info('"'.$this->commandData->modelNamePluralCamel.'" route added.');
    }
}
