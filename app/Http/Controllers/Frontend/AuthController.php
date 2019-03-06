<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Notifications\RegistrationEmailNotification;

class AuthController extends Controller
{
    public function showLoginForm()
    {
    	return view('frontend.auth.login');
    }

    public function processLogin(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'email' => 'requiredu|email',
    		'password' => 'required',
    	]);

    	if($validator->fails()){
    		return redirect()->back()->withErrors()->withInput();
    	}

    	$credential = $request->only(['email', 'password']);

    	if(auth()-attempt($credential)){

    		$user = auth()->user();
    		if($user->email_varified_at == null){
    			$this->setError('Your account in not activated.');
    			return redirect()->route('login');
    		}

    		$this->setSuccess('User logged in.');
    		return redirect('/');
    	}

    	$this->setError('Invalid credential');
    	return redirect()->back();

    }

    public function showRegisterForm()
    {
    	return view('frontend.auth.register');
    }

    public function processRegister(Request $request)
    {
    	$validator = Validator::make($request->all(),[
    		'name' => 'required',
    		'email' => 'required|email|unique:users,email',
    		'phone_number' => 'required|min:11|max:13|unique:users,phone_number',
    		'password' => 'required|min:6',
    		]);

    	if($validator->fails()){
    		return redirect()->back()->withErrors($validator)->withInput();
    	}

    	try {

    		$user = User::create([
	    			'name' => $request->input('name'),
	    			'email' => strtolower($request->input('email')),
	    			'phone_number' => $request->input('phone_number'),
	    			'password' => bcrypt($request->input('password')),
	    			'email_varification_token' => uniqid(time(), true).str_random(16),
	    		]);

    		$user->notify(new RegistrationEmailNotification($user));

    		$this->setSuccess('Account Registered Successfully Created');
    		return redirect()->route('register');

    		
    	} catch (\Exception $e) {
    		$this->setError($e->getMessage());
    		return redirect()->back();
    	}


    }

    public function activate($token = null)
    {
    	if($token == null){
    		return redirect('/');
    	}

    	$user = User::where('email_varification_token', $token)->firstOrFail();

    	if($user){
    		$user->update([
    			'email_varified_at' => Carbon::now(),
    			'email_varification_token' => null,
    		]);

    		$this->setSuccess('Account activated. You can login now.');

    		return redirect()->route('login');
    	}

    	$this->setError('Invalid token.');
    	return redirect()->route('login');
    }

}

