@extends('layout.layout_user')
@section('content')
    <!-- Sliders -->
    <div class = "box_main">
        <div class = "box_left">
            <div id="carouselExampleCaptions" class="carousel slide">
                <div class="carousel-indicators">
                @foreach ($images as $index => $image)
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$index}}" class="ducanh {{$index == 0?'active':''}}" aria-current="true" aria-label="Slide {{$index+1}}"></button>
                @endforeach
                </div>
        
                <div class="carousel-inner">
                @foreach ($images as $index => $image)
                    <div class="carousel-item {{$index == 0?'active':''}}" align = "center">
                        <img class="slider-img"  src="{{URL::to($image->path)}}" style="width:40%" alt="Responsive image">
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
        </div>
        <div class = "box_right">
            <h3>{{$product->product_name}}</h3>
            <h5>{!! $product->description !!}</h5>
        </div>
    </div>
    

@endsection

<style>
    img.slider-img{
      height: 400px !important;
      width: 100px
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

    .box_left {
    width: calc(100% - 600px);
    float: left;
}

.box_right {
    width: 520px;
    float: right;
    margin-left: 30px;
}
    
  </style>