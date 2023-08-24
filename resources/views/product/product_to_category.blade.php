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
                        <form action="/add_category" method="POST">
                            <div class="table-responsive">
                                @csrf
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Index</th>
                                            <th>Product Id</th>
                                            <th>Product</th>
                                            <th>Cost</th>                           
                                            <th>Check</th>                 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $key => $product)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{ $product['id'] }}</td>
                                                <td>{{ $product['product_name'] }}</td>
                                                <td>{{ $product['cost'] }}</td>
                                                <td><input type="checkbox" name="ids[{{$product->id}}]" value="{{$product->id}}"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                            <input type="submit" value="Add to Category">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection