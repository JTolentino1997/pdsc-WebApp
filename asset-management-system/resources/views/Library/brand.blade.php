@extends('layouts.main')

@section('content')
    <div class="wrapper">
        @include('layouts.sidebar')

        <div class="main">
            @include('layouts.header')
            
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <div class="container">
                            <div class="row">
                                <div class="d-flex justify-content-between pb-2">
                                    <h3 class="fw-bold p-0">Brands</h3>  
                                    <button class="btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#newBrandsModal">
                                        Create
                                    </button>
                                </div>
                                <div class="table-responsive" style="height: 500px; overflow-y: auto;">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($brands as $brand)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $brand->brand}}</td>
                                                <td>
                                                    <button class="btn btn-primary"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#updateBrandModal"
                                                            data-brand-brand="{{ $brand->brand }}"
                                                            data-brand-id="{{ $brand->id}}">Edit</button>
                                                    <form action="{{ route('library.deleteBrand', $brand->id)}}" method="post" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" onclick="return confirm('are you sure you want to delete {{ $brand->brand}}')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layouts.footer')
        </div>
    </div>

    {{-- modal create start --}}
    <div class="modal fade" id="newBrandsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('library.createBrand')}}" method="POST" class="form-control">
                    @csrf
                    <x-form.input label="Brand Name" name="brandName" type="text"/>
 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <x-form.button label="Save Changes"/>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
    {{-- modal create end --}}


      
      {{-- modal Update start --}}

      <div class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Update Brand</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('library.updateBrand') }}" method="POST" class="form-control">
                    @csrf
                    @method('patch')

                    <input type="hidden" name="id" id="Id">
                    <x-form.input label="Brand Name" name="brandName" id="brand" type="text"/>
                     
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <x-form.button label="Save Changes"/>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function (){
            var editBrand = document.getElementById('updateBrandModal');

            editBrand.addEventListener('show.bs.modal', function (event){
                var button = event.relatedTarget;

                var eBrand = button.getAttribute('data-brand-brand');
                var eId = button.getAttribute('data-brand-Id');

                editBrand.querySelector('#brand').value = eBrand;
                editBrand.querySelector('#Id').value = eId;

            });
        });
      </script>
    
     {{-- modal Update end --}}
@endsection

