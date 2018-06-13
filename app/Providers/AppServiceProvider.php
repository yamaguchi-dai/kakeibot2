<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        DB::listen(function ($query) {
            $sql = $query->sql;
            for ($i = 0; $i < count($query->bindings); $i++) {
                $sql = preg_replace("/\?/", $query->bindings[$i], $sql, 1);
            }
            Log::info($sql);
        });
        
         // Blade::if('タグ名', コールバック)
         Blade::if('isLogin', function () {
        return session('auth') == true?true:false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
