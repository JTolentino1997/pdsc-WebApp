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
                                <h5 class="p-0" >Items</h5>
                                <button class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalCreateItem">Create new</button>
                            </div>
                            <div class="table-responsive" style="height: 500px; overflow-y: auto;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>UOM</th>
                                            <th>Category</th>
                                            <th>Has Serial</th>
                                            <th>Has Expiry</th>
                                            <th>For Fix Asset</th>
                                            <th>For PMS</th>
                                            <th>For Calibration</th>
                                            <th>Desc</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                               <a href="#">view</a>
                                            </td>
                                            <td>
                                              <button></button>
                                                <form action="" method="POST" class="d-inline" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
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

<div class="modal fade" id="modalCreateItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">New Asset</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('library.createItem') }}" method="POST" class="form-control">
            @csrf
            <x-form.input label="Name" name="assetName" id="assetName" type="text" />
           
            {{-- <div class="form-group my-2">
                <label for="category">Category: </label>
                <select class="form-control" id="category">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" name="code"> {{ $category->name}} </option> 
                    @endforeach
                </select>
            </div> --}}

            <x-form.input label="Code" name="code"  id="code" type="text"/>

            <x-form.input label="uom_id" name="uom_id" type="number" id="uom_id" />

           <div class="container d-flex justify-content-center align-items-center">
                <div class="row">
                    <div class="m-3">
                        <div class="form-check-inline">
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="hasSerial" value="1" unchecked>Has Serial No.
                            </label>
                        </div>
                          <div class="form-check-inline">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="hasExpiry" value="1" unchecked>Has Expiry No.
                            </label>
                          </div>
                    </div>
        
                    <div class="m-3">
                        <div class="form-check-inline">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="fixAsset" value="1" unchecked >Fix Asset
                            </label>
                          </div>
                          <div class="form-check-inline">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="pms" value="1" unchecked >PMS
                            </label>
                          </div>
                          <div class="form-check-inline">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="calibration" value="1" unchecked >Calibration
                            </label>
                          </div>
                    </div>
                </div>
            </div>
            
            <x-form.input label="Description" name="desc" type="text" id="desc" />
            
            <br>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <x-form.button label="save Changes"/>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>