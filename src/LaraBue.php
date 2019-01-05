<?php

namespace LaraBue;

use \Illuminate\Foundation\Console\Presets\Preset;

use \Illuminate\Support\Facades\File;

use \Illuminate\Support\Arr;

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
            'buefy' => '0.7.1'
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
    }
}