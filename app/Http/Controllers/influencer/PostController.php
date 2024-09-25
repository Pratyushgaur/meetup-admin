<?php

namespace App\Http\Controllers\influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    function index(Request $request){
        $request->validate([
          'images.*' => 'required|image|mimes:jpeg,png,jpg',
          'description' => 'required',
          'price'     => 'required_if:post_type,0|numeric|min:0',
          'post_type' => 'required|in:0,1',
          'plan'     => 'required_if:post_type,1|numeric|min:0',
        ]);
      
        $imagePath = [];
        $mainImage = '';
        if($request->hasFile('images')){
          foreach($request->file('images') as $key => $image){
            $imageName = time() . auth()->user()->id.$key.'_' . $image->getClientOriginalName();
            $image->move(public_path('posts'), $imageName);
            $imagePath = $imageName;
            if($key == 0){
              $mainImage  = $imageName ;
            }else{
              $imagePaths[] = $imagePath;
            }
          }
        }
        $post = Post::create([
          'userid' => \Auth::id(),
          'post_title' => $request->input('description'),
          'price' => $request->input('price'),
          'post_type' => $request->input('post_type'),
          'file_type' => 'image',
          'main_file' => $mainImage,
          'more_files' => (!empty($imagePaths)) ? json_encode($imagePaths): null, 
          'plan_id' => (int) $request->plan
        ]);
        echo json_encode(array('status' => '1' ,'message' => 'Post updated'));
    }

    function view(Request $request,$postype){
      $posts  = Post::where('userid','=',\Auth::id())
      ->when($postype == 'exclusive',function($posts){
        $posts->where('post_type','=',"0");
        
      })
      ->when($postype == 'premium',function($posts){
        $posts->where('post_type','=',"1");
        $posts->join('influencer_plans','posts.plan_id','=','influencer_plans.id');
        $posts->select('posts.*','influencer_plans.title as plan_name');
      })
      ->get();
        return view("influencer.Feed.feed",compact('posts','postype'));

    }
}
