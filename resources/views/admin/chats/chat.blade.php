@extends('admin.layouts.app')
@section('content')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Chat</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Chats</h4>
                                <div id="activity chat-wrapper">
                                    @foreach ($users as $item)
                                        <div id="{{$item->id}}" class="media border-bottom-1 chat-user user p-3">

                                            <img width="35" height="35"  src="{{Storage::url($item->image)}}" class="mr-3 rounded-circle">
                                            <div class="media-body">
                                                <h5>{{$item->lastname.' '.$item->firstname}}</h5>
                                                @if($item->unread)
                                                <span class="pending float-right">{{ $item->unread }}</span>
                                                @endif
                                                <p class="mb-0">{{$item->email}}</p>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-xl-6" id="messages">

                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
@endsection
@section('custom-script')
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        var receiver_id = '';
        var my_id = "{{Auth::id()}}";
        $(document).ready(function (){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = false;

            var pusher = new Pusher('6318b08f48b8edb19eaa', {
                cluster: 'mt1'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                //alert(JSON.stringify(data));
                if(my_id == data.from){
                    $('#'+data.to).click();
                }else if(my_id == data.to){
                    if(receiver_id == data.from){
                        $('#'+data.from).click();
                    }else{
                        // if receiver is not seleted, add notification for that user
                        var pending = parseInt($('#' + data.from).find('.pending').html());
                        if (pending) {
                            $('#' + data.from).find('.pending').html(pending + 1);
                        } else {
                            $('#' + data.from).append('<span class="pending">1</span>');
                        }
                    }
                }
            });

            $('.user').on('click keyup', function(){
                $('.user').removeClass('menu-active');
                $(this).addClass('menu-active');
                receiver_id = $(this).attr('id');
                $(this).find('.pending').remove();
                $.ajax({
                    type: "GET",
                    url: "messages/"+receiver_id,
                    data: "",
                    cache: false,
                    success: function (response) {
                        $('#messages').html(response);
                        scrollToBottomFunc();
                    }
                });

            })

            var message = '';
            $(document).on('keyup','.input-text input', function(e){
                message = $(this).val();
                if(e.keyCode == 13){
                    $(this).val('');
                    submit();
                }
            })

            $(document).on('click','#submit', function(e){
                submit();
            })

            function submit() {
                //console.log('i am here')
                if(message != '' && receiver_id != ''){
                    $(this).val('');
                    $.ajax({
                        type: "POST",
                        url: "chat/message",
                        data: { "receiver_id":receiver_id, "message":message },
                        cache: false,
                        success: function (response) {
                            //$('#messages').html(response);
                        },
                        error:function(jqXHR, status, err){

                        },
                        complete:function(){
                            scrollToBottomFunc();
                        }
                    });
                }
            }

        });


    function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 0);
    }

    </script>
@endsection
