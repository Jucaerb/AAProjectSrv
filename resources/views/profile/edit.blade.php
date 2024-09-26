<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">

                    <!-- Update Profile Information Form -->
                    <div class="card mb-4">
                        <div class="card-body">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password Form -->
                    <div class="card mb-4">
                        <div class="card-body">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Delete User Form -->
                    <div class="card mb-4">
                        <div class="card-body">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
