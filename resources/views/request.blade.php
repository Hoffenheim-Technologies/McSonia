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
<script>
    $(window).on('load', () => {
        getLocation($('#plocation').val())
    })
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
        console.log(id)
        $.ajax({
            type:'GET',
            url:`/location/${id}`,
            data: id,
            success: (response) => {
                console.log(response)
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
    $('button[type=submit]').click(()=>{
        $('.timing').val($('[name=pdate]').val() + ', ' + $('[name=ptime]').val())
        $('.journey').val($('[name=plocation]').find(":selected").text() + ' - ' + $('[name=dlocation]').find(":selected").text())
    })
    $('[name=pdate]').change(() => {
        $('.timing').val($('[name=pdate]').val() + ', ' + $('[name=ptime]').val())
    })
    $('[name=ptime]').change(() => {
        $('.timing').val($('[name=pdate]').val() + ', ' + $('[name=ptime]').val())
    })
    $('[name=plocation]').change(() => {
        $('.journey').val($('[name=plocation]').find(":selected").text() + ' - ' + $('[name=dlocation]').find(":selected").text())
        $('.start').text($('[name=plocation]').find(":selected").text())
    })
    $('[name=dlocation]').change(() => {
        $('.journey').val($('[name=plocation]').find(":selected").text() + ' - ' + $('[name=dlocation]').find(":selected").text())
        $('.end').text($('[name=dlocation]').find(":selected").text())
        $('.price').text('Price - '+ $('[name=dlocation]').find(":selected").attr('price'))
    })
</script>
@guest
<script> 
$('[name=firstname]').change(()=>{
    $('.firstname').val($('[name=firstname]').val())
})
$('[name=lastname]').change(()=>{
    $('.lastname').val($('[name=lastname]').val())
})
$('[name=email]').change(()=>{
    $('.email').val($('[name=email]').val())
})
$('[name=phone]').change(()=>{
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
@endsection

@section('content')
@isset($message, $reference)
@isset($message)
{{ $message }}
@endisset
<br>
@isset($reference)
Your booking reference is {{ $reference }}
@endisset
@else
<form class="mx-auto container" method="POST" action="/request">
    @csrf @method('PUT')
    <div class="mx-auto w-3/4 mb-12">
        <ul class="relative flex flex-row mx-auto w-full justify-center items-center">
            <li class="flex flex-col justify-center"> <span class="bg-yellow-500 px-3 py-1 border rounded-full flex justify-center flex-grow-0" href="#">1</span></li>
            <span class="absolute left-0 -bottom-8 transform -translate-x-1/3">Ride Details</span>
            <span class="mx-3 flex-grow border-b"></span>
            <li class="flex flex-col justify-center"> <span class="bg-yellow-500 px-3 py-1 border rounded-full flex justify-center" href="#">2</span></li>
            <span class="absolute -bottom-8">Contact Details</span>
            <span class="mx-3 flex-grow border-b"></span>
            <li class="flex flex-col justify-center"> <span class="bg-yellow-500 px-3 py-1 border rounded-full flex justify-center" href="#">3</span></li>
            <span class="absolute right-0 -bottom-8 transform translate-x-1/3">Booking Summary</span>
        </ul>
    </div>
    <div class="content-1">
        <div class="sm:grid grid-cols-2 mt-12">
            <div class="border rounded bg-yellow-100 mx-5">
                <div class="font-semibold py-3 px-3">
                    Ride Details
                </div>
                <div class="flex flex-row w-full bg-white border-b py-3">
                    <div class="w-1/2 border-r">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Pickup Date *</label>
                        <input id="pdate" name="pdate" @isset($input->pdate) value="{{$input->pdate}}" @endisset class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="date" >
                    </div>
                    <div class="w-1/2 border-l">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Pickup Time *</label>
                        <input id="ptime" name="ptime" @isset($input->ptime) value="{{$input->ptime}}" @endisset class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="time" >
                    </div>
                </div>
                <div class="w-full bg-white border-y py-3">
                    <div class="w-full">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Pickup Location *</label>
                        <select @isset($input->plocation) value="{{$input->plocation}}" @endisset onchange="getLocation($(this).val())" name="plocation" id="plocation" class="niceselect border-0 w-full">
                        <option @isset($input->plocation) @else selected @endisset disabled>Choose a Location</option>
                            @foreach ($locations as $location)
                                <option @isset($input->plocation) @if($input->plocation == $location->id) selected @endif @endisset class="capitalize" value="{{$location->id}}">{{$location->location}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                <div class="w-full bg-white border-y py-3">
                    <div class="w-full">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Pickup Address *</label>
                        <input id="paddress" name="paddress" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                    </div>
                </div>
                <div class="w-full bg-white border-t py-3">
                    <div class="w-full">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Dropoff Location *</label>
                        <select name="dlocation" id="dlocation" class="niceselect border-0 w-full">
                            <option @isset($input->dlocation) @else selected @endisset  value="" selected disabled>Choose your location</option>
                        </select>
                    </div>
                </div>
                <div class="w-full bg-white border-t py-3">
                    <div class="w-full">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Dropoff Address *</label>
                        <input id="daddress" name="daddress" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                    </div>
                </div>
            </div>
            <div class="border relative rounded bg-yellow-100 mx-5">
                <div class="h-full">
                    <div class="flex flex-col h-full justify-evenly">
                        <div class="flex flex-row items-center">
                            <span class="mx-3 start">Start</span>
                            <span class="flex-grow border-b-4 border-yellow-500"></span>
                            <span class="mx-3 end">End</span>
                        </div>
                        <div class="mx-3 justify-center grid grid-cols-2">
                            <div class="price">Price</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row justify-end">
            <button id="btn_contact_details" class="btn-lg font-semibold block uppercase border rounded-lg" type="submit" onclick="event.preventDefault();">Enter Contact Details</button>
        </div>
    </div>
    <div class="content-2" style="display: none;">
        <div class="md:flex flex-row">
            <div class="w-64 rounded mx-5 bg-white">
                <div class="bg-yellow-100 rounded mb-3 pt-6">
                    <h3 class="font-semibold mt-4 mb-2 px-3">
                        Summary
                    </h3>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">Service Type</label>
                        <input value="Distance" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text"  disabled>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">from - to</label>
                        <input id="summary_from_to" value="" class="journey w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text"  disabled>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">pickup date, time</label>
                        <input id="summary_pickup_details" value="" class="timing w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text"  disabled>

                    </div>
                    <!-- <div class="flex flex-row mx-3 border-b border-b">
                        <div class="w-1/2">
                            <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">distance</label>
                            <input id="summary_distance" value="300km" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text"  disabled>
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">time</label>
                            <input id="summary_time" value="90 minutes" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text"  disabled>
                        </div>
                    </div> -->
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">vehicle</label>
                        <input id="summary_vehicle" value="Truck" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text"  disabled>
                    </div>
                </div>
                <div class="flex flex-row mx-3 my-5 pb-4 bg-white border-b justify-between">
                    <h6 class="font-medium">
                        Selection
                    </h6>
                    <p id="summary_selection_price">NGN <span class="price"></span></p>
                </div>
                <div class="flex flex-row mx-3 my-5 pb-4 bg-white border-b justify-between">
                    <h6 class="font-bold">
                        Total
                    </h6>
                    <p id="summary_total_price" class="font-bold">NGN <span class="price"></span></p>
                </div>
            </div>
            <div class="flex-grow rounded mx-5">
                @guest
                <div>
                    <div class="w-full bg-yellow-100 px-3 py-3">Sign In</div>
                    <div class="flex flex-row justify-end">
                        <button class="btn-lg font-semibold block uppercase border rounded-lg" type="submit" onclick="event.preventDefault(); $('.contact-details').slideDown()">Don't have an Account?</button>
                        <a class="btn-lg font-semibold block uppercase border rounded-lg" href="/login">Sign In</a>
                    </div>
                </div>
                <div class="mt-6 contact-details" style="display: none;">
                    <div class="w-full bg-yellow-100 px-3 py-3 uppercase">Contact Details</div>
                    <div class="flex flex-row w-full bg-white border py-3">
                        <div class="w-1/2 border-r">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">first name *</label>
                            <input name="fname" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">last name *</label>
                            <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                        </div>
                    </div>
                    <div class="flex flex-row w-full bg-white border py-3">
                        <div class="w-1/2 border-r">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">Email address*</label>
                            <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="email" >
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">phone number *</label>
                            <input  name="phone" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="phone" >
                        </div>
                    </div>
                    <div class="w-full bg-white border py-3">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Comments</label>
                        <textarea id="comments" name="comments" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="email" ></textarea>
                    </div>
                    <div class="w-full bg-yellow-100 py-3 px-5">
                        <div class="flex flex-row items-center py-3">
                            <label for="" class="uppercase text-md px-2 text-gray-500">billing address</label>
                            <input name="billing" class="order-first rounded outline-none border border-yellow-500 text-lg text-yellow-500 focus:ring focus:ring-yellow-500" onchange="$('.billing-address').slideToggle();" type="checkbox" name="" id="">
                        </div>
                    </div>
                    <div class="billing-address" style="display: none;">
                        <div class="flex flex-row w-full bg-white border py-3">
                            <div class="w-1/2 border-r">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">company registered name</label>
                                <input name="company" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                            </div>
                            <div class="w-1/2 border-l">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">tax number </label>
                                <input name="tax" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                            </div>
                        </div>
                        <div class="flex flex-row w-full bg-white border py-3">
                            <div class="w-1/3 border-r">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">street *</label>
                                <input name="street" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                            </div>
                            <div class="w-1/3 border-x">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">street number *</label>
                                <input name="snumber" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                            </div>
                            <div class="w-1/3 border-l">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">city *</label>
                                <input name="city" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                            </div>
                        </div>
                        <div class="flex flex-row w-full bg-white border py-3">
                            <div class="w-1/3 border-r">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">state *</label>
                                <input name="state" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                            </div>
                            <div class="w-1/3 border-x">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">postal code *</label>
                                <input name="postal" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                            </div>
                            <div class="w-1/3 border-l">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">Country *</label>
                                <select name="country" class="niceselect border-0 w-full" >
                                    <option value="1">Nigeria</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="mt-6 contact-details">
                    <div class="w-full bg-yellow-100 px-3 py-3 uppercase">Contact Details</div>
                    <div class="flex flex-row w-full bg-white border py-3">
                        <div class="w-1/2 border-r">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">first name *</label>
                            <input disabled value="{{ Auth::user()->firstname }}" name="fname" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">last name *</label>
                            <input disabled value="{{ Auth::user()->lastname }}" name="lname" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                        </div>
                    </div>
                    <div class="flex flex-row w-full bg-white border py-3">
                        <div class="w-1/2 border-r">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">Email address*</label>
                            <input disabled value="{{ Auth::user()->email }}" name="email" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="email" >
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">phone number *</label>
                            <input disabled value="{{ Auth::user()->phone }}" name="phone" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="phone" >
                        </div>
                    </div>
                    <div class="w-full bg-white border py-3">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Comments</label>
                        <textarea name="comments" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="email" ></textarea>
                    </div>
                    <div class="w-full bg-yellow-100 py-3 px-5">
                        <div class="flex flex-row items-center py-3">
                            <label for="" class="uppercase text-md px-2 text-gray-500">billing address</label>
                            <input name="billing" class="order-first rounded outline-none border border-yellow-500 text-lg text-yellow-500 focus:ring focus:ring-yellow-500" onchange="$('.billing-address').slideToggle();" type="checkbox" name="" id="">
                        </div>
                    </div>
                    <div class="billing-address" style="display: none;">
                        <div class="flex flex-row w-full bg-white border py-3">
                            <div class="w-1/2 border-r">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">company registered name</label>
                                <input name="company" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                            </div>
                            <div class="w-1/2 border-l">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">tax number </label>
                                <input name="tax" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                            </div>
                        </div>
                        <div class="flex flex-row w-full bg-white border py-3">
                            <div class="w-1/3 border-r">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">street *</label>
                                <input name="street" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                            </div>
                            <div class="w-1/3 border-x">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">street number *</label>
                                <input name="snumber" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                            </div>
                            <div class="w-1/3 border-l">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">city *</label>
                                <input name="city" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                            </div>
                        </div>
                        <div class="flex flex-row w-full bg-white border py-3">
                            <div class="w-1/3 border-r">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">state *</label>
                                <input name="state" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                            </div>
                            <div class="w-1/3 border-x">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">postal code *</label>
                                <input name="postal" class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" >
                            </div>
                            <div class="w-1/3 border-l">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">Country *</label>
                                <select name="country" class="niceselect border-0 w-full" >
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
            <button class="underline" type="submit" onclick="event.preventDefault(); $('.content-2').hide(); $('.content-1').show()">Choose Ride Details</button>
            <button class="btn-lg font-semibold block uppercase border rounded-lg" type="submit" onclick="event.preventDefault(); $('.content-2').hide(); $('.content-3').show()">Booking Summary</button>
        </div>
    </div>
    <div class="content-3" style="display: none;">
        <div class="md:flex flex-row">
            <div class="bg-yellow-100 mx-5 w-1/3">
                <div class="bg-yellow-100 rounded mb-3 pt-6">
                    <h3 class="font-semibold mt-4 mb-2 px-3">
                        Contact and Billing Info
                    </h3>

                    <div class="flex flex-row mx-3 border-b border-b">
                        <div class="w-1/2">
                            <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">first name</label>
                            <input value="" class="firstname w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text"  disabled>
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">lastname</label>
                            <input value="" class="lastname w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text"  disabled>
                        </div>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">email address</label>
                        <input value="" class="email w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="email"  disabled>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">phone number</label>
                        <input value="" class="phone w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="phone"  disabled>
                    </div>
                </div>
            </div>
            <div class="bg-yellow-100 mx-5 w-1/3">
                <div class="bg-yellow-100 rounded mb-3 pt-6">
                    <h3 class="font-semibold mt-4 mb-2 px-3">
                        Ride Details
                    </h3>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">Service Type</label>
                        <input value="Distance" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text"  disabled>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">from - to</label>
                        <input value="" class="journey w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text"  disabled>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">pickup date, time</label>
                        <input value="" class="timing w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text"  disabled>
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
                        <input value="Truck" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text"  disabled>
                    </div>
                </div>
            </div>
            <div class="bg-white mx-5 w-1/3">
                <div class="bg-yellow-100 rounded">
                    <h3 class="font-semibold pt-4 mb-2 px-3">
                        Vehicle Info
                    </h3>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">Vehicle</label>
                        <input value="Truck" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text"  disabled>
                    </div>
                </div>
                <div class="my-5">
                <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">do you have a discount code?</label>
                    <textarea class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" name="" id="" rows="5"></textarea>
                    <button class="btn-lg rounded text-right" type="submit">Apply Code</button>
                </div>
                <div class="flex flex-row mx-3 my-5 pb-4 bg-white border-b justify-between">
                    <h6 class="font-medium">
                        Selection
                    </h6>
                    <p>NGN <span class="price"></span></p>
                </div>
                <div class="flex flex-row mx-3 my-5 pb-4 bg-white border-b justify-between">
                    <h6 class="font-bold">
                        Total
                    </h6>
                    <p class="font-bold">NGN <span class="price"></span></p>
                </div>
            </div>
        </div>
        <div class="flex flex-row justify-between">
            <button class="underline" type="submit" onclick="event.preventDefault(); $('.content-3').hide(); $('.content-2').show()">Back</button>
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
            <input type="hidden" name="currency" value="NGN">
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
