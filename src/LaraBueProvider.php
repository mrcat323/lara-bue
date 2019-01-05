<?php

namespace LaraBue;

use Illuminate\Support\ServiceProvider;

use LaraBue\LaraBue;

use Illuminate\Foundation\Console\PresetCommand;

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
            LaraBue::install();
            $command->info('Bue scaffolding installed successfully!');
            $command->comment('Please run "npm install && npm run dev" to compile your fresh scaffolding');
        });
    }
}
