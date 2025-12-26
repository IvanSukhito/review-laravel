@extends('layouts.master')

@section('content')
  <h4>Tambah Product</h4>
  <hr>
  <!-- <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Add Product</a> -->
  <div class="card">
    <div class="card-header">
      Product List
    </div>
    <!-- form -->
    <div class="card-body">
      <form>
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nama Product</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ $detail_product->name }}" readonly>
          @error('name')
          <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="stock" class="form-label">Stok</label>
          <input type="number" class="form-control" id="stock" name="stock" value="{{ $detail_product->stock }}" readonly>
          @error('stock')
          <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Harga</label>
          <input type="number" class="form-control" id="price" name="price" value="{{ $detail_product->price }}" readonly>
          @error('price')
          <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Deskripsi</label>
          <textarea class="form-control" id="description" name="description" rows="3" readonly>{{ $detail_product->description }}</textarea>
          @error('description')
          <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>
        <a href="{{ route('product') }}" class="btn btn-secondary">Back</a>
      </form>
  </div>
   
@endsection