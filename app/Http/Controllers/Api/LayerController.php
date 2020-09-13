<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLayerRequest;
use App\Http\Requests\Admin\UpdateLayerRequest;
use App\Models\Layer;
use Illuminate\Http\Request;

class LayerController extends Controller
{

    public function __construct()
    {

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layer = Layer::paginate(20);
        return response()->json( $layer,200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLayerRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'errors'    => $request->validator->errors()
            ]);
        }

        $layer = new Layer();

        $layer->fill($request->only(['name','logistic_facility_types_id']));

        $layer->save();

        return response([
            'message' => 'Layer successfully stored',
            'data' => $layer
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Layer  $layer)
    {
        return response($layer,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLayerRequest $request, Layer $layer)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'errors'    => $request->validator->errors()
            ]);
        }

        $layer->fill($request->only(['name','logistic_facility_types_id']));

        $layer->save();

        return response([
            'message' => 'Layer successfully updated',
            'data' => $layer
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Layer $layer)
    {
        $layer->delete();
        return response(['message' => 'Layer successfully deleted'], 410);
    }
}
