@extends('welcome')
@section('content')
<div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <a href="{{ route('add.category') }}" class="btn btn-danger">ADD Category</a>
        <a href="{{ route('all.category') }}" class="btn btn-info">ALL Category</a>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        
        <hr>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">SL</th>
              <th scope="col">Category Name</th>
              <th scope="col">Slug Name</th>
              <th scope="col">Created At</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($category as $row)
            <tr>
              <th scope="row">{{ $row->id }}</th>
              <td>{{ $row->name }}</td>
              <td>{{ $row->slug }}</td>
              <td>{{ $row->created_at }}</td>
              <td>
                <a href="{{ URL::to('edit/category/'.$row->id) }}" class="btn btn-sm btn-info" style="padding:5px">Edit</a>
                <a href="{{ URL::to('delete/category/'.$row->id) }}" class="btn btn-sm btn-danger" style="padding:5px" id="delete">Delete</a>
                <a href="{{ URL::to('view/category/'.$row->id) }}" class="btn btn-sm btn-success" style="padding:5px">View</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
@endsection