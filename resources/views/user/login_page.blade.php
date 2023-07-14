@extends('layout.layout_user')
@section('title','Login')
@section('content')
<div class = "container">
    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block" >
        <strong> {{$message}} </strong>
    </div>
    @endif
    <form action="/login" method="POST" class = "ms-auto me-auto" style="width: 500px"> {{-- ms-auto me-auto for aligning the form to center --}}
        @csrf
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" name="loginemail">
        @error('loginemail')
            <span style="color: red;"> {{$message}} </span>
        @enderror
        </div>
        <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="loginpassword">
        @error('loginpassword')
            <span style="color: red;"> {{$message}} </span>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div> 
@endsection