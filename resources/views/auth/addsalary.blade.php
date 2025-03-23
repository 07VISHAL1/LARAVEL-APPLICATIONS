
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
 
  <form method="POST" action="/salary-added" class="mt-6 space-y-6"> 
        @csrf
<h1>Enter Employee salary details</h1> 

      
  <label for="
  ">Enter Employee Name</label><br>
  <select name="employee_id" class="block mt-1 w-1/2" id="employee_id">
  <x-input-error :messages="$errors->get('Employee_id')" class="mt-2" />
  <option value="" ></option>
    @foreach($user as $user)
    
    <option value="{{$user->id}}">{{$user->name}}</option>
    @endforeach
  </select>
        </div>

        <!-- Email Address --> 
        <div class="mt-4">
            <x-input-label for="	year" :value="__('Year')" />
            <x-text-input id="year" class="block mt-1 w-1/2" type="text" name="year" :value="old('year')"  autocomplete="year" />
            <x-input-error :messages="$errors->get('year')" class="mt-2" />
        </div> 

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="amount" :value="__('Salary')" />

            <x-text-input id="amount" class="block mt-1 w-1/2" type="text" name="amount" :value="old('Salary')" autocomplete="amount" />
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Add Salary') }}
            </x-primary-button>
        </div>
        <a href="/salary-table">Salary Info</a>
    

   
</section>

                </div>
            </div>

           

           
        </div>
    </div>
</x-app-layout>

</app-layout>