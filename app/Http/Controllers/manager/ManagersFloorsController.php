<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;

use App\DataTables\ManagersFloorsDatatable;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ManagersFloorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param FloorsDatatable $floor
     * @return Response
     */
    public function index(ManagersFloorsDatatable $floor)
    {
        return $floor->render('manager.floors.index', ['title' => 'Floors']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
         // validation
         $rules = [
            'name' => 'required|string|min:3|max:30',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return \response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ], 400);
        }

        Floor::create([
            'name' => $request->name,
            'created_by'=> auth()->user()->id
        ]);

        return \response()->json(array('success' => true), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        if (\request()->ajax()) {
            $floor = Floor::find($id);
            if ($floor)
                return \response()->json($floor);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // validation
        $rules = [
            'name' => 'required|string|min:1|max:30'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return \response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ], 400);
        }

        $floor = Floor::find($id);

        $floor->update([
           
            'name'  => $request->name
        ]);

        return \response()->json(array('success' => true), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Floor $floor)
    {
        if (\request()->ajax()) {
            if ($floor->delete()) {
                return \response('success');
            } else {
                return \response('Not empty');
            }
        }

    }
}
