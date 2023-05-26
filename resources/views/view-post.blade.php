@extends('layout.layout_2')
@section('content')
<div class = "card " >
    <div class="card-header">
      <h2>View Post</h2>
    </div>
    <div class="card-body">
        <form action="/view-post/{{$post->id}}" method="POST">
          @csrf
          @method('POST')  
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
            @if ($post->id==$image->post_id)
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
          </div>
          <button class="btn btn-primary btn-lg">Save</button>
          <a href="{{route('home')}}" class="btn btn-success float-end btn-lg" title="Back">
            <i class="fa fa-plus" aria-hidden="true"></i> Back
          </a>
        </form>
    </div>
</div>

@endsection