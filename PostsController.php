<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Storage;


//connecting both model functions,postscontroller and route together
use App\post;
use DB;


// use App\input;

class PostsController extends Controller
 {
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
        //fetching all the data in this database model (post.php model)
        // return post::all();  
        //putting everthing in a post and returning it through our views using with function
           /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function index()
    {
        //arrangement of post according to latest post.....
         // for all posts to be displayed
        // $posts = post::all();
        // $posts= DB::select('SELECT * FROM posts');
       //  return post::where('title', 'post Two')->get();
       //arrangement of post according to latest post.....
       
      // $posts = post::orderBy('title', 'desc')->take(1)->get();
      // $posts = post::orderBy('title', 'desc')->get();
     
          $posts = post::orderBy('created_at', 'desc')->paginate(10);
          return view('posts.index')->with('posts', $posts);
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           
            'title'=> 'required',
            'body'=> 'required',
            'cover_image'=> 'image|nullable|max:1999'
           ]);

        //handle file upload
        if($request->hasFile('cover_image')){
            // how to get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get  Just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext.
           $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public\storage', $fileNameToStore);
        }
          else{
            $fileNameToStore = 'noimage.jpg'; 
        }
        
       //Create post
       $post = new post;
       $post ->title = $request->input('title'); 
       $post ->body = $request->input('body');
       $post ->user_id = auth()->user()->id;
       $post ->cover_image = $fileNameToStore;
       $post-> save();

       return redirect('/posts')->with('success', 'post created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = post::find($id);
        return view('posts.show')->with('post', $post);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
     {
        $post = post::find($id);

         //Check for correct user

        if(auth()->user()->id != $post->user_id){

           return redirect('/posts')->with('error','Unauthorized Page');
        }
        return view('posts.edit')->with('post', $post);

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
        $this->validate($request, [
           
            'title'=> 'required',
            'body'=> 'required',
            
        ]);
        
        //handle file upload
        if($request->hasfile('cover_image')){
            // how to get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get  Just filename
            $filename = pathinfo( $filenameWithExt, PATHINFO_FILENAME);
            // Get just ext.
           $extension =$request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
                  
       //Create post
       $post = post::find($id);
       $post ->title = $request->input('title'); 
       $post ->body = $request->input('body');
       if($request->hasFile('cover_image')){
       $post ->cover_image = $fileNameToStore;

       }
       $post->save();

       return redirect('/posts')->with('success', 'post Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = post::find($id);

         //Check for correct user to delete post

         if(auth()->user()->id != $post->user_id){
           return redirect('/posts')->with('error', 'Unauthorized Page');
         }
         if($post->cover_image !='noimage.jpg');{
            //Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);

         }
          
        $post->delete();
        return redirect('/posts')->with('success', 'post deleted Succesfully');
}
}