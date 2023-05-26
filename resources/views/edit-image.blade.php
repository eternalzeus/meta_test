@extends('layout.layout_2')
@section('content')
</div>
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
                                    @if ($post->id==$image->post_id)
                                        <tr>
                                            <td><img src="{{URL::to($image->path)}}" style="height:200px; width:200px" alt=""></td>
                                            <td>
                                                <form action="/update-image/{{$image->id}}" method="POST" enctype="multipart/form-data">
                                                    {{ method_field('PUT') }}
                                                    {{ csrf_field() }}
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Update images</label>
                                                        <input class="form-control" type="file" id="formFile" name="image">
                                                    </div>
                                                    <button class="btn btn-primary">Update</button>
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
                <button class="btn btn-success">Submit</button>
                <a href="{{route('home')}}" class="btn btn-secondary float-end" title="Back">
                    <i class="fa fa-plus" aria-hidden="true"></i> Back
                  </a>
            </form>
        </div>
    </div>
</div>
<br>
@endsection