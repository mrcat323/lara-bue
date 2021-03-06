<?php

namespace LaraBue;

use \Illuminate\Support\ServiceProvider;

use \Illuminate\Foundation\Console\PresetCommand;

use \LaraBue\LaraBue;

class LaraBueProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    
    public function boot()
    {
        PresetCommand::macro('bue', function ($command) {
            if ($command->confirm('Would you like to install Vuex ?', true)) {
                LaraBue::$vuex = true;
            }
            LaraBue::install();
            $command->info('Bue scaffolding installed successfully!');
            $command->comment('Please run "npm install && npm run dev" to compile your fresh scaffolding');
        });
    }
}
