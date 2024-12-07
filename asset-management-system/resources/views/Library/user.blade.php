
<x-layout.main>
    <x-slot:header>
        <p class="text-center">Company Name</p>
     </x-slot:header>
 <hr>

   <div class="container">
      <button class="btn btn-warning"
               data-bs-toggle="modal"
               data-bs-target="#createModal">New User
      </button>
      @if ($employees->isEmpty())
          <p class="text-secondary">No record found!</p>
      @else
         <table class="table">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Last Name</th>
                  <th>First Name</th>
                  <th>Middle Name</th>
                  <th>Email Add</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($employees as $index => $employee)
               <tr>
                  <td>{{ $loop->iteration}}</td>
                  <td>{{ $employee->lastName }}</td>
                  <td>{{ $employee->firstName }}</td>
                  <td>{{ $employee->middleName }}</td>
                  <td>{{ $employee->email }}</td>
                  <td>
                     <button class="btn btn-primary"
                           data-bs-toggle="modal" 
                           data-bs-target="#UpdateModal"
                           data-employee-id="{{ $employee->id }}"
                           data-employee-lName="{{ $employee->lastName }}"
                           data-employee-fName="{{ $employee->firstName }}"
                           data-employee-mName="{{ $employee->middleName }}"
                           data-employee-email="{{ $employee->email }}"
                     >Edit
                     </button>
                     <form action="{{ route('library.deleteUser', $employee->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('are you sure you want to delete this user?');">
                           Delete
                        </button>
                     </form>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      @endif
   </div>

   <hr>
     <x-slot:footer>
       <p class="text-center">Physician Diagnostic Clinic</p>
     </x-slot:footer>


     {{-- modal Create --}}
     <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Create new user</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
               <form action="{{ route('library.saveUser') }}" method="POST" class="form-control">
                  @csrf
           
                  <x-form.input label="Last Name" name="lastName" type="text"/>
                  
                  <x-form.input label="First Name" name="firstName" type="text"/>
         
                  <x-form.input label="Middle Name" name="middleName" type="text"/>
         
                  <x-form.input label="Email" name="email" type="email"/>
         
                  <br>
                  {{-- <x-form.button label="Submit" :data="$data"/> --}}
                  
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <x-form.button label="Save Changes"/>
                  </div>
               </form>
          </div>
        </div>
      </div>
    </div>

    {{-- Modal Update --}}
 
   <div class="modal fade" id="UpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Update </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="{{ route('library.updateUser') }}" method="POST">
               @csrf
               @method('patch')

               <input type="hidden" name="id" id="empId">

               <x-form.input label="Last Name" name="lastName" id="lastName" type="text"/>

               <x-form.input label="Middle Name" name="middleName" id="middleName" type="text"/>

               <x-form.input label="First Name" name="firstName" id="firstName" type="text"/>

               <x-form.input label="Email" name="email" id="email" type="text"/>

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
          var editModal = document.getElementById('UpdateModal');
          
          editModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
              
              // Extract data-* attributes from the button
              var empId = button.getAttribute('data-employee-id');
              var empLName = button.getAttribute('data-employee-lName');
              var empFName = button.getAttribute('data-employee-fName');
              var empMName = button.getAttribute('data-employee-mName');
              var empEmail = button.getAttribute('data-employee-email');
              
              // Populate the modal form fields with the data
              editModal.querySelector('#empId').value = empId;
              editModal.querySelector('#lastName').value = empLName;
              editModal.querySelector('#middleName').value = empFName;
              editModal.querySelector('#firstName').value = empMName;
              editModal.querySelector('#email').value = empEmail;
          });
      });
   </script>


</x-layout.main>


