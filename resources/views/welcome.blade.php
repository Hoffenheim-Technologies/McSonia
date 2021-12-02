@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-col md:grid md:grid-cols-2">
        <div class="ml-auto self-center w-full">
            <h1 class="font-bold text-3xl lg:text-6xl mb-5 w-full md:w-11/12">All Tools for Delivery Services in One Place</h1>
            <h3 class="lg:text-lg text-base text-yellow-600 w-full md:w-2/3 my-5">We are one team with you! <br> Our goal is to provide the best service for your clients.</h3>
            <a href="/request" class="btn-lg font-semibold inline-block uppercase border rounded-lg">Order a Delivery</a>
        </div>
        <div class="mx-auto order-first lg:order-last py-5">
            <img src="images/deliveries.svg" alt="deliveries">
        </div>
    </div>
</div>
@endsection
