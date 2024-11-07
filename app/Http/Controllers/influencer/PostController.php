<?php

namespace App\Http\Controllers\influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use FFMpeg;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    
    function index(Request $request){

      try {
        
        $request->validate([
          'images.*' => 'required|image|mimes:jpeg,png,jpg,',
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
              $manager = ImageManager::withDriver(new Driver());
              $image_blue_read = $manager->read('posts/'.$imageName);
              $thumbimage = $image_blue_read->blur(100);
              $thumbimage = $thumbimage->pixelate(8);
              $newName = time() . auth()->user()->id.$key.'_blue_' . $image->getClientOriginalName();
              $thumbimage->save(public_path('posts/'.$newName));


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
          'plan_id' => (int) $request->plan,
          'main_image_blur' =>$newName
        ]);
        echo json_encode(array('status' => '1' ,'message' => 'Post updated'));
      } catch (\Illuminate\Validation\ValidationException $e) {
        //Log::error($e->errors());
        return response()->json(  array('status' => '0' ,'message' => $e->getMessage()), 422);
      }


       
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
      ->orderBy('posts.id','desc')
      ->get();
      $plans = \App\Models\Influencerplan::where('user_id',\Auth::id())->latest()->get();
        return view("influencer.Feed.feed",compact('posts','postype','plans'));

    }
    function video_post(Request $request){
      try {
        $request->validate([
          'video' => 'required|mimes:mp4,mov,ogg,qt',
          'description' => 'required',
          'price'     => 'required_if:post_type,0|numeric|min:0',
          'post_type' => 'required|in:0,1',
          'plan'     => 'required_if:post_type,1|numeric|min:0',
        ]);
        if($request->hasFile('video')){
          $imageName = time() . auth()->user()->id.'_' . $request->video->getClientOriginalName();
          $request->video->move(public_path('posts'), $imageName);
          $imagePath = $imageName;
          //
          $imageName = time() . auth()->user()->id.'thumbnail_' . $request->thumbnail->getClientOriginalName();
          $request->thumbnail->move(public_path('thumbnails'), $imageName);
          $thumbnail = $imageName;
          
          $post = Post::create([
            'userid' => \Auth::id(),
            'post_title' => $request->input('description'),
            'price' => $request->input('price'),
            'post_type' => $request->input('post_type'),
            'file_type' => 'video',
            'main_file' => $imagePath,
            'video_thumbnail' => $thumbnail,
            'plan_id' => (int) $request->plan
          ]);
          //echo json_encode(array('status' => '1' ,'message' => 'Post updated'));
          return response()->json(  array('status' => '1' ,'message' => 'Post updated'), 200);

        }else{
          return response()->json(  array('status' => '0' ,'message' => 'Video File Required'), 422);
        }
      } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(  array('status' => '0' ,'message' => $e->getMessage()), 422);
      }
    }

    function post_comment(Request $request) {
      try {
        $request->validate([
          'comment' => 'required',
          'post_id' => 'required'
        ]);
        $comment = new \App\Models\Comment;
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->user_id = auth()->user()->id;
        $comment->save();
        return response()->json(  array('status' => '1' ,'message' => "comment added"), 200);
      } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(  array('status' => '0' ,'message' => $e->getMessage()), 422);
      }
    }

    function comment_get(Request $request)  {
      try {
        $request->validate([
          'post_id' => 'required'
        ]);
        $comment = \App\Models\Comment::where('post_id','=',$request->post_id)->join('users','comments.user_id','=','users.id')->select('users.name','users.username','comments.*')->orderBy('comments.id','desc')->get();
        return response()->json( array('status' => '1' ,'comment' => $comment), 200);
      } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(  array('status' => '0' ,'message' => $e->getMessage()), 422);
      }
    }
    function get_post(Request $request)  {
      try {
        $post = Post::findOrFail($request->postid);
        return response()->json( array('status' => '1' ,'postdata' => $post), 200);

      } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(  array('status' => '0' ,'message' => $e->getMessage()), 422);
      }
      

    }

    function post_update(Request $request)  {
      try {
        $request->validate([
          'title' => 'required',
          'post_price'     => 'required_if:post_type,0|numeric|min:0',
          'post_type' => 'required|in:0,1',
          'post_plans'     => 'required_if:post_type,1|numeric|min:0',
          'id'            => 'required'
        ]);

        
        Post::where('id','=',$request->id)->update([
       
          'post_title' => $request->input('title'),
          'price' => $request->input('post_price'),
          'post_type' => $request->input('post_type'),
          'plan_id' => (int) $request->post_plans
        ]);

        return response()->json( array('status' => '1' ,'message' => 'Updated Success'), 200);

      } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(  array('status' => '0' ,'message' => $e->getMessage()), 422);
      }
    }

}
