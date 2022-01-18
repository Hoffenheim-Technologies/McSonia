<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id','!=',Auth::user()->id)
                        ->where('role','!=','default')->get();
        return view('chat', compact('users'));
    }

    /**
     * Fetch all messages by receiver
     *
     * @return Message
     */
    public function fetchMessages($id)
    {
        $my_id = Auth::id();
        $receiver = User::find($id);
        $messages = Message::where(function ($query) use ($my_id,$id) {
                $query->where('user_id', $my_id)
                    ->Where('receiver_id', $id);
            })->orwhere(function ($query) use ($my_id,$id) {
                $query->where('user_id', $id)
                    ->Where('receiver_id', $my_id);
            })->get();

        return view('messages',compact('messages','receiver'));
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        try{
            $data = [];
            $data['user_id'] = $user->id;
            $data['receiver_id'] = $request->receiver_id;
            $data['message'] = $request->message;

            Message::create($data);

            // pusher
            $options = array(
                'cluster' => 'mt1',
                'useTLS' => true
            );

            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );

            $data = ['from' => $user->id, 'to' => $request->receiver_id]; // sending from and to user id when pressed enter
            $pusher->trigger('my-channel', 'my-event', $data);

        }catch(Exception $d){
            //dd($d);
        }



    }
}
