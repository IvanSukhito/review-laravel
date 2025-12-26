@extends('layouts.master')

@section('content')
       <div class="card mb-3">
        <!-- <img src="..." class="card-img-top" alt="..."> -->
        <div class="card-body">
          <h5 class="card-title">Hello, {{ $name }}</h5>
          <p class="card-text">{{ $address }}</p>
          <p class="card-text"><small class="text-muted">Your age is {{ $age }}</small></p>
        </div>
       </div>
@endsection
