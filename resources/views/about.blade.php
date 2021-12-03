@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-col md:grid md:grid-cols-2">
        <div class="mx-auto self-center">
            <img src="images/about.svg" alt="deliveries">
        </div>
        <div class="ml-auto self-center text-left md:text-right">
            <h6 class="text-md uppercase text-yellow-500 w-max ml-auto mt-12 font-semibold">about us</h6>
            <h1 class="font-bold text-3xl lg:text-6xl mb-5 capitalize">make your work easier with us</h1>
            <p class="text-base md:text-md ml-auto text-yellow-600 w-full md:w-2/3 my-3">
                McSonia is a platform for your entire business seamless functioning. 
            </p>
            <p class="text-md ml-auto text-yellow-600 w-full md:w-2/3 my-3">
                Accept orders, manage courier's schedules, automate the creation of a personal account for every client.
            </p>
        </div>
    </div>
</div>
@endsection
