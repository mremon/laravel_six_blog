<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class postController extends Controller
{
    
    public function addCategory(){
    	return view('post.add_category');
    }

    public function storeCategory(Request $request){
    	$validatedData = $request->validate([
	        'name' => 'required|unique:categories|max:25|min:4',
	        'slug' => 'required|unique:categories|max:25|min:4',
	    ]);

    	$data=array();
    	$data['name']=$request->name;
    	$data['slug']=$request->slug;

    	$category=DB::table('categories')->insert($data);
    	if($category){
    		$notification=array(
				'message'=>'Successfully Category Inserted',
				'alert-type'=>'success'
			);
			return Redirect()->route('all.category')->with($notification);
    	}else{
    		$notification=array(
				'message'=>'Something Went Wrong!',
				'alert-type'=>'error'
			);
			return Redirect()->back()->with($notification);
    	}

    }

    public function allCategory(){
    	$category=DB::table('categories')->get();

    	return view('post.all_category', compact('category'));
    	//return view('post.all_category')->with('something','category');
    }

    public function viewCategory($id){
    	$category=DB::table('categories')->where('id',$id)->first();

    	return view('post.view_category')->with('single_id',$category);
    }

    public function deleteCategory($id){
    	$delete=DB::table('categories')->where('id',$id)->delete();

    	if($delete){
    		$notification=array(
				'message'=>'Successfully Category Deleted',
				'alert-type'=>'success'
			);
			return Redirect()->back()->with($notification);
    	}else{
    		$notification=array(
				'message'=>'Something Went Wrong!',
				'alert-type'=>'error'
			);
			return Redirect()->back()->with($notification);
    	}
    }

    public function editCategory($id){
    	$category=DB::table('categories')->where('id',$id)->first();
    	return view('post.edit_category', compact('category'));
    }
    public function updateCategory(Request $request,$id){
    	$validatedData = $request->validate([
	        'name' => 'required|max:25|min:4',
	        'slug' => 'required|max:25|min:4',
	    ]);

    	$data=array();
    	$data['name']=$request->name;
    	$data['slug']=$request->slug;

    	$category=DB::table('categories')->where('id', $id)->update($data);
    	if($category){
    		$notification=array(
				'message'=>'Successfully Category Updated',
				'alert-type'=>'success'
			);
			return Redirect()->route('all.category')->with($notification);
    	}else{
    		$notification=array(
				'message'=>'Nothing to update!',
				'alert-type'=>'error'
			);
			return Redirect()->route('all.category')->with($notification);
    	}
    }




    // post related things are here
    public function writePost(){
    	$category=DB::table('categories')->get();
    	return view('post.writepost', compact('category'));
    }

    public function storePost(Request $request){
    	$validatedData = $request->validate([
	        'title' => 'required|max:125',
	        'details' => 'required|max:400',
	        'image' => 'required | mimes:jpeg,jpg,png,PNG | max:1000',
	    ]);

	    $data=array();
	    $data['title']=$request->title;
	    $data['category_id']=$request->category_id;
	    $data['details']=$request->details;
	    $image=$request->file('image');

	    if ($image) {
	    	$image_name=hexdec(uniqid());
	    	$ext=strtolower($image->getClientOriginalExtension());
			$image_full_name=$image_name.".".$ext;
			$upload_path='public/frontend/image/';
			$image_url=$upload_path.$image_full_name;
			$success=$image->move($upload_path,$image_full_name);
			$data['image']=$image_url;
			DB::table('posts')->insert($data);
	    	$notification=array(
				'message'=>'Successfully Post Inserted',
				'alert-type'=>'success'
			);
			return Redirect()->back()->with($notification);
	    }else{
	    	DB::table('posts')->insert($data);
	    	$notification=array(
				'message'=>'Successfully Post Inserted',
				'alert-type'=>'success'
			);
			return Redirect()->back()->with($notification);
	    }
    }

    public function allPost(){
    	$post=DB::table('posts')
    			->join('categories','posts.category_id','categories.id')
    			->select('posts.*','categories.name')
    			->get();

    	return view('post.all_post', compact('post'));
    }
    public function viewPost($id){
    	$post=DB::table('posts')
    			->join('categories','posts.category_id','categories.id')
    			->select('posts.*','categories.name')
    			->where('posts.id', $id)
    			->first();

    	return view('post.view_post', compact('post'));
    }
    public function editPost($id){
    	$category=DB::table('categories')->get();
    	$post=DB::table('posts')->where('id',$id)->first();

    	return view('post.edit_post', compact('category','post'));
    }
    public function updatePost(Request $request,$id){
    	$validatedData = $request->validate([
	        'title' => 'required|max:125',
	        'details' => 'required|max:400',
	        'image' => 'mimes:jpeg,jpg,png,PNG | max:1000',
	    ]);

	    $data=array();
	    $data['title']=$request->title;
	    $data['category_id']=$request->category_id;
	    $data['details']=$request->details;
	    $image=$request->file('image');

	    if ($image) {
	    	$image_name=hexdec(uniqid());
	    	$ext=strtolower($image->getClientOriginalExtension());
			$image_full_name=$image_name.".".$ext;
			$upload_path='public/frontend/image/';
			$image_url=$upload_path.$image_full_name;
			$success=$image->move($upload_path,$image_full_name);
			$data['image']=$image_url;
			unlink($request->old_photo);
			DB::table('posts')->where('id',$id)->update($data);
	    	$notification=array(
				'message'=>'Successfully Post Updated',
				'alert-type'=>'success'
			);
			return Redirect()->route('all.post')->with($notification);
	    }else{
	    	$data['image']=$request->old_photo;
	    	DB::table('posts')->where('id',$id)->update($data);
	    	$notification=array(
				'message'=>'Successfully Post Updated',
				'alert-type'=>'success'
			);
			return Redirect()->route('all.post')->with($notification);
	    }
    }
    public function deletePost($id){
    	$post=DB::table('posts')->where('id',$id)->first();
		$image=$post->image;
    	$delete=DB::table('posts')->where('id',$id)->delete();

    	if($delete){
    		unlink($image);
    		$notification=array(
				'message'=>'Successfully Post Deleted',
				'alert-type'=>'success'
			);
			return Redirect()->back()->with($notification);
    	}else{
    		$notification=array(
				'message'=>'Something Went Wrong!',
				'alert-type'=>'error'
			);
			return Redirect()->back()->with($notification);
    	}
    }

    
}
