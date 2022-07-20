@extends('frontend.layouts.master')
@section('title')
Profile Page
@endsection
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Problems</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Home</a></li>
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
                        <a href="{{ route('user.problem.delete',$item->id) }}" data-type="confirm" class="dltBtn btn-sm btn-danger js-sweetalert" title="Delete">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </a>
                        
                            
                        </td>
                    </tr>
                       
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