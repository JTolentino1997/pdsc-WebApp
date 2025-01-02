@extends('layouts.main')

@section('content')
    <div class="wrapper">
        @include('layouts.sidebar')

        <div class="main">
            @include('layouts.header')

            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <div class="col-12">
                            <div class="container">
                                <div class="d-flex justify-content-between">
                                    <h5 class="p-0">Departments</h5>
                                    <button class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#createDeptModal">Create new</button>
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>Desc</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($departments as $department)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $department->code}}</td>
                                            <td>{{ $department->desc}}</td>
                                            <td>
                                                <button class="btn btn-primary">Edit</button>
                                                <form action="{{ route('library.deleteDepartment', $department->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete {{ $department->code }}?');">Delete</button>
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
            </main>
            @include('layouts.footer')
        </div>
    </div>
@endsection

{{-- modal create --}}
<div class="modal fade" id="createDeptModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('library.createDepartment') }}" method="post" class="form-control">
            @csrf
            <x-form.input label="Code" name="code" type="text"/>
            <x-form.input label="Name" name="desc" type="text"/>

            <br>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <x-form.button label="Save Changes"/>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>