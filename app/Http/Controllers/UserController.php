<?php

namespace App\Http\Controllers;

use App\Notifications\UserApprovalNotify;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use App\DataTables\UserDataTable;
use App\Models\User;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index', ['title' => 'Users']);
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,',
            'national_id' => 'required|digits_between:10,17|unique:users,national_id,',
            'avatar' => 'image|mimes:jpeg,jpg|max:1999',
            'mobile' => 'required|regex:/(01)[0-9]{9}/|unique:users,mobile,',
            'country' => 'required',
            'password' => 'min:6'
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
            'approved' => True,
            'approved_by' => auth()->user()->id,
        ]);

        if ($user->exists()) {
            $user->assignRole('user');
            return response()->json(array('success' => true), 200);
        }
        return response()->json(array('success' => false), 400);

    }

    public function destroy($id)
    {

        if (request()->ajax()) {
            $user = user::find($id);
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

    public function update(Request $request, User $user)
    {

        if ($request->ajax()) {
            $user->update([
                'approved' => true,
                'approved_by' => auth()->user()->id
            ]);

            // send message to user after approval
            Notification::route('mail', $user->email)
                    ->notify(new UserApprovalNotify($user));

            return \response('success');
        }

//        $user = User::find($id);
//
//        // validation
//        $rules = [
//            'name' => 'required',
//            'email'=> 'required|email|unique:users,email,' .$id,
//            'national_id' => 'required|digits_between:10,17|unique:users,national_id,' .$id,
//            'avatar'=>'image|mimes:jpeg,jpg|max:1999',
//            'mobile' => 'required|regex:/(01)[0-9]{9}/|unique:users,mobile,' .$id,
//            'country' => 'required',
//            'password' => 'min:6',
//
//        ];
//
//        $validator = Validator::make($request->all(), $rules);
//
//
//
//        if ($validator->fails()) {
//
//            return \response()->json([
//                'success' => false,
//                'errors' => $validator->getMessageBag()->toArray()
//            ], 400);
//        }
//
//
//       if($user->update($request->all())){
//          return response()->json(array('success' => true), 200);
//       } return  response()->json(array('success' => false), 400);
    }
}
