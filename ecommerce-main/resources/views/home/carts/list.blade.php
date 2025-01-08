@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <form action="{{route('cart.update')}}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $rows => $cart)
                                        <tr>
                                            <td>{{ ++$rows }}</td>
                                            <td>{{ $cart->product->name }}</td>
                                            <td>{{ $cart->product->name }}</td>
                                            <td>
                                                <input class="w-50" name="items[{{ $cart->id }}][qty]" min="0" type="number" value="{{ $cart->qty }}">
                                                <input class="w-50" name="items[{{ $cart->id }}][price]" type="hidden" value="{{ $cart->product->price }}">
                                            </td>
                                            <td>{{ $cart->product->price }}</td>
                                            <td>{{ $cart->qty * $cart->product->price }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5"><b>Total Amount</b></td>
                                        <td><b>{{ $carts->sum('amount') }}</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-sm btn-warning">Update Cart</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
@endsection
