@extends('layout.layout_sidebar')
@section('content')
{{ Breadcrumbs::render('create_post') }}
<div class = "card " >
  <div class="card-header">
    <h2>New Post</h2>
  </div>
  <div class="card-body">
    
    <form action="/create-post" method="POST" id="upload_form" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
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
        <div class="mb-3">
          <label for="formFile" class="form-label">Upload images</label>
          <input class="form-control" type="file" id="formFile" name="images[]" multiple>
          @error('images.*')
            <span style="color: red;"> {{$message}} </span>
          @enderror
        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

@endsection