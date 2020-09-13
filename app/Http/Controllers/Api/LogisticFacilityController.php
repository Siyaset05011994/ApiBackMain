<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLogisticFacilityRequest;
use App\Http\Requests\Admin\UpdateLogisticFacilityRequest;
use App\Models\LogisticFacility;
use Illuminate\Http\Request;

class LogisticFacilityController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLogisticFacilityRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'errors'    => $request->validator->errors()
            ]);
        }

        $logisticFacility = new LogisticFacility();

        $logisticFacility->fill($request->only(['name','lat','lng','parameters','type_id']));

        $logisticFacility->save();

        return response([
            'message' => 'Logistic facility successfully stored',
            'data' => $logisticFacility
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(LogisticFacility  $logisticFacility)
    {
        return response($logisticFacility,200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLogisticFacilityRequest $request, LogisticFacility $logisticFacility)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'errors'    => $request->validator->errors()
            ]);
        }

        $logisticFacility->fill($request->only(['name','lat','lng','parameters','type_id']));

        $logisticFacility->save();

        return response([
            'message' => 'Logistic facility successfully updated',
            'data' => $logisticFacility
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LogisticFacility  $logisticFacility)
    {
        $logisticFacility->delete();

        return response([
            'message' => 'Logistic facility successfully deleted'
        ], 410);
    }
}
