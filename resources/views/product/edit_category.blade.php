@extends('sidebar.sidebar')
@section('content')
<div class = "card " >
  <div class="card-header">
    <h2>Edit Category</h2>
  </div>
  <div class="card-body">
  </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="/edit_category/{{$category->id}}" method="POST">
                    @csrf
                    @method('PUT')  
                        <div class="mb-3">
                        <label for="validationTooltip01">Category</label>
                        <textarea class="form-control" name="category_name" >{{$category->category_name}}</textarea>
                            @error('category_name')
                                <span style="color: red;"> {{$message}} </span>
                            @enderror
                        </div>
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
                    <input type="submit" value="Update">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection