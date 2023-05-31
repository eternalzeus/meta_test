@extends('layout.layout_2')
@section('content')
<div class = "card " >
    <div class="card-header">
      <h2>View Post</h2>
    </div>
    <div class="card-body">
        <form id="upload_form" method="POST" enctype="multipart/form-data">
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
            <h4>Your Comment</h4>
            <textarea class="form-control" name="comment" placeholder="Comment"></textarea>
            @error('comment')
              <span style="color: red;"> {{$message}} </span>
            @enderror
            <label for="formFile" class="form-label">Comment images</label>
            <input class="form-control" type="file" id="formFile" name="images[]" multiple>
          </div>
          <button class="btn btn-primary btn-lg">Save</button>
        </form>
        <a href="{{route('home')}}" class="btn btn-success float-end btn-lg" title="Back">
          <i class="fa fa-plus" aria-hidden="true"></i> Back
        </a>
    </div>
</div>
<br>

<div class="alert" id="message" style="display: none"></div>

<script>
$(document).ready(function(){
  $('#upload_form').on('submit', function(event){ // 'upload_form' is the id of above form
    event.preventDefault();
    $.ajax({
        url:'/view-post' + $image->id,
        method:"POST",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
            $('#message').css('display', 'block');
            $('#message').html(data.message);
            $('#message').addClass(data.class_name);
            // $('#uploaded_image').html(data.uploaded_image);
        }
    })
  });
});
</script>

  
@endsection