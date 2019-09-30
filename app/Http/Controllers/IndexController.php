<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class IndexController extends Controller
{
    public function index(Request $request)
    {
    	if(isset($request->checkedSort)){
    		$posts = Post::select('*')->orderBy('count', 'DESC')->paginate(3);
    		$checkedSort=$request->checkedSort;
    	}
    	else {
    		$posts = Post::select('*')->orderBy('id', 'DESC')->paginate(3);
    	}
        return view('news', compact('posts', 'checkedSort'));
    }
    public function categoryShowNews($id, Request $request)
    {
    	$category = Category::find($id);
    	
    	if(isset($request->checkedSort)){
    		$posts = Post::where('category_id', '=', $id)->orderBy('count', 'DESC')->paginate(3);
    		$checkedSort=$request->checkedSort;
    	}
    	else {
    		$posts = Post::where('category_id', '=', $id)->orderBy('id', 'DESC')->paginate(3);
    	}
        return view('category', compact('posts', 'category', 'checkedSort'));
    }
    public function newsShow($id)
    {
    	$posts = Post::find($id);
    	$count=$posts->count;
    	if($count!=null){
    		$posts->count=$count+1;
    	}
    	else{
    		$posts->count=1;
    	}
    	$posts->save();

        return view('show', compact('posts'));
    }
    public function search(Request $request)
    {
        $checkedSort=$request->checkedSort;
        $s=$request->s;
        if(isset($request->checkedSort)){
        	$posts=Post::where('title', 'like', '%'.$s.'%')
                    ->orWhere('content', 'like', '%'.$s.'%')
                    ->orderBy('id', 'DESC')
                    ->paginate(3);
        }
        else{
        	$posts=Post::where('title', 'like', '%'.$s.'%')
                    ->orWhere('content', 'like', '%'.$s.'%')
                    ->orderBy('count', 'DESC')
                    ->paginate(3);
        }
        
        return view('category', compact('posts', 's', 'checkedSort'));
    }
    public function subscribe($id)
    {
        $user = User::find($id);
        $user->subscribe = 1;
        $user->save();
        Session::put('page', \Redirect::back()->getTargetUrl());
        return redirect(Session::get('page'))->with('success', 'You have successfully subscribed to the newsletter!');

    }
    public function nosubscribe($id)
    {
        $user = User::find($id);
        $user->subscribe = null;
        $user->save();
        Session::put('page', \Redirect::back()->getTargetUrl());
        return redirect(Session::get('page'))->with('error', 'Why do you unsubscribe from our newsletter?');
    }
    public function addfavorite(Request $request)
    {
        Session::put('page', \Redirect::back()->getTargetUrl());
        $user = User::find($request->user);
        $news = $request->news;
        if($user->favorites==null){
            $user->favorites = $news;
            $user->save();
            return redirect(Session::get('page'))->with('success', 'This news has been added to your favorites.');
        }
        else{
            $favorite = explode(', ', $user->favorites);
            if(in_array($news, $favorite)){
                return redirect(Session::get('page'))->with('error', 'This news is already in my favorites.');
            }
            else
            {
                $favorite[] = $news;
                $favorites = implode(', ', $favorite);
                $user->favorites = $favorites;
                $user->save();
                return redirect(Session::get('page'))->with('success', 'This news has been added to your favorites.');
            }
        }
    }
    public function favorite($id, Request $request)
    {
        $checkedSort = $request->checkedSort;
        $user = User::find($id);
        if(isset($user->favorites)!=null){
            $postId = explode(', ', $user->favorites);
            if(isset($checkedSort)!=null){
                $posts = Post::whereIn('id', $postId)->orderBy('count', 'DESC')->paginate(3);
            }
            else{
                $posts = Post::whereIn('id', $postId)->orderBy('id', 'DESC')->paginate(3);
            }
            return view('users.favorites', compact('posts', 'checkedSort'));
        }
        else{
            $posts = null;
            return view('users.favorites', compact('posts', 'checkedSort'));
        }
    }
}
