<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Http\Response;
use App\DataTables\ManagersDatatable;
use Illuminate\Support\Facades\Validator;


class ManagersController extends Controller
{
    public function index(ManagersDatatable $dataTable)
    {
        return $dataTable->render('admin.managers.index', ['title' => 'Managers']);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users',
            'national_id' => 'required|unique:users',
            'avatar' => 'image|mimes:jpeg,jpg|max:1999',
            'mobile' => 'required|unique:users',
            'country' => 'required',
            'password' => 'min:6',
        ];

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $ext = $file->getClientOriginalExtension();
            $filename = "imges" . "_" . time() . "." . $ext;
            $file->storeAs('public/images', $filename);
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return \response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ], 400);
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'national_id' => $request->national_id,
            'password' => $request->password,
            'avatar' => $filename,
            'country' => $request->country,
            'mobile' => $request->mobile,
            'gender' => $request->gender,
            'approved' => true,
            'approved_by' => auth()->user()->id
        ]);
        if ($user->exists()) {
            $user->assignRole('manager');
            return response()->json(array('success' => true), 200);
        }
        return response()->json(array('success' => false), 400);

    }

    public function edit($id)
    {
        if (\request()->ajax()) {
            $manager = User::find($id);
            if ($manager)
                return \response()->json($manager);
        }
    }

    public function update(Request $request, $id)
    {
        // validation
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'national_id' => 'required|digits_between:10,17|unique:users,national_id,' . $id,
            'avatar' => 'image|mimes:jpeg,jpg|max:1999',
            'mobile' => 'required|regex:/(01)[0-9]{9}/|unique:users,mobile,' . $id,
            'country' => 'required',
            'password' => 'min:6',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return \response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ], 400);
        }

        $manager = User::find($id);


        $manager->update($request->all());
        return \response()->json(array('success' => true), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */

    public function destroy($id)
    {
        if (request()->ajax()) {
            $user = User::find($id);
            if ($user->delete()) {
                return response('success');
            }
        }

    }

}

