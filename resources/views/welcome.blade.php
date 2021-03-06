@extends('layouts.app')

@section('pageStyles')
<!-- <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/bootstrap.min.css"> -->
<link rel="stylesheet" href="css/nice-select.css">
<style>
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
<script>
$(window).on('load', () => {
    setTimeout(() => {
        $('.modal').slideDown()
    }, 3000)
})
</script>
<script>
$('body').click((event) => {
    if (!$(event.target).is($('.modal').find('*'))) {
        $('.plocation').slideUp()
        $('.dstate').slideUp()
        $('.dlocation').slideUp()
        $('.pdate').slideUp()
        $('.ptime').slideUp()
        $('.submit').slideUp()
    }
})
$('.fa-minus').click((event) => {
    $('.modal').slideUp()
    $('.open-modal').show()
})
$('.open-modal').click((event) => {
    $('.modal').slideDown()
    $('.open-modal').hide()
})
</script>
<script>
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
    $("#plocation").html(`<option selected disabled>Choose a Location</option>`)
    //console.log(id)

    $.ajax({
        type: 'GET',
        url: `/pstate/${id}`,
        data: id,
        success: (response) => {
            //console.log(response)
            for (const destination of response.locations) {
                $("#plocation").append(
                    `<option class="capitalize" value="${destination.id}">${destination.location}</option>`
                )
                $('#plocation').niceSelect('update')
            }

        },
        error: (e) => {
            //console.log(e);
        }
    });
}

var locales

function getLocation(id) {
    //console.log(id)
    $("#dlocation").html(`<option selected disabled>Choose a Location</option>`)
    $('#dstate').html(`<option selected disabled>Choose a State</option>`)
    $('#dlocation').niceSelect('update')
    $('#dstate').niceSelect('update')
    $.ajax({
        type: 'GET',
        url: `/location/${id}`,
        data: id,
        success: (response) => {
            locales = response.locales
            // for (const destination of response.destination) {
            //     $("#dlocation").append(`<option price="${destination.price}" value="${destination.dropoff_id}">${getName(destination.dropoff_id)}</option>`)
            //     $('#dlocation').niceSelect('update')
            // }
            for (const state of response.states) {
                $("#dstate").append(
                    `<option class="capitalize" value="${state.id}">${state.state}</option>`)
                $('#dstate').niceSelect('update')
            }

        },
        error: (e) => {
            console.log(e);
        }
    });
}
const setLocations = (id) => {
    $("#dlocation").html(`<option selected disabled>Choose a Location</option>`)
    for (const destination of locales[id]) {
        //console.log(destination)
        $("#dlocation").append(
            `<option price="${destination.price}" value="${destination.dropoff_id}">${getName(destination.dropoff_id)}</option>`
        )
        $('#dlocation').niceSelect('update')
    }
}
</script>
<script>
$('.question').click(function() {
    $(this).toggleClass('text-yellow-500')
    $(this).find('.fa').toggleClass('fa-chevron-down fa-chevron-up')
    $(this).next('.answer').slideToggle()
})
</script>
<script>
$('.item').change(() => {
    $('.pstate').slideDown()
})
$('.pstate').change(() => {
    $('.plocation').slideDown()
})
$('.plocation').change(() => {
    $('.dstate').slideDown()
})
$('.dstate').change(() => {
    $('.dlocation').slideDown()
})
$('.dlocation').change(() => {
    $('.pdate').slideDown()
})
$('.pdate').change(() => {
    $('.ptime').slideDown()
})
$('.ptime').change(() => {
    $('.submit').slideDown()
})
</script>
@endsection

@section('content')
<div class="mx-5 mb-8">
    <div class="flex flex-col md:grid md:grid-cols-2 mb-8 pb-4">
        <div class="ml-auto self-center w-full">
            <h1 class="font-bold text-3xl lg:text-6xl mb-5 w-full md:w-11/12">All Tools for Delivery Services in One
                Place</h1>
            <h3 class="lg:text-lg text-base w-full md:w-2/3 my-5">We are one team with you! <br> Our
                goal is to provide the best service for your clients.</h3>
            <a href="/request" class="btn-lg font-semibold inline-block uppercase border rounded-lg">Order a
                Delivery</a>
        </div>
        <div class="mx-auto order-first lg:order-last py-5">
            <img src="images/deliveries.svg" alt="deliveries">
        </div>
    </div>

    <div class="md:grid md:grid-cols-2 lg:grid-cols-3 lg:w-full mx-auto my-8 py-4 text-center lg:text-left">
        <div
            class="pb-5 lg:pr-5 md:col-span-2 lg:col-span-1 lg:pb-0 w-full text-3xl md:text-4xl lg:text-6xl text-yellow-600 font-extrabold">
            Swift and Timely Deliveries
        </div>
        <div class="w-full lg:px-5">
            <h4 class="text-2xl font-semibold">
                Reliable and Safe Logistic Services
            </h4>
            <p class="pt-5">Being a logistics company, we fully believe in the notion that our success is determined by
                your success. We therefore vet thoroughly and ensure that our service is as safe and reliable as
                possible.</p>
        </div>
        <div class="w-full lg:px-5">
            <h4 class="text-2xl font-semibold">
                We Help You Derive Fulfillment
            </h4>
            <p class="pt-5">At the same time, we want to make <b>you</b> happy and fulfilled, which would make us happy
                and fulfilled. For this reason, we always want to put you <b>first</b>.</p>
        </div>
    </div>

    <div class="text-center my-8 py-4 w-7/8 md:w-2/3 mx-auto">
        <div class="w-2/3 uppercase text-yellow-500 mx-auto my-8 text-xl font-bold">
            why choose us
        </div>
        <div class="grid grid-cols-2 items-center">
           <div>
                <p class="text-gray-600 italic mb-5">
                    At McSonia Logistics, we pride ourselves in efficient service delivery
                    to our clients while committing to the following cultural values:
                </p>
                <ul class="text-left">
                    <li class="flex flex-row items-center text-md"><i class="fa fa-flash pr-2 text-yellow-500"></i><span>Act with integrity</span></li>
                    <li class="flex flex-row items-center text-md"><i class="fa fa-fire pr-2 text-yellow-500"></i><span>Passion</span></li>
                    <li class="flex flex-row items-center text-md"><i class="fa fa-handshake-o pr-2 text-yellow-500"></i><span>Synergy</span></li>
                    <li class="flex flex-row items-center text-md"><i class="fa fa-lightbulb-o pr-2 text-yellow-500"></i><span>Innovation</span></li>
                    <li class="flex flex-row items-center text-md"><i class="fa fa-thumbs-o-up pr-2 text-yellow-500"></i><span>Quality and Efficiency</span></li>
                    <li class="flex flex-row items-center text-md"><i class="fa fa-users pr-2 text-yellow-500"></i><span>Collaboration</span></li>
                    <li class="flex flex-row items-center text-md"><i class="fa fa-wrench pr-2 text-yellow-500"></i><span>Decisiveness</span></li>
                    <li class="flex flex-row items-center text-md"><i class="fa fa-line-chart pr-2 text-yellow-500"></i><span>Aspiration</span></li>
                </ul>
           </div>
           <div>
               <img src="images/hopme.svg" alt="">
           </div>
        </div>
    </div>

    <div class="text-center w-full my-8 py-4">
        <div class="w-2/3 uppercase text-yellow-500 mx-auto my-8 text-xl font-bold">
            Key Features
        </div>
        <div class="lg:grid grid-cols-4 pb-6">
            <div>
                <i class="fa fa-car text-6xl text-yellow-500"></i>
                <h3 class="text-xl font-semibold text-center mt-5 mb-3">
                    Wide Range of Dispatchers
                </h3>
                <!-- <p class="text-md">Experienced staff and professionally trained drivers</p> -->
            </div>
            <div>
                <i class="fa fa-book text-6xl text-yellow-500"></i>
                <h3 class="text-xl font-semibold text-center mt-5 mb-3">
                    Wide range of delivery items
                </h3>
                <!-- <p class="text-md">Experienced staff and professionally trained drivers</p> -->
            </div>
            <div>
                <i class="fa fa-bus text-6xl text-yellow-500"></i>
                <h3 class="text-xl font-semibold text-center mt-5 mb-3">
                    Speed of Service
                </h3>
                <!-- <p class="text-md">Experienced staff and professionally trained drivers</p> -->
            </div>
            <div>
                <i class="fa fa-road text-6xl text-yellow-500"></i>
                <h3 class="text-xl font-semibold text-center mt-5 mb-3">
                    Large Distances Covered
                </h3>
                <!-- <p class="text-md">Experienced staff and professionally trained drivers</p> -->
            </div>
        </div>

        <div class="w-2/3 mx-auto uppercase font-bold text-white pt-8">
            <a href="/request" class="btn-lg rounded-lg">Book now</a>
        </div>
    </div>

    <div class="my-8 py-4 bg-gray-200">
        <div class="text-yellow-500 text-center">
            @if (!empty($faqs))
            <h1 class="font-bold text-3xl pb-4">FAQs</h1>
            <p class="font-medium text-2xl text-black">Frequently Asked Questions</p>
            <div class="md:grid grid-cols-2 pt-8">
                @foreach($faqs as $faq)
                <div class="text-black w-5/6 md:w-2/3 mx-auto my-5">
                    <div class="question w-full flex flex-row justify-between text-left cursor-pointer">
                        <span>
                            <i class="fa fa-bus text-yellow-500 pr-3"></i>
                            {{ $faq->question }}
                        </span>

                        <i class="fa fa-chevron-down text-yellow-500"></i>
                    </div>
                    <div class="answer w-full text-left py-2 font-bold text-xl" style="display: none;">
                        {{ $faq->answer }}
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
<div class="modal fixed top-1/2 lg:top-16 right-1/2 lg:right-0 transform -translate-y-1/2 translate-x-1/2 lg:translate-y-0 lg:translate-x-0 right-5 lg:w-1/4 bg-yellow-500 shadow-lg pb-4"
    style="display:none">
    <form action="/" method="POST">
        @csrf
        <div class="py-2 px-3 flex justify-between items-center">
            <div class="text-2xl text-white font-bold">Order Now</div>
            <i class="fa fa-minus text-white hover:text-black"></i>
        </div>
        <div class="item hidden px-3 mb-2">
            <label for="" class="uppercase text-xs px-2 text-white">Items *</label>
            <select name="item" id="item" class="niceselect border-0 w-full">
                <option selected disabled>Choose an Item</option>
                @foreach ($items as $item)
                <option value="{{$item->id}}" price="{{$item->price}}">{{$item->item}}</option>
                @endforeach
            </select>
        </div>
        <div class="pstate px-3 mb-2">
            <label for="" class="uppercase text-xs px-2 text-white">Pickup State *</label>
            <select onchange="getPickupLocales($(this).val())" name="pstate" id="pstate" class="niceselect border-0 w-full">
                <option selected disabled>Choose a State</option>
                @foreach ($states as $state)
                <option value="{{$state->id}}">{{$state->state}}</option>
                @endforeach
            </select>
        </div>
        <div class="plocation px-3 mb-2" style="display: none">
            <label for="" class="uppercase text-xs px-2 text-white">Pickup Location *</label>
            <select onchange="getLocation($(this).val())" name="plocation" id="plocation" class="niceselect border-0 w-full">
                <option selected disabled>Choose a Location</option>
                @foreach ($locations as $location)
                <option class="capitalize" value="{{$location->id}}">{{$location->location}}</option>
                @endforeach
            </select>
        </div>
        <div class="dstate px-3 mb-2" style="display: none">
            <label for="" class="uppercase text-xs px-2 text-white">Dropoff State *</label>
            <select name="dstate" id="dstate" class="niceselect border-0 w-full"
                onchange="setLocations($(this).val())">
                <option value="" selected disabled>Choose your State</option>
            </select>
        </div>
        <div class="dlocation px-3" style="display: none;">
            <label for="" class="uppercase text-xs px-2 text-white">Dropoff Location *</label>
            <select name="dlocation" id="dlocation" class="niceselect border-0 w-full">
                <option value="" selected disabled>Choose your location</option>
            </select>
        </div>
        <div class="w-full pdate px-3" style="display: none;">
            <label for="" class="uppercase text-xs px-2 text-white">Pickup Date *</label>
            <input id="pdate" name="pdate"
                class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="date">
        </div>
        <div class="w-full ptime px-3" style="display: none;">
            <label for="" class="uppercase text-xs px-2 text-white">Pickup Time *</label>
            <input id="ptime" name="ptime"
                class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="time">
        </div>
        <div class="submit w-full px-3" style="display: none;">
            <button
                class="mt-4 px-3 py-3 bg-white text-black hover:bg-black hover:text-white hover:border-0 hover:ring-0 w-full rounded font-semibold uppercase border"
                type="submit">Book Now</button>
        </div>
    </form>
</div>
<div class="open-modal fixed rounded-full bottom-5 right-5 bg-yellow-500 py-4 px-5 shadow-xl cursor-pointer text-white" style="display: none">
    <i class="fa fa-sign-in"></i>
</div>
@endsection