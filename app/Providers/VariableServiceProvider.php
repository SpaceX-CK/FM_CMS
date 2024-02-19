<?php

namespace App\Providers;

use App\Helpers\Status;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class VariableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->shareVariables();
    }

    private function shareVariables()
    {
        view()->composer(["live-pages.layouts.live"], function ($view) {
            $categories= Category::get();
            $settings= Setting::get();
            $setting_array = [];
            foreach ($settings as $setting) {
                $setting_array[$setting->setting_keys] = $setting->setting_values;
            }
            // dd($setting_array['facebook']);
            $view->with(compact('categories','setting_array'));
        });
    }
}
