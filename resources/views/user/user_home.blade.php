@extends('layout.layout_user')
@section('content')

    <div class="form-group">
      <form action="/user_product_search" method="GET">
          <input type="text" name="product_name" class="form-control col-md-4 float-left" placeholder="Search product" />
          <button type="submit" class="btn btn-info"> Search</button>
      </form>
    </div>

    <!-- Sliders -->
    <div id="carouselExampleCaptions" class="carousel slide">
      <div class="carousel-indicators">
        @foreach ($products as $index => $product)
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$index}}" class="ducanh {{$index == 0?'active':''}}" aria-current="true" aria-label="Slide {{$index+1}}"></button>
        @endforeach
      </div>

      <div class="carousel-inner">
        @foreach ($products as $index => $product)
            <div class="carousel-item {{$index == 0?'active':''}}" align = "center">
              <img class="slider-img"  src="{{URL::to($product->images[0]->path)}}" style="width:40%" alt="Responsive image">
              <div class="carousel-caption d-none d-md-block">
                <h5>{{$product->product_name}}</h5>
                <p> {!! $product->description !!} </p>
              </div>
            </div>
        @endforeach
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
      </button>
    </div>
    
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($products as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{URL::to($product->images[0]->path)}}" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{$product->product_name}}</h5>
                                    <!-- Product price-->
                                    {{$product->cost}}
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{url('/product_detail/'.$product->id)}}">View detail</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{ $products->links() }}


    
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    {{-- <script src="js/scripts.js"></script> --}}
    <script src="{{url('js/scripts.js')}}"></script>

<style>
  img.slider-img{
    height: 400px !important;
  }
  .carousel-control-prev-icon, .carousel-control-next-icon {
    height: 50px;
    width: 50px;
    outline: black;
    background-color: rgba(0, 0, 0, 0.3);
    background-size: 100%, 100%;
    border-radius: 50%;
    /* border: 1px solid black; */
  }
  .ducanh {
    background-color: red;
  }
  
</style>
@endsection

