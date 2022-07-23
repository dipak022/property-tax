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
  

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           
          <div class="container">
            <h2> Select Divition</h2>
            <form action="{{ route('porperty-tax.store') }}" method="post">
              @csrf
              <div class="form-group">

              <select id="divition" class="form-control" name="divition" >
                <option value="">Select Divition</option>
                @foreach($country as $list)
                  <option value="{{$list->id}}">{{$list->district_name}}</option>
                @endforeach
              </select>
              
              <br/>
              <select id="municipality" class="form-control" name="municipality" >
                <option value="">Select municipality</option>
              </select>
              <br/>
              <select id="ward" class="form-control" name="ward" >
                <option value="">Select Ward</option>
              </select>
              <br/>
              <select id="block" class="form-control" name="block" >
                <option value="">Select Ward</option>
              </select>

              <br/>
              <select id="subblock" class="form-control" name="subblock" >
                <option value="">Select Ward</option>
              </select>
 <button ttpe="submit">add</button>
              </div>
              </form>
          </div>
           
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
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

		<script>
		

      jQuery(document).ready(function(){
			jQuery('#divition').change(function(){
				let cid=jQuery(this).val();
				jQuery('#ward').html('<option value="">Select Ward</option>')
				jQuery.ajax({
					url:'/getMunicipality',
					type:'post',
					data:'cid='+cid+'&_token={{csrf_token()}}',
					success:function(result){
						jQuery('#municipality').html(result)
					}
				});
			});
			
      jQuery('#municipality').change(function(){
				let wid=jQuery(this).val();
				jQuery('#block').html('<option value="">Select Block</option>')
				jQuery.ajax({
					url:'/getWard',
					type:'post',
					data:'wid='+wid+'&_token={{csrf_token()}}',
					success:function(result){
						jQuery('#ward').html(result)
					}
				});
			});

      jQuery('#ward').change(function(){
				let bid=jQuery(this).val();
				jQuery('#subblock').html('<option value="">Select Sub-Block</option>')
				jQuery.ajax({
					url:'/getBlock',
					type:'post',
					data:'bid='+bid+'&_token={{csrf_token()}}',
					success:function(result){
						jQuery('#block').html(result)
					}
				});
			});

			jQuery('#block').change(function(){
				let sbid=jQuery(this).val();
				jQuery.ajax({
					url:'/getSubBlock',
					type:'post',
					data:'sbid='+sbid+'&_token={{csrf_token()}}',
					success:function(result){
						jQuery('#subblock').html(result)
					}
				});
			});
			
		});
			
		</script>
@endsection