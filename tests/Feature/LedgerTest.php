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
            'name'        =>    'INR',
            'code'      =>    'INR XC',
            'ledger_type'      =>    'bank',
            'exchange_type'      =>    'fiat',
            'exchange_from'      =>    'wrappex',
            'asset_category'      =>    'fiat_currency',
            'asset_class'      =>    '14082022104027',
            'asset_type'      =>    '19062022175532',
            'status'      =>    'active',
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
            'name'        =>    'INR',
            'code'      =>    'INR XC',
            'ledger_type'      =>    'bank',
            'exchange_from'      =>    'wrappex',
            'asset_class'      =>    '14082022104027',
            'status'      =>    'active',
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
            'name'        =>    'INR',
            'code'      =>    'INR XC',
            'ledger_type'      =>    'bank',
            'exchange_type'      =>    'fiat',
            'exchange_from'      =>    'wrappex',
            'asset_category'      =>    'fiat_currency',
            'asset_class'      =>    '14082022104027',
            'asset_type'      =>    '19062022175532',
            'status'      =>    'active',
        ];
        $response = $this->putJson(route('dashboard.wallet.ledger.update','9'),$data);
        $response->assertStatus(302);
    }

    /** @test */
    public function ledger_update_test_failure()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'        =>    'INR',
            'code'      =>    'INR XC',
            'ledger_type'      =>    'bank',
            'exchange_from'      =>    'wrappex',
            'asset_type'      =>    '19062022175532',
            'status'      =>    'active',
        ];
        $response = $this->putJson(route('dashboard.wallet.ledger.update','9'),$data);
        $response->assertStatus(422);
    }

    /** @test */
    public function ledger_delete_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $response = $this->delete(route('dashboard.wallet.ledger.destroy','9'));
        $response->assertStatus(302);
    }
}

?>
