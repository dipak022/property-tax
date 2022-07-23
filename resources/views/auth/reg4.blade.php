<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Multi Step Bootstrap Form with animations</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap" rel="stylesheet"><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<style>
  * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  color: #2c2c2c;
}
body a {
  color: inherit;
  text-decoration: none;
}

.header__btn {
  transition-property: all;
  transition-duration: 0.2s;
  transition-timing-function: linear;
  transition-delay: 0s;
  padding: 10px 20px;
  display: inline-block;
  margin-right: 10px;
  background-color: #fff;
  border: 1px solid #2c2c2c;
  border-radius: 3px;
  cursor: pointer;
  outline: none;
}
.header__btn:last-child {
  margin-right: 0;
}
.header__btn:hover, .header__btn.js-active {
  color: #fff;
  background-color: #2c2c2c;
}

.header {
  max-width: 600px;
  margin: 50px auto;
  text-align: center;
}

.header__title {
  margin-bottom: 30px;
  font-size: 2.1rem;
}

.content {
  width: 95%;
  margin: 0 auto 50px;
}

.content__title {
  margin-bottom: 40px;
  font-size: 20px;
  text-align: center;
}

.content__title--m-sm {
  margin-bottom: 10px;
}

.multisteps-form__progress {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(0, 1fr));
}

.multisteps-form__progress-btn {
  transition-property: all;
  transition-duration: 0.15s;
  transition-timing-function: linear;
  transition-delay: 0s;
  position: relative;
  padding-top: 20px;
  color: rgba(108, 117, 125, 0.7);
  text-indent: -9999px;
  border: none;
  background-color: transparent;
  outline: none !important;
  cursor: pointer;
}
@media (min-width: 500px) {
  .multisteps-form__progress-btn {
    text-indent: 0;
  }
}
.multisteps-form__progress-btn:before {
  position: absolute;
  top: 0;
  left: 50%;
  display: block;
  width: 13px;
  height: 13px;
  content: '';
  -webkit-transform: translateX(-50%);
          transform: translateX(-50%);
  transition: all 0.15s linear 0s, -webkit-transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
  transition: all 0.15s linear 0s, transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
  transition: all 0.15s linear 0s, transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s, -webkit-transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
  border: 2px solid currentColor;
  border-radius: 50%;
  background-color: #fff;
  box-sizing: border-box;
  z-index: 3;
}
.multisteps-form__progress-btn:after {
  position: absolute;
  top: 5px;
  left: calc(-50% - 13px / 2);
  transition-property: all;
  transition-duration: 0.15s;
  transition-timing-function: linear;
  transition-delay: 0s;
  display: block;
  width: 100%;
  height: 2px;
  content: '';
  background-color: currentColor;
  z-index: 1;
}
.multisteps-form__progress-btn:first-child:after {
  display: none;
}
.multisteps-form__progress-btn.js-active {
  color: #007bff;
}
.multisteps-form__progress-btn.js-active:before {
  -webkit-transform: translateX(-50%) scale(1.2);
          transform: translateX(-50%) scale(1.2);
  background-color: currentColor;
}

.multisteps-form__form {
  position: relative;
}

.multisteps-form__panel {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 0;
  opacity: 0;
  visibility: hidden;
}
.multisteps-form__panel.js-active {
  height: auto;
  opacity: 1;
  visibility: visible;
}
.multisteps-form__panel[data-animation="scaleOut"] {
  -webkit-transform: scale(1.1);
          transform: scale(1.1);
}
.multisteps-form__panel[data-animation="scaleOut"].js-active {
  transition-property: all;
  transition-duration: 0.2s;
  transition-timing-function: linear;
  transition-delay: 0s;
  -webkit-transform: scale(1);
          transform: scale(1);
}
.multisteps-form__panel[data-animation="slideHorz"] {
  left: 50px;
}
.multisteps-form__panel[data-animation="slideHorz"].js-active {
  transition-property: all;
  transition-duration: 0.25s;
  transition-timing-function: cubic-bezier(0.2, 1.13, 0.38, 1.43);
  transition-delay: 0s;
  left: 0;
}
.multisteps-form__panel[data-animation="slideVert"] {
  top: 30px;
}
.multisteps-form__panel[data-animation="slideVert"].js-active {
  transition-property: all;
  transition-duration: 0.2s;
  transition-timing-function: linear;
  transition-delay: 0s;
  top: 0;
}
.multisteps-form__panel[data-animation="fadeIn"].js-active {
  transition-property: all;
  transition-duration: 0.3s;
  transition-timing-function: linear;
  transition-delay: 0s;
}
.multisteps-form__panel[data-animation="scaleIn"] {
  -webkit-transform: scale(0.9);
          transform: scale(0.9);
}
.multisteps-form__panel[data-animation="scaleIn"].js-active {
  transition-property: all;
  transition-duration: 0.2s;
  transition-timing-function: linear;
  transition-delay: 0s;
  -webkit-transform: scale(1);
          transform: scale(1);
}

</style>
<style>
  .id-card-wrapper {
  height:50%;
  width:100%;
  background-color: #122023;
  display: flex;
}
.id-card {
  flex-basis: 100%;
  /* max-width: 30em; */
  border: 2px solid #0AE0DF;
  margin: auto;
  color: #fff;
  padding: 1em;
}

.profile-row {
  display: flex;
}
.profile-row .dp {
  flex-basis: 33.3%;
  position: relative;
  margin: 24px;
}
.profile-row .desc {
  flex-basis: 66.6%;
}

.profile-row .dp img {
  max-width: 100%;
  border-radius: 50%;
  display: block;
}
.profile-row .desc {
  padding: 1em;
}





.profile-row .desc {
  font-family: 'Orbitron', sans-serif;
  color: #a4f3f2;
}
.profile-row .desc h1 {
  margin: 0px;
}
</style>
</head>
<body>
<!-- partial:index.partial.html -->

<!--PEN HEADER-->
<header class="header">
  <h1 class="header__title">Multi Steps Form with animations</h1>
 </header>
<!--PEN CONTENT     -->
<div class="content">
  <!--content inner-->
  <div class="content__inner">
   
    <div class="container overflow-hidden">
      <!--multisteps-form-->
      <div class="multisteps-form">
        <!--progress bar-->
        <div class="row">
          <div class="col-12 col-lg-8 ml-auto mr-auto mb-4">
            <div class="multisteps-form__progress">
              <button class="multisteps-form__progress-btn js-active" type="button" title="User Info"> Identity of the nation</button>
              <button class="multisteps-form__progress-btn js-active" type="button" title="Address">National identity information</button>
              <button class="multisteps-form__progress-btn js-active" type="button" title="Order Info">User Info</button>
              <button class="multisteps-form__progress-btn js-active" type="button" title="Comments">Confirmation National identity </button>
              <button class="multisteps-form__progress-btn" type="button" title="Comments">Complete Registation</button>
            </div>
          </div>
        </div>
        <!--form panels-->
               <!--form panels-->
               <div class="row">
          <div class="col-12 col-lg-8 m-auto">
              <!--single form panel-->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                <h3 class="multisteps-form__title">National identity information</h3>
                <div class="multisteps-form__content">
                  <div class="form-row mt-4">
                  <div class="id-card-wrapper">
                    <div class="id-card">
                      <div class="profile-row">
                        @if($nid_details)
                        <div class="dp">
                          <div class="dp-arc-outer"></div>
                          <div class="dp-arc-inner"></div>
                          <img src="{{ asset($nid_details->image) }}"  style="margin-top: 46px; height: 200px; width: 200px;" >
                        </div>
                        <div class="desc">
                          <h3>{{ $nid_details->name }}</h3>
                              <p>Nid Number: {{ $nid_details->nid_number }}</p>
                              <p>Father Name: {{ $nid_details->father_name }}</p>  
                              <p>Mother Name: {{ $nid_details->mother_name }}</p>  
                              <p>Date Of Birth: {{ $nid_details->date_of_birth }}</p>  
                              <p>Gender: {{ $nid_details->gender }}</p>    
                              <p>Permanent Address: {{ $nid_details->permanent_address }}</p>
                        </div>
                        @else
                        <h3 class="text-center"><span style="color:red;"> <br>Not Found !!! </span> Please valid NID Number ! try Again, Thank You.</h3>
                        @endif
                        
                      </div>
                    </div>
                  </div>
                  <div>
                          <h3 class="text-center"><span class=" text-danger"> <br>Are you sure this is your national identity card,if sure then confirm, </span> Thank You.</h3>
                        </div>
                  </div>
                  <div class="button-row d-flex mt-4">
                   <a href="{{ route('reg') }}" class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</a>
                   @if($nid_details)
                    <a class="btn btn-primary ml-auto js-btn-next" href="{{ route('registation.store') }}" title="Next">Confirm</a>
                    @else
                    @endif
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'></script>
<script>

</script>

</body>
</html>