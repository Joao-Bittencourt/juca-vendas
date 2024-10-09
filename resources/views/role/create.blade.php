<x-app-layout>
    <div class="card-body">
        <!-- Basic information -->
        <iv class="card mb-4">
            <x-card-header title="Roles" controller="roles"  />
            <div class="card-body">
                <form method="post" action="{{ route('roles.store') }}" class="mt-6 space-y-6">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <x-input-label for="name" :value="__('Role')" />
                                <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                        </div>

                    </div>

            </div>
            <div class="card-footer">
                <x-primary-button class="btn btn-primary">{{ __('Save') }}</x-primary-button>
            </div>

    </div>
</x-app-layout>