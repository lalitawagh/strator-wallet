<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Kanexy\LedgerFoundation\Http\Enums\Permission as EnumsPermission;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LedgerFoundationRoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $COMMODITY_TYPE_VIEW = Permission::create(['name' => EnumsPermission::COMMODITY_TYPE_VIEW]);
        $COMMODITY_TYPE_CREATE = Permission::create(['name' => EnumsPermission::COMMODITY_TYPE_CREATE]);
        $COMMODITY_TYPE_EDIT = Permission::create(['name' => EnumsPermission::COMMODITY_TYPE_EDIT]);
        $COMMODITY_TYPE_DELETE = Permission::create(['name' => EnumsPermission::COMMODITY_TYPE_DELETE]);

        $ASSET_TYPE_VIEW = Permission::create(['name' => EnumsPermission::ASSET_TYPE_VIEW]);
        $ASSET_TYPE_CREATE = Permission::create(['name' => EnumsPermission::ASSET_TYPE_CREATE]);
        $ASSET_TYPE_EDIT = Permission::create(['name' => EnumsPermission::ASSET_TYPE_EDIT]);
        $ASSET_TYPE_DELETE = Permission::create(['name' => EnumsPermission::ASSET_TYPE_DELETE]);

        $ASSET_CLASS_VIEW = Permission::create(['name' => EnumsPermission::ASSET_CLASS_VIEW]);
        $ASSET_CLASS_CREATE = Permission::create(['name' => EnumsPermission::ASSET_CLASS_CREATE]);
        $ASSET_CLASS_EDIT = Permission::create(['name' => EnumsPermission::ASSET_CLASS_EDIT]);
        $ASSET_CLASS_DELETE = Permission::create(['name' => EnumsPermission::ASSET_CLASS_DELETE]);

        $LEDGER_VIEW = Permission::create(['name' => EnumsPermission::LEDGER_VIEW]);
        $LEDGER_CREATE = Permission::create(['name' => EnumsPermission::LEDGER_CREATE]);
        $LEDGER_EDIT = Permission::create(['name' => EnumsPermission::LEDGER_EDIT]);
        $LEDGER_DELETE = Permission::create(['name' => EnumsPermission::LEDGER_DELETE]);

        $SUPER_ADMIN = Role::where(['name' => \Kanexy\Cms\Enums\Role::SUPER_ADMIN])->first();
        $SUPER_ADMIN->givePermissionTo(Permission::all());
    }
}
