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
      <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nama Product</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" >
          @error('name')
          <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
           <label for="name" class="form-label">Category</label>
          <select class="form-control js-example-basic-single" name="category_id">
            <option selected>Select Category</option>
            @foreach($data_category as $data_category)
            <option value="{{$data_category->id}}">{{ $data_category->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="stock" class="form-label">Stok</label>
          <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" >
          @error('stock')
          <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Harga</label>
          <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" >
          @error('price')
          <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Image</label>
          <input type="file" 
              name="image" 
              class="form-control dropify" 
              accept=".jpg,.png,.jpeg" 
              data-allowed-file-extensions="jpg png jpeg" />          
          @error('image')
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
        <a href="{{ route('product') }}" class="btn btn-secondary">Cancel</a>
      </form>
  </div>
   
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2({
        theme: 'classic', // opsional: untuk tampilan lebih rapi
        placeholder: "Pilih data...",
        allowClear: true
    });
    $('.dropify').dropify();
});


</script>