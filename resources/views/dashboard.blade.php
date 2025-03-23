@include('layouts.navUser')
@include('components.sidemenu2')

<style>
        h1{
        margin-left:16rem;    
        }
        .card{
        width: 15rem;
    margin-top: 4rem;
    margin-left: 17rem;
}
    </style>
    <h1>
        Hello {{ Auth::user()->name  }} !!
    </h1>
<x-guest-layout>
   
<style>
        h1{
        margin-left:16rem;    
        }
        <style>
.py-12 {
        margin-left: 19rem;
    }
    h1{
        margin-left: 18rem;
    }
    </style>
   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="margin-left: 8rem;">
                    {{ __("User Dashboard") }}
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>