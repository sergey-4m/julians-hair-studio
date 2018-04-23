<?php
namespace App\Http\Controllers\API;

use App\ServiceItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceItems = ServiceItem::all();
        return response()->json([
            'serviceItems' => $serviceItems,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $item = new ServiceItem;
            $item->title = request('title');
            $item->save();
            return response()->json([
                'serviceItem' => $item,
            ]);
        } catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServiceItem  $serviceItem
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $item = ServiceItem::find($id);
            return response()->json([
                'serviceItem' => $item,
            ]);
        } catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServiceItem  $serviceItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceItem $serviceItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update($id)
    {
        try {
            $item = ServiceItem::find($id);
            $item->title = request('title');
            $item->save();
            return response()->json([
                'serviceItem' => $item,
            ]);
        } catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceItem  $serviceItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceItem $serviceItem)
    {
        //
    }
}
