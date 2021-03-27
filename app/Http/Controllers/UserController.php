<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\DataTables\UserDataTable;
use App\Models\User;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        $users = User::with(['roles' => function ($q) {
            $q->where('name', 'user');
        }])->get();
        return $dataTable->render('admin.users.index', ['title' => 'Users', 'users' => $users]);
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email'=> 'required|email|unique:users,email,',
            'national_id' => 'required|digits_between:10,17|unique:users,national_id,',
            'avatar'=>'image|mimes:jpeg,jpg|max:1999',
            'mobile' => 'required|regex:/(01)[0-9]{9}/|unique:users,mobile,',
            'country' => 'required',
            'password' => 'min:6'
          
        ];

        if ($request->hasFile('avatar')) {
            $file=$request->file('avatar');
            $ext=$file->getClientOriginalExtension();
            $filename="img" . "_" . time() . "." . $ext;
            $file->storeAs('public/images', $filename);
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return \response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ], 400);
        }


        $user=User::create([
            'name'  => $request->name,
            'email'  => $request->email,
            'national_id' => $request->national_id,
            'password' => $request->password,
            'avatar'  => $filename,
            'country'  => $request->country,
            'mobile'  => $request->mobile,
            'gender'  => $request->gender,
            'approved'=>true,
            'approved_by'=> auth()->user()->id,
        ]);

        if ($user->exists()) {
            $user->assignRole('user');
            return response()->json(array('success' => true), 200);
        }
        return  response()->json(array('success' => false), 400);
    }

    public function destroy($id)
    {
        if (request()-> ajax()) {
            $user=user::find($id);
            if ($user->delete()) {
                return response('success');
            }
        }
    }

    public function edit($id)
    {
        if (\request()->ajax()) {
            $user = User::find($id);
            if ($user) {
                return \response()->json($user);
            }
        }
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        // validation
        $rules = [
            'name' => 'required',
            'email'=> 'required|email|unique:users,email,' .$id,
            'national_id' => 'required|digits_between:10,17|unique:users,national_id,' .$id,
            'avatar'=>'image|mimes:jpeg,jpg|max:1999',
            'mobile' => 'required|regex:/(01)[0-9]{9}/|unique:users,mobile,' .$id,
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


        if ($user->update($request->all())) {
            return response()->json(array('success' => true), 200);
        }
        return  response()->json(array('success' => false), 400);
    }
}
