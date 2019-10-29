@extends('welcome')
@section('content')
<div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <a href="{{ route('add.category') }}" class="btn btn-danger">ADD Category</a>
        <a href="{{ route('all.category') }}" class="btn btn-info">ALL Category</a>
        <a href="{{ route('all.post') }}" class="btn btn-info">ALL Post</a>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <hr>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('update/post/'.$post->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Post title</label>
              <input type="text" class="form-control" value="{{ $post->title }}" name="title" id="" >
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Category</label>
              <select class="form-control" name="category_id">
                @foreach($category as $row)
              	<option value="{{ $row->id }}"<?php if($row->id == $post->category_id) echo"Selected" ?>>{{ $row->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Post Image</label>
              <input type="file" class="form-control" name="image" id="" ><br>
              Old Image:
              <img src="{{ URL::to($post->image) }}" alt="No Image" style="width:100px; height:100px;">
              <input type="hidden" name="old_photo" value="{{ $post->image }}">
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Post Details</label>
              
              <textarea name="details" class="from-control"  rows="5" cols="50">
                {{ $post->details }}
              </textarea>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" >Update</button>
          </div>
        </form>
      </div>
    </div>
@endsection