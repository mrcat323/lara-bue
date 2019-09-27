<?php

namespace LaraBue;

use \Illuminate\Foundation\Console\Presets\Preset;
use \Illuminate\Support\Arr;
use \Illuminate\Foundation\Application as App;
use File;

final class LaraBue extends Preset
{
    /**
     * This helps to know user interests: Install Vuex Store or not
     *
     * @var boolean
     */

    public static $vuex;

    /**
     * Install all.
     * Clean assets/resources
     * Update package.json file with necessary dependencies
     * Update resources directory with needed file
     *
     * @return void
     */
    public static function install()
    {
        static::cleanSassDirectory();
        static::cleanJSDirectory();
        static::updatePackages();
        static::updateResources();
        static::loadRoutes();
        static::loadControllers();
        static::loadViews();
    }

    /**
     * Grabbing Laravel App version
     *
     * @return float $version
     */
    public static function grabAppVersion()
    {
        $version = (float) App::VERSION;
        return $version;
    }

    /**
     * Clear sass directory in resources
     *
     * @return void
     */
    public static function cleanSassDirectory()
    {
        return (static::grabAppVersion() <= 5.6) ? File::cleanDirectory(resource_path('assets/sass')) : File::cleanDirectory(resource_path('sass'));
    }

    /**
     * Clear JS directory in resources
     *
     * @return void
     */
    public static function cleanJSDirectory()
    {
        return (static::grabAppVersion() <= 5.6) ? File::cleanDirectory(resource_path('assets/js')) : File::cleanDirectory(resource_path('js'));
    }

    /**
     * Placing all necessary packages in package.json file
     *
     * @param array $packages
     *
     * @return mixed
     */
    public static function updatePackageArray(array $packages)
    {
        if (static::$vuex) {
            $packages = array_merge(['vuex' => '3.1.1'], $packages);
            static::loadStore();
        }

        return array_merge([
            'buefy' => '0.8.2',
            'vue' => '2.6.10',
            'vue-router' => '3.1.2',
            'vue-template-compiler' => '2.6.10'
        ], Arr::except($packages, [
            'popper.js',
            'jquery'
        ]));
    }

    /**
     * Update resources directory with all needed file/components
     *
     * @return void
     */
    public static function updateResources()
    {
        return (static::grabAppVersion() <= 5.6) ? static::updateOldResources() : static::updateNewResources();
    }

    /**
     * Method for updating resources directory for Laravel less that 5.6 version
     *
     * @return void
     */
    public static function updateOldResources()
    {
        // SASS stuff copying

        copy(__DIR__ . '/stubs/sass/app.scss', resource_path('assets/sass/app.scss'));

        // JS stuff copying

        copy(__DIR__ . '/stubs/js/app.js', resource_path('assets/js/app.js'));
        copy(__DIR__ . '/stubs/js/bootstrap.js', resource_path('assets/js/bootstrap.js'));

        // everything including components, we just grab components directory from stubs and copy to resources

        File::copyDirectory(__DIR__ . '/stubs/js/components', resource_path('assets/js/components'));

        File::copyDirectory(__DIR__ . '/stubs/js/router', resource_path('assets/js/router'));
    }

    /**
     * Method for updating 'resources' directory for Laravel more than 5.6 version
     *
     * @return void
     */
    public static function updateNewResources()
    {
        // SASS stuff copying

        copy(__DIR__ . '/stubs/sass/app.scss', resource_path('sass/app.scss'));

        // JS stuff copying

        copy(__DIR__ . '/stubs/js/app.js', resource_path('js/app.js'));
        copy(__DIR__ . '/stubs/js/bootstrap.js', resource_path('js/bootstrap.js'));

        // everything including components, we just grab components directory from stubs and copy to resources

        File::copyDirectory(__DIR__ . '/stubs/js/components', resource_path('js/components'));

        File::copyDirectory(__DIR__ . '/stubs/js/router', resource_path('js/router'));
    }

    /**
     * Loading routes from routes-file and replacing it with the main route-file
     *
     * @return void
     */
    public static function loadRoutes()
    {
        copy(__DIR__ . '/routes/main.php', base_path('routes/web.php'));
    }

    /**
     * Loading views from our directory to application's resources/views directory
     *
     * @return void
     */
    public static function loadViews()
    {
        copy(__DIR__ . '/views/init.blade.php', resource_path('views/init.blade.php'));
    }

    /**
     * Grabbing all controllers from that directory to application's controllers directory
     *
     * @return void
     */
    public static function loadControllers()
    {
        copy(__DIR__ . '/controllers/MainController.php', base_path('app/Http/Controllers/MainController.php'));
    }

    /**
     * Loads main Vuex store file into your assets by Laravel versions
     *
     * @return void
     */
    public static function loadStore()
    {
        return (static::grabAppVersion() <= 5.6) ? File::copyDirectory(__DIR__ . '/stubs/js/store', resource_path('assets/js/store')) : File::copyDirectory(__DIR__ . '/stubs/js/store', resource_path('js/store'));
    }
}
