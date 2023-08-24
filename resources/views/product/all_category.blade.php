@extends('sidebar.sidebar')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block" >
            <strong> {{$message}} </strong>
        </div>
    @endif
<br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>All Products</h2>
                    </div>
                    <div class="card-body">
                        <a href="/new_category" class="btn btn-info" title="Add New Category">
                            <i class="fa fa-plus" aria-hidden="true"></i> New Category
                        </a>
                        <br/>
                        <br/>
                            <div class="table-responsive">
                                @csrf
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Index</th>
                                            <th>Category Id</th>
                                            <th>Category</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $key => $category)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{ $category['id'] }}</td>
                                                <td>{{ $category['category_name'] }}</td>
                                                <td>
                                                    <a href="/edit_category/{{$category['id']}}" title="Edit category"><button class="btn btn-secondary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                                    <a href="/view_category/{{$category['id']}}" title="View category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> View</button></a>
                                                    <form method="POST" action="/delete_category/{{$category['id']}}" accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete category" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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