<?php

namespace Gavoronok30\LaravelGeneratorConfigurable\Providers;

use Gavoronok30\LaravelGeneratorConfigurable\Console\Commands\GeneratorCommand;
use Gavoronok30\LaravelGeneratorConfigurable\GeneratorService;
use Gavoronok30\LaravelGeneratorConfigurable\GeneratorServiceInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Routing\Router;

/**
 * Class GeneratorServiceProvider
 * @package Gavoronok30\LaravelGeneratorConfigurable\Providers
 */
class GeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadCustomCommands();
        $this->loadCustomConfig();

        if (!Config::get('generator.enable')) {
            return;
        }

        $this->loadCustomPublished();
        $this->loadCustomView();
        $this->loadCustomClasses();
        $this->loadCustomRoutes();
        $this->loadCustomDisk();
    }

    /**
     * @return void
     */
    private function loadCustomCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands(
                GeneratorCommand::class
            );
        }
    }

    /**
     * @return void
     */
    private function loadCustomConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/generator.php', 'generator');
    }

    /**
     * @return void
     */
    private function loadCustomPublished()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../../config' => base_path('config')
                ],
                'config'
            );
            $this->publishes(
                [
                    __DIR__ . '/../../resources/views/templates' => Config::get('generator.templates')
                ],
                'resources'
            );
        }
    }

    /**
     * @return void
     */
    private function loadCustomView()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/page', 'generator');

        View::composer(
            'generator::page',
            function (\Illuminate\Contracts\View\View $view) {
                $view->with(
                    'js',
                    [
                        __DIR__ . '/../../assets/js/chunk-vendors.js',
                        __DIR__ . '/../../assets/js/app.js',
                    ]
                );
                $view->with(
                    'css',
                    [
                        __DIR__ . '/../../assets/css/main.css',
                        __DIR__ . '/../../assets/css/bootstrap.min.css',
                        __DIR__ . '/../../assets/css/app.css',
                    ]
                );
            }
        );
    }

    /**
     * @return void
     */
    private function loadCustomClasses()
    {
        $this->app->singleton(GeneratorServiceInterface::class, GeneratorService::class);
    }

    /**
     * @return void
     */
    private function loadCustomRoutes()
    {
        $option = [
            'prefix' => 'generator',
            'namespace' => 'Gavoronok30\LaravelGeneratorConfigurable\Http\Controllers',
        ];

        $this->app->router->group(
            $option,
            function (Router $router) {
                $router->get(
                    '/',
                    [
                        'uses' => 'GeneratorController@page',
                        'as' => 'generator.page',
                    ]
                );
            }
        );

        $this->app->router->group(
            $option,
            function (Router $router) {
                $router->post(
                    'check',
                    [
                        'uses' => 'GeneratorController@check',
                        'as' => 'generator.check',
                    ]
                );
            }
        );

        $this->app->router->group(
            $option,
            function (Router $router) {
                $router->post(
                    'generate',
                    [
                        'uses' => 'GeneratorController@generate',
                        'as' => 'generator.generate',
                    ]
                );
            }
        );
    }

    /**
     * @return void
     */
    private function loadCustomDisk()
    {
        $config = Config::get('filesystems.disks', []);
        $config[GeneratorServiceInterface::FILESYSTEM_DISK] = [
            'driver' => 'local',
            'root' => Config::get('generator.testMode') ? Config::get('generator.testFolder') : base_path(),
        ];
        Config::set('filesystems.disks', $config);
    }
}