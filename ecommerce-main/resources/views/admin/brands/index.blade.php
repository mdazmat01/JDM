@extends('layouts.admin')
@section('content')

@include('components.admins.brands.list')
@include('components.admins.brands.add')
@include('components.admins.brands.update')
@include('components.admins.brands.delete')

@endsection
