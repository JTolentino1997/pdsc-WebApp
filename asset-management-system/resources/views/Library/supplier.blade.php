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
                            <div class="d-flex justify-content-between pb-2">
                                <h5 class="p-0" >Supplier</h5>
                                <button class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalCreateSupplier">Create new</button>
                            </div>
                            <div class="table-responsive" style="height: 500px; overflow-y: auto;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Contact Person</th>
                                            <th>Contact Number</th>
                                            <th>Email</th>
                                            <th>Designation</th>
                                            <th>Item</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
@endsection

{{-- modal Create --}}
<div class="modal fade" id="modalCreateSupplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create Supplier</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('library.createSupplier') }}" method="POST" class="form-control">
                @csrf
                <x-form.input label="Supplier Name" name="name" type="text"/>
                <x-form.input label="Address" name="address" type="text"/>
                <x-form.input label="Contact No." name="contactNumber" type="number"/>
                <x-form.input label="Contact Person" name="contactPerson" type="text"/>
                <x-form.input label="Email" name="email" type="text"/>
                <x-form.input label="Designation" name="designation" type="text"/>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <x-form.button label="Save Changes"/>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>