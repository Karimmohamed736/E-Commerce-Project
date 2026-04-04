{{-- @include('admin.errors')
@include('admin.success') --}}

@extends('User.layouts.app')
@section('content')

@if (session()->has('success'))
    <div class="alert alert-success">{{session('success')}}</div>
@endif
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Desc</th>
        <th scope="col">Aciton</th>
      </tr>
    </thead>
    <tbody>

        @foreach ($products as $product )
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td><a href="{{ route("user.products.show", "$product->id") }}">{{$product->name}}</a></td>
        <td>{{$product->price}} $</td>
        <td>{{$product->quantity}}</td>
        <td>{{$product->desc}}</td>
        <td><img src="{{asset("storage/$product->image")}}"  width="200px" alt="" srcset=""></td>
        <td>
            {{-- <form action="{{route('admin.products.delete',$product->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"> Delete </button>
            </form>
            <h1>
                <a class="btn btn-success" href="{{route('admin.products.editForm', $product->id)}}" >edit</a>
            </h1> --}}
        </td>
    </tr>
    @endforeach

    </tbody>
  </table>

@endsection

