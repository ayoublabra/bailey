<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Bailey Assurances</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  {{-- <link href="{{ asset('assets/img/favicon.png') }}" rel="icon"> --}}
  {{-- <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon"> --}}

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex flex-column align-items-center">

      {{-- <h1>Bailey Assurance</h1> --}}
      {{-- <div class="card iq-product-custom-card animate:hover-media assfacture"> --}}
        <div style="width: 70%;">
           <img src="{{ asset('images/pages/bailey.png') }}" alt="product-details" class="img-fluid iq-product-img hover-media logo-check" loading="lazy">
        </div>
     {{-- </div> --}}
      {{-- <img src="{{asset('images/pages/bailey.png')}}" alt=""> --}}
      <div style="display: block;width: 40%;margin: auto;background-color: transparent;">
        <img src="{{ asset('images/pages/maintenance.png') }}" alt="product-details" class="img-fluid iq-product-img hover-media logo-check" loading="lazy">
     </div>
      <h2 style="margin-top: 10%;color: black;">La plateforme est en maintenance pour</h2>
    
      <div class="countdown d-flex justify-content-center" data-count="2023/09/26">
        <div>
          <h3>%d</h3>
          <h4>Jours</h4>
        </div>
        <div>
          <h3>%h</h3>
          <h4>Heures</h4>
        </div>
        <div>
          <h3>%m</h3>
          <h4>Minutes</h4>
        </div>
        <div>
          <h3>%s</h3>
          <h4>Secondes</h4>
        </div>
      </div>
      

      {{-- <div class="subscribe">
        <h4>Subscribe now to get the latest updates!</h4>
        <form action="forms/notify.php" method="post" role="form" class="php-email-form">
          <div class="subscribe-form">
            <input type="email" name="email" required><input type="submit" value="Subscribe">
          </div>
          <div class="mt-2">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your notification request was sent. Thank you!</div>
          </div>
        </form>
      </div> --}}

     

    </div>
  </header><!-- End #header -->



  <!-- ======= Footer ======= -->
 
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
  <!-- Include php-email-form Validation Script -->
  <script src="{{ asset('/vendor/php-email-form/validate.js') }}"></script>

  <!-- Include your custom JS -->
  <script src="{{ asset('/js/main.js') }}"></script>

</body>

</html>

