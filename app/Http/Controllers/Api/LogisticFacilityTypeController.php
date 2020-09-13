<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLogisticFacilityTypeRequest;
use App\Http\Requests\Admin\UpdateLogisticFacilityTypeRequest;
use App\Models\LogisticFacilityType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogisticFacilityTypeController extends Controller
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
        $logistic_facility_types=LogisticFacilityType::all();
        return response($logistic_facility_types,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLogisticFacilityTypeRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'errors'    => $request->validator->errors()
            ]);
        }

        $logisticFacilityType = new LogisticFacilityType();

        $logisticFacilityType->fill($request->only(['name','zoom','parameters']));

        $logisticFacilityType->save();

        if($request->hasFile('icon')){

            $icon=$request->file('icon')->getClientOriginalName();

            $logisticFacilityType->icon=$icon;

            $logisticFacilityType->save();

            Storage::putFileAs('logistic_facility_types'.'/'.$logisticFacilityType->id,$request->file('icon'),$icon);

        }


        return response([
            'message' => 'logistic facility type successfully stored',
            'data' => $logisticFacilityType
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(LogisticFacilityType $logisticFacilityType)
    {
        return response($logisticFacilityType,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLogisticFacilityTypeRequest $request, LogisticFacilityType $logisticFacilityType)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'errors'    => $request->validator->errors()
            ]);
        }

        $logisticFacilityType->fill($request->only(['name','zoom','parameters']));

        $logisticFacilityType->save();

        if($request->hasFile('icon')){

            Storage::delete('logistic_facility_types/'.$logisticFacilityType->id.'/'.$logisticFacilityType->icon);

            $icon=$request->file('icon')->getClientOriginalName();

            $logisticFacilityType->icon=$icon;

            $logisticFacilityType->save();

            Storage::putFileAs('logistic_facility_types'.'/'.$logisticFacilityType->id,$request->file('icon'),$icon);

        }

        return response($logisticFacilityType, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LogisticFacilityType $logisticFacilityType)
    {
        Storage::delete('logistic_facility_types/'.$logisticFacilityType->id.'/'.$logisticFacilityType->icon);

        $logisticFacilityType->delete();

        return response([
            'message' => 'Logistic facility type successfully deleted'
        ], 410);
    }

}
