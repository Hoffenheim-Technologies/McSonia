<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $users = DB::select("select firstname,lastname,image,email,users.id, count(is_read) as unread
        from users LEFT JOIN  messages ON users.id = messages.user_id and is_read = 0 and messages.receiver_id = " . Auth::id() . "
        where users.id != " . Auth::id() . " and users.role <> 'default'
        group by users.id,firstname,lastname,image,email");
        // $users = User::leftJoin('messages', function($join) {
        //                     $join->on('users.id', '=', 'messages.user_id');
        //                 })
        //                 ->count('is_read',0)
        //                 ->where('users.id','!=',Auth::user()->id)
        //                 ->where('role','!=','default')->get();
        //dd($users);

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

        // Make read all unread message
        Message::where(['user_id' => $receiver, 'receiver_id' => $my_id])->update(['is_read' => 1]);

        $messages = Message::where(function ($query) use ($my_id,$id) {
                $query->where('user_id', $my_id)
                    ->Where('receiver_id', $id);
            })->orwhere(function ($query) use ($my_id,$id) {
                $query->where('user_id', $id)
                    ->Where('receiver_id', $my_id);
            })
            ->orderBy('created_at','ASC')
            ->get();
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
            $data['is_read'] = 0;

            Message::create($data);

            // pusher
            $options = array(
                'cluster' => 'mt1',
                'useTLS' => false
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
