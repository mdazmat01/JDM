@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($products as $product)
        <div class="col-xl-4 col-xxl-3">
            <div class="card overflow-hidden">
                <div class="card-header p-0">
                    <img src="{{asset($product->productImage->first()->image)}}" class="w-100" alt="Product Image">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <p class="mb-0">Price : <span>{{$product->price}}</span></p>
                    <p class="mb-0">Color : <span>{{$product->color}}</span></p>
                    @if ($product->stock > 0)
                    <p class="mb-0 text-success">In Stock : <span>{{$product->stock}}</span></p>
                    @else
                    <p class="mb-0 text-danger">Out of Stock</p>
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="" class="btn btn-sm btn-primary">Buy Now</a>
                    <div class="flex justify-content-end">
                        <form action="{{route('cart.store')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$product->id}}" name="productId">
                            <button type="submit" class="btn btn-ms btn-success"><i class="fa fa-cart-shopping"></i></button>
                        </form>
                        {{-- <button type="submit" class="btn btn-ms btn-danger"><i class="fa fa-heart"></i></button> --}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection
