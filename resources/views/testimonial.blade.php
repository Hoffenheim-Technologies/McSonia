@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h6 class="text-md uppercase text-yellow-500 w-max mx-auto mt-12 font-semibold">testimonials</h6>
    <h3 class="font-bold text-4xl mb-5 capitalize w-max mx-auto">what people say about us</h3>
    @if ($testimonials)
    <div class="mt-12 md:grid md:grid-cols-2 lg:grid-cols-3 w-5/6 mx-auto ">
        @foreach($testimonials as $testimonial)
        <div class="border shadow-md rounded-lg mx-4 relative py-8 px-6 my-4">
            <div class="lowercase text-right text-gray-400 text-sm absolute bottom-5 left-5">
                <span class="capitalize font-bold text-base md:text-lg">{{$testimonial->name}}</span>
            </div>
            <span class="text-4xl fa fa-quote-left pb-5 text-gray-400"></span>
            <div>{{$testimonial->comment}}</div>
            <div class="text-right py-5">
                <?php 
            for ($i=0; $i < $testimonial->rating; $i++) { 
                echo('<span class="fa fa-star text-yellow-500"></span>');
            }
            for ($i=0; $i < 5 - $testimonial->rating; $i++) { 
                echo('<span class="fa fa-star text-gray-400"></span>');
            }  
            ?></div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection