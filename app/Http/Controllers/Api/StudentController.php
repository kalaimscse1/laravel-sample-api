<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Student::orderBy('id', 'asc')->get();
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
    public function store(Request $request)
    {
        //

        $request->validate([  
            'name'=>'required',  
            'regno'=>'required',  
            'email'=>'required',  
            'mobile'=>'required',
            'address'=>'required'
        ]);  
  
        $student = new Student();

        $student->name = $request->get('name');
        $student->regno = $request->get('regno');
        $student->email = $request->get('email');
        $student->mobile = $request->get('mobile');
        $student->address = $request->get('address');
        $student->save();

        return response()->json([
            'data' => $student,
            'status'=>200
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if (Student::where('id', $id)->exists()) {
            $student = Student::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($student, 200);
          } else {
            return response()->json([
              "message" => "Student not found"
            ], 404);
          }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $this->validate($request, [ // the new values should not be null
            'name' => 'required',
            'regno' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'address' => 'required'
        ]);
  
        $task = Student::findorFail($id); // uses the id to search values that need to be updated.
        $task->name = $request->input('name'); //retrieves user input
        $task->regno = $request->input('regno');////retrieves user input
        $task->email = $request->input('email');
        $task->mobile = $request->input('mobile');
        $task->address = $request->input('address');
        $task->save();//saves the values in the database. The existing data is overwritten.
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(Student::where('id', $id)->exists()) {
            $student = Student::find($id);
            $student->delete();
    
            return response()->json([
              "message" => "records deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Student not found"
            ], 404);
          }
    }
}
