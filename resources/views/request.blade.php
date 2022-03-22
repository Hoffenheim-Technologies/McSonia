@extends ('layouts.app')

@section('pageStyles')
<!-- <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/bootstrap.min.css"> -->
<link rel="stylesheet" href="css/nice-select.css">
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<style>
header a:hover {
    text-decoration: none;
    color: #f59e0b
}

ul.list {
    width: 100%;
    overflow-y: auto !important;
    max-height: 300px;
    scrollbar-color: #000;
    scrollbar-width: thin;
}

ul.list::-webkit-scrollbar {
    width: 0.25em;
}

ul.list::-webkit-scrollbar-track {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}

ul.list::-webkit-scrollbar-thumb {
    background-color: #000;
}
</style>
@endsection

@section('extraScripts')
@isset($message, $reference)
@else
<script>
$(window).on('load', () => {
    getPickupLocales($('#pstate').val())
    
    var pstate_set = @isset($input) <?php echo($input->pstate) ?> @else '' @endisset;
    if (pstate_set){
        getLocation(pstate_set)
    }
    


    $('.journey').val($('[name=plocation]').find(":selected").text() + ' - ' + $('[name=dlocation]').find(
        ":selected").text())
    $('.end').text($('[name=dlocation]').find(":selected").text())
    $('.start').text($('[name=plocation]').find(":selected").text())
    var price = ((val1 = $('[name=dlocation]').find(":selected").attr('price')) ? +val1 : 0) + ((sval = $(
        '[name=item]').find(":selected").attr('price')) ? +sval : 0)
    $('.price').text('Price - ' + price.toString())
    
    $('[name=subtotal]').val(price)
    $('[name=total]').val(price)
})

function getName(id) {
    var locations = <?php
        echo(json_encode($locations));
    ?>;
    for (const location of locations) {
        if (location.id == id) {
            return location.location
        }
    }
}

function getPickupLocales(id) {
    $("#plocation").html(`<option selected disabled>Select a State</option>`)
    $('#plocation').niceSelect('update')
    

    $.ajax({
        type: 'GET',
        url: `/pstate/${id}`,
        data: id,
        success: (response) => {
            var plocation_set = @isset($input)<?php echo(($input->plocation)) ?>@else null @endisset;
            $('[name=plocation]').val(plocation_set)
            
            if (!response.locations.length > 0) {
                $("#plocation").html(`<option selected disabled>No selections available</option>`)
                $('#plocation').niceSelect('update')
            } else {
                if (plocation_set) {
                    $("#plocation").html(`<option selected disabled>Select a location</option>`)
                    for (const destination of response.locations) {
                        $("#plocation").append(
                            `<option class="capitalize" value="${destination.id}" ${(plocation_set == destination.id) ? 'selected' : '' }>${destination.location}</option>`
                        )
                        $('#plocation').niceSelect('update')
                    }
                } else {
                   
                    $("#plocation").html(`<option selected disabled>Select a location</option>`)
                    for (const destination of response.locations) {
                        $("#plocation").append(
                            `<option class="capitalize" value="${destination.id}">${destination.location}</option>`
                        )
                        $('#plocation').niceSelect('update')
                    }
                }
            }
            
            

        },
        error: (e) => {
            //console.log(e);
        }
    });
}

var locales

function getLocation(id) {
    $("#dlocation").html(`<option selected disabled>Choose a State</option>`)
    $('#dstate').html(`<option selected disabled>Loading...</option>`)
    $('#dlocation').niceSelect('update')
    $('#dstate').niceSelect('update')
    
    
    $.ajax({
        type: 'GET',
        url: `/location/${id}`,
        data: id,
        success: (response) => {
            locales = response.locales
            var pstate_set = @isset($input)<?php echo($input->pstate) ?>@else '' @endisset;
            var dstate_set = @isset($input)<?php echo($input->dstate) ?> @else '' @endisset;
            if(dstate_set) {setLocations(dstate_set)}
            // for (const destination of response.destination) {
            //     $("#dlocation").append(`<option price="${destination.price}" value="${destination.dropoff_id}">${getName(destination.dropoff_id)}</option>`)
            //     $('#dlocation').niceSelect('update')
            // }
            if (!response.states.length > 0){
                $("#dlocation").html(`<option selected disabled>No Destinations Available!</option>`)
                $('#dstate').html(`<option selected disabled>No Destinations Available!</option>`)
                $('#dlocation').niceSelect('update')
                $('#dstate').niceSelect('update')
            } else {
                console.log(response.states)
                for (const state of response.states) {
                    $("#dlocation").html(`<option selected disabled>Choose a Location</option>`)
                    $('#dstate').html(`<option selected disabled>Choose a State</option>`)
                    $('#dlocation').niceSelect('update')
                    $('#dstate').niceSelect('update')
                    $("#dstate").append(
                        `<option class="capitalize" value="${state.id}"  ${pstate_set ? ((pstate_set == state.id) ? 'selected' : '' ) : ''}>${state.state}</option>`)
                    $('#dstate').niceSelect('update')
                }
            }
        },
        error: (e) => {
            console.log(e);
        }
    });
}
const setLocations = (id) => {
    $("#dlocation").html(`<option selected disabled>Choose a Location</option>`)
    var dlocation_set = @isset($input) <?php echo(($input->dlocation)); ?> @else '' @endisset;
    for (const destination of locales[id]) {
       
        $("#dlocation").append(
            `<option price="${destination.price}" value="${destination.dropoff_id}" ${(dlocation_set == destination.id) ? 'selected' : '' }>${getName(destination.dropoff_id)}</option>`
        )
        $('#dlocation').niceSelect('update')
    }
}
</script>
<script>
$('button[type=submit]').click(() => {
    $('.timing').val($('[name=pdate]').val() + ', ' + $('[name=ptime]').val())
    $('.journey').val($('[name=plocation]').find(":selected").text() + ' - ' + $('[name=dlocation]').find(
        ":selected").text())
})
$('[name=pdate]').change(() => {
    $('.timing').val($('[name=pdate]').val() + ', ' + $('[name=ptime]').val())
})
$('[name=ptime]').change(() => {
    $('.timing').val($('[name=pdate]').val() + ', ' + $('[name=ptime]').val())
})
$('[name=plocation]').change(() => {
    $('.journey').val($('[name=plocation]').find(":selected").text() + ' - ' + $('[name=dlocation]').find(
        ":selected").text())
    $('.start').text($('[name=plocation]').find(":selected").text())
})
$('[name=dlocation]').change(() => {
    $('.journey').val($('[name=plocation]').find(":selected").text() + ' - ' + $('[name=dlocation]').find(
        ":selected").text())
    $('.start').text($('[name=plocation]').find(":selected").text())
    $('.end').text($('[name=dlocation]').find(":selected").text())
    var price = ((val1 = $('[name=dlocation]').find(":selected").attr('price')) ? +val1 : 0) + ((sval = $(
        '[name=item]').find(":selected").attr('price')) ? +sval : 0)
    $('.price').html('&#8358;' + price.toFixed(2).toLocaleString())
    $('[name=subtotal]').val(price)
    $('[name=total]').val(price)
})
$('[name=item]').change(() => {
    $('.journey').val($('[name=plocation]').find(":selected").text() + ' - ' + $('[name=dlocation]').find(
        ":selected").text())
    $('.start').text($('[name=plocation]').find(":selected").text())
    $('.end').text($('[name=dlocation]').find(":selected").text())
    var price = ((val1 = $('[name=dlocation]').find(":selected").attr('price')) ? +val1 : 0) + ((sval = $(
        '[name=item]').find(":selected").attr('price')) ? +sval : 0)
    $('.price').html('&#8358;' + price.toFixed(2).toLocaleString())
    console.log(price)
    $('[name=subtotal]').val(price)
    $('[name=total]').val(price)
})
</script>
@guest
<script>
$('[name=firstname]').change(() => {
    $('.firstname').val($('[name=firstname]').val())
})
$('[name=lastname]').change(() => {
    $('.lastname').val($('[name=lastname]').val())
})
$('[name=email]').change(() => {
    $('.email').val($('[name=email]').val())
})
$('[name=phone]').change(() => {
    $('.phone').val($('[name=phone]').val())
})
</script>
@else
<script>
$('.firstname').val('{{ Auth::user()->firstname }}')
$('.lastname').val('{{ Auth::user()->lastname }}')
$('.email').val('{{ Auth::user()->email }}')
$('.phone').val('{{ Auth::user()->phone }}')
</script>
@endguest
@endisset
@endsection

@section('content')
@isset($message, $reference)
<div>
    <div class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 w-max">
        @isset($message)
        <div
            class="flex flex-col sm:flex-row justify-center items-center uppercase text-green-800 font-bold text-3xl sm:text-6xl">
            {{ $message }}
            <img src="images/confirmation.svg" class="h-28 pl-5 order-first sm:order-last" alt="">
        </div>
        @endisset

        @isset($reference)
        <div class="py-3 lg:flex justify-center items-center text-center sm:text-2xl">
            <div>Your booking reference is</div>
            <div class="pl-5 text-yellow-500 text-3xl sm:text-6xl font-extrabold">{{ $reference }}</div>
        </div>
        <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
            @csrf @method('POST')
            <div class="row" style="margin-bottom:40px;">
                <div class="col-md-8 col-md-offset-2">
                    <p>
                    <div>
                        <strong>Total:</strong> @money($order->total)
                    </div>
                    </p>
                    <input type="hidden" name="email" value="{{$order->email}}"> {{-- required --}}
                    <input type="hidden" name="order_id" value="{{$order->id}}">
                    <input type="hidden" name="amount" value="{{$order->total*100}}"> {{-- required in kobo --}}
                    <input type="hidden" name="quantity" value="">
                    <input type="hidden" name="metadata" value="{{ json_encode($array = ['order_id' => $order->id,'user_id'=>$order->user_id]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                    <input type="hidden" name="currency" value="{{env('CURRENCY')}}">
                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                    <p>
                        <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                            <i class="fa fa-credit fa-lg"></i> Pay Now!
                        </button>
                    </p>
                </div>
            </div>
        </form>
        @endisset

    </div>
</div>
@else
<form class="mx-auto" method="POST" action="/request">
    @csrf @method('PUT')
    <div class="mx-auto w-3/4 mb-12">
        <ul class="relative flex flex-row mx-auto w-full justify-center items-center">
            <li class="flex flex-col justify-center"> <span
                    class="bg-yellow-500 px-3 py-1 border rounded-full flex justify-center flex-grow-0"
                    href="#">1</span></li>
            <span class="hidden sm:absolute left-0 -bottom-8 transform -translate-x-1/3">Ride Details</span>
            <span class="mx-3 flex-grow border-b"></span>
            <li class="flex flex-col justify-center"> <span
                    class="bg-yellow-500 px-3 py-1 border rounded-full flex justify-center" href="#">2</span></li>
            <span class="hidden sm:absolute -bottom-8">Contact Details</span>
            <span class="mx-3 flex-grow border-b"></span>
            <li class="flex flex-col justify-center"> <span
                    class="bg-yellow-500 px-3 py-1 border rounded-full flex justify-center" href="#">3</span></li>
            <span class="hidden sm:absolute right-0 -bottom-8 transform translate-x-1/3">Booking Summary</span>
        </ul>
    </div>
    <div class="content-1">
        <div class="sm:w-2/3 mx-auto mt-12">
            <div class="border rounded bg-yellow-100 mx-3">
                <div class="font-semibold py-3 px-3">
                    Ride Details
                </div>
                <div class="sm:flex flex-row w-full bg-white border-b py-3">
                    <div class="sm:w-1/3 border-b sm:border-b-0 sm:border-r">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Pickup Date *</label>
                        <input required id="pdate" name="pdate" @isset($input->pdate) value="{{$input->pdate}}" @endisset
                        class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="date"
                        >
                    </div>
                    <div class="sm:w-1/3 border-b sm:border-b-0 sm:border-x">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Pickup Time *</label>
                        <input required id="ptime" name="ptime" @isset($input->ptime) value="{{$input->ptime}}" @endisset
                        class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="time"
                        >
                    </div>
                    <div class="sm:w-1/3 border-b sm:border-b-0 sm:border-l">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Item *</label>
                        <select required class="niceselect item border-0 border-b sm:border-0 w-full" name="item" id="">
                            <option selected disabled>Choose</option>
                            @foreach ($items as $item)
                            <option value="{{$item->id}}" price="{{$item->price}}" @isset($input->item) @if($input->item == $item->id) selected @endif @endisset>{{$item->item}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="w-full bg-white border-y py-3">
                    <label for="" class="uppercase text-xs px-2 text-gray-500">Pickup Location *</label>
                    <div class="sm:flex flex-row">
                        <div class="sm:w-1/2 border-b sm:border-b-0 sm:border-r">
                            <select required @isset($input->pstate) value="{{$input->pstate}}" @endisset
                                onchange="getPickupLocales($(this).val())" name="pstate" id="pstate" class="niceselect
                                pstate border-0 w-full">
                                <option @isset($input->state) @else selected @endisset disabled>Choose a State
                                </option>
                                @foreach ($states as $state)
                                <option @isset($input->pstate) @if($input->pstate == $state->id) selected @endif @endisset class="capitalize" value="{{$state->id}}">{{$state->state}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="sm:w-1/2 border-b sm:border-b-0 sm:border-l">
                            <select required @isset($input->plocation) value="{{$input->plocation}}" @endisset
                                onchange="getLocation($(this).val())" name="plocation" id="plocation" class="niceselect
                                plocation border-0 w-full">
                                <option @isset($input->plocation) @else selected @endisset disabled>Choose a Location
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="w-full bg-white border-y py-3 border-t">
                    <div class="w-full">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Pickup Address *</label>
                        <input required id="paddress" name="paddress"
                            class="w-full bg-white border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                            type="text" />
                    </div>
                </div>
                <div class="locales hidden" id="locales"></div>
                <div class="w-full bg-white border-t py-3">
                    <label for="" class="uppercase text-xs px-2 text-gray-500">Dropoff Location *</label>
                    <div class="sm:flex flex-row">
                        <div class="sm:w-1/2 border-b sm:border-b-0 sm:border-r">
                            <select required name="dstate" id="dstate" class="niceselect dstate border-0 w-full"
                                onchange="setLocations($(this).val())">
                                <option @isset($input->dlocation) @else selected @endisset value="" selected
                                    disabled>Choose your State</option>
                            </select>
                        </div>
                        <div class="sm:w-1/2 border-b sm:border-b-0 sm:border-l">
                            <select required name="dlocation" id="dlocation" class="niceselect dlocation border-0 w-full">
                                <option @isset($input->dlocation) @else selected @endisset value="" selected
                                    disabled>Choose your location</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="w-full bg-white border-t py-3">
                    <div class="w-full">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Dropoff Address *</label>
                        <input required id="daddress" name="daddress"
                            class="w-full bg-white border-0 focus:outline-none focus:border-none focus:ring-0"
                            type="text">
                    </div>
                </div>
                <div class="w-full bg-white border py-3">
                    <label for="" class="uppercase text-xs px-2 text-gray-500">Item Description</label>
                    <textarea id="comments" name="comments"
                        class="w-full focus:bg-white border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                        type="text" placeholder="Describe your item"></textarea>
                </div>
            </div>
            <!-- <div class="border relative rounded bg-yellow-100 mx-3 my-3 sm:my-0 sm:mx-5">
                <div class="h-full">
                    <div class="flex flex-col h-full justify-evenly">
                        <div class="flex flex-col items-start text-3xl font-bold px-4">
                            <div class="flex flex-row items-center">From <span
                                    class="mx-3 text-green-400 text-5xl start">Start</span></div>
                            <span class="flex-grow border-b-4 border-yellow-500"></span>
                            <div class="flex flex-row items-center">To <span
                                    class="mx-3 text-green-400 text-5xl end">End</span></div>
                        </div>
                        <div class="mx-3 hidden justify-center grid grid-cols-2">
                            <input readonly name="subtotal" class="">
                            <input readonly name="total" class="">
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="flex flex-row justify-end">
            <button id="btn_contact_details" class="btn-lg font-semibold block uppercase border rounded-lg"
                type="submit" onclick="event.preventDefault();">
                Next
                <i class="fa fa-arrow-right text-white"></i>
            </button>
        </div>
    </div>
    <div class="content-2" style="display: none;">
        <div class="md:flex flex-row">
            <div class="lg:w-64 rounded mx-5 bg-white">
                <div class="shadow rounded mb-3 pt-6">
                    <h3 class="font-semibold mt-4 mb-2 px-3">
                        Summary
                    </h3>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">Service Type</label>
                        <input value="Distance"
                            class="w-full py-3 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                            type="text" disabled>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">from - to</label>
                        <input id="summary_from_to" value=""
                            class="journey w-full py-3 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                            type="text" disabled>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">pickup date, time</label>
                        <input id="summary_pickup_details" value=""
                            class="timing w-full py-3 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                            type="text" disabled>

                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">vehicle</label>
                        <input id="summary_vehicle" value="Truck"
                            class="w-full py-3 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                            type="text" disabled>
                    </div>
                </div>
                <div class="flex flex-row mx-3 my-5 pb-4 bg-white border-b justify-between">
                    <h6 class="font-medium">
                        Selection
                    </h6>
                    <p id="summary_selection_price">Price - <span class="price"></span></p>
                </div>
                <div class="flex flex-row mx-3 my-5 pb-4 bg-white border-b justify-between">
                    <h6 class="font-bold">
                        Total
                    </h6>
                    <p id="summary_total_price" class="font-bold">Price - <span class="price"></span></p>
                </div>
            </div>
            <div class="flex-grow rounded mx-5">
                @guest
                <div class="mt-6 contact-details shadow">
                    <div class="w-full bg-yellow-100 px-3 py-3 uppercase">Contact Details</div>
                    <div class="flex flex-row w-full bg-white border py-3">
                        <div class="w-1/2 border-r">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">first name *</label>
                            <input required name="firstname"
                                class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                type="text">
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">last name *</label>
                            <input name="lastname"
                                class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                type="text">
                        </div>
                    </div>
                    <div class="flex flex-row w-full bg-white border py-3">
                        <div class="w-1/2 border-r">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">Email address*</label>
                            <input name="email"
                                class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                type="email">
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">phone number *</label>
                            <input name="phone"
                                class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                type="phone">
                        </div>
                    </div>
                    <div class="w-full bg-yellow-100 py-3 px-5">
                        <div class="flex flex-row items-center py-3">
                            <label for="" class="uppercase text-md px-2 text-gray-500">billing address</label>
                            <input name="billing"
                                class="order-first rounded outline-none border border-yellow-500 text-lg text-yellow-500 focus:ring focus:ring-yellow-500"
                                onchange="$('.billing-address').slideToggle();" type="checkbox" name="" id="">
                        </div>
                    </div>
                    <div class="billing-address" style="display: none;">
                        <div class="flex flex-row w-full bg-white border py-3">
                            <div class="w-full border-r">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">company registered
                                    name</label>
                                <input name="company"
                                    class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                    type="text">
                            </div>
                        </div>
                        <div class="flex flex-row w-full bg-white border py-3">
                            <div class="w-1/3 border-r">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">street *</label>
                                <input name="street"
                                    class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                    type="text">
                            </div>
                            <div class="w-1/3 border-x">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">street number *</label>
                                <input name="snumber"
                                    class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                    type="text">
                            </div>
                            <div class="w-1/3 border-l">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">city *</label>
                                <input name="city"
                                    class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                    type="text">
                            </div>
                        </div>
                        <div class="flex flex-row w-full bg-white border py-3">
                            <div class="w-1/3 border-r">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">state *</label>
                                <input name="state"
                                    class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                    type="text">
                            </div>
                            <div class="w-1/3 border-x">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">postal code *</label>
                                <input name="postal"
                                    class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                    type="text">
                            </div>
                            <div class="w-1/3 border-l">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">Country *</label>
                                <select name="country" class="niceselect border-0 w-full">
                                    <option value="1">Nigeria</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center w-full mt-3">
                OR 
                </div>

                <div>
                    <div class="flex flex-row justify-center w-full">
                        <!-- <button class="btn-lg font-semibold block uppercase border rounded-lg" type="submit"
                            onclick="event.preventDefault(); $('.contact-details').slideDown()">Don't have an
                            Account?</button> -->
                        <a class="btn-lg font-semibold block uppercase border rounded-lg" href="/login">Sign In / Sign Up</a>
                    </div>
                </div>
                @else
                <div class="mt-6 contact-details">
                    <div class="w-full bg-yellow-100 px-3 py-3 uppercase">Contact Details</div>
                    <div class="flex flex-row w-full bg-white border py-3">
                        <div class="w-1/2 border-r">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">first name *</label>
                            <input disabled value="{{ Auth::user()->firstname }}" name="fname"
                                class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                type="text">
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">last name *</label>
                            <input disabled value="{{ Auth::user()->lastname }}" name="lname"
                                class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                type="text">
                        </div>
                    </div>
                    <div class="flex flex-row w-full bg-white border py-3">
                        <div class="w-1/2 border-r">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">Email address*</label>
                            <input disabled value="{{ Auth::user()->email }}" name="email"
                                class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                type="email">
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">phone number *</label>
                            <input disabled value="{{ Auth::user()->phone }}" name="phone"
                                class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                type="phone">
                        </div>
                    </div>
                    <div class="w-full bg-yellow-100 py-3 px-5">
                        <div class="flex flex-row items-center py-3">
                            <label for="" class="uppercase text-md px-2 text-gray-500">billing address</label>
                            <input name="billing"
                                class="order-first rounded outline-none border border-yellow-500 text-lg text-yellow-500 focus:ring focus:ring-yellow-500"
                                onchange="$('.billing-address').slideToggle();" type="checkbox" name="" id="">
                        </div>
                    </div>
                    <div class="billing-address" style="display: none;">
                        <div class="flex flex-row w-full bg-white border py-3">
                            <div class="w-1/2 border-r">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">company registered
                                    name</label>
                                <input name="company"
                                    class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                    type="text">
                            </div>
                            <div class="w-1/2 border-l">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">tax number </label>
                                <input name="tax"
                                    class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                    type="text">
                            </div>
                        </div>
                        <div class="flex flex-row w-full bg-white border py-3">
                            <div class="w-1/3 border-r">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">street *</label>
                                <input name="street"
                                    class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                    type="text">
                            </div>
                            <div class="w-1/3 border-x">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">street number *</label>
                                <input name="snumber"
                                    class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                    type="text">
                            </div>
                            <div class="w-1/3 border-l">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">city *</label>
                                <input name="city"
                                    class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                    type="text">
                            </div>
                        </div>
                        <div class="flex flex-row w-full bg-white border py-3">
                            <div class="w-1/3 border-r">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">state *</label>
                                <input name="state"
                                    class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                    type="text">
                            </div>
                            <div class="w-1/3 border-x">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">postal code *</label>
                                <input name="postal"
                                    class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                    type="text">
                            </div>
                            <div class="w-1/3 border-l">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">Country *</label>
                                <select name="country" class="niceselect border-0 w-full">
                                    <option value="1">Nigeria</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @endguest
            </div>
        </div>
        <div class="flex flex-row justify-between mt-8">
            <button class="underline" id="return_item_details" type="submit"
                onclick="event.preventDefault(); $('.content-2').hide(); $('.content-1').show()">
                <i class="fa fa-arrow-left text-black"></i>
                Previous
            </button>
            <button class="btn-lg font-semibold block uppercase border rounded-lg" id="button_booking_summary"
                type="submit"
                onclick="event.preventDefault(); if(validate(1, {{Auth::check()}})){ console.log(true);$('.content-2').hide(); $('.content-3').show() } else {alert('Please sign in or fill in your contact details');}">
                View Booking
                <i class="fa fa-arrow-right text-white"></i>
            </button>
        </div>
    </div>
    <div class="content-3" style="display: none;">
        <div class="md:flex flex-row">
            <div class="bg-yellow-100 mx-5 lg:w-1/3">
                <div class="bg-yellow-100 rounded mb-3 pt-6">
                    <h3 class="font-semibold mt-4 mb-2 px-3">
                        Contact and Billing Info
                    </h3>

                    <div class="flex flex-row mx-3 border-b border-b">
                        <div class="w-1/2">
                            <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">first name</label>
                            <input name="firstname" value=""
                                class="firstname w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                type="text" disabled>
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">lastname</label>
                            <input name="lastname" value=""
                                class="lastname w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                                type="text" disabled>
                        </div>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">email address</label>
                        <input name="email" value=""
                            class="email w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                            type="email" disabled>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">phone number</label>
                        <input name="phone" value=""
                            class="phone w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                            type="phone" disabled>
                    </div>
                </div>
            </div>
            <div class="bg-yellow-100 mx-5 lg:w-1/3">
                <div class="bg-yellow-100 rounded mb-3 pt-6">
                    <h3 class="font-semibold mt-4 mb-2 px-3">
                        Ride Details
                    </h3>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">Service Type</label>
                        <input value="Distance"
                            class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                            type="text" disabled>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">from - to</label>
                        <input value=""
                            class="journey w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                            type="text" disabled>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">pickup date, time</label>
                        <input value=""
                            class="timing w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                            type="text" disabled>
                    </div>
                    <!-- <div class="flex flex-row mx-3 border-b border-b">
                        <div class="w-1/2">
                            <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">distance</label>
                            <input value="300km" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text"  disabled>
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">time</label>
                            <input value="90 minutes" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text"  disabled>
                        </div>
                    </div> -->
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">vehicle</label>
                        <input value="Truck"
                            class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                            type="text" disabled>
                    </div>
                </div>
            </div>
            <div class="bg-white mx-5 lg:w-1/3">
                <div class="bg-yellow-100 rounded">
                    <h3 class="font-semibold pt-4 mb-2 px-3">
                        Vehicle Info
                    </h3>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">Vehicle</label>
                        <input value="Truck"
                            class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                            type="text" disabled>
                    </div>
                </div>
                <div class="my-5">
                    <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">do you have a discount code?</label>
                    <textarea
                        class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0"
                        name="" id="" rows="5"></textarea>
                    <button class="btn-lg rounded text-right" type="submit">Apply Code</button>
                </div>
                <div class="flex flex-row mx-3 my-5 pb-4 bg-white border-b justify-between">
                    <h6 class="font-medium">
                        Selection
                    </h6>
                    <p>Price - <span class="price"></span></p>
                </div>
                <div class="flex flex-row mx-3 my-5 pb-4 bg-white border-b justify-between">
                    <h6 class="font-bold">
                        Total
                    </h6>
                    <p class="font-bold">Price - <span class="price"></span></p>
                </div>
            </div>
        </div>
        <div class="flex flex-row justify-between">
            <button class="underline" type="submit"
                onclick="event.preventDefault(); $('.content-3').hide(); $('.content-2').show()"><i
                    class="fa fa-arrow-left text-black"></i>Previous</button>
            <button class="btn-lg font-semibold block uppercase border rounded-lg" type="submit">Book Now</button>
        </div>
    </div>
</form>
@endisset
<!-- <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
    <div class="row" style="margin-bottom:40px;">
        <div class="col-md-8 col-md-offset-2">
            <p>
                <div>
                    Lagos Eyo Print Tee Shirt
                    ₦ 2,950
                </div>
            </p>
            <input type="hidden" name="email" value="otemuyiwa@gmail.com"> {{-- required --}}
            <input type="hidden" name="orderID" value="345">
            <input type="hidden" name="amount" value="800"> {{-- required in kobo --}}
            <input type="hidden" name="quantity" value="3">
            <input type="hidden" name="currency" value="Price -">
            <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
            {{-- <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">  required --}}

            <input type="hidden" name="split_code" value="SPL_EgunGUnBeCareful"> {{-- to support transaction split. more details https://paystack.com/docs/payments/multi-split-payments/#using-transaction-splits-with-payments --}}
            <input type="hidden" name="split" value="{{ json_encode($split ?? '') }}"> {{-- to support dynamic transaction split. More details https://paystack.com/docs/payments/multi-split-payments/#dynamic-splits --}}
            {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

            <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}

            <p>
                <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                    <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                </button>
            </p>
        </div>
    </div>
</form> -->
@endsection
@section('custom-script')
<script src="js/request.js"></script>
@endsection