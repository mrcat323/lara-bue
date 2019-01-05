<?php

namespace LaraBue;

use \Illuminate\Foundation\Console\Presets\Preset;

use \Illuminate\Support\Facades\File;

use \Illuminate\Support\Arr;

class LaraBue extends Preset
{
    public static function install() 
    {
        static::cleanSassDirectory();
        static::cleanJSDirectory();
        static::updatePackages();
        static::updateResources();
    }
    
    public static function cleanSassDirectory() 
    {
        return File::cleanDirectory(resource_path('sass'));
    }
    
    public static function cleanJSDirectory() 
    {
        return File::cleanDirectory(resource_path('js'));
    }
    
    public static function updatePackageArray($packages) 
    {
        return array_merge([
            'buefy' => '0.7.1'
        ], Arr::except($packages, [
            'popper.js',
            'jquery'
        ]));
    }
    
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
