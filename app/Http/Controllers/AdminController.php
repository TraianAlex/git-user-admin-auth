<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Admin;

class AdminController extends Controller
{
    public function getLogin()
    {
    	return view('admin.login');
    }

    public function getDashboard()
    {
    	$authors = User::all();
    	return view('admin.dashboard', compact('authors'));
    }

    public function postLogin(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required',
    		'password' => 'required'
		]);
        //auth()->guard('admins')->attempt(['email' => '', 'password' => ''])
    	if(!Auth::guard('admins')->attempt(['name' => $request['name'], 'password' => $request['password']])){
    		return redirect()->back()->with('fail', 'Could not be log you in!');
    	}

    	return redirect()->route('admin.dashboard');
    }

    public function getLogout()
    {       
        auth()->guard('admins')->logout();
        return redirect('/');
    }
}