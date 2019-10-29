@extends('welcome')
@section('content')
<div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        @foreach($post as $row)
        <div class="post-preview">
          <a href="{{ URL::to('view/post/'.$row->id) }}">
            <h2 class="post-title">
              {{ $row->title }}
            </h2>
            <h3 class="post-subtitle">
              <img src="{{ URL::to($row->image) }}" style="width:100%; height:300px;" alt="No Image">
            </h3>
          </a>
          <p class="post-meta">Category
            <a href="#">{{ $row->name }}</a>
            {{ $row->created_at }}</p>
        </div>
        <hr>
        @endforeach
      
        
        
        <!-- Pager -->
        <div class="clearfix">
          <div class="float-right">{{ $post->links() }}</div>
        </div>
      </div>
    </div>
@endsection