@extends('welcome')
@section('content')
<div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <a href="{{ route('write.post') }}" class="btn btn-info">Write Post</a>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        
        <hr>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">SL</th>
              <th scope="col">Category</th>
              <th scope="col">Title</th>
              <th scope="col">Image</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($post as $row)
            <tr>
              <th scope="row">{{ $row->id }}</th>
              <td>{{ $row->name }}</td>
              <td>{{ $row->title }}</td>
              <td><img src="{{ URL::to($row->image) }}" style="width:50px; height:50px;" alt=""></td>
              <td>
                <a href="{{ URL::to('edit/post/'.$row->id) }}" class="btn btn-sm btn-info" style="padding:5px">Edit</a>
                <a href="{{ URL::to('delete/post/'.$row->id) }}" class="btn btn-sm btn-danger" style="padding:5px" id="delete">Delete</a>
                <a href="{{ URL::to('view/post/'.$row->id) }}" class="btn btn-sm btn-success" style="padding:5px">View</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
@endsection