
<x-app-layout>
<style>
  .py-12 {
    margin-left: 15rem;
    
  
}
h1{
    margin-left: 18rem;
   }
    </style>
   

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <section>
 
  <form method="POST" action="/save-salary" class="mt-6 space-y-6"> 
        @csrf
        {{ method_field('PUT') }}

<h1>Enter Employee salary details</h1> 

      
  <label for="
  "> Employee Name</label><br>
  <x-text-input id="employee_id" class="block mt-1 w-1/2" type="text" value="" name="employee_id" :value="old('name',$response->name)"  autocomplete="name" />
  <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
 
    
  
  </select>
        </div>
        <input type="hidden" name="employee_id" value="{{ $response->employee_id }}">
        <!-- Email Address --> 
        <div class="mt-4">
            <x-input-label for="	year" :value="__('Year')" />
            <x-text-input id="year" class="block mt-1 w-1/2" type="text" name="year" :value="old('year',$response->year)"  autocomplete="year" />
            <x-input-error :messages="$errors->get('year')" class="mt-2" />
        </div> 

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="amount" :value="__('Salary')" />

            <x-text-input id="amount" class="block mt-1 w-1/2" type="text" name="amount" :value="old('amount',$response->amount)" autocomplete="amount" />
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Save Salary') }}
            </x-primary-button>
        </div>

    

   
</section>

                </div>
            </div>

           

           
        </div>
    </div>
</x-app-layout>

</app-layout>