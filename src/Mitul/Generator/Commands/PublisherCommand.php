<?php

namespace Mitul\Generator\Commands;

use Config;
use File;
use Illuminate\Console\Command;
use Mitul\Generator\CommandData;
use Mitul\Generator\File\FileHelper;
use Mitul\Generator\TemplatesHelper;
use Mitul\Generator\Utils\GeneratorUtils;
use Symfony\Component\Console\Input\InputOption;

class PublisherCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'mitul.generator:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishes a various things of generator.';

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->option('all')) {
            $this->publishCommonViews();
            $this->publishAPIRoutes();
            $this->publishScaffoldRoutes();
            $this->initAPIRoutes();
            $this->publishTemplates();
            $this->publishAppBaseController();
        } elseif ($this->option('templates')) {
            $this->publishTemplates();
        } elseif ($this->option('baseController')) {
            $this->publishAppBaseController();
        } else {
            $this->publishCommonViews();
            $this->publishAPIRoutes();
            $this->publishScaffoldRoutes();
            $this->initAPIRoutes();
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            ['templates', null, InputOption::VALUE_NONE, 'Publish templates'],
            ['baseController', null, InputOption::VALUE_NONE, 'Publish base controller'],
            ['all', null, InputOption::VALUE_NONE, 'Publish all options'],
        ];
    }

    /**
     * Publishes templates.
     */
    public function publishTemplates()
    {
        $templatesPath = __DIR__.'/../../../../templates';

        $templatesCopyPath = base_path('resources/api-generator-templates');

        $this->publishDirectory($templatesPath, $templatesCopyPath, 'templates');
    }

    /**
     * Publishes common views.
     */
    public function publishCommonViews()
    {
        $controllerPath         = __DIR__.'/../../../../controllers';

        $exceptionPath         = __DIR__.'/../../../../exceptions';

        $middlewarePath         = __DIR__.'/../../../../middleware';

        $requestPath            = __DIR__.'/../../../../requests';

        $generatorPath          = __DIR__.'/../../../../views/generators';

        $viewsPath              = __DIR__.'/../../../../views/common';

        $errorsPath             = __DIR__.'/../../../../views/errors';

        $viewsPathForTemplate   = __DIR__.'/../../../../views/template';

        $viewsPathForLayout     = __DIR__.'/../../../../views/layout';

        $viewsPathForAuth       = __DIR__.'/../../../../views/auth';

        $controllerCopyPath = base_path('app/Http/Controllers');

        $exceptionCopyPath = base_path('app/Exceptions');

        $middlewareCopyPath = base_path('app/Http/Middleware');

        $requestCopyPath = base_path('app/Http/Requests');

        $generatorCopyPath = base_path('resources/views/generators');

        $viewsCopyPath = base_path('resources/views/common');

        $errorsCopyPath = base_path('resources/views/errors');

        $viewsCopyPathForTemplate = base_path('public/admin');

        $viewsCopyPathForLayout = base_path('resources/views/layouts');

        $viewsCopyPathForAuth = base_path('resources/views/auth');

        $this->publishDirectory($controllerPath, $controllerCopyPath, 'generator controller');
        $this->publishDirectory($exceptionPath, $exceptionCopyPath, 'generator exception');
        $this->publishDirectory($middlewarePath, $middlewareCopyPath, 'generator middleware');
        $this->publishDirectory($controllerPath, $controllerCopyPath, 'generator controller');
        $this->publishDirectory($requestPath, $requestCopyPath, 'generator requests');
        $this->publishDirectory($generatorPath, $generatorCopyPath, 'generator views');
        $this->publishDirectory($viewsPath, $viewsCopyPath, 'common views');
        $this->publishDirectory($errorsPath, $errorsCopyPath, 'error views');
        $this->publishDirectory($viewsPathForTemplate, $viewsCopyPathForTemplate, 'template views');
        $this->publishDirectory($viewsPathForLayout, $viewsCopyPathForLayout, 'layout views');
        $this->publishDirectory($viewsPathForAuth, $viewsCopyPathForAuth, 'auth views');
    }

    /**
     * Publishes base controller.
     */
    private function publishAppBaseController()
    {
        $templateHelper = new TemplatesHelper();
        $templateData = $templateHelper->getTemplate('AppBaseController', 'controller');

        $templateData = GeneratorUtils::fillTemplate(CommandData::getConfigDynamicVariables(), $templateData);

        $fileName = 'AppBaseController.php';

        $filePath = Config::get('generator.path_controller', app_path('Http/Controllers/'));

        $fileHelper = new FileHelper();
        $fileHelper->writeFile($filePath.$fileName, $templateData);
        $this->comment('AppBaseController generated');
        $this->info($fileName);
    }

    /**
     * Publishes api_routes.php.
     */
    public function publishAPIRoutes()
    {
        $routesPath = __DIR__.'/../../../../templates/routes/api_routes.stub';

        $apiRoutesPath = Config::get('generator.path_api_routes', app_path('Http/api_routes.php'));

        $this->publishFile($routesPath, $apiRoutesPath, 'api_routes.php');
    }

    /**
     * Publishes scaffold_routes.php.
     */
    public function publishScaffoldRoutes()
    {
        $routesPath = __DIR__.'/../../../../templates/routes/scaffold_routes.stub';

        $apiRoutesPath = Config::get('generator.path_scaffold_routes', app_path('Http/scaffold_routes.php'));

        $this->publishFile($routesPath, $apiRoutesPath, 'scaffold_routes.php');
    }

    public function publishFile($sourceFile, $destinationFile, $fileName)
    {
        if (file_exists($destinationFile)) {
            $answer = $this->ask('Do you want to overwrite '.$fileName.'? (y|N) :', false);

            if (strtolower($answer) != 'y' and strtolower($answer) != 'yes') {
                return;
            }
        }

        copy($sourceFile, $destinationFile);

        $this->comment($fileName.' generated');
        $this->info($destinationFile);
    }

    public function publishDirectory($sourceDir, $destinationDir, $dirName)
    {
        if (file_exists($destinationDir)) {
            $answer = $this->ask('Do you want to overwrite '.$dirName.'? (y|N) :', false);

            if (strtolower($answer) != 'y' and strtolower($answer) != 'yes') {
                return;
            }
        } else {
            File::makeDirectory($destinationDir);
        }

        File::copyDirectory($sourceDir, $destinationDir);

        $this->comment($dirName.' published');
        $this->info($destinationDir);
    }

    /**
     * Initialize routes group based on route integration.
     */
    private function initAPIRoutes()
    {
        $path = Config::get('generator.path_routes', app_path('Http/routes.php'));

        $fileHelper = new FileHelper();
        $routeContents = $fileHelper->getFileContents($path);

        $useDingo = Config::get('generator.use_dingo_api', false);

        if ($useDingo) {
            $template = 'dingo_api_routes_group';
        } else {
            $template = 'api_routes_group';
        }

        $templateHelper = new TemplatesHelper();
        $templateData = $templateHelper->getTemplate($template, 'routes');

        $templateData = $this->fillTemplate($templateData);

        $fileHelper->writeFile($path, $routeContents."\n\n".$templateData);
        $this->comment("\nAPI group added to routes.php");
    }

    /**
     * Replaces dynamic variables of template.
     *
     * @param string $templateData
     *
     * @return string
     */
    private function fillTemplate($templateData)
    {
        $apiVersion = Config::get('generator.api_version');
        $apiPrefix = Config::get('generator.api_prefix');
        $adminPrefix = Config::get('generator.admin_prefix');
        $apiNamespace = Config::get('generator.namespace_api_controller');

        $templateData = str_replace('$API_VERSION$', $apiVersion, $templateData);
        $templateData = str_replace('$NAMESPACE_API_CONTROLLER$', $apiNamespace, $templateData);
        $templateData = str_replace('$API_PREFIX$', $apiPrefix, $templateData);
        $templateData = str_replace('$ADMIN_PREFIX$', $adminPrefix, $templateData);

        return $templateData;
    }
}
