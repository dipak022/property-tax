@extends('backend.superadmin.layouts.master')
@section('title')
Seting Update
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Setting Update</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Setting update</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update Setting</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
            <form class="add-contact-form" method="post" action="{{ route('setting.update',$seting->id) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label for="inputName">Website Name</label>
                    <input type="text" id="inputName" class="form-control" name="website_name" value="{{$seting->website_name}}">
                </div>
                <div class="form-group">
                    <label for="inputDescription">Website Short Description</label>
                    <textarea id="inputDescription" class="form-control" rows="4" name="short_desc">{{$seting->short_desc}}</textarea>
                </div>
                <div class="form-group">
                    <label for="inputName">Website Address</label>
                    <input type="text" id="inputName" class="form-control" name="address" value="{{$seting->address}}">
                </div>
                <div class="form-group">
                    <label for="inputName">Website Email</label>
                    <input type="email" id="inputName" class="form-control" name="email" value="{{$seting->email}}">
                </div>
                <div class="form-group">
                    <label for="inputName">Website Number</label>
                    <input type="number" id="inputName" class="form-control" name="phone" value="{{$seting->phone}}">
                </div>
                <div class="form-group">
                    <label for="inputName">Website Footer</label>
                    <input type="text" id="inputName" class="form-control" name="footer" value="{{$seting->footer}}">
                </div>
                <div class="form-group">
                    <label for="inputName">Website facebook url</label>
                    <input type="text" id="inputName" class="form-control" name="facebook_url" value="{{$seting->facebook_url}}">
                </div>
                <div class="form-group">
                    <label for="inputName">Website twitter url</label>
                    <input type="text" id="inputName" class="form-control" name="twitter_url" value="{{$seting->twitter_url}}">
                </div>
                <div class="form-group">
                    <label for="inputName">Website linkedin url</label>
                    <input type="text" id="inputName" class="form-control" name="linkedin_url" value="{{$seting->linkedin_url}}">
                </div>
                <div class="form-group">
                    <label for="inputName">Website skype link</label>
                    <input type="text" id="inputName" class="form-control" name="skype_link" value="{{$seting->skype_link}}">
                </div>
                <div class="form-group">
                    <label for="inputName">Website instagram link</label>
                    <input type="text" id="inputName" class="form-control" name="instagram_link" value="{{$seting->instagram_link}}">
                </div>
                <input type="submit" value="Update Setting" class="btn btn-success float-right">
                </div>
            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
      </div>
    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

                       

@endsection

