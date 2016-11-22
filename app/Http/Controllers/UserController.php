<?php

namespace App\Http\Controllers;

use App\Posts;
use App\Comments;
use App\User;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

class UserController extends Controller
{

  public function user_posts($id)
  {
   
    $posts = Posts::where('author_id',$id)->where('active',1)->orderBy('created_at','desc')->paginate(5);
    $title = User::find($id)->name;
    return view('home')->withPosts($posts)->withTitle($title);
  }

  public function get_all_users(){
  	return 'this is jest a test function test';
  }
  public function get_all_active_users(){
  	return 'this is just a function for geting all active users for admin';
  }
  /*
   * Display all of the posts of a particular user
   * 
   * @param Request $request
   * @return view
   */

  public function user_posts_all(Request $request)
  {
    //
    $user = $request->user();
    $posts = Posts::where('author_id',$user->id)->orderBy('created_at','desc')->paginate(5);
    $title = $user->name;
    return view('home')->withPosts($posts)->withTitle($title);
  }

  /*
   * Display draft posts of a currently active user
   * 
   * @param Request $request
   * @return view
   */
  public function user_posts_draft(Request $request)
  {
    //
    $user = $request->user();
    $posts = Posts::where('author_id',$user->id)->where('active',0)->orderBy('created_at','desc')->paginate(5);
    $title = $user->name;
    return view('home')->withPosts($posts)->withTitle($title);
  }
  /**
   * profile for user
   */
  public function profile(Request $request, $id) 
  {

    $data['user'] = User::find($id);

    if (!$data['user'])
      return redirect('/');
    if ($request -> user() && $data['user'] -> id == $request -> user() -> id) {
      $data['author'] = true;
    } else {
      $data['author'] = null;
    }

    $data['comments_count'] = $data['user'] -> comments -> count();
    $data['posts_count'] = $data['user'] -> posts -> count();
    $data['posts_active_count'] = $data['user'] -> posts -> where('active', '1') -> count();
    $data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
    $data['latest_posts'] = $data['user'] -> posts -> where('active', '1') -> take(5);
    $data['latest_comments'] = $data['user'] -> comments -> take(5);
    
    return view('admin.profile', $data);
  }


}
