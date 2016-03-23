<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Quote;
use App\Http\Requests\CreateQuoteRequest;
use App\Events\QuoteCreated;
use Illuminate\Support\Facades\Event;
use App\AuthorLog;

class QuoteController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
    public function getIndex($author = null)
    {
        if(!is_null($author)){
            $quote_author = User::where('name', $author)->first();
            if($quote_author){
                $quotes = $quote_author->quotes()->orderBy('created_at', 'desc')->paginate(6);
            }
        }else{
            $quotes = Quote::orderBy('created_at', 'desc')->paginate(6);
        }
    	
    	return view('home', compact('quotes'));
    }

    public function postQuote(CreateQuoteRequest $request)
    {
    	$authorText = $request['author'];
    	$quoteText = $request['quote'];

    	$author = User::where('name', $authorText)->first();
    	if(!$author){
    		//$author = new User();
    		//$author->name = $authorText;
            //$author->email = $request['email'];
    		//$author->save();
    		$author = auth()->user();
    	}

    	$quote = new Quote();
    	$quote->quote = $quoteText;
    	$author->quotes()->save($quote);

        Event::fire(new QuoteCreated($author));

    	return redirect()->route('index')->with(['success' => 'Quote saved!']);
    }

    public function getDeleteQuote($quote_id)
    {
    	$quote = Quote::find($quote_id);
    	$author_deleted = false;

    	if(count($quote->user->quotes) === 1){
    		$quote->user->delete();
    		$author_deleted = true;
    	}
    	$quote->delete();

    	$msg = $author_deleted ? 'Quote and author deleted!' : 'Quote deleted!';
    	return redirect()->route('index')->with(['success' => $msg]);
    }

    public function getMailCallback($author_name)
    {
        $author_log = new AuthorLog();
        $author_log->author = $author_name;
        $author_log->save();

        return view('email.callback', compact('author_name'));
    }
}
