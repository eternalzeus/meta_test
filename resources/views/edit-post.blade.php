@extends('layout.layout_2')
@section('content')
<div class = "card " >
    <div class="card-header">
      <h2>Edit Post</h2>
    </div>
    <div class="card-body">
        <form action="/edit-post/{{$post->id}}" method="POST" enctype="multipart/form-data">
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
            
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h2>All Images</h2>
                            </div>
                            <div class="card-body">
                                <br/>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Image</th>             
                                                <th>Action</th>                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($images as $index => $image)
                                                @if ($post->id==$image->imageable_id)
                                                    <tr>
                                                        <td id='test'><img src="{{URL::to($image->path)}}" style="height:200px; width:200px" alt=""></td>
                                                        <td>
                                                            <form  method="POST" id="upload_form" enctype="multipart/form-data">
                                                                {{-- action="/update-image/{{$image->id}}" --}}
                                                                {{ method_field('PUT') }}
                                                                {{ csrf_field() }}
                                                                <div class="mb-3">
                                                                    <label for="formFile" class="form-label">Update images</label>
                                                                    <input class="form-control" type="file" id="formFile" name="image">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary" >Update</button>
                                                            </form>
                                                            <br>
                                                            <form method="POST" action="/delete-image/{{$image->id}}" accept-charset="UTF-8" style="display:inline">
                                                                {{ method_field('DELETE') }}
                                                                {{ csrf_field() }}
                                                                <button type="submit" class="btn btn-danger" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <form action="/add-image/{{$post->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Add images</label>
                                <input class="form-control" type="file" id="formFile" name="image[]" multiple>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-lg">Save</button>
            <a href="{{route('home')}}" class="btn btn-success float-end btn-lg" title="Back">
                <i class="fa fa-plus" aria-hidden="true"></i> Back
            </a>
        </form>
    </div>
</div>
<span id="uploaded_image"></span>
<script>
    $(document).ready(function(){
        $('#upload_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:'/update-image/' + $image->id,
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
                    $('#uploaded_image').html(data.uploaded_image);
                }
            })
        });
    });
</script>

@endsection