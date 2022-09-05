<?php

namespace Kanexy\LedgerFoundation\Tests;

use Kanexy\Cms\Models\User;
use Kanexy\LedgerFoundation\Tests\TestCase;

class LedgerTest extends TestCase
{
    /** @test */
    public function ledger_create_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'              =>    'India Currency',
            'code'              =>    'INR',
            'ledger_type'       =>    'bank',
            'exchange_type'     =>    'fiat',
            'exchange_from'     =>    'wrappex',
            'asset_category'    =>    'fiat_currency',
            'asset_class'       =>    '18082022064905',
            'asset_type'        =>    '18082022045705',
            'status'            =>    'active',
        ];

        $response = $this->postJson(route('dashboard.wallet.ledger.store'),$data);
        $response->assertStatus(302);
    }

    /** @test */
    public function ledger_create_test_failure()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'              =>    'India Currency',
            'code'              =>    'INR',
            'ledger_type'       =>    'bank',
            'exchange_type'     =>    'fiat',
            'asset_category'    =>    'fiat_currency',
            'asset_class'       =>    '18082022064905',
            'asset_type'        =>    '18082022045705',
            'status'            =>    'active',
        ];

        $response = $this->postJson(route('dashboard.wallet.ledger.store'),$data);
        $response->assertStatus(422);
    }

    /** @test */
    public function ledger_update_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'              =>    'Binance',
            'code'              =>    'BNB',
            'ledger_type'       =>    'bank',
            'exchange_type'     =>    'fiat',
            'exchange_from'     =>    'local',
            'asset_category'    =>    'fiat_currency',
            'asset_class'       =>    '18082022064905',
            'asset_type'        =>    '18082022045705',
            'status'            =>    'active',
        ];

        $response = $this->putJson(route('dashboard.wallet.ledger.update','11'),$data);
        $response->assertStatus(302);
    }

    /** @test */
    public function ledger_update_test_failure()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'              =>    'Binance',
            'code'              =>    'BNB',
            'ledger_type'       =>    'bank',
            'exchange_type'     =>    'fiat',
            'asset_category'    =>    'fiat_currency',
            'asset_class'       =>    '18082022064905',
            'asset_type'        =>    '18082022045705',
            'status'            =>    'active',
        ];

        $response = $this->putJson(route('dashboard.wallet.ledger.update','11'),$data);
        $response->assertStatus(422);
    }

    /** @test */
    public function ledger_delete_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $response = $this->delete(route('dashboard.wallet.ledger.destroy','11'));
        $response->assertStatus(302);
    }
}

?>
