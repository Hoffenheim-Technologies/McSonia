<div class="message-wrapper">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{$receiver->lastname.' '.$receiver->firstname}}</h4>
            <div id="activity">
                <ul class="messages">
                    @foreach($messages as $message)
                        <li class="message clearfix">
                            {{--if message from id is equal to auth id then it is sent by logged in user --}}
                            <div class="{{ ($message->user_id == Auth::id()) ? 'sent' : 'received' }}">
                                <p>{{ $message->message }}</p>
                                <p class="date">{{ date('d M y, h:i a', strtotime($message->created_at)) }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="form-row">
                    <div class="form-group input-text col-md-9">
                        <input type="text" value="" name="message" class="form-control " id="">
                    </div>
                    <div class="form-group col-md-3">
                        <button id="submit" onclick="" class="btn btn-primary mx-2"><i class="fa fa-plane"></i> Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

