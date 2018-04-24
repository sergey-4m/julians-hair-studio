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
        $total = \DB::table('service_items')->count();
        $query = \DB::table('service_items')
            ->offset(request('offset', 0))
            ->limit(request('limit', 20))
            ->orderBy('service_items.'.request('sort', 'id'), request('order', 'asc'));
        $filter = trim(request('search'));
        if ($filter && $filter !== '') {
            $query
                ->where('service_items.title', 'like', $filter.'%');
            $total = $query->count();
        }
        $serviceItems = $query->get();
        return response()->json([
            'serviceItems' => $serviceItems,
            'total' => $total,
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $item = ServiceItem::find($id);
            $item->delete();
        } catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
        return response()->json([
            'status' => 'ok',
        ]);
    }
}
