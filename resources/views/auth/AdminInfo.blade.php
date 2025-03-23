
<style>
  .py-12 {
    margin-left: 15rem;
    h1{
        margin-left:15rem;
    }
   
}
</style>
    <section>
        <h1>Add More About You!!</h1>
            <form method="POST" action="{{ route('addinfo') }}">
                 @csrf 

                <div class="mt-4">
                    <x-input-label for="phone_no" :value="__('Phone no')" />
                    <x-text-input id="phone_no" class="block mt-1 w-full" type="text" name="phone_no" :value="old('Phone no ')"  autocomplete="phone_no" />
                    <x-input-error :messages="$errors->get('phone_no')" class="mt-2" />
                </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="address" :value="__('address')" />

                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"  autocomplete="address" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="company_name" :value="__('Company Name	')" />

                        <x-text-input id="company_name	" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" autocomplete="company_name" />
                        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-right mt-4">


                        <x-primary-button class="ms-0">
                            {{ __('Add Info') }}
                        </x-primary-button>
                    </div> 
                    <div class="flex items-center justify-right mt-4">
                    <a href="edit-admin-detail" >See Your Info</a>
                </div> 



            </form>
    </section>

