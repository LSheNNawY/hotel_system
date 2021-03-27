<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\DataTables\ReceptionistsDatatable;

use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;


class ReceptionistsController extends Controller
{
    public function index(ReceptionistsDatatable $dataTable)
    {
        return $dataTable->render('admin.receptionists.index', ['title' => 'Receptionists']);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'national_id' => 'required|required|digits_between:10,17|unique:users',
            'avatar' => 'image|mimes:jpeg,jpg|max:1999',
            'mobile' => 'required|regex:/(01)[0-9]{9}/|unique:users',
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
            'approved' => True,
            'approved_by' => auth()->user()->id
        ]);
        if ($user->exists()) {
            $user->assignRole('receptionist');
            return response()->json(array('success' => true), 200);
        }
        return response()->json(array('success' => false), 400);

    }

    public function edit($id)
    {
        if (\request()->ajax()) {
            $receptionist = User::find($id);
            if ($receptionist)
                return \response()->json($receptionist);
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if ($request->status == "ban")
                User::find($id)->delete();
            else
                User::withTrashed()->whereId($id)->restore();

            return \response('success');
        }


        // validation
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
//        if($request->hasFile('avatar')){
//            $file=$request->file('avatar');
//            $ext=$file->getClientOriginalExtension();
//            $filename="imges" . "_" . time() . "." . $ext;
//            $file->storeAs('public/images',$filename);
//        }
//
//        $validator = Validator::make($request->all(), $rules);
//
//        if ($validator->fails()) {
//
//            return \response()->json([
//                'success' => false,
//                'errors' => $validator->getMessageBag()->toArray()
//            ], 400);
//        }
//
//        $receptionist = User::find($id);
//        // $receptionist->name= $request->name;
//        // $receptionist->email= $request->email;
//        // $receptionist->national_id = $request->national_id;
//        // $receptionist->password= $request->password;
//        // $receptionist->avatar= $filename;
//        // $receptionist->country= $request->country;
//        // $receptionist->mobile= $request->mobile;
//        // $receptionist->gender= $request->gender;
//        // $receptionist->approved= True;
//        // $receptionist->approved_by = auth()->user()->id;
//
//       if($receptionist->update($request->all())){
//          return response()->json(array('success' => true), 200);
//       } return  response()->json(array('success' => false), 400);
    }


    public function destroy($id)
    {
        if (request()->ajax()) {
            $user = user::find($id);
            if ($user->forceDelete()) {
                return response('success');
            }
        }
    }

    
    function UnApprovedClients(){
        return "yes";
    }

}

