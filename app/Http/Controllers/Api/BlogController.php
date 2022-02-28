<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Blog::orderBy('id', 'asc')->get();

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
            'title'=>'required',  
            'post'=>'required',  
            'user_id'=>'required'
        ]);  
  
        $blog = new Blog();

        $blog->title = $request->get('title');
        $blog->post = $request->get('post');
        $blog->user_id = $request->get('user_id');
        $blog->save();

        return response()->json([
            'data' => $blog,
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
        if (Blog::where('id', $id)->exists()) {
            $blog = blog::where('id', $id)->get();
            return response()->json([
                'data' => $blog,
                'status'=>200
            ], 200);          } else {
            return response()->json([
              "message" => "Blog not found"
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
        
        $request->validate([  
            'title'=>'required',  
            'post'=>'required',  
            'user_id'=>'required'
        ]);  
  
        $blog = Blog::findorFail($id); // uses the id to search values that need to be updated.
        $blog->title = $request->get('title');
        $blog->post = $request->get('post');
        $blog->user_id = $request->get('user_id');
        $blog->save();

        return response()->json([
            'data' => $blog,
            'status'=>200
        ], 200);
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
        
        if(Blog::where('id', $id)->exists()) {
            $blog = Blog::find($id);
            $blog->delete();
    
            return response()->json([
              "message" => "records deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Blog not found"
            ], 404);
          }
    }
}
