<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUser;
use App\Http\Resources\User as UserResource;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function register(RegisterUser $request)
    {
    	$request_data = $request->all();

    	$request_data['password'] = bcrypt($request_data['password']);

    	$user = User::create($request_data);

    	if ($user) {

    	$token = $user->createToken(config('app.name'))->accessToken;

    	$user_resource = new UserResource($user);

    	return response()->json(['data' => ['user' => $user_resource, 'token' => $token]], 201);

    	} else {

    		$message = "Sorry! User account could not be created.";

    	return response()->json(['error' => $message], 400);

    	}
    	
    	
    }

    public function fund_account(Request $request, $user_id)
    {
    	$this->validate($request, [
    		'amount' => 'required|numeric'
    	]);

    	$user = User::find($user_id);

    	if (! $user) {

    		$message = 'Sorry! User not found';

    		return response()->json(['error' => $message], 404);
    	}

    	//Get amount and Fund User's account.
    	$get_amount = (int) $request->amount;

    	$user->increment('current_balance', $get_amount);

    	$user_resource = new UserResource($user);

    	//Persist data on transaction model
    	$transaction = new Transaction;

    	$transaction->amount = $get_amount;

    	$transaction->transaction_type = 'credit';

    	$transaction->user_id = $user->id;

    	$transaction->save();

    	return response()->json(['data' => $user_resource]);


    }


    public function withdraw_from_account(Request $request, $user_id)
    {
    	$this->validate($request, [
    		'amount' => 'required|numeric'
    	]);

    	$user = User::find($user_id);

    	if (! $user) {

    		$message = 'Sorry! User not found';

    		return response()->json(['error' => $message], 404);
    	}

    	//Get amount and Fund User's account.
    	$get_amount = (int) $request->amount;

    	//Check user current account balance

    	if ($user->current_balance < $get_amount) {

    		$message = 'Insufficient funds';
    		
    		return response()->json(['error' => $message], 401);
    	}

    	$user->decrement('current_balance', $get_amount);

    	$user_resource = new UserResource($user);

    	//Persist data on transaction model
    	$transaction = new Transaction;

    	$transaction->amount = $get_amount;

    	$transaction->transaction_type = 'debit';

    	$transaction->user_id = $user->id;

    	$transaction->save();

    	return response()->json(['data' => $user_resource]);


    }

}
