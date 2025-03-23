<x-app-layout>
    <style>
        .py-12 {
            margin-left: 15rem;
        }

        h1 {
            margin-left: 18rem;
        }

        .flex {
            align-items: center;
        }

        /* Adjust margin between label and asterisk */
        .text-red-500 {
            margin-left: 5px;
        }
    </style>

    @if (session('success'))
        <div id="alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div id="alert" class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <section>
        <h1>Edit User Details</h1>
            <form method="POST" action="{{ route('update-user', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex items-center mt-4"> 
                    <x-input-label for="name" :value="__('Name')" />
                    <span class="text-red-500">*</span>
                </div>
                <x-text-input id="name" class="block mt-1 w-full" type="text" required name="name"
                    value="{{ old('name', $user->name) }}" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />

                <div class="flex items-center mt-4"> 
                    <x-input-label for="email" :value="__('Email')" />
                    <span class="text-red-500">*</span>
                </div>
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    value="{{ old('email', $user->email) }}" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                <div class="flex items-center mt-4"> 
                    <x-input-label for="password" :value="__('New Password (optional)')" />
                </div>
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                <div class="flex items-center mt-4">
                    <x-input-label for="image" :value="__('Profile Image')" />
                </div>

                <div class="flex items-center mt-2 space-x-4">
                    <img src="{{ $user->image_path ? asset($user->image_path) : asset('image/logo.jpg') }}" 
                        class="w-20 h-20 rounded-full object-cover border" 
                        alt="Profile Image">
                    <input id="image" class="block w-full" type="file" name="image" accept="image/*" />
                </div>
                <x-input-error :messages="$errors->get('image')" class="mt-2" />


                <div class="flex items-center justify-right mt-4">
                    <x-primary-button class="ms-0" type="submit">
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </form>
        </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
