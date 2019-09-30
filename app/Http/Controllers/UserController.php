<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('users.index');
    }
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $posts = new Post();
        return view('users.addnews', compact('categories', 'posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $posts = new Post();
        $posts->title=htmlspecialchars($request->title);
        $posts->content=htmlspecialchars($request->content);
        if(isset($request->image)!=null){
            $posts->imagePath=htmlspecialchars($request->image);
        }
        else{
            $posts->imagePath='/public/images/NonIzo.png';
        }
        $posts->category_id=$request->categories;
        $posts->save();

        $users = User::where('subscribe', '=', 1)->get();
        if(isset($users)!=null){
            foreach ($users as $user) {
                $email = $user->email;
                \Mail::send('emails.order', ['title'=>htmlspecialchars_decode($posts->title), 'name'=>$user->name], function($m) use ($email){
                    $m->from('testnews30092019@gmail.com');
                    $m->to($email);
                });
            }
        }

        return redirect('home')->with('success', 'News added!');
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
    }
}
