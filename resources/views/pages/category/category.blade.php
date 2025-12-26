@extends('layouts.master')

@section('content')
    <div class="container">
        <h1 class="my-4">Categories</h1>
        <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">Add Category</a>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Congrats!</strong> {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row">
       
        <div class="card-header d-flex justify-content-end align-items-center">
            <form action="" class="input-group" style="width: 350px;">
            <input type="text" class="form-control" placeholder="Search..." name="keyword" value="{{ old('keyword', request()->get('keyword')) }}">
            <button class="btn btn-primary" type="submit">Search</button>
            <a href="{{ route('category.index') }}" class="btn btn-secondary" type="submit">reset</a>
          </form>
        </div>
        
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Name</th>
                      <th scope="col">Description</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($data_category as $category)
                    <tr>
                      <th scope="row">{{ $category->id }}</th>
                      <td>{{ $category->name }}</td>
                      <td>{{ $category->description }}</td>
                      <td>
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                          <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-{{ $category->id }}">
                            Delete
                          </button>
                      </td>
                    </tr>
                     @empty
                    <tr>
                      <td colspan="4" class="text-center">No categories found.</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>    
        </div>         
    </div>

     @foreach($data_category as $category)
          <div class="modal fade" id="delete-{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <form class="modal-content" method="POST" action="{{ route('category.destroy', $category->id) }}">
                @method('DELETE')
                @csrf  
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Delete Data</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <b>{{ $category->name }}</b> Akan Dihapus, Apakah Anda Yakin?
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