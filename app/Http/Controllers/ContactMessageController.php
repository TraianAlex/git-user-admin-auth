<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ContactMessage;
use App\Http\Requests\SendMessageRequest;
use App\Events\MessageSent;
use Event;//Illumunate\Support\Facades\Event;

class ContactMessageController extends Controller
{
    public function getContactIndex()
    {
    	return view('other.contact');
    }

    public function postSendMessage(SendMessageRequest $request)
    {
    	$message = new ContactMessage();
    	$message->email = $request->email;
    	$message->sender = $request->name;
    	$message->subject = $request->subject;
    	$message->body = $request->message;
    	$message->save();
    	Event::fire(new MessageSent($message));
    	return redirect()->route('contact')->with(['success' => 'Message Successfully sent']);
    }

    public function getContactMessageIndex()
    {
    	$contact_messages = ContactMessage::orderBy('created_at', 'desc')->paginate(5);
    	return view('other.contact_messages', compact('contact_messages'));
    }

    public function getDeleteMessage($message_id)
    {
    	$contact_message = ContactMessage::find($message_id);
    	$contact_message->delete();
    	return response()->json(['message' => 'Category Deleted'], 200);
    }
}
