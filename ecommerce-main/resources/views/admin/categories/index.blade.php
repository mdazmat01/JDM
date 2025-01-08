@extends('layouts.admin')
@section('content')

@include('components.admins.categories.list')
@include('components.admins.categories.add')
@include('components.admins.categories.update')
@include('components.admins.categories.delete')

@endsection
