@extends('layouts.master')

@section('content')
 <h4>Add Category</h4>
  <hr>
  <!-- <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Add Product</a> -->
  <div class="card">
    <div class="card-header">
      Form Category
    </div>
    <!-- form -->
    <div class="card-body">
      <form action="{{ route('category.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nama Category</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" >
          @error('name')
          <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Deskripsi</label>
          <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          @error('description')
          <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>
        <button type="submit" class="btn btn-success">Save Product</button>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
  </div>
@endsection