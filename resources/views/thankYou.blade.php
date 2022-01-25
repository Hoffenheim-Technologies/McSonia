@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-col md:grid md:grid-cols-2">
        <div class="ml-auto self-center">
            <form class="border shadow-md rounded w-5/6 mx-auto px-7 py-12">
                <h3 class="font-bold text-yellow-500 mb-4">Booking Reference: {{$order->reference?? 'Null'}}</h3>
                <h3 class="font-bold text-4xl mb-5">Thank You For Your Payment</h3>
                <h5 class="font-semibold text-xl text-yellow-500 mb-4">An Email Has Been Sent To You With Your Payment Receipt</h5>
            </form>
        </div>
        <div class="mx-auto self-center order-first lg:order-last">
            <img src="images/confirmation.svg" alt="confirmation">
        </div>
    </div>
</div>
@endsection
