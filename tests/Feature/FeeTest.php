<?php

namespace Kanexy\LedgerFoundation\Tests;

use Kanexy\Cms\Models\User;
use Kanexy\LedgerFoundation\Tests\TestCase;

class FeeTest extends TestCase
{
    /** @test */
    public function fee_create_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'base_currency'        =>    '2',
            'exchange_currency'      =>    '3',
            'payment_type'      =>    'payout',
            'fee_type'      =>    'amount',
            'amount'      =>    '5',
        ];
        $response = $this->postJson(route('dashboard.wallet.fee.store'),$data);
        $response->assertStatus(302);
    }

    /** @test */
    public function fee_create_test_failure()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'base_currency'        =>    '2',
            'payment_type'      =>    'payout',
            'fee_type'      =>    'amount',
            'amount'      =>    '5',
        ];
        $response = $this->postJson(route('dashboard.wallet.fee.store'),$data);
        $response->assertStatus(422);
    }

    /** @test */
    public function fee_update_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'base_currency'        =>    '2',
            'exchange_currency'      =>    '3',
            'payment_type'      =>    'payout',
            'fee_type'      =>    'amount',
            'amount'      =>    '5',
        ];
        $response = $this->putJson(route('dashboard.wallet.fee.update','15082022114732'),$data);
        $response->assertStatus(302);
    }

    /** @test */
    public function fee_update_test_failure()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'base_currency'        =>    '2',
            'payment_type'      =>    'payout',
            'fee_type'      =>    'amount',
            'amount'      =>    '5',
        ];
        $response = $this->putJson(route('dashboard.wallet.fee.update','15082022114732'),$data);
        $response->assertStatus(422);
    }

    /** @test */
    public function fee_delete_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $response = $this->delete(route('dashboard.wallet.fee.destroy','15082022114732'));
        $response->assertStatus(302);
    }
}

?>
