<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller; 
use App\User;
use App\Location;
use Auth;

class LocationController extends Controller
{
	private $user;

	public function __construct()
	{
		//$this->middleware(['throttle:15','auth:api']);
		$this->user = Auth::guard('api')->user();
	}

	/*
		Gives Last user location
	 */
	private function getLastUserLocation()
	{
		return $this->user->Locations->last();
	}

	/*
		Locations filtered by day
		Default: today;
	 */
	public function getDay($day)
	{
		return $this->user->locations()->day($day)->get();
	}

	/*
		Stores new locations
	 */
	public function store(Request $request)
	{
		$point = $request->input('location');
		$user = Auth::guard('api')->user();
		try{
			$location = new Location();
			$location->location = $point;
			$user->Locations()->save($location);
		}catch(Exception $e){
			return "fubar";
		}
	}
}
