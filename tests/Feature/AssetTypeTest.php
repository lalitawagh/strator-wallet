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
            'name'        =>    'rohit',
            'asset_category'      =>    'xyz',
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
            'name'        =>    'rohit',
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
            'name'        =>    'rohit',
            'asset_category'      =>    'xyz',
        ];
        $response = $this->putJson(route('dashboard.wallet.asset-type.update','15082022090505'),$data);
        $response->assertStatus(302);
    }

    /** @test */
    public function assettype_update_test_failure()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'        =>    'rohit',
        ];
        $response = $this->putJson(route('dashboard.wallet.asset-type.update','15082022090505'),$data);
        $response->assertStatus(422);
    }

    /** @test */
    public function assettype_delete_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $response = $this->delete(route('dashboard.wallet.asset-type.destroy','15082022090505'));
        $response->assertStatus(302);
    }
}

?>
