<?php

namespace Kanexy\LedgerFoundation;

use Kanexy\Cms\Facades\Cms;
use Kanexy\Cms\Traits\InteractsWithMigrations;
use Kanexy\LedgerFoundation\Livewire\LedgerConfigFieldComponent;
use Kanexy\LedgerFoundation\Menu\WalletConfigurationMenuItem;
use Kanexy\LedgerFoundation\Menu\WalletMenuItem;
use Kanexy\LedgerFoundation\Wallet\WalletContent;
use Kanexy\PartnerFoundation\Core\Facades\PartnerFoundation;
use Livewire\Livewire;
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

    protected array $migrationsWithPresetDateTime = [
        '2021_11_11_131746_create_asset_types_table',
        '2021_11_11_131923_create_asset_classes_table',
        '2021_11_18_090458_create_commodity_types_table',
        '2021_11_18_090541_create_ledgers_table',
        '2022_01_18_012628_create_fees_table'
    ];

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
            ->hasMigrations($this->migrationsWithPresetDateTime);

        $this->publishMigrationsWithPresetDateTime($this->migrationsWithoutPresetDateTime);
    }

    public function packageRegistered()
    {
    }

    public function packageBooted()
    {
        parent::packageBooted();
        \Kanexy\Cms\Facades\SidebarMenu::addItem(new WalletMenuItem());
        \Kanexy\Cms\Facades\SidebarMenu::addItem(new WalletConfigurationMenuItem());
        \Kanexy\Cms\Facades\RegistrationContent::addItem(WalletContent::class);

        Cms::setRedirectRouteAfterRegistrationEmailVerification(function (){
            return route("customer.signup.wallet.create");
        });

        PartnerFoundation::setRedirectRouteAfterBanking(function () {
            return route("customer.signup.wallet.create");
        });

        Livewire::component('ledger-config-field-component', LedgerConfigFieldComponent::class);
    }
}
