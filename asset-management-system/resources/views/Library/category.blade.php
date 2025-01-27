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
                            <h5 class="p-0" >Category</h5>
                            <button class="btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#createModal">Create new</button>
                        </div>
                        <div class="table-responsive" style="height: 500px; overflow-y: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      @foreach ($categories as $category)
                                      <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->desc }}</td>
                                        <td>
                                          <button class="btn btn-primary"
                                          data-bs-toggle="modal"
                                          data-bs-target="#updateCatModal"
                                          data-category-id="{{ $category->id }}"
                                          data-category-name="{{ $category->name }}"
                                          data-category-desc="{{ $category->desc }}"
                                          >Update</button>

                                            <form action="{{ route('library.deleteCategory', $category->id) }}" method="POST" class="d-inline" >
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" onclick="return confirm('are you sure you want to delete {{ $category->name}}?')">Delete</button>
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


 {{-- create modal --}}
 <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create Category</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <form action="{{ route('library.storeCategory')}}" method="POST" class="form-control">
                @csrf
                <div class="modal-body">
                    <x-form.input label="Name" name="name" id="name" type="text"/>
                    <x-form.input label="Desc" name="desc" id="desc" type="text"/>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <x-form.button label="Save Changes"/>
                </div>
            </form>
      </div>
    </div>
</div>
  {{-- end create modal --}}


  {{-- updateModal --}}
  <div class="modal fade" id="updateCatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Category</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('library.updateCategory')}}" method="POST" class="form-control">
            @csrf
            @method('patch')
            <div class="modal-body">
                <input type="hidden" name="id" id="id"/>
                
                <x-form.input label="Name" name="name" id="nameId" value="name" type="text"/>
                <div id="name-updateError" class="text-danger"></div>

                <x-form.input label="Desc" name="desc" id="descId" name="desc" type="text"/>
                <div id="desc-updateError" class="text-danger"></div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <x-form.button label="Save Changes"/>
              </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var updateCat = document.getElementById('updateCatModal');

        updateCat.addEventListener('show.bs.modal', function(event){
            var button = event.relatedTarget;

            var id = button.getAttribute('data-category-id');
            var name = button.getAttribute('data-category-name');
            var desc = button.getAttribute('data-category-desc');

            updateCat.querySelector('#id').value = id;
            updateCat.querySelector('#nameId').value = name;
            updateCat.querySelector('#descId').value = desc;

        });
    });


    const form = document.querySelector('#updateCatModal form');

    form.addEventListener('submit', function(event){
        event.preventDefault();

        const errors = validationForm();
        
        if (Object.keys(errors).length > 0) 
        {
            displayErrors(errors);
        }
        else 
        {
            console.log('Form is valid, submitting');
            form.submit();
        }
    });


    function validationForm()
    {
        const errors = {};

        const name = document.getElementById('nameId').value.trim();
        const desc = document.getElementById('descId').value.trim();

       if(!name)
       {
            errors.name = "Category name is required!";
       }
       else if(name.length > 255)
       {
        errors.name = "Category name must not exceed 255 character";
       }

       if(!desc)
       {
        errors.desc = "Category desc is required!";
       }
       else if(desc.length > 255)
       {
        errors.desc = "Category desc must not exceed 255 character";
       }  


       return errors;
    }

    function displayErrors(errors)
    {
        document.querySelectorAll('.text-danger').forEach(el => el.textContent = '') ;

        for(const field in errors)
        {
            const errorElement = document.getElementById(`${field}-updateError`);

            if(errorElement)
            {
                errorElement.textContent = errors[field];
            }
            else
            {
                console.warn(`No Error element found for field: ${field}`);
            }
        }
    }
  </script>
  {{-- end updateModal --}}

