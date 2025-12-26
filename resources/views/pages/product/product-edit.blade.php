@extends('layouts.master')

@section('content')
  <h4>Edit Product</h4>
  <hr>
  <!-- <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Add Product</a> -->
  <div class="card">
    <div class="card-header">
      Update Product
    </div>
    <!-- form -->
    <div class="card-body">
      <form action="{{ route('product.update', $detail_product->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nama Product</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ? old('name') : $detail_product->name }}" >
          @error('name')
          <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="stock" class="form-label">Stok</label>
          <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') ? old('stock') : $detail_product->stock }}" >
          @error('stock')
          <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Harga</label>
          <input type="number" class="form-control" id="price" name="price" value="{{ old('price') ? old('price') : $detail_product->price }}" >
          @error('price')
          <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Deskripsi</label>
          <textarea class="form-control" id="description" name="description" rows="3" >{{ old('description') ? old('description') : $detail_product->description }}</textarea>
          @error('description')
          <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('product') }}" class="btn btn-secondary">Back</a>
      </form>
  </div>
   
@endsection