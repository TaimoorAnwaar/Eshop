<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id', 
            'text' => 'required|string|max:255',
        ]);
    
        $message = new Message();
        $message->sender_id = auth()->id(); 
        $message->receiver_id = $validated['receiver_id'];
        $message->text = $validated['text'];
        $message->save();
    
        broadcast(new MessageSent($message));
    
        return redirect()->route('messages.view'); 
    }
    
    

    public function viewMessages()
    {
        $messages = Message::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->orderBy('created_at', 'desc') 
            ->get();

        return view('index', compact('messages'));
    }

    public function viewManagerMessages()
{
    $managerId = auth()->id(); 
    $messages = Message::where('receiver_id', $managerId)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('messages.manager', compact('messages'));
}

public function replyMessage(Request $request)
{
    
    $validated = $request->validate([
        'message_id' => 'required|exists:messages,id',  
        'reply_text' => 'required|string|max:255',
    ]);

    
    $originalMessage = Message::find($validated['message_id']);


    $replyMessage = new Message();
    $replyMessage->sender_id = auth()->id();  
    $replyMessage->receiver_id = $originalMessage->sender_id;  
    $replyMessage->text = $validated['reply_text'];
    $replyMessage->save();

    
    broadcast(new MessageSent($replyMessage));

    return redirect()->route('manager.messages.view'); 
}
public function getMessageCount()
{
    $managerId = auth()->id();
    $messageCount = Message::where('receiver_id', $managerId)->count();

    return response()->json(['count' => $messageCount]);
}


}