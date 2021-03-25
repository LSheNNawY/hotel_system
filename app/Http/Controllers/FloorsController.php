<?php

namespace App\Http\Controllers;

use App\DataTables\FloorsDatatable;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class FloorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param FloorsDatatable $floor
     * @return Response
     */
    public function index(FloorsDatatable $floor)
    {
        return $floor->render('admin.floors.index', ['title' => 'Floors']);
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
        //
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
        // $floor=Floor::find($id);
        // $floor->name=$request->name;
        // $floor->save();   
        // return redirect()->route('floors.admin.index'); 
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
