<?php

namespace Mdnayeemsarker\RolePermission;

use Illuminate\Support\ServiceProvider;
use function config_path;

class MnsRpServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load migrations automatically
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Publish configuration
        $this->publishes(
            [
                __DIR__ . '/../config/rolepermission.php' => config_path('rolepermission.php'),
            ],
            'rolepermission-config',
        );
        // Publish models
        $this->publishes(
            [
                __DIR__ . '/../src/Models' => app_path('Models'), // Publish models to the app's Models directory
            ],
            'rolepermission-models',
        );
    }

    public function register()
    {
        // Merge default configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/rolepermission.php', 'rolepermission');
    }
}
