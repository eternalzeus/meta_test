@extends('layout.layout_2')
@section('content')
<div class = "card " >
    <div class="card-header">
      <h2>Edit Post</h2>
    </div>
    <div class="card-body">
        <form action="/edit-post/{{$post->id}}" method="POST">
            @csrf
            @method('PUT')  
            <div class="col-md-4 mb-3">
            <label for="validationTooltip01">Title</label>
            <input type="text" class="form-control" name="title" value={{$post->title}}>
            @error('title')
                <span style="color: red;"> {{$message}} </span>
            @enderror
            </div>
            <div class="mb-3">
                <label for="validationTextarea">Content</label>
                <textarea name="body" class="form-control" >{{$post->body}}</textarea>
                @error('body')
                    <span style="color: red;"> {{$message}} </span>
                @enderror
            </div>
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

@endsection