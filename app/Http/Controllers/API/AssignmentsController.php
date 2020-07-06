<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AssignmentsController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'title' => 'required',
            'user_id' => 'required',
        ]);

        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else
        {
            $a = new \App\Assignments;
            $a->title = $request->input('title');
            $a->user_id = $request->input('user_id');
            $a->save();

            return response()->json([
                'error' => false,
                'a'  => $a,
            ], 200);
        }
    }

    public function destroy($id)
    {
        $a = \App\Assignments::find($id);

        if(is_null($a)){
            return response()->json([
                'error' => true,
                'message'  => "assignment with id # $id not found",
            ], 404);
        }

        $a->delete();

        return response()->json([
            'error' => false,
            'message'  => "assignment successfully deleted id # $id",
        ], 200);
    }
}
