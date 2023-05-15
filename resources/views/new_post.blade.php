@extends('layout.layout_2')
@section('content')
<div class = "card " >
  <div class="card-header">
    <h2>New Post</h2>
  </div>
  <div class="card-body">
    <form action="/create-post" method="POST">
        @csrf
        <div class="col-md-4 mb-3">
          <label for="validationTooltip01">Title</label>
          <input type="text" class="form-control" name="title" placeholder="Title">
          @error('title')
            <span style="color: red;"> {{$message}} </span>
          @enderror
        </div>
        <div class="mb-3">
          <label for="validationTextarea">Content</label>
          <textarea class="form-control" name="body" placeholder="Content"></textarea>
          @error('body')
            <span style="color: red;"> {{$message}} </span>
          @enderror
        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
@endsection