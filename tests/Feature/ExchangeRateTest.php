<?php

namespace Kanexy\LedgerFoundation\Tests;

use Kanexy\Cms\Models\User;
use Kanexy\LedgerFoundation\Tests\TestCase;

class ExchangeRateTest extends TestCase
{
    /** @test */
    public function exchangerate_create_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'base_currency'          =>    '1',
            'exchange_currency'      =>    '2',
            'frequency'              =>    'daily',
            'valid_date'             =>    '2022-08-15',
            'exchange_rate'          =>    '0.01',
            'note'                   =>    '1 INR = 0.01 GBP',
        ];

        $response = $this->postJson(route('dashboard.wallet.exchange-rate.store'),$data);
        $response->assertStatus(302);
    }

    /** @test */
    public function exchangerate_create_test_failure()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'base_currency'          =>    '1',
            'exchange_currency'      =>    '2',
            'valid_date'             =>    '2022-08-15',
            'exchange_rate'          =>    '-0.01',
            'note'                   =>    '1 INR = 0.01 GBP',
        ];

        $response = $this->postJson(route('dashboard.wallet.exchange-rate.store'),$data);
        $response->assertStatus(422);
    }

    /** @test */
    public function exchangerate_update_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'base_currency'          =>    '1',
            'exchange_currency'      =>    '2',
            'frequency'              =>    'daily',
            'valid_date'             =>    '2022-08-15',
            'exchange_rate'          =>    '0.01',
            'note'                   =>    '1 INR = 0.01 GBP',
        ];

        $response = $this->putJson(route('dashboard.wallet.exchange-rate.update','7'),$data);
        $response->assertStatus(302);
    }

    /** @test */
    public function exchangerate_update_test_failure()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'base_currency'        =>    '1',
            'frequency'            =>    'daily',
            'valid_date'           =>    '2022-08-15',
            'exchange_rate'        =>    '-0.01',
            'note'                 =>    '1 INR = 0.01 GBP',
        ];

        $response = $this->putJson(route('dashboard.wallet.exchange-rate.update','7'),$data);
        $response->assertStatus(422);
    }

    /** @test */
    public function exchangerate_delete_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $response = $this->delete(route('dashboard.wallet.exchange-rate.destroy','7'));
        $response->assertStatus(302);
    }
}

?>
