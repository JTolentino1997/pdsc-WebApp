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
                                        @foreach($suppliers as $supplier)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $supplier->name}}</td>
                                            <td>{{ $supplier->address }}</td>
                                            <td>{{ $supplier->contactNumber}}</td>
                                            <td>{{ $supplier->contactPerson}}</td>
                                            <td>{{ $supplier->email}}</td>
                                            <td>{{ $supplier->designation}}</td>
                                            <td>
                                               <a href="#">view</a>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#updateSupplier"
                                                        data-supplier-id= "{{ $supplier->id}}"
                                                        data-supplier-name= "{{ $supplier->name}}"
                                                        data-supplier-address= "{{ $supplier->address}}" 
                                                        data-supplier-contactNumber= "{{ $supplier->contactNumber}}"
                                                        data-supplier-email= "{{ $supplier->email }}"
                                                        data-supplier-contactPerson= "{{ $supplier->contactPerson }}"
                                                        data-supplier-designation = "{{ $supplier->designation }}"
                                                        >Edit</button>
                                                <form action="{{ route('library.deleteSupplier', $supplier->id) }}" method="POST" class="d-inline" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="return confirm('are you sure you want to delete {{ $supplier->name}}?')">Delete</button>
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
                <x-form.input label="Supplier Name" name="name" type="text" id="name" />
                <div id="name-error" class="text-danger"></div>
                
                <x-form.input label="Address" name="address" type="text" id="address" />
                <div id="address-error" class="text-danger"></div>
                
                <x-form.input label="Contact No." name="contactNumber" type="text" id="contactNumber" />
                <div id="contactNumber-error" class="text-danger"></div>
                
                <x-form.input label="Contact Person" name="contactPerson" type="text" id="contactPerson" />
                <div id="contactPerson-error" class="text-danger"></div>
                
                <x-form.input label="Email" name="email" type="text" id="email" />
                <div id="email-error" class="text-danger"></div>
                
                <x-form.input label="Designation" name="designation" type="text" id="designation" />
                <div id="designation-error" class="text-danger"></div>
                
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
    document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector('form');
    const modalCreateSupplier = document.getElementById('modalCreateSupplier');

    form.addEventListener('submit', function (event) {
        event.preventDefault(); 
        const errors = validateForm();

        if (Object.keys(errors).length > 0) {
            displayErrors(errors);
        } else {
            form.submit();
        }
    });

    function validateForm() {
        const errors = {};
        
        const name = document.getElementById('name').value.trim();
        const address = document.getElementById('address').value.trim();
        const contactNumber = document.getElementById('contactNumber').value.trim();
        const contactPerson = document.getElementById('contactPerson').value.trim();
        const email = document.getElementById('email').value.trim();
        const designation = document.getElementById('designation').value.trim();

        if (!name) errors.name = "Supplier name is required.";
        else if (name.length > 255) errors.name = "Supplier name must not exceed 255 characters.";

        if (!address) errors.address = "address name is required.";
        else if (address.length > 255) errors.address = "Address must not exceed 255 characters.";

        const contactNumberRegex = /^\+?[0-9]{1,15}$/;
        if (contactNumber && !contactNumberRegex.test(contactNumber)) {
            errors.contactNumber = "Contact number must be valid.";
        }

        if (contactPerson.length > 255) errors.contactPerson = "Contact person must not exceed 255 characters.";

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!email) 
        {
            errors.email = "Email is required.";
        }
        else if (!emailRegex.test(email))
        {
            errors.email = "Email must be valid.";
        }

        if (designation.length > 255) errors.designation = "Designation must not exceed 255 characters.";

        return errors;
    }

    function displayErrors(errors) {
        document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');

        for (const field in errors) {
            const errorElement = document.getElementById(`${field}-error`);
            if (errorElement) errorElement.textContent = errors[field];
        }
    }
});
</script>
{{-- modal EndCreated --}}


{{-- modal Update --}}

<div class="modal fade" id="updateSupplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Supplier</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('library.updateSupplier')}}" method="POST" class="form-control">
               @csrf
               @method('PATCH') 
                <input type="hidden" name="id" id="id">
               
                <x-form.input label="Supplier Name" name="name" type="text" id="nameId" />
                <div id="name-updateError" class="text-danger"></div>

                <x-form.input label="Address" name="address" id="addressId" type="text"/>

                <x-form.input label="Contact number" name="contactNumber" id="contactNumId" type="text"/>
                <div id="contactNumber-updateError" class="text-danger"></div>

                <x-form.input label="Contact Person" name="contactPerson" id="contactPersonId" type="text"/>

                <x-form.input label="Email" name="email" id="emailId" type="text"/>

                <x-form.input label="Designation" name="designation" id="designationId"/>

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
document.addEventListener('DOMContentLoaded', function () {
    var updateSupp = document.getElementById('updateSupplier');

    updateSupp.addEventListener('show.bs.modal', function (event) {

        var button = event.relatedTarget;  

        var targetId = button.getAttribute('data-supplier-id');
        var targetName = button.getAttribute('data-supplier-name');
        var targetAddress = button.getAttribute('data-supplier-address');
        var targetContactNum = button.getAttribute('data-supplier-contactNumber');
        var targetEmail = button.getAttribute('data-supplier-email');
        var targetDesignation = button.getAttribute('data-supplier-designation');
        var targetContactPerson = button.getAttribute('data-supplier-contactPerson');

        updateSupp.querySelector('#id').value = targetId;
        updateSupp.querySelector('#nameId').value = targetName;
        updateSupp.querySelector('#addressId').value = targetAddress;
        updateSupp.querySelector('#contactNumId').value = targetContactNum;
        updateSupp.querySelector('#emailId').value = targetEmail;
        updateSupp.querySelector('#designationId').value = targetDesignation;
        updateSupp.querySelector('#contactPersonId').value = targetContactPerson;
    });

    const form = document.querySelector('#updateSupplier form');

    form.addEventListener('submit', function (event) {
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

    function validationForm() {
        const errors = {};

        const mobileRegex = /^(?:\+63|63|0)9\d{9}$/;
        const landlineRegex = /^(?:\+63|63|0)(2|[3-9]\d{1})\d{7}$/;

        const name = document.getElementById('nameId').value.trim();
        const contactNum = document.getElementById('contactNumId').value.trim();

        if (!name) 
        {
            errors.name = "Supplier name is required!";
        } 
        else if (name.length > 255) 
        {
            errors.name = "Supplier name must not exceed 255 characters";
        }

        if(!contactNum)
        {
            errors.contactNumber = "Contact number is required";
        }


        return errors;
    }

    function displayErrors(errors) {
        document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');

        for (const field in errors) {

            const errorElement = document.getElementById(`${field}-updateError`);
            
            if (errorElement) 
            {
                errorElement.textContent = errors[field];
            } 
            else 
            {
                console.warn(`No error element found for field: ${field}`);
            }
        }
    }

});
 
</script>

{{-- modal EndUpdate --}}