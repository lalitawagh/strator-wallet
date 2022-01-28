<?php

namespace Kanexy\LedgerFoundation;

use Illuminate\Support\Facades\Gate;
use Kanexy\Cms\Facades\Cms;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\Cms\Traits\InteractsWithMigrations;
use Kanexy\LedgerFoundation\Http\Policies\CommodityTypePolicy;
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
        '2021_11_18_090541_create_ledgers_table',
        '2022_01_17_130105_create_wallets_table'
    ];

    private array $policies = [
        Setting::class => CommodityTypePolicy::class,
    ];

    public function registerDefaultPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }
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

        $this->registerDefaultPolicies();

        \Kanexy\Cms\Facades\SidebarMenu::addItem(new WalletMenuItem());
        \Kanexy\Cms\Facades\SidebarMenu::addItem(new WalletConfigurationMenuItem());
        \Kanexy\Cms\Facades\SignupViewContent::addItem(new WalletContent());

        Cms::setRedirectRouteAfterRegistrationEmailVerification(function (){
            return route("customer.signup.wallet.create");
        });

        PartnerFoundation::setRedirectRouteAfterBanking(function () {
            return route("customer.signup.wallet.create");
        });

        Livewire::component('ledger-config-field-component', LedgerConfigFieldComponent::class);
    }
}
