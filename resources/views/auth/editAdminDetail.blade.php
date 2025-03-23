@extends('layouts.abc')
@include('components.sidemenu')
@include ('layouts.navigation')
    <style>
        .p-4 {
        margin-left: 16rem; 
    }
    </style>
    
<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <div class="max-w-xl">
        <section>
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



            <h1>Edit Your Details Here !!</h1>
                <form method="POST" action="/update-admin-info">
                    @csrf 
                    {{ method_field('PUT') }}
                    <div class="mt-4">
                        <x-input-label for="phone_no" :value="__('Phone no')" />
                        <x-text-input id="	phone_no" class="block mt-1 w-full" type="text" name="phone_no" :value="old('phone_no',$users->phone_no)"  autocomplete="year" />
                        <x-input-error :messages="$errors->get('phone_no')" class="mt-2" />
                    </div>

                        
                        <div class="mt-4">
                            <x-input-label for="address" :value="__('address')" />

                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address',$users->address)"  autocomplete="address" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="company_name" :value="__('Company Name	')" />

                            <x-text-input id="company_name	" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name',$users->company_name)"  autocomplete="company_name" />
                            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-right mt-4">


                            <x-primary-button class="ms-0">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div> 

                    </div> 
                </form>
        </section>
    </div>
</div>