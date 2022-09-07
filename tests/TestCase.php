<?php

namespace Kanexy\LedgerFoundation\Tests;

use AmrShawky\LaravelCurrency\CurrencyServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Kanexy\Cms\CmsServiceProvider;
use Kanexy\LedgerFoundation\LedgerFoundationServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Permission\PermissionServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Kanexy\\LedgerFoundation\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );

        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }

    protected function getPackageProviders($app)
    {
        return [
            LedgerFoundationServiceProvider::class,
            CmsServiceProvider::class,
            LivewireServiceProvider::class,
            CurrencyServiceProvider::class,
            PermissionServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {

        $app['config']->set('view.paths', [
            __DIR__ . '/views',
            resource_path('views'),
        ]);

        $app['config']->set('app.key', 'base64:Hupx3yAySikrM2/edkZQNQHslgDWYfiBfCuSThJ5SK8=');

        $app['config']->set('database.connections.mysql', [
            'driver'   => 'mysql',
            'database' => 'kanexy',
            'prefix'   => '',
            'host' => '127.0.0.1',
            'username'=> 'root',
            'password' => '',
        ]);
    }
}
