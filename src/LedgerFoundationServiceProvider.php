<?php

namespace Kanexy\LedgerFoundation;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Kanexy\Cms\Facades\Cms;
use Kanexy\Cms\Menu\MenuItem;
use Kanexy\Cms\Traits\InteractsWithMigrations;
use Kanexy\LedgerFoundation\Contracts\AssetClassConfiguration;
use Kanexy\LedgerFoundation\Contracts\AssetTypeConfiguration;
use Kanexy\LedgerFoundation\Contracts\CommodityTypeConfiguration;
use Kanexy\LedgerFoundation\Contracts\MasterAccount;
use Kanexy\LedgerFoundation\Contracts\Payout;
use Kanexy\LedgerFoundation\Contracts\Withdraw;
use Kanexy\LedgerFoundation\Livewire\DepositOtpVerificationComponent;
use Kanexy\LedgerFoundation\Livewire\DepositWalletComponent;
use Kanexy\LedgerFoundation\Livewire\LedgerConfigFieldComponent;
use Kanexy\LedgerFoundation\Livewire\WalletBeneficiary;
use Kanexy\LedgerFoundation\Livewire\WalletGraph;
use Kanexy\LedgerFoundation\Livewire\WalletPayoutComponent;
use Kanexy\LedgerFoundation\Livewire\OtpWalletVerification;
use Kanexy\LedgerFoundation\Livewire\WalletTransactionDetailComponent;
use Kanexy\LedgerFoundation\Livewire\WalletTransactionGraph;
use Kanexy\LedgerFoundation\Livewire\WalletTransactionsListComponent;
use Kanexy\LedgerFoundation\Livewire\WalletWithdrawComponent;
use Kanexy\LedgerFoundation\Livewire\WithdrawBeneficiaryComponent;
use Kanexy\LedgerFoundation\Menu\WalletDashboardMenuItem;
use Kanexy\LedgerFoundation\Menu\WalletMenuItem;
use Kanexy\LedgerFoundation\Model\ExchangeRate;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\LedgerFoundation\Policies\AssetClassPolicy;
use Kanexy\LedgerFoundation\Policies\AssetTypePolicy;
use Kanexy\LedgerFoundation\Policies\CommodityTypePolicy;
use Kanexy\LedgerFoundation\Policies\DepositPolicy;
use Kanexy\LedgerFoundation\Policies\ExchangeRatePolicy;
use Kanexy\LedgerFoundation\Policies\FeePolicy;
use Kanexy\LedgerFoundation\Policies\LedgerPolicy;
use Kanexy\LedgerFoundation\Policies\MasterAccountPolicy;
use Kanexy\LedgerFoundation\Policies\PayoutPolicy;
use Kanexy\LedgerFoundation\Policies\WithdrawPolicy;
use Kanexy\LedgerFoundation\Setting\GeneralSettingForm;
use Kanexy\LedgerFoundation\Step\WalletRegistrationStep;
use Kanexy\LedgerFoundation\Wallet\CustomerRegistrationForm;
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
        Payout::class => PayoutPolicy::class,
        ExchangeRate::class => ExchangeRatePolicy::class,
        Wallet::class => DepositPolicy::class,
        AssetClassConfiguration::class => AssetClassPolicy::class,
        AssetTypeConfiguration::class => AssetTypePolicy::class,
        CommodityTypeConfiguration::class => CommodityTypePolicy::class,
        MasterAccount::class => MasterAccountPolicy::class,
        Fee::class => FeePolicy::class,
        Withdraw::class => WithdrawPolicy::class
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
        \Kanexy\Cms\Facades\SidebarMenu::addItem(new WalletDashboardMenuItem());
        \Kanexy\Cms\Facades\MembershipServiceSelection::addItem(new MembershipServiceSelectionContent());
        \Kanexy\Cms\Facades\GeneralSetting::addItem(GeneralSettingForm::class);
        \Kanexy\Cms\Facades\CustomerRegistration::addItem(CustomerRegistrationForm::class);
        \Kanexy\Cms\Facades\RegistrationStep::addItem(new WalletRegistrationStep());

        \Kanexy\Cms\Facades\Cms::setRegistrationFlow(function (User $user) {
            if ($user->is_banking_user != true) {
                $type = 'wallet_flow';
                return $type;
            }
            return false;
        }, 2000);


        \Kanexy\Cms\Facades\Cms::setRedirectRouteAfterRegistrationVerification(function (Request $request, User $user) {
            if ($user->is_banking_user != true) {
                return route("customer.signup.wallet.create");
            }

            return false;
        }, 3000);

        /** Create wallet account by default from banking flow **/
        PartnerFoundation::setRedirectRouteAfterBanking(function (User $user) {
            return route("customer.signup.wallet.create");
        });

        PartnerFoundation::setRedirectRouteAfterKyc(function (User $user) {
            return route("dashboard.wallet.wallet-dashboard");
        });

        Cms::setRedirectRouteAfterLogin(function (User $user) {
            if (!$user->is_banking_user) {
                return route("dashboard.wallet.wallet-dashboard");
            }
        });



        Livewire::component('deposit-wallet-component', DepositWalletComponent::class);
        Livewire::component('deposit-otp-verification-component', DepositOtpVerificationComponent::class);
        Livewire::component('ledger-config-field-component', LedgerConfigFieldComponent::class);
        Livewire::component('wallet-transactions-list-component', WalletTransactionsListComponent::class);
        Livewire::component('wallet-transaction-detail-component', WalletTransactionDetailComponent::class);
        Livewire::component('wallet-beneficiary', WalletBeneficiary::class);
        Livewire::component('wallet-payout-component', WalletPayoutComponent::class);
        Livewire::component('wallet-withdraw-component', WalletWithdrawComponent::class);
        Livewire::component('withdraw-beneficiary', WithdrawBeneficiaryComponent::class);
        Livewire::component('wallet-transaction-graph', WalletTransactionGraph::class);
        Livewire::component('otp-wallet-verification-component', OtpWalletVerification::class);
        Livewire::component('confirmation-modal', DeleteConfirmationModal::class);


        Blade::component('cms::components.modal', 'modal');
    }
}
