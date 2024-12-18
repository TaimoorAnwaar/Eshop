<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Show the Contact Page
    public function show()
    {
        return view('contact');
    }

    // Handle Form Submission

    
    
        public function submitContactMessage(Request $request)
        {
            // Validate the input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required|string|max:1000',
            ]);
    
            // Save the message (assigning it to the manager as receiver)
            $message = new Message();
            $message->sender_id = auth()->id() ?? null; // Null if not authenticated
            $message->receiver_id = 1; // Assuming the manager's ID is 1
            $message->text = $validated['message'];
            $message->save();
    
            // Redirect with a success message
            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        }
    }
    
