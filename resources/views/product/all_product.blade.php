@extends('sidebar.sidebar')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block" >
            <strong> {{$message}} </strong>
        </div>
    @endif
<br>
    <div class="container">
        <div class="form-group">
            <form action="/product_search" method="GET">
                <input type="text" name="title" class="form-control col-md-4 float-left" placeholder="Search product" />
                <input type="text" name="body" class="form-control col-md-4 " placeholder="Search cost" />
                <button type="submit" class="btn btn-info"> Search</button>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>All Products</h2>
                    </div>
                    <div class="card-body">
                        <a href="/new_product" class="btn btn-info" title="Add New Product">
                            <i class="fa fa-plus" aria-hidden="true"></i> New Product
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Index</th>
                                        <th>Product id</th>
                                        <th>Product</th>
                                        <th>Cost</th>                           
                                        <th>Image</th>                         
                                        <th>Action</th>                         
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $key => $product)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{ $product['id']}}</td>
                                            <td>{{ $product['product_name'] }}</td>
                                            <td>{{ $product['cost'] }}</td>
                                            <td>
                                                @foreach($product->images as $image)
                                                    <img src="{{URL::to($image->path)}}"  style="height:100px; width:100px" alt="">
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="/edit_product/{{$product['id']}}" title="Edit product"><button class="btn btn-secondary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                                <a href="/view_product/{{$product['id']}}" title="View product"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> View</button></a>
                                                <form method="POST" action="/delete_product/{{$product['id']}}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete product" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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
    {{ $products->links() }}
@endsection