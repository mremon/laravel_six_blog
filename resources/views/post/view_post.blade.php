@extends('welcome')
@section('content')
<div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <a href="{{ route('write.post') }}" class="btn btn-danger">Write Post</a>
        <a href="{{ route('all.post') }}" class="btn btn-info">ALL Post</a>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        
        <hr>
        
        <h3>{{ $post->title }}</h3>
        <img src="{{ URL::to($post->image) }}" style="width:200px;height:200px;" alt="Nothing Found">
        <p>{{ $post->name }}</p>
        <p>{{ $post->details }}</p>

      </div>
    </div>
@endsection