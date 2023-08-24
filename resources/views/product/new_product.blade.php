@extends('sidebar.sidebar')
@section('content')
{{ Breadcrumbs::render('new_product') }}
<div class = "card " >
  <div class="card-header">
    <h2>New Product</h2>
  </div>
  <div class="card-body">
    
    <form action="/new_product" method="POST" id="upload_form" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="validationTooltip01">Product</label>
          <input type="text" class="form-control" name="product_name" placeholder="Product Name">
          @error('product_name')
            <span style="color: red;"> {{$message}} </span>
          @enderror
        </div>
        <div class="mb-3">
          <label for="validationTooltip01">Description</label>
          <textarea id="editor" class="form-control" name="description" ></textarea>
          @error('description')
              <span style="color: red;"> {{$message}} </span>
          @enderror
        </div>
        <div class="mb-3">
          <label for="validationTextarea">Cost</label>
          <input type="text" class="form-control" name="cost" placeholder="Product Cost">
          @error('cost')
            <span style="color: red;"> {{$message}} </span>
          @enderror
        </div>
        <div class="mb-3">
          <label for="formFile" class="form-label">Image of the product</label>
          <input class="form-control" type="file" id="formFile" name="images[]" multiple>
          @error('images.*')
            <span style="color: red;"> {{$message}} </span>
          @enderror
        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
<script type="text/javascript" src="{{url('js/ckeditor.js')}}"></script>
@endsection
<script src="{{asset('assets/ckeditor5/build/ckeditor.js')}}" type="text/javascript"></script>
