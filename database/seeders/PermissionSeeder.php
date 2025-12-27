<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $this->createPermissions();

        $productPermission = PermissionEnum::getPermissions('products');
        $customerPermission = PermissionEnum::getPermissions('customers');
        $salesPermission = PermissionEnum::getPermissions('sales');
        $transactionsPermission = PermissionEnum::getPermissions('transactions');
        $paymentMethodsPermission = PermissionEnum::getPermissions('payment_methods');
        $brandsPermission = PermissionEnum::getPermissions('brands');
        $usersPermission = PermissionEnum::getPermissions('users');
        $rolesPermission = PermissionEnum::getPermissions('roles');
        $permissionsPermission = PermissionEnum::getPermissions('permissions');

        $roleSuperAdmin = Role::findByName('super_admin');
        $roleSuperAdmin->syncPermissions(
            array_merge(
                $productPermission,
                $customerPermission,
                $salesPermission,
                $transactionsPermission,
                $paymentMethodsPermission,
                $brandsPermission,
                $usersPermission,
                $rolesPermission,
                $permissionsPermission,
                [
                    PermissionEnum::HOME_INDEX,
                    PermissionEnum::PULSE,
                ]
            )
        );

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->syncPermissions(
            array_merge(
                $productPermission,
                $customerPermission,
                $salesPermission,
                $transactionsPermission,
                $paymentMethodsPermission,
                $brandsPermission,
                $usersPermission,
                [
                    PermissionEnum::HOME_INDEX,
                    PermissionEnum::ROLES_INDEX,
                    PermissionEnum::PERMISSIONS_INDEX
                ]
            )
        );

        $roleUser = Role::findByName('user');
        $roleUser->syncPermissions(
            array_merge(
                $productPermission,
                $customerPermission,
                $salesPermission,
                $transactionsPermission,
                $brandsPermission,
                [
                    PermissionEnum::HOME_INDEX,
                    PermissionEnum::PAYMENT_METHODS_INDEX,
                    PermissionEnum::PAYMENT_METHODS_ACTIVE_DEACTIVE,
                    PermissionEnum::USERS_INDEX
                ]
            )
        );
    }

    protected function createPermissions(): void
    {
        Permission::firstOrCreate(['name' => PermissionEnum::HOME_INDEX]);

        Permission::firstOrCreate(['name' => PermissionEnum::PRODUCTS_INDEX]);
        Permission::firstOrCreate(['name' => PermissionEnum::PRODUCTS_CREATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::PRODUCTS_STORE]);
        Permission::firstOrCreate(['name' => PermissionEnum::PRODUCTS_EDIT]);
        Permission::firstOrCreate(['name' => PermissionEnum::PRODUCTS_UPDATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::PRODUCTS_ACTIVE_DEACTIVE]);

        Permission::firstOrCreate(['name' => PermissionEnum::CUSTOMERS_INDEX]);
        Permission::firstOrCreate(['name' => PermissionEnum::CUSTOMERS_CREATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::CUSTOMERS_STORE]);
        Permission::firstOrCreate(['name' => PermissionEnum::CUSTOMERS_EDIT]);
        Permission::firstOrCreate(['name' => PermissionEnum::CUSTOMERS_UPDATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::CUSTOMERS_ACTIVE_DEACTIVE]);

        Permission::firstOrCreate(['name' => PermissionEnum::SALES_INDEX]);
        Permission::firstOrCreate(['name' => PermissionEnum::SALES_CREATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::SALES_STORE]);
        Permission::firstOrCreate(['name' => PermissionEnum::SALES_EDIT]);
        Permission::firstOrCreate(['name' => PermissionEnum::SALES_UPDATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::SALES_VIEW]);
        Permission::firstOrCreate(['name' => PermissionEnum::SALES_VALIDATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::SALES_ACTIVE_DEACTIVE]);

        Permission::firstOrCreate(['name' => PermissionEnum::TRANSACTIONS_INDEX]);
        Permission::firstOrCreate(['name' => PermissionEnum::TRANSACTIONS_CREATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::TRANSACTIONS_STORE]);
        Permission::firstOrCreate(['name' => PermissionEnum::TRANSACTIONS_EDIT]);
        Permission::firstOrCreate(['name' => PermissionEnum::TRANSACTIONS_UPDATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::TRANSACTIONS_VALIDATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::TRANSACTIONS_ACTIVE_DEACTIVE]);

        Permission::firstOrCreate(['name' => PermissionEnum::PAYMENT_METHODS_INDEX]);
        Permission::firstOrCreate(['name' => PermissionEnum::PAYMENT_METHODS_CREATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::PAYMENT_METHODS_STORE]);
        Permission::firstOrCreate(['name' => PermissionEnum::PAYMENT_METHODS_EDIT]);
        Permission::firstOrCreate(['name' => PermissionEnum::PAYMENT_METHODS_UPDATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::PAYMENT_METHODS_ACTIVE_DEACTIVE]);

        Permission::firstOrCreate(['name' => PermissionEnum::BRANDS_INDEX]);
        Permission::firstOrCreate(['name' => PermissionEnum::BRANDS_CREATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::BRANDS_STORE]);
        Permission::firstOrCreate(['name' => PermissionEnum::BRANDS_EDIT]);
        Permission::firstOrCreate(['name' => PermissionEnum::BRANDS_UPDATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::BRANDS_ACTIVE_DEACTIVE]);

        Permission::firstOrCreate(['name' => PermissionEnum::USERS_INDEX]);
        Permission::firstOrCreate(['name' => PermissionEnum::USERS_CREATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::USERS_STORE]);
        Permission::firstOrCreate(['name' => PermissionEnum::USERS_EDIT]);
        Permission::firstOrCreate(['name' => PermissionEnum::USERS_UPDATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::USERS_ACTIVE_DEACTIVE]);

        Permission::firstOrCreate(['name' => PermissionEnum::ROLES_INDEX]);
        Permission::firstOrCreate(['name' => PermissionEnum::ROLES_CREATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::ROLES_STORE]);
        Permission::firstOrCreate(['name' => PermissionEnum::ROLES_EDIT]);
        Permission::firstOrCreate(['name' => PermissionEnum::ROLES_UPDATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::ROLES_ADD_PERMISSION_TO_ROLE]);
        Permission::firstOrCreate(['name' => PermissionEnum::ROLES_GIVE_PERMISSION_TO_ROLE]);

        Permission::firstOrCreate(['name' => PermissionEnum::PERMISSIONS_INDEX]);
        Permission::firstOrCreate(['name' => PermissionEnum::PERMISSIONS_CREATE]);
        Permission::firstOrCreate(['name' => PermissionEnum::PERMISSIONS_STORE]);
        Permission::firstOrCreate(['name' => PermissionEnum::PERMISSIONS_EDIT]);
        Permission::firstOrCreate(['name' => PermissionEnum::PERMISSIONS_UPDATE]);

        Permission::firstOrCreate(['name' => PermissionEnum::PULSE]);
    }
}
