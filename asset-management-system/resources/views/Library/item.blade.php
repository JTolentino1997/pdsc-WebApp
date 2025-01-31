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
                                          @foreach ($items as $item)
                                          <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $item->name}}</td>
                                            <td>{{ $item->uoms->name ?? 'N/A'}}</td>
                                            <td>{{ $item->categories->name ?? 'N/A'}}</td>
                                            <td>{{ $item->hasSerial ? 'Yes' : 'No'}}</td>
                                            <td>{{ $item->hasExpiry?  'Yes' : 'No'}}</td>
                                            <td>{{ $item->fixAsset ?  'Yes' : 'No'}}</td>
                                            <td>{{ $item->pms ?  'Yes' : 'No'}}</td>
                                            <td>{{ $item->calibration ?  'Yes' : 'No'}}</td>
                                            <td>{{ $item->desc }}</td>
                                            
                                            <td>
                                              <button class="btn btn-primary"
                                                      data-bs-toggle="modal"
                                                      data-bs-target="#updateItem"
                                                      data-item-id = "{{ $item->id }}"
                                                      data-item-name = "{{ $item->name }}"
                                                      data-item-uom = "{{ $item->uom_id	 }}"
                                                      data-item-hasSerial="{{$item->hasSerial}}">
                                                Update</button>

                                                <form action="{{ route('library.deleteItem', $item->id) }}" method="POST" class="d-inline" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="return confirm('are you sure you want to delete {{ $item->name}}?')">Delete</button>
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

          <x-form.input label="Name" name="name" id="name" type="text" />
         
          <div class="form-group my-2">
              <label for="category">Category:</label>
              <select class="form-control" name="category_id" id="category">
                  @foreach($categories as $category)
                      <option value="{{ $category->id }}"> {{ $category->name}} </option> 
                  @endforeach
              </select>
          </div>

          <x-form.input label="Code" name="code"  id="code" type="text"/>

          <div class="form-group my-2">
            <label for="UnitOfMeasures">Unit of Measures</label>
            <select class="form-control" name="uom_id" id="unitOfMeasures">
              @foreach ($Uoms as $Uom)
                <option value="{{ $Uom->id }}">{{ $Uom->name }}</option>
              @endforeach
            </select>
          </div>
          {{-- <x-form.input label="Unit of Measures" name="uom_id" type="number" id="uom_id"/> --}}

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
            <x-form.button label="Save Changes"/>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- end modal create --}}


 
{{-- modal update--}}
<div class="modal fade" id="updateItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Update </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          @csrf
          @method('PATCH')
          <input type="hidden" name="id" id='id'>

          <x-form.input label="Name" name="name" id="nameId" type="text" />
          
          <div class="form-group my-2">
            <label for="UomId">Unit of Measures</label>
            <select class="form-control" name="Oum" id="uomId">
                @foreach($Uoms as $Uom)
                    <option value="{{ $Uom->id }}">{{ $Uom->name }}</option>
                @endforeach
            </select>
          </div>

          <div class="container d-flex justify-content-center align-items-center">
            <div class="row">
                <div class="m-3">
                    <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="hasSerial" value="1" id="hasSerialId"> Has Serial No.
                        </label>
                    </div>
 
                </div>
            </div>
        </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var updateItem = document.getElementById('updateItem');

    updateItem.addEventListener('show.bs.modal', function (event) {

      var button = event.relatedTarget;

      var targetId = button.getAttribute('data-item-id');
      var targetName = button.getAttribute('data-item-name');
      var targetUOm = button.getAttribute('data-item-uom');
      var targetHasSerial = button.getAttribute('data-item-hasSerial');

      targetHasSerial = targetHasSerial === "1"; // Convert "1" to true, otherwise false
    
      console.log("Target Has Serial:", targetHasSerial);
      console.log("Target Has Expiry:", targetHasExpiryId);

      updateItem.querySelector('#id').value = targetId;
      updateItem.querySelector('#nameId').value = targetId;
      updateItem.querySelector('#uomId').value = targetUOm;
      updateItem.querySelector('#hasSerialId').value = targetHasSerial;

      // updateItem.querySelector('#pmsId').checked = targetPms;
    });
  });
</script>
{{-- end modal update--}}