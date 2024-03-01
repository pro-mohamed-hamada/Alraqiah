@extends('layouts.errors.master')
@section('title', 'Error 403')

@section('css')
@endsection

@section('style')
@endsection


@section('content')
<div class="col-md-12">
  <div class="mb-3">
    <div class="text-center col-lg-12">
      <div>
        <img width="300" src="{{asset('images/sad.png')}}" alt="">
        <h1 class="headline font-success">404</h1>
        <p class="lead">The page you are attempting to reach is currently not available. This may be because the page does not exist or has been moved.</p>
        <a class="btn btn-success" href="{{route('home')}}">BACK TO HOME PAGE</a>
      </div>
  </div>
</div>
</div>
@endsection

