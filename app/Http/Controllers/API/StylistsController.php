<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Stylist;

class StylistsController extends Controller
{
	public function list()
	{
		$total = \DB::table('stylists')->count();
		$stylists = \DB::table('stylists')
			->select('stylists.id', 'stylists.first_name', 'stylists.last_name', 'stylists.email', 'stylists.phone', 'stylists.mobile')
			->offset(request('offset', 0))
			->limit(request('limit', 20))
			->orderBy('stylists.'.request('sort', 'id'), request('order', 'asc'))
			->get();
		$data = [
			'rows' => $stylists,
			'total' => $total,
		];
		return response()->json([
			'data' => $data,
		]);
	}

	public function create()
	{
		try {
			$client = new Stylist;
			foreach (['first_name', 'last_name', 'email', 'phone', 'mobile'] as $field) {
				if (request($field)) {
					$client->$field = request($field);
				}
			}
			$client->save();
			return response()->json([
				'stylist' => $client,
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
			$client = Stylist::find($id);
			foreach (['first_name', 'last_name', 'email', 'phone', 'mobile'] as $field) {
				if (request($field)) {
					$client->$field = request($field);
				}
			}
			$client->save();
			return response()->json([
				'stylist' => $client,
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
			$client = Stylist::find($id);
			return response()->json([
				'stylist' => $client,
			]);
		} catch(Exception $e) {
			return response()->json([
				'error' => $e->getMessage(),
			]);
		}
	}

	public function loadForSelect()
	{
		try {
			$stylists = \DB::table('stylists')
				->select(
					'stylists.id', 
					\DB::raw('CONCAT(stylists.first_name, " ", stylists.last_name) AS name')
				)
				->get();
			return response()->json([
				'stylists' => $stylists,
			]);
		} catch(Exception $e) {
			return response()->json([
				'error' => $e->getMessage(),
			]);
		}
	}
}