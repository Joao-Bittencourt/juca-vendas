@can(\App\Enums\PermissionEnum::HOME_INDEX)
<li class="nav-item">
    <a href="{{ route('home.index') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
@endcan

@can(\App\Enums\PermissionEnum::PRODUCTS_INDEX)
<li class="nav-item">
    <a href="{{ route('products.index') }}" class="nav-link {{ Request::is('products') ? 'active' : '' }}">
        <i class="fas fa-box-open"></i>
        <p>{{ __('Products') }}</p>
    </a>
</li>
@endcan

@can(\App\Enums\PermissionEnum::CUSTOMERS_INDEX)
<li class="nav-item">
    <a href="{{ route('customers.index') }}" class="nav-link {{ Request::is('customers') ? 'active' : '' }}">
        <i class="fas fa-user-tie"></i>
        <p>{{ __('Customers') }}</p>
    </a>
</li>
@endcan
@can(\App\Enums\PermissionEnum::SALES_INDEX)
<li class="nav-item">
    <a href="{{ route('sales.index') }}" class="nav-link {{ Request::is('sales') ? 'active' : '' }}">
        <i class="fas fas fa-cart-arrow-down"></i>
        <p>{{ __('Sales') }}</p>
    </a>
</li>
@endcan
@can(\App\Enums\PermissionEnum::TRANSACTIONS_INDEX)
<li class="nav-item">
    <a href="{{ route('transactions.index') }}" class="nav-link {{ Request::is('transactions') ? 'active' : '' }}">
        <i class="fas fa-money-check-alt"></i>
        <p>{{ __('Financial') }}</p>
    </a>
</li>
@endcan

<li class="nav-header"> {{ __('Configurations') }}</li>


<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-cog"></i>
        <p>
            {{ __('Configurations') }}
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        @can(\App\Enums\PermissionEnum::PAYMENT_METHODS_INDEX)
        <li class="nav-item">
            <a href="{{ route('payment-methods.index') }}" class="nav-link {{ Request::is('payment-methods') ? 'active' : '' }}">
                <i class="nav-icon fas fa-money-bill"></i>
                <p>
                    {{ __('Payment methods') }}
                </p>
            </a>
        </li>
        @endcan
        @can(\App\Enums\PermissionEnum::BRANDS_INDEX)
        <li class="nav-item">
            <a href="{{ route('brands.index') }}" class="nav-link {{ Request::is('brands') ? 'active' : '' }}">
                <i class="nav-icon fas fa-bookmark"></i>
                <p>
                    {{ __('Brands')}}
                </p>
            </a>
        </li>
        @endcan
        @can(\App\Enums\PermissionEnum::ROLES_INDEX)
        <li class="nav-item">
            <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles') ? 'active' : '' }}">
            <i class="fas fa-user-shield"></i>
                <p>
                    {{ __('Roles')}}
                </p>
            </a>
        </li>
        @endcan

    </ul>
</li>