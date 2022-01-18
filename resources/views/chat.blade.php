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
                                <div id="activity">
                                    @foreach ($users as $item)
                                        <div id="{{$item->id}}" class="media border-bottom-1 chat-user user p-3">
                                            <img width="35" src="{{Storage::url($item->image)}}" class="mr-3 rounded-circle">
                                            <div class="media-body">
                                                <h5>{{$item->lastname.' '.$item->firstname}}</h5>
                                                <p class="mb-0">{{$item->email}}</p>
                                            </div><span class="text-muted ">April 24, 2018</span>
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('6318b08f48b8edb19eaa', {
        cluster: 'mt1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            alert(JSON.stringify(data));
        });

        var receiver_id = '';
        var my_id = "{{Auth::id()}}";
        $(document).ready(function (){
            $('.user').on('click keyup', function(){
                $('.user').removeClass('menu-active');
                $(this).addClass('menu-active');
                receiver_id = $(this).attr('id');
                //alert(receiver_id);

                $.ajax({
                    type: "GET",
                    url: "messages/"+receiver_id,
                    data: "",
                    cache: false,
                    success: function (response) {
                        $('#messages').html(response);
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

                        }
                    });
                }
            }

        });

    </script>
@endsection
