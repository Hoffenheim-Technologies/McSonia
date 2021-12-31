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
            if (!$(event.target).is($('.modal').find('*'))){
                $('.dlocation').slideUp()
                $('.pdate').slideUp()
                $('.ptime').slideUp()
                $('.submit').slideUp()
            }           
        }) 
        $('.fa-minus').click((event) => {
            $('.modal').slideUp()
        })       
    </script>
    <script>
        function getName(id) {
            var locations = {!! json_encode($locations) !!}
            for (const location of locations) {
                if (location.id == id){
                    return location.location
                }
            }
        }
        function getLocation(id) {
            $("#dlocation").html(`<option selected disabled>Choose a Location</option>`)
            $('#dlocation').niceSelect('update')
            $.ajax({
                type:'GET',
                url:`/location/${id}`,
                data: id,
                success: (response) => {
                    for (const destination of response.destination) {
                        $("#dlocation").append(`<option price="${destination.price}" value="${destination.dropoff_id}">${getName(destination.dropoff_id)}</option>`)
                        $('#dlocation').niceSelect('update')
                    }
                },
                error: (e) => {
                    console.log(e);
                }
            });
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
        $('.plocation').change(()=>{
            $('.dlocation').slideDown()
        })
        $('.dlocation').change(()=>{
            $('.pdate').slideDown()
        })
        $('.pdate').change(()=>{
            $('.ptime').slideDown()
        })
        $('.ptime').change(()=>{
            $('.submit').slideDown()
        })
    </script>
@endsection

@section('content')
<div class="mx-5 mb-8">
    <div class="flex flex-col md:grid md:grid-cols-2 mb-8 pb-4">
        <div class="ml-auto self-center w-full">
            <h1 class="font-bold text-3xl lg:text-6xl mb-5 w-full md:w-11/12">All Tools for Delivery Services in One Place</h1>
            <h3 class="lg:text-lg text-base text-yellow-600 w-full md:w-2/3 my-5">We are one team with you! <br> Our goal is to provide the best service for your clients.</h3>
            <a href="/request" class="btn-lg font-semibold inline-block uppercase border rounded-lg">Order a Delivery</a>
        </div>
        <div class="mx-auto order-first lg:order-last py-5">
            <img src="images/deliveries.svg" alt="deliveries">
        </div>
    </div>

    <div class="md:grid md:grid-cols-2 lg:grid-cols-3 lg:w-full mx-auto my-8 py-4 text-center lg:text-left">
        <div class="pb-5 lg:pr-5 md:col-span-2 lg:col-span-1 lg:pb-0 w-full text-3xl md:text-4xl lg:text-6xl text-yellow-600 font-extrabold">
            Swift and Timely Deliveries
        </div>
        <div class="w-full lg:px-5">
            <h4 class="text-2xl font-semibold">
                Reliable and Safe Logistic Services
            </h4>
            <p class="pt-5">Video content is available on demand. Types of video include recreational video and graphical video and emotional makeup.</p>
        </div>
        <div class="w-full lg:px-5">
            <h4 class="text-2xl font-semibold">
                We Help You Derive Fulfillment
            </h4>
            <p class="pt-5">Video content is available on demand. Types of video include recreational video and graphical video and emotional makeup.</p>
        </div>
    </div>

    <div class="text-center my-8 py-4 w-7/8 md:w-2/3 mx-auto">
        <div class="w-2/3 uppercase text-yellow-500 mx-auto my-8 text-xl font-bold">
            why choose us
        </div>
            <p class="text-gray-600 italic mb-5">
                At McSonia Logistics, we pride ourselves in efficient service delivery
                to our clients while committing to the following cultural values:
            </p>
            <ul>
                <li class="text-md hover:text-lg hover:text-yellow-500">Act with integrity</li>
                <li class="text-md hover:text-lg hover:text-yellow-500">Passion</li>
                <li class="text-md hover:text-lg hover:text-yellow-500">Synergy </li>
                <li class="text-md hover:text-lg hover:text-yellow-500">Innovation</li>
                <li class="text-md hover:text-lg hover:text-yellow-500">Quality and Efficiency</li>
                <li class="text-md hover:text-lg hover:text-yellow-500">Collaboration</li>
                <li class="text-md hover:text-lg hover:text-yellow-500">Decisiveness</li>
                <li class="text-md hover:text-lg hover:text-yellow-500">Aspiration</li>
            </ul>
    </div>

    <div class="text-center w-full my-8 py-4">
        <div class="w-2/3 uppercase text-yellow-500 mx-auto my-8 text-xl font-bold">
            Key Features
        </div>
        <div class="lg:grid grid-cols-4 pb-6">
            <div>
                <i class="fa fa-car text-6xl text-yellow-500"></i>
                <h3 class="text-xl font-semibold text-center mt-5 mb-3">
                    Safety First
                </h3>
                <p class="text-md">Experienced staff and professionally trained drivers</p>
            </div>
            <div>
                <i class="fa fa-book text-6xl text-yellow-500"></i>
                <h3 class="text-xl font-semibold text-center mt-5 mb-3">
                    Safety First
                </h3>
                <p class="text-md">Experienced staff and professionally trained drivers</p>
            </div>
            <div>
                <i class="fa fa-bus text-6xl text-yellow-500"></i>
                <h3 class="text-xl font-semibold text-center mt-5 mb-3">
                    Safety First
                </h3>
                <p class="text-md">Experienced staff and professionally trained drivers</p>
            </div>
            <div>
                <i class="fa fa-road text-6xl text-yellow-500"></i>
                <h3 class="text-xl font-semibold text-center mt-5 mb-3">
                    Safety First
                </h3>
                <p class="text-md">Experienced staff and professionally trained drivers</p>
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
                <div class="text-black w-5/6 md:w-2/3 mx-auto">
                    <div class="question w-full flex flex-row justify-between text-left cursor-pointer">
                        <span>
                            <i class="fa fa-bus text-yellow-500"></i> 
                            {{ $faq->question }}
                        </span>
                        
                        <i class="fa fa-chevron-down text-yellow-500"></i>
                    </div>
                    <div class="answer w-full text-left py-4" style="display: none;">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
<div class="modal fixed top-1/2 lg:top-16 right-1/2 lg:right-0 transform -translate-y-1/2 translate-x-1/2 lg:translate-y-0 lg:translate-x-0 right-5 lg:w-1/4 bg-yellow-500 shadow-lg pb-4" style="display:none">
    <form action="/" method="POST">
        @csrf
        <div class="py-2 px-3 flex justify-between items-center">
            <div class="text-2xl text-white font-bold">Order Now</div>
            <i class="fa fa-minus text-white hover:text-black"></i>
        </div>
        <div class="plocation px-3 mb-2">
            <label for="" class="uppercase text-xs px-2 text-white">Pickup Location *</label>
            <select onchange="getLocation($(this).val())" name="plocation" id="" class="niceselect border-0 w-full">
                <option selected disabled>Choose a Location</option>
                @foreach ($locations as $location)
                    <option class="capitalize" value="{{$location->id}}">{{$location->location}}</option>
                @endforeach
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
            <input id="pdate" name="pdate" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="date" >
        </div>
        <div class="w-full ptime px-3" style="display: none;">
            <label for="" class="uppercase text-xs px-2 text-white">Pickup Time *</label>
            <input id="ptime" name="ptime" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="time" >
        </div>
        <div class="submit w-full px-3" style="display: none;">
            <button class="mt-4 px-3 py-3 bg-white text-black hover:bg-black hover:text-white hover:border-0 hover:ring-0 w-full rounded font-semibold uppercase border" type="submit">Book Now</button>
        </div>        
    </form>
</div>
@endsection
