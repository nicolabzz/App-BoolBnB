<?php

namespace App\Http\Controllers\Admin;

use App\Message;
use App\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    private $validation = [
        'message' => 'string|required',
        'date'    => 'date|required',
    ];

    public function index()
    {
        $messages = Message::where('apartment_id', Auth::id())->paginate();
        $apartments = Apartment::where('user_id', Auth::id())->paginate();
        $users = Auth::id();

        return view('admin.messages.index', [
            'messages' => $messages,
            'apartments' => $apartments,
            'users' => $users
        ]);

    }

    public function create()
    {
        return view('admin.messages.create');
    }


    public function store(Request $request)
    {
        $request->validate($this->validation);

        $data = $request->all();

        $message = new Message;
        $message->message          =    $data['message'];
        $message->date             =    $data['date'];
        $message->save();

        return redirect()->route('admin.messages.show', ['message' => $message]);
    }


    // public function show(Message $message)
    // {
    //     return view('admin.messages.show', compact('message'));
    // }


    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success_delete', $message);
    }
}
