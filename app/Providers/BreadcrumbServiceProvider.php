<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BreadcrumbServiceProvider extends ServiceProvider
{
    public function boot()
    {
        require base_path('routes/breadcrumbs.php');
    }
}