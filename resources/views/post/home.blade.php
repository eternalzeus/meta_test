@extends('layout.layout_sidebar')
@section('content')
{{ Breadcrumbs::render('home') }}
<br>
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block" >
            <strong> {{$message}} </strong>
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block" >
            <strong> {{$message}} </strong>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2>All Posts</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{route('createPost')}}" class="btn btn-success" title="Add New Student">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Content</th>                           
                                        <th>Comment</th>                         
                                        <th>Action</th>                         
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $index => $post)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->body }}</td>
                                        <td>
                                            @foreach($comments as $comment)
                                                @if ($post->id==$comment->post_id)
                                                     @foreach ($users as $user)                                                 
                                                            @if ($comment->user_id==$user->id)
                                                                {{$user->name}}: {!! nl2br(e($comment->comment)) !!}
                                                                <br>
                                                                @foreach($comment->images as $image)
                                                                <img src="{{URL::to($image->path)}}" style="height:50px; width:50px" alt="">
                                                                @endforeach
                                                            @endif
                                                        <br>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="/edit_post/{{$post->id}}" title="Edit Student"><button class="btn btn-secondary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {{-- <a href="/edit-image/{{$post->id}}" title="Edit Student"><button class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Image</button></a> --}}
                                            <a href="/view_post/{{$post->id}}" title="View Post"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> View</button></a>
                                            <form method="POST" action="/delete-post/{{$post->id}}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection