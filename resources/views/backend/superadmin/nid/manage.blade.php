@extends('backend.superadmin.layouts.master')
@section('title')
Nid Manage
@endsection
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nid Data </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('superadmin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Nid</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Total Nid : {{\App\Models\Nid::count()}} </h3>
                <div class="pull-right" style="text-align:right;">
                    <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#branch-info">
                    Add Nid
                    </button>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Photo</th>
                    <th>Nid</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>Mother Name</th>
                    <th>Date</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Permanent Address</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($nids as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><img style=" height:50px; width:50px; border-radius: 25px;" src="{{asset($item->image)}}"></td>
                        <td>{{$item->nid_number}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->father_name}}</td>
                        <td>{{$item->mother_name}}</td>
                        <td>{{$item->date_of_birth}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->gender}}</td>
                        <td>{{$item->permanent_address}}</td>
                        <td>
                            <a type="button" data-toggle="modal" data-target="#edit_{{$item->id}}"
                             class="btn-sm btn-info">Edit</a>
                           
                            <form class="float-left px-2" action="{{ route('nid.destroy',$item->id) }}" method="POST">
                                @csrf 
                                @method('delete')
                                <a type="button" data-type="confirm" class="dltBtn btn-sm btn-danger js-sweetalert" title="Delete">Delete</a>

                            </form>
                            
                        </td>
                    </tr>
                        <!-- District Edit model start --> 
                        <div class="modal fade" id="edit_{{$item->id}}">
                                <div class="modal-dialog">
                                <div class="modal-content bg-info">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Update Nid </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form class="add-contact-form" method="post" action="{{ route('nid.update',$item->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')
                                        <!-- <input type="hidden" name="id" value="{{$item->id}}" > -->
                                        <div class="modal-body">
                                            <!-- <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Enter nid number" value="{{$item->nid_number}}" name="nid_number"  />
                                            </div> -->
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Enter name" value="{{$item->name}}" name="name"  />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Enter father name" value="{{$item->father_name}}" name="father_name"  />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Enter mother name" value="{{$item->mother_name}}" name="mother_name"  />
                                            </div>
                                            <!-- <div class="form-group">
                                                <input type="date" class="form-control" value="{{ ( Date("d-m-Y",strtotime($item->date_of_birth))) }}" name="date_of_birth"  />
                                            </div> -->
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Enter phone" value="{{$item->phone}}" name="phone"  />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Enter permanent address" value="{{$item->permanent_address}}" name="permanent_address" />
                                            </div>
                                           
                                            <div class="form-group">
                                                <label>Upload Image</label>
                                                <input type="file" class="form-control rounded" name="image" onchange="readURLImage(this);" >
                                                </br>
                                                @if($item->image !=null)
                                                <img style=" height:150px; width:150px; border-radius: 25px;" src="{{asset($item->image)}}" id="image">
                                                @else
                                                <img style=" height:150px; width:150px; border-radius: 25px;" src="{{asset('1.jpg')}}" id="image">
                                                @endif
                                            </div>
                                            <div class="form-group">
                                               <select name="gender" class="form-control">
                                                <option disabled selected >Select Gender</option>
                                                <option value="male" {{ $item->gender == "male" ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ $item->gender == "female" ? 'selected' : '' }}>Female</option>
                                               </select>
                                            </div>
                                           
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-outline-light">Update Nid</button>
                                        </div>
                                    </form>  
                                </div>
                                <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <!-- branch Edit model end -->   
                  @endforeach   
                  </tbody>
                
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- District add model start --> 
  <div class="modal fade" id="branch-info">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title">Create Nid </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="add-contact-form" method="post" action="{{ route('nid.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                  <div class="form-group">
                      <input type="number" class="form-control" placeholder="Enter nid number"  name="nid_number" value="{{old('nid_number')}}" />
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" placeholder="Enter name"  name="name" value="{{old('name')}}" />
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" placeholder="Enter father name"  name="father_name" value="{{old('father_name')}}" />
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" placeholder="Enter mother name"  name="mother_name" value="{{old('mother_name')}}" />
                  </div>
                  <div class="form-group">
                      <input type="date" class="form-control"  name="date_of_birth" value="{{old('date_of_birth')}}" />
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" placeholder="Enter phone"  name="phone" value="{{old('phone')}}" />
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" placeholder="Enter permanent address"  name="permanent_address" value="{{old('permanent_address')}}" />
                  </div>
                  <div class="form-group">
                      <label>Upload Image</label>
                        <input type="file" class="form-control rounded" name="image" onchange="readURLImageAdd(this);">
                      </br>
                      <img style="height:150px; width:150px; border-radius: 25px;" src="{{asset('1.jpg')}}" id="image1">
                  </div>
                  <div class="form-group">
                      <select name="gender" class="form-control">
                      <option disabled selected >Select Gender</option>
                      <option value="male" {{old("male") == 1 ? "selected" : "" }}>Male</option>
                      <option value="female" {{old("female") == 0 ? "selected" : "" }}>Female</option>
                      </select>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-light">Save Nid</button>
                </div>
            </form>  
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- branch add model end --> 



@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
	function readURLImage(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#image')
                  .attr('src', e.target.result)
                  .width(150)
                  .height(150);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }


   function readURLImageAdd(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#image1')
                  .attr('src', e.target.result)
                  .width(150)
                  .height(150);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $('.dltBtn').click(function(e){
       
        var form = $(this).closest('form');
        var dataId = $(this).data('id');
        e.preventDefault();
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
        }
        })
        
        

    });

</script>




@endsection