@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('fail'))
                    <div class="alert alert-warning">
                        {{ session('fail') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <form action="{{ url('/product-image-store/' . $product->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group mb-3">
                                <label for="">Product Image Upload</label>
                                <input type="file" multiple name="productImage[]" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Save Change</button>
                            <a href="{{route('product.index')}}" class="btn btn-sm btn-success">Go to product list</a>
                        </form>
                    </div>
                    <div class="card-footer d-flex">
                        @foreach ($productImages as $item)
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($item->image) }}" class="bordered border-2" alt="Product Image"
                                    style="width:100px">
                                <form action="{{ url('/product-image-delete/' . $item->id) }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-sm btn-light"><i
                                            class="fa fa-trash text-danger"></i></button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
