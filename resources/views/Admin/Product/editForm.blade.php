{{-- @include('admin.errors')
@include('admin.success') --}}

@extends('Admin.layouts.app')
@section('content')
<form method="POST" action="{{route('admin.products.update',$products->id)}}" enctype="multipart/form-data">
    @csrf
    @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger" style="color:red">{{$error}}</div>
            @endforeach
    @endif
    @method('PUT')
    <div class="form-group">
      <label for="exampleInputEmail1">product Name</label>
      <input type="text" name="name" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$products->name}}">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">product desc</label>
        <textarea type="text" name="desc" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" >{{$products->desc}}</textarea>
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">product Price</label>
        <input type="number" name="price" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$products->price}}">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">product quantity</label>
        <input type="text" name="quantity" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$products->quantity}}">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">old image</label>
        <img src="{{asset("storage/$products->image")}}" width="100" alt="" srcset="">
        <input type="file" name="image" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

