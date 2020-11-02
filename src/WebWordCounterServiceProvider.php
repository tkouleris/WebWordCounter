<?php

namespace tkouleris\WebWordCounter;

use Illuminate\Support\ServiceProvider;

class WebWordCounterServiceProvider extends ServiceProvider
{
    public function boot()
    {
//        $this->app->register(Symfony\Component\DomCrawler\Crawler::class );
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }

    public function register()
    {

    }
}
