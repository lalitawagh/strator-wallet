<?php

namespace Kanexy\LedgerFoundation\Tests;

use Kanexy\Cms\Models\User;
use Kanexy\LedgerFoundation\Tests\TestCase;

class AssetTypeTest extends TestCase
{
    /** @test */
    public function assettype_create_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'                =>    'INR',
            'asset_category'      =>    'fiat_currency',
        ];

        $response = $this->postJson(route('dashboard.wallet.asset-type.store'),$data);
        $response->assertStatus(302);
    }

    /** @test */
    public function assettype_create_test_failure()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'                =>    '123',
            'asset_category'      =>    'xyz',
        ];

        $response = $this->postJson(route('dashboard.wallet.asset-type.store'),$data);
        $response->assertStatus(422);
    }

    /** @test */
    public function assettype_update_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'                =>    'GBP',
            'asset_category'      =>    'fiat_currency',
        ];

        $response = $this->putJson(route('dashboard.wallet.asset-type.update','18082022045222'),$data);
        $response->assertStatus(302);
    }

    /** @test */
    public function assettype_update_test_failure()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'                =>    '1df',
            'asset_category'      =>    'abc',
        ];

        $response = $this->putJson(route('dashboard.wallet.asset-type.update','18082022045222'),$data);
        $response->assertStatus(422);
    }

    /** @test */
    public function assettype_delete_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $response = $this->delete(route('dashboard.wallet.asset-type.destroy','18082022045222'));
        $response->assertStatus(302);
    }
}

?>
