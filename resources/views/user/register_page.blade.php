@extends('layout.layout_1')
    @section('title','Login')
    @section('content')
    <div class = "container">
        <form action="/register" method="POST" class = "ms-auto me-auto" style="width: 500px"> {{-- ms-auto me-auto for aligning the form to center --}}
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">User Name</label>
                <input type="text" class="form-control" name="name" >
                @error('name')
                    <span style="color: red;"> {{$message}} </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email Address</label>
                <input type="text" class="form-control" name="email" aria-describedby="emailHelp">
                @error('email')
                    <span style="color: red;"> {{$message}} </span>
                @enderror
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
                @error('password')
                    <span style="color: red;"> {{$message}} </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> 
    @endsection