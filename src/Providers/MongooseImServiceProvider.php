<?php
/**
 * Created by PhpStorm.
 * User: kibet
 * Date: 7/3/2018
 * Time: 8:37 AM
 */

namespace MongooseIm\Providers;


use MongooseIm\MongooseIm;
use Illuminate\Support\ServiceProvider;

class MongooseImServiceProvider extends ServiceProvider
{
    public function register()
    {

        $this->publishConfig();

        $this->app->singleton(MongooseIm::class, function ($app) {
            $config = $app['config']->get('mongoose-im');
            return new MongooseIm($config);
        });
    }

    public function provides()
    {
        return MongooseIm::class;
    }

    private function publishConfig()
    {
        $path = $this->getConfigPath();
        $this->publishes([$path => config_path('mongoose-im.php')]);
    }

    private function getConfigPath()
    {
        return __DIR__ . '/../../config/mongoose-im.php';
    }
}
