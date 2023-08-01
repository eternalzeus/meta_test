@extends('sidebar.sidebar')
@section('content')
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
        <div class="form-group">
            <form action="/post_search" method="GET">
                <input type="text" name="title" class="form-control col-md-4 float-left" placeholder="Search title" />
                <input type="text" name="body" class="form-control col-md-4 " placeholder="Search content" />
                <button type="submit" class="btn btn-success"> Search</button>
            </form>
        </div>
        <span id="total_records" style="font-size:14.0pt; font-weight:bold"></span>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>All Posts</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{route('createPost')}}" class="btn btn-success" title="Add New Post">
                            <i class="fa fa-plus" aria-hidden="true"></i> New Post
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Index</th>
                                        <th>Post id</th>
                                        <th>Title</th>
                                        <th>Content</th>                           
                                        <th>Comment</th>                         
                                        <th>Action</th>                         
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($res as $key => $post)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{ $post['post_id']}}</td>
                                            <td>{{ $post['title'] }}</td>
                                            <td>{{ $post['content'] }}</td>
                                            <td>
                                                @foreach($post['comment'] as $index => $row)
                                                    {!! $row['comment_content'] !!}
                                                    @foreach($row['comment_image'] as $index => $image)
                                                        @if($index > 0)
                                                            <img src="{{URL::to($image)}}"  style="height:100px; width:100px" alt="">
                                                        @endif
                                                    @endforeach
                                                    <br>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="/edit_post/{{$post['post_id']}}" title="Edit Post"><button class="btn btn-secondary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                                {{-- <a href="/edit-image/{{$post['post_id']}}" title="Edit Post"><button class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Image</button></a> --}}
                                                <a href="/view_post/{{$post['post_id']}}" title="View Post"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> View</button></a>
                                                <form method="POST" action="/delete-post/{{$post['post_id']}}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Post" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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
        {{$res->links()}}
    </div>
@endsection
<script src="{{asset('assets/js/jquerry_address.js')}}" type="text/javascript"></script>