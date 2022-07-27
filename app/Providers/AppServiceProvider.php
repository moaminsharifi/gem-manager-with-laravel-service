<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
        * set default value for string due to Illuminate\Database\QueryException : SQLSTATE[42000] Exception
        * read more at:
        * https://stackoverflow.com/questions/52623867/illuminate-database-queryexception-sqlstate42000
        */
        Schema::defaultStringLength(191);
    }
}
