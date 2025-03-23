<section>

    <form method="POST" action="add-employee-info">
        @csrf
        @if (session('success'))
        <div  id="alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('errors'))
        <div  id="alert" class="alert alert-danger">
           Required Feild Missing
        </div>
    @endif
    @if (session('Error'))
        <div  id="alert" class="alert alert-danger">
            {{ session('Error') }}
        </div>
    @endif

<h1 style="margin-left: 16rem;">
    Add More About You !!
</h1>
        <!-- Name -->
        <div>
            <x-input-label for="phone_no" :value="__('Phone no')" />
            <x-text-input id="phone_no" class="block mt-1 w-full" type="text" name="phone_no"  autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('phone_no')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="date_of_birth" :value="__('Date Of Birth')" />
            <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('Date Of Birth')"  autocomplete="dob" />
            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="date_of_joining" :value="__('Date Of Joining')" />

            <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_joining" :value="old('Date Of Joining')"  autocomplete="dob" />
            <x-input-error :messages="$errors->get('date_of_joining')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="tax_regime" :value="__('Tax Regime')" />

            <x-text-input id="tax_regime" class="block mt-1 w-full" type="text" name="tax_regime" :value="old('Tax Regime')" autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('tax_regime')" class="mt-2" />
        </div>
       

        <div>
        <div class="mt-4">
            <x-input-label for="emrgency_phone_no" :value="__('Emergency No')" />
            <x-text-input id="emrgency_phone_no" class="block mt-1 w-full" type="text" name="emrgency_phone_no" :value="old('Emrgency No')"  autofocus autocomplete="usertype" />
            <x-input-error :messages="$errors->get('emrgency_phone_no')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="employee_code" :value="__('Employee Code')" />
            <x-text-input id="employee_code" class="block mt-1 w-full" type="text" name="employee_code" :value="old('Employee Code')"  autofocus autocomplete="usertype" />
            <x-input-error :messages="$errors->get('employee_code')" class="mt-2" />
        </div>
        <div class="flex items-center justify-right mt-4">
           

           <x-primary-button class="ms-0">
               {{ __('Add') }}
           </x-primary-button>
       </div> 
        <div class="flex items-center justify-right mt-4">
           

          
              <a href="edit-employee-details">Edit Your Info</a>
           
       </div> 
   
    </form>
    <script>
          
          setTimeout(function() {
              $('#alert').fadeOut('fast');
          }, 5000); // 5000 milliseconds = 5 seconds
      </script>
</section>
