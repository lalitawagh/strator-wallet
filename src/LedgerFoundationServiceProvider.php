<?php

namespace Kanexy\LedgerFoundation;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Kanexy\Cms\Enums\RegistrationStep;
use Kanexy\Cms\Helper;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\Cms\Traits\InteractsWithMigrations;
use Kanexy\LedgerFoundation\Contracts\LedgerConfiguration;
use Kanexy\LedgerFoundation\Livewire\DepositOtpVerificationComponent;
use Kanexy\LedgerFoundation\Livewire\LedgerConfigFieldComponent;
use Kanexy\LedgerFoundation\Livewire\WalletTransactionDetailComponent;
use Kanexy\LedgerFoundation\Livewire\WalletTransactionsListComponent;
use Kanexy\LedgerFoundation\Livewire\WalletBeneficiary;
use Kanexy\LedgerFoundation\Livewire\WalletPayoutComponent;
use Kanexy\LedgerFoundation\Livewire\DepositWalletComponent;
use Kanexy\LedgerFoundation\Menu\WalletMenuItem;
use Kanexy\LedgerFoundation\Model\ExchangeRate;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\LedgerFoundation\Policies\AssetClassPolicy;
use Kanexy\LedgerFoundation\Policies\AssetTypePolicy;
use Kanexy\LedgerFoundation\Policies\CommodityTypePolicy;
use Kanexy\LedgerFoundation\Policies\DepositPolicy;
use Kanexy\LedgerFoundation\Policies\ExchangeRatePolicy;
use Kanexy\LedgerFoundation\Policies\LedgerPolicy;
use Kanexy\LedgerFoundation\Policies\PayoutPolicy;
use Kanexy\LedgerFoundation\Wallet\MembershipServiceSelectionContent;
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
        '2022_01_25_115840_add_column_in_ledgers_table',
        '2022_01_25_122500_create_exchange_rates_table',
        '2022_01_17_130105_create_wallets_table',
        '2022_02_02_062027_change_ref_id_type_for_transaction',
        '2022_02_08_111607_alter_column_nullable_in_ledger',
        '2022_02_14_123946_alter_table_column_exchange_rate'
    ];

    private array $policies = [
        Ledger::class => LedgerPolicy::class,
        Wallet::class => PayoutPolicy::class,
        ExchangeRate::class => ExchangeRatePolicy::class,
        Wallet::class => DepositPolicy::class,
        LedgerConfiguration::class => AssetClassPolicy::class,
        LedgerConfiguration::class => AssetTypePolicy::class,
        LedgerConfiguration::class => CommodityTypePolicy::class
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
            ->hasTranslations()
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
        \Kanexy\Cms\Facades\MembershipServiceSelection::addItem(new MembershipServiceSelectionContent());

        \Kanexy\Cms\Facades\Cms::setRedirectRouteAfterRegistrationVerification(function (Request $request,User $user) {
            if($user->is_banking_user != true)
            {
                return route("customer.signup.wallet.create");
            }

            return false;
        },3000);

        /** Create wallet account by default from banking flow **/
        PartnerFoundation::setRedirectRouteAfterBanking(function () {
            $nextRoute = (new Helper())->getNextRoute(RegistrationStep::BANKING);
            redirect($nextRoute->getUrl());
        });

        Livewire::component('deposit-wallet-component', DepositWalletComponent::class);
        Livewire::component('deposit-otp-verification-component', DepositOtpVerificationComponent::class);
        Livewire::component('ledger-config-field-component', LedgerConfigFieldComponent::class);
        Livewire::component('wallet-transactions-list-component', WalletTransactionsListComponent::class);
        Livewire::component('wallet-transaction-detail-component', WalletTransactionDetailComponent::class);

        Livewire::component('wallet-beneficiary', WalletBeneficiary::class);
        Livewire::component('wallet-payout-component', WalletPayoutComponent::class);
    }
}
