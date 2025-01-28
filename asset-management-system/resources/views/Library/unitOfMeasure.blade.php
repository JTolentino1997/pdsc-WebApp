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
                                <h5 class="p-0" >Unit of Measures</h5>
                                <button class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalCreateItem">Create new</button>
                            </div>
                            <div class="table-responsive" style="height: 500px; overflow-y: auto;">
                                @if ($Uoms->isEmpty())
                                    <p class="text-secondary">No record found!</p>
                                @else
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Desc</th>
                                                <th>Action</th>
                                            </tr> 
                                        </thead>
                                        <tbody>
                                        @foreach ($Uoms as $Uom)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $Uom->name }}</td>
                                                <td>{{ $Uom->desc }}</td>
                                                <td>
                                                    <button class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#updateModal"
                                                            data-Uom-id = "{{ $Uom->id }}"
                                                            data-Uom-name = "{{ $Uom->name }}"
                                                            data-Uom-desc = "{{ $Uom->desc }}"
                                                            >Edit</button>
                                                    <form action="{{ route('library.deleteUnitOfMeasure', $Uom->id)}}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" onclick="return confirm('are you sure you want to delete {{ $Uom->name}}')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layouts.footer')
        </div>
    </div>
@endsection
 


{{-- create Modal --}}
<div class="modal fade" id="modalCreateItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Unit Of Measures</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('library.storeUnitOfMeasure')}}" method="POST" class="form-control">
            <div class="modal-body">
                @csrf
                <x-form.input label="Name" name="name" id="name" type="text"/>

                <x-form.input label="Desc" name="desc" id="desc" type="text"/>

                <br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <x-form.button label="Save Changes"/>
                  </div>
            </div>
        </form>

      </div>
    </div>
  </div>
{{-- end create Modal --}}


{{-- update modal --}}
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('library.updateUnitOfMeasure')}}" method="POST" class="form-control">
            @csrf
            @method('PATCH')

            <input type="hidden" name="id" id="id">

            <x-form.input label="Name" name="name" id="nameId" type="text"/>
            <div id="name-updateError" class="text-danger"></div>

            <x-form.input label="Desc" name="desc" id="descId" type="text"/>
            <div id="desc-updateError" class="text-danger"></div>

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
    document.addEventListener('DOMContentLoaded', function() {
        var update = document.getElementById('updateModal');

        update.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            var targetId = button.getAttribute('data-Uom-id');
            var targetName = button.getAttribute('data-Uom-name');
            var targetDesc = button.getAttribute('data-Uom-desc');

            update.querySelector('#id').value = targetId;
            update.querySelector('#nameId').value = targetName;
            update.querySelector('#descId').value = targetDesc;

        });
    });


    const form = document.querySelector('#updateModal form');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const errors = validationForm();

        if(Object.keys(errors).length > 0){
            displayError(errors);
        }
        else
        {
            console.log('form is valid');
            form.submit();
        }
    });


    function validationForm()
    {
        const errors = {};

        const name = document.getElementById('nameId').value.trim();
        const desc = document.getElementById('descId').value.trim();

        if (!name) {
            errors.name = "measurement name is required";
        }
        else if(name.length > 255)
        {
            errors.name = "measurement name must not exceed 255 characters";
        }

        if(!desc) {
            errors.desc = "measurement desc is required";
        }
        else if (desc.length > 255) {
            errors.desc = "measurement desc must not exceed 255 characters";
        }

        return errors;
    }

    function displayError(errors)
    {
        document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');

        for(const field in errors){
            
            const errorElement = document.getElementById(`${field}-updateError`)
            
            if(errorElement){
                errorElement.textContent = errors[field]
            }
            else
            {
                console.warn(`No error element found for field: ${field}`)
            }
        }
    }
  </script>
{{-- end update modal --}}