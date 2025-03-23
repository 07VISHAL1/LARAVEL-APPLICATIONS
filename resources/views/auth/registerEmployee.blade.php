

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
@if (session('success'))
        <div  id="alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('errors'))
        <div  id="alert" class="alert alert-danger">
            {{ session('errors') }}
        </div>
    @endif
    @if (session('Error'))
        <div  id="alert" class="alert alert-danger">
            {{ session('Error') }}
        </div>
    @endif

/* Adjust margin between label and asterisk */
.text-red-500 {
    margin-left: 5px; /* Adjust as needed */
}
</style>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                    <form method="POST" action="/user-added" enctype="multipart/form-data">
                    @csrf                           
                <h1>Add User Details</h1>
                <!-- Name -->
                <div class="flex items-center mt-4"> 
                    <x-input-label for="name" :value="__('Name')" />
                    <span class="text-red-500">*</span>
                </div>
                <x-text-input id="name" class="block mt-1 w-full {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" required name="name"
                    :value="old('name')" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                
                <!-- Email -->
                <div class="flex items-center mt-4"> 
                    <x-input-label for="email" :value="__('Email')" />
                    <span class="text-red-500">*</span>
                </div>
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <div id="email-error" class="text-red-500 mt-2" style="display: none;"></div>
                
                <!-- Password -->
                <div class="flex items-center mt-4"> 
                    <x-input-label for="password" :value="__('Password')" />
                    <span class="text-red-500">*</span>
                </div>
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                
                <!-- Image Upload -->
                <div class="flex items-center mt-4"> 
                    <x-input-label for="image" :value="__('Profile Image')" />
                </div>
                <input id="image" class="block mt-1 w-full" type="file" name="image" accept="image/*" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                
                <!-- Submit Button -->
                <div class="flex items-center justify-right mt-4">
                    <x-primary-button class="ms-0" type="submit">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>

                    </section>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
