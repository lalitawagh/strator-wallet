<?php

namespace Riteserve\LedgerFoundation;

use Riteserve\Cms\Traits\InteractsWithMigrations;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LedgerFoundationServiceProvider extends PackageServiceProvider
{

    use InteractsWithMigrations;
    /**
     * The date and time for these migrations will be preserved when
     * published.
     *
     * @var array|string[]
     */

    protected array $migrationsWithPresetDateTime = [];

    /**
     * A new date and time for these migrations will be appended in the
     * files when published.
     *
     * @var array|string[]
     */
    protected array $migrationsWithoutPresetDateTime = [];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
         $package
            ->name('ledger-foundation')
            ->hasViews()
            ->hasRoute('web')
            ->hasRoute('api')
            ->hasMigrations($this->migrationsWithoutPresetDateTime);

        $this->publishMigrationsWithPresetDateTime($this->migrationsWithPresetDateTime);
    }

    public function packageRegistered()
    {
    }

    public function packageBooted()
    {
        parent::packageBooted();

    }
}
