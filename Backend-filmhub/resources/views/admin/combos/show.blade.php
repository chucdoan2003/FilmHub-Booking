@extends('admin.layouts.master')
@section('content')
    <h1>Show Combo</h1>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif


    <h1>{{ $combo->name }}</h1>
    <p>Price: {{ $combo->price }}</p>
    <p>Description: {{ $combo->description }}</p>
    <a href="{{ route('admin.combos.index') }}">Back</a>
@endsection
