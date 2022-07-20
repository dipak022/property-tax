@extends('backend.admin.layouts.master')
@section('title')
Problem Manage
@endsection
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Problem All Data </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('technician.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Problem</li>
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
                <h3 class="card-title">Total Problem Send : {{\App\Models\Problem::count()}} </h3>
                
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Problem Title</th>
                    <th>Room Number</th>
                    <th>Floor Number</th>
                    <th>Equipment Number</th>
                    <th>Status</th> 
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($problems as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->problem_title}}</td>
                        <td>{{$item->room_number}}</td>
                        <td>{{$item->floor_number}}</td>
                        <td>{{$item->equipment_number}}</td>
                        <td>
                          @if($item->status==1)
                            <span class="badge badge-success"> Request </span>
                           @elseif($item->status==2)
                           <span class="badge badge-success"> Send Tachnician </span>
                           @elseif($item->status==3)
                           <span class="badge badge-success"> Problen Solved </span>
                           @elseif($item->status==4)
                           <span class="badge badge-success"> Send Officer For Equipment </span>
                           @elseif($item->status==5)
                           <span class="badge badge-success"> Equipment Buying Done</span>
                           @endif
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#show_{{$item->id}}">
                              <i class="fas fa-folder">
                              </i>
                              View
                            </a>
                            @if($item->status == 4)
                            <a class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#edit_{{$item->id}}">
                              <i class="fas fa-user-alt">
                              </i>
                              Equipment Buying
                            </a>
                            
                            @else
                            <a class="btn btn-success btn-sm">
                              <i class="fas fa-user-alt">
                              </i>
                              Equipment Buying Done
                            </a>
                            @endif
                            
                            
                        </td>
                    </tr>
                        <!-- branch Edit model start --> 
                        <div class="modal fade" id="edit_{{$item->id}}">
                                <div class="modal-dialog">
                                <div class="modal-content bg-info">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Equipment  </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    @php 
                                    $technicians=DB::table('users')
                                      ->where('role',2)
                                      ->get();
                                    @endphp  
                                    <form class="add-contact-form" method="post" action="{{ route('equipment.update',$item->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <!-- <input type="hidden" name="id" value="{{$item->id}}" > -->
                                        <div class="modal-body">
                                        
                                        <div class="form-group">
                                            <label>Equipment Describe :</label>
                                            <textarea class="form-control" placeholder="Enter officer details" rows="5" name="equipment_details" >{{$item->equipment_details}}</textarea>
                                        </div>
                                                        
                                        

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-outline-light">Equipment</button>
                                        </div>
                                    </form>  
                                </div>
                                <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <!-- branch Edit model end -->   



                           <!-- branch Show model start --> 
                        <div class="modal fade" id="show_{{$item->id}}">
                            @php
                                $problem = \App\Models\Problem::where('id',$item->id)->first();
                            @endphp
                            <div class="modal-dialog">
                            <div class="modal-content bg-info">
                                <div class="modal-header">
                                <h4 class="modal-title">View Send Problem </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form class="add-contact-form" method="post" action="#" enctype="multipart/form-data">
                                   
                                    <!-- <input type="hidden" name="id" value="{{$item->id}}" > -->
                                    <div class="modal-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Problem Title :</strong>
                                            <p>{{$problem->problem_title}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Eduipment Description :</strong>
                                            <p>{{$problem->equipment_details}}</p>
                                        </div>
                                    </div>

                                  
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Room :</strong>
                                            <p>{{$problem->room_number}}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Floor :</strong>
                                            <p>{{$problem->floor_number}}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Equipment :</strong>
                                            <p>{{$problem->equipment_number}}</p>
                                        </div>
                                    </div>
                                   
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong>Status  :</strong>
                                            @if($problem->active==1)
                                            <p>
                                              <span class="right badge badge-success">Active</span>
                                            </p>
                                            @else
                                            <p>
                                              <span class="right badge badge-success">Inactive</span>
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                        
                    
                                    <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light pull-right" data-dismiss="modal">Close</button>
                                    </div>
                                </form>  
                          </div>
                          <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                      </div>
                      <!-- /.modal -->
                      <!-- Department Show  model end -->    
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





@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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