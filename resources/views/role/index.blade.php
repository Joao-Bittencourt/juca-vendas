<x-app-layout>

    <div class="card-body">
        <div class="card mb-4">
            <div class="card-header">
                {{ __('Role') }}

                <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right">
                    {{ __('Create role')}}
                </a>
            </div>
            <x-lists.roles-list :data=$roles />

        </div>
    </div>
    </div>
</x-app-layout>