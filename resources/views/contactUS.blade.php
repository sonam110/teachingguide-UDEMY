@extends('layouts.landing')

@section('css')
<link href="{{ asset('assets/css/home.css?v=123') }}" rel="stylesheet">
<link href="{{ asset('assets/css/responsive.css?v=123') }}" rel="stylesheet">
<link href="{{ asset('assets/css/lp_style.css?v=123') }}" rel="stylesheet">
@endsection

@section('content')
<div class="background-part">
  <div class="row">
      <div class="col-md-12">
          <div class="investor_title text-center">
              <h1><strong>Contact Us</strong></h1>
              <h4>We would love to hear from you. Please send us a message.</h4>
          </div>
      </div>
  </div>
  <div class="container">

  @if(Session::has('success'))
    <div class="alert alert-success">
      {{ Session::get('success') }}
      <a href="/">Get Back to Home</a>
    </div>
  @endif
  <form id="contact" method="POST" action="{{ route('contactus.store') }}">
    @csrf


  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  {!! Form::label('Name:') !!}
  {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
  <span class="text-danger">{{ $errors->first('name') }}</span>
  </div>

  <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
  {!! Form::label('Email:') !!}
  {!! Form::text('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Enter Email']) !!}
  <span class="text-danger">{{ $errors->first('email') }}</span>
  </div>

  <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
  {!! Form::label('Message:') !!}
  {!! Form::textarea('message', old('message'), ['class'=>'form-control', 'placeholder'=>'Enter Message']) !!}
  <span class="text-danger">{{ $errors->first('message') }}</span>
  </div>

  <div class="form-group">
  <button class="btn btn-success">Contact US!</button>
  </div>

  {!! Form::close() !!}

  </div>
</div>
<footer>
 <div class="footer_inner text-center">
     <div class="container">
         <div class="footer_logo">
            <a href="/">
             <img src="{{ asset('assets/img/logo/logo_white.svg') }}">
           </a>
         </div>
         <div class="copyrights">
             <p>&copy; 2018 TeachinGuide</p>
         </div>
     </div>
 </div>
</footer>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/plugins/validate/jquery.validate.min.js') }}"></script>

<script  type="text/javascript">

    var form = jQuery("#contact");
    var validator = form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {}
    });

    var form = document.getElementById('contact');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      var errorCount = validator.numberOfInvalids();

      if (errorCount > 0) {
          console.log("error");
          return false;
      }

      form.submit();
    });

</script>

@endsection
