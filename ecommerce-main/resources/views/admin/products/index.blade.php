@extends('layouts.admin')
@section('content')

@include('components.admins.products.list')
@include('components.admins.products.add')
@include('components.admins.products.update')
@include('components.admins.products.delete')

@endsection
