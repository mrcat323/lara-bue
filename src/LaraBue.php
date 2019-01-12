<?php

namespace LaraBue;

use \Illuminate\Foundation\Console\Presets\Preset;

use \Illuminate\Support\Facades\File;

use \Illuminate\Support\Arr;

use \Illuminate\Foundation\Application as App;

class LaraBue extends Preset
{
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
        return File::cleanDirectory(resource_path('sass'));
    }
    
    /**
     * Clear JS directory in resources
     * 
     * @return void
     */
    
    public static function cleanJSDirectory() 
    {
        return File::cleanDirectory(resource_path('js'));
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
        return array_merge([
            'buefy' => '0.7.1',
            'vue-router' => '3.0.1'
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
}
