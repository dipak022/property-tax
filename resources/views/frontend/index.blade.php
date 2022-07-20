@extends('frontend.layouts.master')
@section('title')
Home Page
@endsection
@section('content')

@php
$about=App\Models\About::orderBy('id','DESC')->first(); 
$questions=App\Models\Questions::orderBy('id','DESC')->get(); 
$seting=App\Models\Seting::orderBy('id','DESC')->first();
@endphp
<script src="https://kit.fontawesome.com/6b4894d2af.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
 <!-- ======= About Us Section ======= -->
 <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About Us</h2>
        </div>

        <div class="row content">
          <div class="col-lg-12">
            <p>
             {{$about->details}}
            </p>
            <a href="#" class="btn-learn-more">Learn More</a>
          </div>
         
        </div>

      </div>
    </section><!-- End About Us Section -->



    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
            <img src="{{asset('frontend')}}/assets/img/skills.png" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
            <h3>Voluptatem dignissimos provident quasi corporis voluptates</h3>
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>

            <div class="skills-content">

              <div class="progress">
                <span class="skill">HTML <i class="val">100%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="progress">
                <span class="skill">CSS <i class="val">90%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="progress">
                <span class="skill">JavaScript <i class="val">75%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="progress">
                <span class="skill">Photoshop <i class="val">55%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

            </div>

          </div>
        </div>

      </div>
    </section><!-- End Skills Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>All Services</h2>
          <p>you have a good day,any problem send pro problem</p>
        </div>

        <div class="row">
          @php 
            $services = DB::table('services')->where('active',1)->get();
          @endphp
          @foreach($services as $service)
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box text-center">
              <div class="icon"><i class="fa-solid fa-laptop"></i></div>
              <h4><a href="#">{{$service->service_name}}</a></h4>
              <p>{{$service->description}}</p>
              <div class="text-center">
                <button type="button" class="btn-sm btn btn-outline-info  pull-right" data-toggle="modal" data-target="#add_{{$service->id}}-xl">
                  Send Problem
                </button>
          
              </div>
            </div>
          </div>

           
          @endforeach
        </div>

      </div>
    </section><!-- End Services Section -->



          
    @foreach($services as $service)
   <!-- branch add model start --> 
   <div class="modal fade" id="add_{{$service->id}}-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title">Send Problem Informatiom </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="add-contact-form" method="post" action="{{ route('user.problem.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="service_id" value="{{$service->id}}" ></input>
                <div class="modal-body">
                  <div class="row">
                    
                    <div class="col-md-4">
                      <div class="form-group">
                          <label> Name  :</label>
                          <input type="text" class="form-control" placeholder="Enter name" name="name" value="{{old('name')}}" required></input>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                            <label> Email  :</label>
                            <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{old('email')}}" required></input>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                            <label> Phone  :</label>
                            <input type="number" class="form-control" placeholder="Enter phone" name="phone" value="{{old('phone')}}" required></input>
                      </div>
                    </div>
                  </div>
                    
                    <div class="form-group">
                        <label> Problem Title  :</label>
                        <input type="text" class="form-control" placeholder="Enter problem title" name="problem_title" value="{{old('problem_title')}}" required></input>
                    </div>
                    <div class="form-group">
                        <label> Problem Description  :</label>
                        <textarea type="text" class="form-control" placeholder="Enter problem details" rows="5" name="problem_details" required>{{old('problem_details')}}</textarea>
                    </div>
                    <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label> Room Number  :</label>
                          <input type="number" class="form-control" placeholder="Enter room number" name="room_number" value="{{ old('room_number') }}" required></input>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                            <label> Floor Number  :</label>
                            <input type="number" class="form-control" placeholder="Enter floor number" name="floor_number" value="{{old('floor_number')}}" required></input>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                            <label> Equipment Number  :</label>
                            <input type="number" class="form-control" placeholder="Enter equipment number" name="equipment_number" value="{{old('equipment_number')}}" required></input>
                      </div>
                    </div>
                  </div>
                  
                
                    
                
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-light">Send Problem</button>
                </div>
            </form>  
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- branch add model end --> 
      @endforeach



    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="faq-list">
          <ul>
            
           @foreach($questions as $question)
            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#fax_{{$question->id}}-list-2" class="collapsed">{{$question->question}} <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="fax_{{$question->id}}-list-2" class="collapse" data-bs-parent=".faq-list">
                <p>
                 {{$question->answer}}.
                </p>
              </div>
            </li>
           @endforeach
           

          </ul>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>{{$seting->address}}</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>{{$seting->email}}</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>{{$seting->phone}}</p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="https://technext.github.io/arsha/forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Your Name</label>
                  <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" required>
              </div>
              <div class="form-group">
                <label for="name">Message</label>
                <textarea class="form-control" name="message" rows="10" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->
@endsection