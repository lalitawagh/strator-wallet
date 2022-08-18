<?php

namespace Kanexy\LedgerFoundation\Tests;

use Kanexy\Cms\Models\User;
use Kanexy\LedgerFoundation\Tests\TestCase;

class CommodityTypeTest extends TestCase
{
    /** @test */
    public function commoditytype_create_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'        =>    'Energy',
        ];

        $response = $this->postJson(route('dashboard.wallet.commodity-type.store'),$data);
        $response->assertStatus(302);
    }

    /** @test */
    public function commoditytype_create_test_failure()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'        =>    '1Energy',
        ];

        $response = $this->postJson(route('dashboard.wallet.commodity-type.store'),$data);
        $response->assertStatus(422);
    }

    /** @test */
    public function commoditytype_update_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'        =>    'Energy',
        ];

        $response = $this->putJson(route('dashboard.wallet.commodity-type.update','15082022094017'),$data);
        $response->assertStatus(302);
    }

    /** @test */
    public function commoditytype_update_test_failure()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $data = [
            'name'        =>    '12energy',
        ];

        $response = $this->putJson(route('dashboard.wallet.commodity-type.update','15082022094017'),$data);
        $response->assertStatus(422);
    }

    /** @test */
    public function commoditytype_delete_test_success()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $response = $this->delete(route('dashboard.wallet.commodity-type.destroy','15082022094017'));
        $response->assertStatus(302);
    }
}
?>
