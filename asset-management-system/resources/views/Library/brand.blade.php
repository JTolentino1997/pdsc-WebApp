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
                                <h3 class="fw-bold p-0">Brands</h3>  
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#newBrandsModal">
                                        Create
                                    </button>
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>Name</th> 
                                            <th>Action</th> 

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td>sample 1</td>
                                        <td>sample 2</td>
                                        <td>sample 3</td>
                                        <td>
                                            <button class="btn btn-primary">Edit
                                            </button>

                                            <button class="btn btn-danger">Delete</button>
                                        </td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layouts.footer')
        </div>
    </div>

    {{-- modal create --}}
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
@endsection