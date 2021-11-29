@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="grid grid-cols-2">
        <div class="ml-auto self-center">
            <form class="border shadow-md rounded w-5/6 mx-auto px-7 py-12">
                <h3 class="font-bold text-4xl mb-5">A Powerful Solution for all your Delivery needs.</h3>
                <h5 class="font-semibold text-xl text-yellow-500 mb-4">Leave a request to get a demonstration of how McSonia deliveries work.</h5>
                <div class="w-11/12 mx-auto">
                    <input class="w-full mx-auto px-4 md:px-5 py-2 my-3 rounded-md bg-yellow-50" type="text" name="" id="" placeholder="Your Name">
                    <input class="w-full mx-auto px-4 md:px-5 py-2 my-3 rounded-md bg-yellow-50" type="phone" name="" id="" placeholder="Phone">
                    <input class="w-full mx-auto px-4 md:px-5 py-2 my-3 rounded-md bg-yellow-50" type="email" name="" id="" placeholder="Email">
                    <button class="w-full btn-lg font-semibold block uppercase border rounded-lg">Leave a request</button>
                </div>                
            </form>

        </div>
        <div class="mx-auto self-center">
            <img src="images/contact.svg" alt="contact">
        </div>
    </div>
</div>
@endsection
