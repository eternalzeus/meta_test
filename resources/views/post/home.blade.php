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
            <input type="text" name="search" id="search" class="form-control" placeholder="Search Post" />
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
                                                                    Comment of {{$user->name}}:{!! $comment->comment !!}
                                                                    {{-- {!! nl2br(e($comment->comment)) !!} --}}
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
                                                <a href="/edit_post/{{$post->id}}" title="Edit Post"><button class="btn btn-secondary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                                {{-- <a href="/edit-image/{{$post->id}}" title="Edit Post"><button class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Image</button></a> --}}
                                                <a href="/view_post/{{$post->id}}" title="View Post"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> View</button></a>
                                                <form method="POST" action="/delete-post/{{$post->id}}" accept-charset="UTF-8" style="display:inline">
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
    </div>
@endsection
<script src="{{asset('assets/js/jquerry_address.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        
        function fetch_customer_data(query){
            
            $.ajax({
                url:"{{ route('postSearch') }}",
                method:'GET',
                data:{query:query},
                dataType:'json',
                success:function(data){
                    $('tbody').html(data.table_data);
                    $('#total_records').text("Total search data: " +data.total_data);
                }
            })
        }
        $(document).on('keyup', '#search', function(){
            var query = $(this).val();
            fetch_customer_data(query);
        });
    });
</script>