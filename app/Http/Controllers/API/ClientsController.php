<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;

class ClientsController extends Controller
{
	public function create()
	{
		try {
			$client = new Client;
			foreach (['first_name', 'last_name', 'email', 'phone', 'mobile'] as $field) {
				if (request($field)) {
					$client->$field = request($field);
				}
			}
			$client->save();
			return response()->json([
				'client' => $client,
			]);
		} catch(Exception $e) {
			return response()->json([
				'error' => $e->getMessage(),
			]);
		}
	}

	public function update($id)
	{
		try {
			$client = Client::find($id);
			foreach (['first_name', 'last_name', 'email', 'phone', 'mobile'] as $field) {
				if (request($field)) {
					$client->$field = request($field);
				}
			}
			$client->save();
			return response()->json([
				'client' => $client,
			]);
		} catch(Exception $e) {
			return response()->json([
				'error' => $e->getMessage(),
			]);
		}
	}

	public function load($id)
	{
		try {
			$client = Client::find($id);
			return response()->json([
				'client' => $client,
			]);
		} catch(Exception $e) {
			return response()->json([
				'error' => $e->getMessage(),
			]);
		}
	}
}