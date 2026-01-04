@extends('layouts.master')

@section('content')
  <h4>Daftar Product</h4>
  <hr>
  <div class="alert alert-primary" role="alert">
    <p><b>Toko : </b>{{ $data_toko['name'] }}</p>
    <p><b>Alamat : </b>{{ $data_toko['address'] }}</p>
    <p><b>Tipe : </b>{{ $data_toko['tipe'] }}</p>
  </div>
  <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Add Product</a>

  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Congrats!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      Product List
      <form action="" class="input-group" style="width: 350px;">
        <input type="text" class="form-control" placeholder="Search..." name="keyword" value="{{ old('keyword', request()->get('keyword')) }}">
        <button class="btn btn-primary" type="submit">Search</button>
        <a href="{{ route('product') }}" class="btn btn-secondary" type="submit">reset</a>
      </form>
    </div>
     <table class="table table-striped">
      <thead>
         <tr>
           <th scope="col">ID</th>
           <th scop="col">Code Product</th>
           <th scope="col">Nama</th>
           <th scop="col">Stok</th>
           <th scope="col">Harga</th>
           <th scope="col">Kategori</th>
           <th scope="col">Aksi</th>
           
         </tr>
       </thead>
       <tbody>
        @forelse($data_product as $product)
         <tr>
           <th scope="row">{{ $product->id }}</th>
           <td>{{ $product->code_product }}</td>
           <td>{{ $product->name }}</td>
           <td>{{ $product->stock }}</td>
           <td>{{ $product->price }}</td>
           <!-- <td>{{ $product->category_name ?? 'Tidak ada' }}</td> -->
          <td>{{ $product->category->name ?? ' Tidak ada '}}</td>
           <td>
            
            <a href="{{ route('product.show', $product->code_product) }}" class="btn btn-info btn-sm">Show</a>
            <a href="{{ route('product.edit', $product->code_product) }}" class="btn btn-warning btn-sm">Edit</a>
            <!-- <a href="{{ route('product.destroy', $product->id) }}" class="btn btn-danger btn-sm">Delete</a>  -->
            <!-- Button trigger modal -->
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-{{ $product->code_product }}">
            Delete
          </button>
          </tr>
        @empty
         <tr>
           <td colspan="6" class="text-center">No Products Found.</td>
         </tr>        
        @endforelse
       </tbody>
    </table>
  </div>
   
    <!-- Modal -->
    @foreach($data_product as $product)
          <div class="modal fade" id="delete-{{ $product->code_product }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <form class="modal-content" method="POST" action="{{ route('product.destroy', $product->code_product) }}">
                @method('DELETE')
                @csrf  
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Delete Data</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <b>{{ $product->name }}</b> Akan Dihapus, Apakah Anda Yakin?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-danger">Delete</button>
                </div>
              </form>
            </div>
          </div>
    @endforeach
@endsection