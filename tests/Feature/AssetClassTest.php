<?php

namespace Kanexy\LedgerFoundation\Tests;

use Kanexy\Cms\Models\User;
use Kanexy\LedgerFoundation\Tests\TestCase;

class AssetClassTest extends TestCase
{
    /** @test */
    public function assetclass_create_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'        =>    'Currency',
        ];

        $response = $this->postJson(route('dashboard.wallet.asset-class.store'),$data);
        $response->assertStatus(302);
    }

    /** @test */
    public function assetclass_create_test_failure()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'        =>    '12bond',
        ];

        $response = $this->postJson(route('dashboard.wallet.asset-class.store'),$data);
        $response->assertStatus(422);
    }

    /** @test */
    public function assetclass_update_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'        =>    'Bond',
        ];

        $response = $this->putJson(route('dashboard.wallet.asset-class.update','14082022140925'),$data);
        $response->assertStatus(302);
    }

    /** @test */
    public function assetclass_update_test_failure()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'        =>    '123bond',
        ];

        $response = $this->putJson(route('dashboard.wallet.asset-class.update','14082022140925'),$data);
        $response->assertStatus(422);
    }

    /** @test */
    public function assetclass_delete_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $response = $this->delete(route('dashboard.wallet.asset-class.destroy','14082022140925'));
        $response->assertStatus(302);
    }

}

?>
