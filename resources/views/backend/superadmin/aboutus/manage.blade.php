@extends('backend.superadmin.layouts.master')
@section('title')
About Us Manage
@endsection
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>About Us All Data </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('superadmin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">About Us</li>
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
                <h3 class="card-title">Total About : {{\App\Models\About::count()}} </h3>
                <div class="pull-right" style="text-align:right;">
                    <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#branch-info">
                    Add About Us
                    </button>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>About Us Details</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($abouts as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->details}}</td>
                        <td>
                            <input type="checkbox" name="toogle" value="{{$item->id}}" data-toggle="switchbutton" {{$item->active == 1 ? 'checked' : ''}}  data-onlabel="Active" data-offlabel="Inactive" data-onstyle="success" data-size="sm" data-offstyle="danger">
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#show_{{$item->id}}">
                              <i class="fas fa-folder">
                              </i>
                              View
                            </a>

                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_{{$item->id}}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                            </a>
                            <form class="float-left px-2" action="{{ route('about_us.destroy',$item->id) }}" method="POST">
                                @csrf 
                                @method('delete')
                                <a type="button" data-type="confirm" class="dltBtn btn-sm btn-danger js-sweetalert" title="Delete">
                                  <i class="fas fa-trash">
                                  </i>
                                  Delete
                                </a>

                            </form>
                            
                        </td>
                    </tr>
                        <!-- branch Edit model start --> 
                        <div class="modal fade" id="edit_{{$item->id}}">
                                <div class="modal-dialog">
                                <div class="modal-content bg-info">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Update About Us </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form class="add-contact-form" method="post" action="{{ route('about_us.update',$item->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')
                                        <!-- <input type="hidden" name="id" value="{{$item->id}}" > -->
                                        <div class="modal-body">
                                            
                                        <div class="form-group">
                                            <label>About us description  :</label>
                                            <textarea class="form-control" placeholder="About us description" rows="5" name="details" >{{$item->details}}</textarea>
                                        </div>
                                                        
                                        <div class="form-group">
                                          <label>About us status :</label>
                                          <select class="form-control show-tick" name="active">
                                                <option selected disable>--Select Status--</option>
                                                <option value="1" {{$item->active == 1 ? "selected" : "" }}>Active</option>
                                                <option value="0" {{$item->active == 0 ? "selected" : "" }}>Inactive</option>
                                            </select>
                                        </div>

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-outline-light">Update About Us</button>
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
                                $about = \App\Models\About::where('id',$item->id)->first();
                            @endphp
                            <div class="modal-dialog">
                            <div class="modal-content bg-info">
                                <div class="modal-header">
                                <h4 class="modal-title">View About Us </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form class="add-contact-form" method="post" action="#" enctype="multipart/form-data">
                                   
                                    <!-- <input type="hidden" name="id" value="{{$item->id}}" > -->
                                    <div class="modal-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong>Description :</strong>
                                            <p>{{$about->details}}</p>
                                        </div>
                                    </div>
                                   
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong>Status  :</strong>
                                            @if($about->active==1)
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

<!-- branch add model start --> 
  <div class="modal fade" id="branch-info">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title">Create About Us </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="add-contact-form" method="post" action="{{ route('about_us.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    
                  
                    <div class="form-group">
                        <label>About us description  :</label>
                        <textarea class="form-control" placeholder="About us description" rows="5" name="details" >{{old('details')}}</textarea>
                    </div>
                  
                    <div class="form-group">
                      <label>About us status :</label>
                      <select class="form-control show-tick" name="active">
                      
                          <option selected disable>--Select Status--</option>
                          <option value="1" {{old("active") == 1 ? "selected" : "" }}>Active</option>
                          <option value="0" {{old("active") == 0 ? "selected" : "" }}>Inactive</option>
                      </select>
                    </div>
                    
                
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-light">Save About Us</button>
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

<script>
$('input[name=toogle]').change(function(){
   var mode = $(this).prop('checked');
   var id = $(this).val();
   //alert(id);
   $.ajax({
       url:"{{ route('about_us.status')}}",
       type:"POST",
       data:{
           _token:'{{csrf_token()}}',
           mode:mode,
           id:id,
       },
       success:function(response){
           console.log(response.status);

       }
   })
});
</script>


@endsection