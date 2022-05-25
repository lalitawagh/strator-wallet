<?php

namespace Kanexy\LedgerFoundation\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kanexy\Cms\CmsServiceProvider;
use Kanexy\LedgerFoundation\PartnerFoundationServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Kanexy\\
            LedgerFoundation\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            PartnerFoundationServiceProvider::class,
            LivewireServiceProvider::class,
            CmsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {

        $app['config']->set('view.paths', [
            __DIR__.'/views',
            resource_path('views'),
        ]);

        $app['config']->set('app.key', 'base64:Hupx3yAySikrM2/edkZQNQHslgDWYfiBfCuSThJ5SK8=');

        $app['config']->set('database.connections.mysql', [
            'driver'   => 'mysql',
            'database' => 'kanexyv1',
            'prefix'   => '',
            'host' => '127.0.0.1',
            'username'=> 'root',
            'password' => ''
        ]);
    }
}
