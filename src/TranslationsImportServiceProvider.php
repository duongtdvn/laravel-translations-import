<?php

namespace WeDesignIt\LaravelTranslationsImport;

use WeDesignIt\LaravelTranslationsImport\Console\Commands\TranslationsClean;
use WeDesignIt\LaravelTranslationsImport\Console\Commands\TranslationsExport;
use WeDesignIt\LaravelTranslationsImport\Console\Commands\TranslationsFind;
use WeDesignIt\LaravelTranslationsImport\Console\Commands\TranslationsImport;
use WeDesignIt\LaravelTranslationsImport\Console\Commands\TranslationsNuke;
use Illuminate\Support\ServiceProvider;

class TranslationsImportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Register the commands
        $this->commands([
            TranslationsImport::class,
            TranslationsExport::class,
            TranslationsFind::class,
            TranslationsClean::class,
            TranslationsNuke::class
        ]);

        // Merge package config with published config
        $this->mergeConfigFrom(__DIR__ . '/../config/translations-import.php', 'translations-import');
        // Enable publishing of the config
        $this->publishes([__DIR__ . '/../config/translations-import.php' => config_path('translations-import.php')], 'config');

        // Register the manager
        $this->app->singleton('translation-manager', function ($app) {
            return $app->make('WeDesignIt\LaravelTranslationsImport\Manager');
        });
    }
}
