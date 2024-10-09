<x-app-layout>

    <div class="card-body">
        <!-- Basic information -->
        <div class="card mb-4">
            <x-card-header title="Give permission to role" controller="roles" />
            <div class="card-body">
                <form method="post" action="{{ route('roles.give_permission_to_role', ['roleId' => $role->id]) }}" class="mt-6 space-y-6">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8">
                            <x-input-label for="permission" :value="__('permissions')" />
                            <select id="permission" name="permission[]" class="form-control" multiple>
                                @foreach ($permissions as $permission)
                                <option value="{{ $permission->name }}" {{ (in_array($permission->id, $rolePermissions)) ? 'selected' : ''}}> {{ $permission->name }} </option>
                                @endforeach

                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('permission')" />
                        </div>
                    </div>


            </div>
            <div class="card-footer">
                <x-primary-button class="btn btn-primary">{{ __('Save') }}</x-primary-button>
            </div>
        </div>
    </div>
    <script>
        new MultipleSelect('#permission', {
            placeholder: 'Select permissions',
        })
    </script>

</x-app-layout>