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

@section('content')
<form class="mx-auto container">
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
                        <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="date" required>
                    </div>
                    <div class="w-1/2 border-l">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Pickup Time *</label>
                        <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="time" required>
                    </div>
                </div>
                <div class="w-full bg-white border-y py-3">
                    <div class="w-full">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Pickup Location *</label>
                        <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required>
                    </div>
                </div>
                <div class="w-full bg-white border-t py-3">
                    <div class="w-full">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Dropoff Location *</label>
                        <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required>
                    </div>
                </div>
            </div>
            <div class="border relative rounded bg-yellow-100 mx-5">
                <div class="h-full"> 
                    <div class="flex flex-col h-full justify-evenly">
                        <div class="flex flex-row items-center">
                            <span class="mx-3">Start</span>
                            <span class="flex-grow border-b-4 border-yellow-500"></span>
                            <span class="mx-3">End</span>
                        </div>
                        <div class="mx-3 justify-center grid grid-cols-2">
                            <div>Time - 2 Hours</div>
                            <div>Distance - 40KM</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row justify-end">
            <button class="btn-lg font-semibold block uppercase border rounded-lg" type="submit" onclick="event.preventDefault(); $('.content-1').hide(); $('.content-2').show()">Enter Contact Details</button>
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
                        <input value="Distance" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required disabled>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">from - to</label>
                        <input value="Ajah - Lekki Phase 3" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required disabled>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">pickup date, time</label>
                        <input value="28-12-21, 07:00" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required disabled>
                    </div>
                    <div class="flex flex-row mx-3 border-b border-b">
                        <div class="w-1/2">
                            <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">distance</label>
                            <input value="300km" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required disabled>
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">time</label>
                            <input value="90 minutes" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required disabled>
                        </div>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">vehicle</label>
                        <input value="Truck" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required disabled>
                    </div>
                </div>
                <div class="flex flex-row mx-3 my-5 pb-4 bg-white border-b justify-between">
                    <h6 class="font-medium">
                        Selection
                    </h6>
                    <p>NGN 2000</p>
                </div>
                <div class="flex flex-row mx-3 my-5 pb-4 bg-white border-b justify-between">
                    <h6 class="font-bold">
                        Total
                    </h6>
                    <p class="font-bold">NGN 2000</p>
                </div>
            </div>
            <div class="flex-grow rounded mx-5">
                <div>
                    <div class="w-full bg-yellow-100 px-3 py-3">Sign In</div>
                    <div class="flex flex-row w-full bg-white border py-3">
                        <div class="w-1/2 border-r">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">Email *</label>
                            <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="email" required>
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">Password *</label>
                            <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="password" required>
                        </div>
                    </div>
                    <div class="flex flex-row justify-end">
                        <button class="btn-lg font-semibold block uppercase border rounded-lg" type="submit" onclick="event.preventDefault(); $('.contact-details').slideDown()">Don't have an Account?</button>
                        <button class="btn-lg font-semibold block uppercase border rounded-lg" type="submit" onclick="event.preventDefault(); $('.content-2').hide(); $('.content-3').show()">Sign In</button>
                    </div>
                </div>
                <div class="mt-6 contact-details" style="display: none;">
                    <div class="w-full bg-yellow-100 px-3 py-3 uppercase">Contact Details</div>
                    <div class="flex flex-row w-full bg-white border py-3">
                        <div class="w-1/2 border-r">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">first name *</label>
                            <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required>
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">last name *</label>
                            <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required>
                        </div>
                    </div>
                    <div class="flex flex-row w-full bg-white border py-3">
                        <div class="w-1/2 border-r">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">Email address*</label>
                            <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="email" required>
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500">phone number *</label>
                            <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="phone" required>
                        </div>
                    </div>
                    <div class="w-full bg-white border py-3">
                        <label for="" class="uppercase text-xs px-2 text-gray-500">Comments</label>
                        <textarea class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="email" required></textarea>
                    </div>
                    <div class="w-full bg-yellow-100 py-3 px-5">
                        <div class="flex flex-row items-center py-3">
                            <label for="" class="uppercase text-md px-2 text-gray-500">Create an Account?</label>
                            <input class="order-first rounded outline-none border border-yellow-500 text-lg text-yellow-500 focus:ring focus:ring-yellow-500" type="checkbox" name="" id="">
                        </div>
                        <div class="flex flex-row items-center py-3">
                            <label for="" class="uppercase text-md px-2 text-gray-500">billing address</label>
                            <input class="order-first rounded outline-none border border-yellow-500 text-lg text-yellow-500 focus:ring focus:ring-yellow-500" onchange="$('.billing-address').slideToggle();" type="checkbox" name="" id="">
                        </div>
                    </div>
                    <div class="billing-address" style="display: none;">
                        <div class="flex flex-row w-full bg-white border py-3">
                            <div class="w-1/2 border-r">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">company registered name</label>
                                <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required>
                            </div>
                            <div class="w-1/2 border-l">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">tax number </label>
                                <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required>
                            </div>
                        </div>
                        <div class="flex flex-row w-full bg-white border py-3">
                            <div class="w-1/3 border-r">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">street *</label>
                                <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required>
                            </div>
                            <div class="w-1/3 border-x">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">street number *</label>
                                <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required>
                            </div>
                            <div class="w-1/3 border-l">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">city *</label>
                                <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required>
                            </div>
                        </div>
                        <div class="flex flex-row w-full bg-white border py-3">
                            <div class="w-1/3 border-r">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">state *</label>
                                <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required>
                            </div>
                            <div class="w-1/3 border-x">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">postal code *</label>
                                <input class="w-full border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required>
                            </div>
                            <div class="w-1/3 border-l">
                                <label for="" class="uppercase text-xs px-2 text-gray-500">Country *</label>
                                <select class="niceselect border-0 w-full" required>
                                    <option value="1">Nigeria</option>
                                    <option value="2">Brazil</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row justify-between">
            <button class="btn-lg font-semibold block uppercase border rounded-lg" type="submit" onclick="event.preventDefault(); $('.content-2').hide(); $('.content-1').show()">Choose Ride Details</button>
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
                            <input value="Sola" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required disabled>
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">lastname</label>
                            <input value="Olagunju" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required disabled>
                        </div>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">email address</label>
                        <input value="ogolagunju@gmail.com" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="email" required disabled>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">phone number</label>
                        <input value="08167403991" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="phone" required disabled>
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
                        <input value="Distance" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required disabled>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">from - to</label>
                        <input value="Ajah - Lekki Phase 3" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required disabled>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">pickup date, time</label>
                        <input value="28-12-21, 07:00" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required disabled>
                    </div>
                    <div class="flex flex-row mx-3 border-b border-b">
                        <div class="w-1/2">
                            <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">distance</label>
                            <input value="300km" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required disabled>
                        </div>
                        <div class="w-1/2 border-l">
                            <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">time</label>
                            <input value="90 minutes" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required disabled>
                        </div>
                    </div>
                    <div class="mx-3 border-b">
                        <label for="" class="uppercase text-xs px-2 text-gray-500 py-2">vehicle</label>
                        <input value="Truck" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required disabled>
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
                        <input value="Truck" class="w-full py-3 bg-yellow-100 border-0 outline-0 focus:outline-none focus:border-none focus:ring-0" type="text" required disabled>
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
                    <p>NGN 2000</p>
                </div>
                <div class="flex flex-row mx-3 my-5 pb-4 bg-white border-b justify-between">
                    <h6 class="font-bold">
                        Total
                    </h6>
                    <p class="font-bold">NGN 2000</p>
                </div>
            </div>
        </div>
        <div class="flex flex-row justify-between">
            <button class="btn-lg font-semibold block uppercase border rounded-lg" type="submit" onclick="event.preventDefault(); $('.content-3').hide(); $('.content-2').show()">Back</button>
            <button class="btn-lg font-semibold block uppercase border rounded-lg" type="submit">Book Now</button>
        </div>
    </div>
</form>
@endsection