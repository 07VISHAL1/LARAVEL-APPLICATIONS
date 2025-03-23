@extends('layouts.abc')
@include('components.sidemenu2')
@include ('layouts.navUser')
<style>
    .p-4 {
    margin-left: 16rem; 
}
</style>
 
<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <div class="max-w-xl">
        <section>
            <form method="Post" action="update-employee-info">
                @csrf
                {{ method_field('PUT') }}
                @if (session('success'))
        <div  id="alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('Error'))
        <div  id="alert" class="alert alert-danger">
            {{ session('Error') }}
        </div>
    @endif
    @if (session('validation'))
        <div id="alert" class="alert alert-danger">
            {{ session('validation') }}
        </div>
    @endif
    @if (session('Exception'))
        <div  id="alert"class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">X</button>
            {{ session('Exception') }}
        </div>
    @endif
               
                <h1 style="margin-left: 16rem;">
                Edit your Details!!
                </h1>
                <!-- Name -->
                <div>
                    <x-input-label for="phone_no" :value="__('Phone no')" />
                    <x-text-input id="phone_no" class="block mt-1 w-full" type="text" :value="old('phone_no', $users->phone_no)"  name="phone_no" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('phone_no')" class="mt-2" />
                </div>
                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="date_of_birth" :value="__('Date Of Birth')" />
                    <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth',$users->date_of_birth )" required autocomplete="dob" />
                    <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                </div>
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="date_of_joining" :value="__('Date Of Joining')" />

                    <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_joining" :value="old('date_of_joining',$users->date_of_joining)" required autocomplete="dob" />
                    <x-input-error :messages="$errors->get('date_of_joining')" class="mt-2" />
                </div>
                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="tax_regime" :value="__('Tax Regime')" />

                    <x-text-input id="tax_regime" class="block mt-1 w-full" type="text" name="tax_regime" :value="old('tax_regime',$users->tax_regime)" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('tax_regime')" class="mt-2" />
                </div>
                <div>
                <div class="mt-4">
                    <x-input-label for="emergency_phone_no" :value="__('Emergency No')" />
                    <x-text-input id="emergency_phone_no" class="block mt-1 w-full" type="text" name="emrgency_phone_no	" :value="old('emrgency_phone_no',$users->emrgency_phone_no)" required autofocus autocomplete="usertype" />
                    <x-input-error :messages="$errors->get('emergency_phone_no')" class="mt-2" />
                </div>
                </div>
                <div class="flex items-center justify-right mt-4">
                <x-primary-button class="ms-0">
                    {{ __('update') }}
                </x-primary-button>
                </div> 
                <div class="flex items-center justify-right mt-4">
            </form>
        </section>
    </div>
</div>
    <script>
          setTimeout(function() {
              $('#alert').fadeOut('fast');
          }, 5000); // 5000 milliseconds = 5 seconds
      </script>