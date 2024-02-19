@extends('live-pages.layouts.live')

@section('content')
<section id="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <ul class="breadcrumbs">
          <li><a href="{{ route('index') }}">Home</a></li> <span><i class="fa fa-caret-right"></i></span>
          <li>Contact Us</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section id="contact">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-10">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-4 contact-white-box h-100">
            <h6 class="text-green contact-locate">You may locate & contact us at:</h6>
            <h3 class="text-green contact-company">Tohtonku Sdn. Bhd.</h3>
            <p class="contact-info">No. 10, Jalan TP2,
              <br />
              Taman Perindustrian, UEP Subang Jaya,
              <br />
              47620 UEP Subang Jaya, Selangor,
              <br />
              Malaysia
            </p>
            <p class="contact-info"><span class="font-weight-bold">Tel:</span> (603) 80233308 <br /> <span class="font-weight-bold">Fax:</span> (603) 80233700</p>
            <a class="contact-info mb-0" href="mailto:followme@tohtonku.com.my"><span class="font-weight-bold">Email:</span> followme@tohtonku.com.my</a>
          </div>

          <div class="col-12 col-lg-5 offset-lg-1">
            <h1 class="text-green contact-talk">Talk To Us</h1>
            <p class="contact-delight text-neon-green">We'll be delighted to answer any query you may have in the
              soonest possible time. </p>

            <form action="{{route('form')}}" method="POST">
              @csrf
              <input type="text" class="form-control contact-inputs" placeholder="Name" name="name" required>
              <input type="email" class="form-control contact-inputs" placeholder="Email" name="email" required>
              <input type="number" class="form-control contact-inputs" placeholder="Contact Number" name="contact" required>
              <label class="contact-remarks" for="contact-remarks">Enquiry</label>
              <textarea class="contact-textarea form-control contact-remarks-input" name="enquiry" required></textarea>
              <button type="submit" class="btn products-main-button">Submit</button>
              @if (session('message'))
              <div style="display: block; margin-top:1.5em;">
              <small class="text-success" style="margin:auto;" role="alert">
                {{ session('message') }}
              </small>
              </div>
              @endif
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection