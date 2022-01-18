@extends('layouts.dashboard')

@section('content')
<div class="text-2xl font-bold mb-12">
    Welcome back <span class="text-yellow-900 text-4xl capitalize">{{ Auth::user()->firstname }}</span>
</div>
<div class="w-full">
    <div class="grid grid-cols-3 items-center">
        <div class="mx-3">
            <div class="w-full">
                <img src="images/order.svg" alt="order">
            </div>
            <div class="text-3xl py-8 text-yellow-900 font-bold capitalize">
                my orders
            </div>
            <div class="text-gray-500 font-semibold text-sm">
                <span class="capitalize text-yellow-900">{{ Auth::user()->firstname }}</span>
                , we at {{ config('app.name') }} are delighted to note that you  have 
                used our service 90 times, and we certainly hope we've delighted you too.
                We hope to keep seeing more of you here. Here's a summary of your orders.
            </div>
            <div class="mt-4 py-4 px-2 text-xl font-bold rounded bg-yellow-100">
                <div class="text-center mx-1">
                    <div class="flex flex-row items-center justify-between">
                        <span>Completed Orders</span>
                        <span class="text-3xl text-green-600">7</span>
                    </div>
                    <div class="flex flex-row items-center justify-between">
                        <span>Pending Orders</span>
                        <span class="text-3xl text-yellow-800">14</span>
                    </div>
                    <div class="flex flex-row items-center justify-between">
                        <span>Cancelled Orders</span>
                        <span class="text-3xl text-red-800">2</span>
                    </div>
                   
                    <div class="flex flex-row border-t-2 border-b-2 items-center justify-between">
                        <span>Total Orders</span>
                        <span class="text-3xl text-black">23</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-3">
            <div class="w-full">
                <img src="images/payment.svg" alt="order">
            </div>
            <div class="text-3xl py-8 text-yellow-900 font-bold capitalize">
                my payments
            </div>
            <div class="text-gray-500 font-semibold text-sm">
                <span class="capitalize text-yellow-900">{{ Auth::user()->firstname }}</span>
                , while we at {{ config('app.name') }} are highly service-oriented, we still need
                funding. Your prompt reliable payments help us to keep our service alive. And with
                users like you continuing to support us, we're constantly looking forwards at expanding
                the reach and improving the quality of our service.
            </div>
        </div>
        <div class="mx-3">
            <div class="w-full">
                <img src="images/tracking.svg" alt="order">
            </div>
            <div class="text-3xl py-8 text-yellow-900 font-bold capitalize">
                order status
            </div>
            <!-- <div class="text-gray-500 font-semibold text-sm">
                <span class="capitalize text-yellow-900">{{ Auth::user()->firstname }}</span>
                , we at {{ config('app.name') }} are delighted to note that you  have 
                used our service 90 times, and we certainly hope we've delighted you too.
                We hope to keep seeing more of you here. Here's a summary of your orders.
            </div> -->
        </div>
    </div>
</div>
@endsection
