<?php

namespace App\Enums;

class PermissionEnum
{
    public const HOME_INDEX = 'home_index';

    public const PRODUCTS_INDEX = 'products_index';
    public const PRODUCTS_CREATE = 'products_create';
    public const PRODUCTS_STORE = 'products_store';
    public const PRODUCTS_EDIT = 'products_edit';
    public const PRODUCTS_UPDATE = 'products_update';
    public const PRODUCTS_ACTIVE_DEACTIVE = 'products_active_deactive';

    public const CUSTOMERS_INDEX = 'customers_index';
    public const CUSTOMERS_CREATE = 'customers_create';
    public const CUSTOMERS_STORE = 'customers_store';
    public const CUSTOMERS_EDIT = 'customers_edit';
    public const CUSTOMERS_UPDATE = 'customers_update';
    public const CUSTOMERS_ACTIVE_DEACTIVE = 'customers_active_deactive';

    public const SALES_INDEX = 'sales_index';
    public const SALES_CREATE = 'sales_create';
    public const SALES_STORE = 'sales_store';
    public const SALES_EDIT = 'sales_edit';
    public const SALES_UPDATE = 'sales_update';
    public const SALES_VIEW = 'sales_view';
    public const SALES_VALIDATE = 'sales_validate';
    public const SALES_ACTIVE_DEACTIVE = 'sales_active_deactive';

    public const TRANSACTIONS_INDEX = 'transactions_index';
    public const TRANSACTIONS_CREATE = 'transactions_create';
    public const TRANSACTIONS_STORE = 'transactions_store';
    public const TRANSACTIONS_EDIT = 'transactions_edit';
    public const TRANSACTIONS_UPDATE = 'transactions_update';
    public const TRANSACTIONS_VALIDATE = 'transactions_validate';
    public const TRANSACTIONS_ACTIVE_DEACTIVE = 'transactions_active_deactive';

    public const PAYMENT_METHODS_INDEX = 'payment_methods_index';
    public const PAYMENT_METHODS_CREATE = 'payment_methods_create';
    public const PAYMENT_METHODS_STORE = 'payment_methods_store';
    public const PAYMENT_METHODS_EDIT = 'payment_methods_edit';
    public const PAYMENT_METHODS_UPDATE = 'payment_methods_update';
    public const PAYMENT_METHODS_ACTIVE_DEACTIVE = 'payment_methods_active_deactive';

    public const BRANDS_INDEX = 'brands_index';
    public const BRANDS_CREATE = 'brands_create';
    public const BRANDS_STORE = 'brands_store';
    public const BRANDS_EDIT = 'brands_edit';
    public const BRANDS_UPDATE = 'brands_update';
    public const BRANDS_ACTIVE_DEACTIVE = 'brands_active_deactive';

    public const USERS_INDEX = 'users_index';
    public const USERS_CREATE = 'users_create';
    public const USERS_STORE = 'users_store';
    public const USERS_EDIT = 'users_edit';
    public const USERS_UPDATE = 'users_update';
    public const USERS_ACTIVE_DEACTIVE = 'users_active_deactive';

    public const ROLES_INDEX = 'roles_index';
    public const ROLES_CREATE = 'roles_create';
    public const ROLES_STORE = 'roles_store';
    public const ROLES_EDIT = 'roles_edit';
    public const ROLES_UPDATE = 'roles_update';
    public const ROLES_ADD_PERMISSION_TO_ROLE = 'roles_add_permission_to_role';
    public const ROLES_GIVE_PERMISSION_TO_ROLE = 'roles_give_permission_to_role';

    public const PERMISSIONS_INDEX = 'permissions_index';
    public const PERMISSIONS_CREATE = 'permissions_create';
    public const PERMISSIONS_STORE = 'permissions_store';
    public const PERMISSIONS_EDIT = 'permissions_edit';
    public const PERMISSIONS_UPDATE = 'permissions_update';

    public const PULSE = 'pulse';	

    public static function getPermissions(string $module): array
    {
        return match ($module) {
            'products' => [
                self::PRODUCTS_INDEX,
                self::PRODUCTS_CREATE,
                self::PRODUCTS_STORE,
                self::PRODUCTS_EDIT,
                self::PRODUCTS_UPDATE,
                self::PRODUCTS_ACTIVE_DEACTIVE,
            ],
            'customers' => [
                self::CUSTOMERS_INDEX,
                self::CUSTOMERS_CREATE,
                self::CUSTOMERS_STORE,
                self::CUSTOMERS_EDIT,
                self::CUSTOMERS_UPDATE,
                self::CUSTOMERS_ACTIVE_DEACTIVE,
            ],
            'sales' => [
                self::SALES_INDEX,
                self::SALES_CREATE,
                self::SALES_STORE,
                self::SALES_EDIT,
                self::SALES_UPDATE,
                self::SALES_VIEW,
                self::SALES_VALIDATE,
                self::SALES_ACTIVE_DEACTIVE,
            ],
            'transactions' => [
                self::TRANSACTIONS_INDEX,
                self::TRANSACTIONS_CREATE,
                self::TRANSACTIONS_STORE,
                self::TRANSACTIONS_EDIT,
                self::TRANSACTIONS_UPDATE,
                self::TRANSACTIONS_VALIDATE,
                self::TRANSACTIONS_ACTIVE_DEACTIVE,
            ],
            'payment_methods' => [
                self::PAYMENT_METHODS_INDEX,
                self::PAYMENT_METHODS_CREATE,
                self::PAYMENT_METHODS_STORE,
                self::PAYMENT_METHODS_EDIT,
                self::PAYMENT_METHODS_UPDATE,
                self::PAYMENT_METHODS_ACTIVE_DEACTIVE,
            ],
            'brands' => [
                self::BRANDS_INDEX,
                self::BRANDS_CREATE,
                self::BRANDS_STORE,
                self::BRANDS_EDIT,
                self::BRANDS_UPDATE,
                self::BRANDS_ACTIVE_DEACTIVE,
            ],
            'users' => [
                self::USERS_INDEX,
                self::USERS_CREATE,
                self::USERS_STORE,
                self::USERS_EDIT,
                self::USERS_UPDATE,
                self::USERS_ACTIVE_DEACTIVE,
            ],
            'roles' => [
                self::ROLES_INDEX,
                self::ROLES_CREATE,
                self::ROLES_STORE,
                self::ROLES_EDIT,
                self::ROLES_UPDATE,
                self::ROLES_ADD_PERMISSION_TO_ROLE,
                self::ROLES_GIVE_PERMISSION_TO_ROLE,
            ],
            'permissions' => [
                self::PERMISSIONS_INDEX,
                self::PERMISSIONS_CREATE,
                self::PERMISSIONS_STORE,
                self::PERMISSIONS_EDIT,
                self::PERMISSIONS_UPDATE,
            ],
            default => [],
        };
    }
}
