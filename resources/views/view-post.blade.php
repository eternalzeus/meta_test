@extends('layout.layout_2')
@section('content')
<div class = "card " >
    <div class="card-header">
      <h2>View Post</h2>
    </div>
    <div class="card-body">
        <form action="/edit-post/{{$post->id}}" method="POST">
            @csrf
            @method('PUT')  
            <div class="col-md-4 mb-3">
            <label for="validationTooltip01">Title</label>
            <br>
            {{$post->title}}
            </div>
            <div class="mb-3">
                <label for="validationTextarea">Content</label>
                <br>
                {{$post->body}}
            </div>
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

@endsection