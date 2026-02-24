@extends('admin._layout._layout')
@section('content')
    <div class="container-fluid pl-4 pt-3">
        <h1>Welcome back {{auth()->user()->name}}</h1>
    </div>
@endsection
