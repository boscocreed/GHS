<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'error' => false,
            'employees'  => \App\User::with('assignment')->get(),
            'assignments' => \App\Assignments::all()
        ], 200);
       // $user = \App\User::find(1);
        //return $user->assignments;
    }

    public function view(){
        return view('index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else
        {
            $employee = new \App\User;
            $employee->name = $request->input('name');
            $employee->email = $request->input('email');
            $employee->password = 'hello';
            $employee->save();

            return response()->json([
                'error' => false,
                'employee'  => $employee,
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        if(is_null($employee)){
            return response()->json([
                'error' => true,
                'message'  => "Employee with id # $id not found",
            ], 404);
        }

        return response()->json([
            'error' => false,
            'employee'  => $employee,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else
        {
            $employee = \App\User::find($id);
            $employee->name = $request->input('name');
            $employee->email = $request->input('email');
            $employee->save();

            return response()->json([
                'error' => false,
                'employee'  => $employee,
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = \App\User::find($id);

        if(is_null($employee)){
            return response()->json([
                'error' => true,
                'message'  => "Employee with id # $id not found",
            ], 404);
        }

        $employee->delete();

        return response()->json([
            'error' => false,
            'message'  => "Employee record successfully deleted id # $id",
        ], 200);
    }
}
