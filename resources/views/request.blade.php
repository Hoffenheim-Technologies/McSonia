@extends ('layouts.app')

@section('pageStyles')
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/nice-select.css">
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<style>
    header a:hover {
        text-decoration: none;
        color: #f59e0b
    }
</style>
@endsection

@section('content')
<div class="formify_body formify_signup_fullwidth formify_signup_fullwidth_two flex">
    <div class="formify_left_fullwidth formify_left_top_logo frm-vh-md-100 flex items-center justify-center"
        data-bg-color="#FFEFF9">
        <a href="index.html" class="top_logo"><img src="assets/img/logo.png" alt=""></a>
        <img class="img-fluid" src="images/personal.png" alt="">
    </div>
    <div class="formify_right_fullwidth flex items-center justify-center">
        <div class="form_tab_two">
            <ul class="form_tab" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" id="One-tab" data-toggle="tab" href="#One" role="tab"
                        aria-controls="One" aria-selected="true">
                        <span>1</span>
                        Personal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="Two-tab" data-toggle="tab" href="#Two" role="tab"
                        aria-controls="Two" aria-selected="false">
                        <span>2</span>
                        Item
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="Three-tab" data-toggle="tab" href="#Three" role="tab"
                        aria-controls="Three" aria-selected="false">
                        <span>3</span>
                        Delivery
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="Four-tab" data-toggle="tab" href="#Four" role="tab"
                        aria-controls="Four" aria-selected="false">
                        <span>4</span>
                        Confirm
                    </a>
                </li>
            </ul>
            <style>.niceselect{width: 100%;}</style>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="One" role="tabpanel" aria-labelledby="One-tab">
                    <div class="formify_box">
                        <h4 class="form_title">Tell us about your <span>Personal Details</span></h4>
                        <form action="#" class="signup_form row">
                            <div class="form-group col-md-6">
                                <label class="input_title" for="inputName">First Name</label>
                                <input type="text" class="form-control" id="inputName"
                                    placeholder="Enter First Name" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="input_title" for="inputName2">Last Name</label>
                                <input type="text" class="form-control" id="inputName2"
                                    placeholder="Enter Last Name" required="">
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="input_title" for="inputAddress">Street Address</label>
                                <input type="text" class="form-control" id="inputAddress"
                                    placeholder="PO Box 16122 Collins Street West Victoria" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="input_title">Gender</label>
                                <select class="niceselect">
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="input_title">State/Province</label>
                                <select class="niceselect">
                                    <option value="lagos">Lagos</option>
                                    <!-- <option value="2">Female</option> -->
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="input_title" for="inputzip">Zip code</label>
                                <input type="text" class="form-control" id="inputzip" placeholder="94102"
                                    required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="input_title" for="inputPhone">Phone number</label>
                                <input type="text" class="form-control" id="inputPhone" placeholder="97501456"
                                    required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="input_title" for="inputEmail">Email address</label>
                                <input type="email" class="form-control" id="inputEmail"
                                    placeholder="Email address" required="">
                            </div>
                        </form>
                        <div class="next_button text-right">
                        <button type="submit" class="btn thm_btn red_btn next_tab bg-yellow-600 px-8 py-3 rounded text-white font-semibold">Next to Your
                                        Item <img class="w-4 text-white inline-block" src="images/arrow-right.svg" alt="">
                        </button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Two" role="tabpanel" aria-labelledby="Two-tab">
                    <div class="formify_box">
                        <h4 class="form_title">Tell us about your <span>Item Details</span></h4>
                        <form action="#" class="signup_form row">
                            <div class="form-group col-lg-6">
                                <label class="input_title" for="inputName3">Item</label>
                                <input type="text" class="form-control" id="inputName3" placeholder="Job Title">
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="input_title" for="inputName4">Quantity</label>
                                <input type="number" class="custom-form-control" id="inputName4"
                                    placeholder="Quantity">
                            </div>
                            <div class="form-group col-lg-3">
                                <label class="input_title" for="inputzip2">Item Weight</label>
                                <select type="text" class="niceselect" id="inputzip2" placeholder="Weight (kg)">
                                    <option value="1"> < 5kg</option>
                                    <option value="2">5-15 kg</option>
                                    <option value="3">> 15kg</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label class="input_title" for="inputzip2">Zip Code</label>
                                <input type="text" class="form-control" id="inputzip2" placeholder="94102">
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="input_title">Mode of Delivery</label>
                                <select class="niceselect">
                                    <option value="1">Land</option>
                                    <!-- <option value="2">London</option> -->
                                </select>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="input_title" for="inputPhone2">Description</label>
                                <textarea name="message" id="message" cols="30" rows="10"
                                    placeholder="Provide a brief package description"></textarea>
                            </div>
                        </form>
                        <div class="next_button flex align-items-center justify-content-between">
                            <a href="#" class="prev_tab"><img class="w-4 text-white inline-block" src="images/arrow-left.svg" alt=""> Back</a>
                            <button type="submit" class="btn thm_btn red_btn next_tab bg-yellow-600 px-8 py-3 rounded text-white font-semibold">Next to Your
                                Delivery <img class="w-4 text-white inline-block" src="images/arrow-right.svg" alt=""></button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Three" role="tabpanel" aria-labelledby="Three-tab">
                    <div class="formify_box">
                        <h4 class="form_title">Tell us about your <span>Delivery Details</span></h4>
                        <form action="#" class="signup_form row">
                            <div class="form-group col-lg-6">
                                <label class="input_title" for="inputName5">Recipient</label>
                                <input type="text" class="form-control" id="inputName5"
                                    placeholder="Recipient Name">
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="input_title">Origin</label>
                                <select class="niceselect">
                                    <option value="1">San fransisco</option>
                                    <option value="2">London</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label class="input_title" for="inputzip5">Start Date</label>
                                <input type="date" class="form-control" id="inputzip5" placeholder="NY">
                            </div>
                            <div class="form-group col-lg-3">
                                <label class="input_title" for="inputName6">Gender</label>
                                <select type="text" class="niceselect" id="inputName6">
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="input_title">Destination</label>
                                <select class="niceselect">
                                    <option value="1">San fransisco</option>
                                    <option value="2">London</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="input_title" for="inputPhone2">Description</label>
                                <textarea name="message" id="message" cols="30" rows="10"
                                    placeholder="Any delivery location descriptions"></textarea>
                            </div>
                        </form>
                        <div class="next_button flex align-items-center justify-content-between">
                            <a href="#" class="prev_tab"><img class="w-4 text-white inline-block" src="images/arrow-left.svg" alt=""> Back</a>
                            <button type="submit" class="btn thm_btn red_btn next_tab bg-yellow-600 px-8 py-3 rounded text-white font-semibold">Next to Your
                                Confirm <img class="w-4 text-white inline-block" src="images/arrow-right.svg" alt=""></button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Four" role="tabpanel" aria-labelledby="Four-tab">
                    <div class="formify_box">
                        <h4 class="form_title">Confirm your <span>Payment Details</span></h4>
                        <form action="#" class="signup_form row">
                            <div class="form-group col-lg-12">
                                <label class="input_title" for="inputPhone2">Description</label>
                                <textarea name="message" id="message" cols="30" rows="10"
                                    placeholder="Write your job experience"></textarea>
                            </div>
                            <div class="form-group col-lg-12 flex align-items-center justify-content-between">
                                <a href="#" class="prev_tab"><img class="w-4 text-white inline-block" src="images/arrow-left.svg" alt=""> Back</a>
                                <button type="submit" class="btn thm_btn red_btn bg-yellow-600 px-8 py-3 rounded text-white font-semibold">Submit Your
                                    Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection