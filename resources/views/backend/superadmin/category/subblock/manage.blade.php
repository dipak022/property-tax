@extends('backend.superadmin.layouts.master')
@section('title')
Sub Block Manage
@endsection
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sub Block Data </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('superadmin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Sub Block</li>
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
                <h3 class="card-title">Total Sub Block : {{\App\Models\Subblock::count()}} </h3>
                <div class="pull-right" style="text-align:right;">
                    <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#branch-info">
                    Add Subblock
                    </button>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Block Name</th>
                    <th>Sub Block </th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($Subblock as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->block_name}}</td>
                        <td>{{$item->subblock_name}}</td>
                        
                        
                     
                      
                        <td>
                            <a type="button" data-toggle="modal" data-target="#edit_{{$item->id}}"
                             class="btn-sm btn-info">Edit</a>
                           
                            <form class="float-left px-2" action="{{ route('subblock.destroy',$item->id) }}" method="POST">
                                @csrf 
                                @method('delete')
                                <a type="button" data-type="confirm" class="dltBtn btn-sm btn-danger js-sweetalert" title="Delete">Delete</a>

                            </form>
                            
                        </td>
                    </tr>
                        <!-- Municipality Edit model start --> 
                        <div class="modal fade" id="edit_{{$item->id}}">
                                <div class="modal-dialog">
                                <div class="modal-content bg-info">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Update Sub Block </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form class="add-contact-form" method="post" action="{{ route('subblock.update',$item->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')
                                        <!-- <input type="hidden" name="id" value="{{$item->id}}" > -->
                                        @php 
                                        $blocks=\App\Models\Block::orderBy('id','DESC')->get(); 
                                        @endphp
                                        <div class="modal-body">
                                            <div class="form-group">
                                            <label>Block :</label>
                                                <select class=" form-control show-tick select2 @error('block_id') is-invalid @enderror" id="block_id" name="block_id">
                                                    @foreach($blocks as $block)
                                                        <option value="{{ $block->id }}" {{ $block->id == $item->block_id ? 'selected' : '' }}>{{ $block->block_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('block_id')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Subblock name :</label>
                                                <input type="text" class="form-control" placeholder="Enter subblock_name" value="{{$item->subblock_name}}" name="subblock_name" value="{{old('subblock_name')}}" />
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-outline-light">Update Subblock</button>
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
              <h4 class="modal-title">Create Subblock </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="add-contact-form" method="post" action="{{ route('subblock.store') }}" enctype="multipart/form-data">
                @csrf
                @php 
                $blocks=\App\Models\Block::orderBy('id','DESC')->get(); 
                @endphp
                <div class="modal-body">
                  <div class="form-group">
                      <label>Block :</label>
                        <select class=" form-control show-tick select2 @error('block_id') is-invalid @enderror" id="block_id" name="block_id">
                            @foreach($blocks as $block)
                                <option value="{{ $block->id }}" {{ old('block_id') == $block->id ? 'selected' : '' }}>{{ $block->block_name }}</option>
                            @endforeach
                      </select>
                      @error('block_id')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                  </div>
                    <div class="form-group">
                    <label>Subblock name :</label>
                        <input type="text" class="form-control" placeholder="Enter subblock_name" name="subblock_name" value="{{old('subblock_name')}}" />
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-light">Save Subblock</button>
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




@endsection