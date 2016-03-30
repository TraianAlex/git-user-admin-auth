<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Admin;
use App\Http\Requests\LoginAdminRequest;
use App\Post;
use App\ContactMessage;

class AdminController extends Controller
{
    public function getLogin()
    {
    	return view('admin.login');
    }

    public function getDashboard()
    {
        $authors = User::all();
        $posts = Post::orderBy('created_at', 'desc')->take(3)->get();
    	$contact_messages = ContactMessage::orderBy('created_at', 'desc')->take(3)->get();
    	return view('admin.dashboard', compact('authors', 'posts', 'contact_messages'));
    }

    public function postLogin(LoginAdminRequest $request)
    {
        //Auth::guard('admins')->//auth()->guard('admins')->(['email' => '', 'password' => ''])
    	if(!admins()->attempt(['name' => $request['name'], 'password' => $request['password']])){
    		return redirect()->back()->with('fail', 'Could not be log you in!');
    	}

    	return redirect()->route('admin.dashboard');
    }

    public function getLogout()
    {       
        admins()->logout();//auth()->guard('admins')
        return redirect('/');
    }
}