  <!-- ======= Hero Section ======= -->
  @php

 $banner=App\Models\Banner::orderBy('id','DESC')->first(); 
@endphp
  <section id="hero" class="d-flex align-items-center">
 
    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>
            @if($banner->title !=null)
             {{$banner->title}}
            @else
            @endif
          </h1>
          <h2>
            @if($banner->description !=null)
             {{$banner->description}}
            @else
            @endif
          </h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="{{asset($banner->image)}}" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->