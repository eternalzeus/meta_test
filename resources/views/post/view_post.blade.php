@extends('sidebar.sidebar')
@section('content')
{{ Breadcrumbs::render('view_post') }}
<div class = "card " >
    <div class="card-header">
      <h2>View Post</h2>
    </div>
    <div class="card-body">
        <form action="/view_post/{{$post->id}}" id="upload_form" method="POST" name='images' enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="card">
            <div class="card-header">
              <h5>Title</h5>
            </div>
            <div class="card-body">
              {{$post->title}}
            </div>
          </div>
          <br>
          <div class="card">
            <div class="card-header">
              <h5>Content</h5>
            </div>
            <div class="card-body">
              {{$post->body}}
            </div>
          </div>
          <br>
          <h4>Images</h4>
          @foreach ($images as $image)
            @if ($post->id==$image->imageable_id)
            <img src="{{URL::to($image->path)}}" style="height:200px; width:200px" alt="">
            @endif
          @endforeach
          <div class="mb-3">
            <br>
            <hr class="hr hr-blurry" />
            <h4>Your Comment</h4>
            <br>
            <h6>Comment</h6>
            <textarea id="editor" class="form-control" name="comment" placeholder="Comment"></textarea>
            @error('comment')
              <span style="color: red;"> {{$message}} </span>
            @enderror
            <br>
            <h6>Comment Images</h6>
            <input class="form-control" type="file" id="formFile" name="images[]" multiple>
            @error('images.*')
              <span style="color: red;"> {{$message}} </span>
            @enderror
          </div>
          <button class="btn btn-primary btn-lg">Save</button>
        </form>
    </div>
</div>
<br>

<script type="text/javascript" src="{{url('js/ckeditor.js')}}"></script>

@endsection

<script src="{{asset('assets/ckeditor5/build/ckeditor.js')}}" type="text/javascript"></script>


