<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Career Catalyst</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playball&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        @vite(['resources/css/bootstrap.min.css'])
        @vite(['resources/css/style.css'])
        
    </head>

    <body>

    @include('components.header')
    <!-- @if(Session::has('login') && Session::get('login') == 1)
        <p>You are logged in.</p>
    @else
        <p>You are not logged in.</p>
    @endif -->

    <!-- <a href="{{ route('logout') }}">Logout</a> -->
    <!--  -->
<!-- Hero Start -->
<div class="container-fluid bg-light py-6 mt-0">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7 col-md-12">
                <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-4 animated bounceInDown">Welcome to Career Catalyst</small>
                <h1 class="display-1 mb-4 animated bounceInDown">Bridging <span class="text-primary">Your</span>CV
                    to Success with AI-Powered Insights</h1>
                <div class="d-flex flex-wrap mb-4"> <!-- Wrap the buttons in a div -->
                    <a href="resume"
                        class="btn btn-primary border-0 rounded-pill py-3 px-4 px-md-5 me-4 animated bounceInLeft">Make
                        CV</a>
                    <a href="uploadResume"
                        class="btn btn-primary border-0 rounded-pill py-3 px-4 px-md-5 me-4 animated bounceInLeft">Upload
                        CV</a>
                    <a href="jobRecommendationDB"
                        class="btn btn-primary border-0 rounded-pill py-3 px-4 px-md-5 me-4 animated bounceInLeft">Job
                        Recomendation</a>
                </div>
                <a href="search"
                    class="btn btn-primary border-0 rounded-pill py-3 px-4 px-md-5 animated bounceInLeft">Mock
                    Interview</a>
                <!-- Update the link to point to the new route -->
                <!-- <a href="{{ route('resume.builder') }}">Resume Builder Integrated without css</a>
                <a href="{{ route('resume.builder') }}" class="btn btn-primary border-0 rounded-pill py-3 px-4 px-md-5 animated bounceInLeft">Upload CV</a> -->
                <input type="file" name="upload" id="upload" style="display: none;">
            </div>
            <div class="col-lg-5 col-md-12">
                <img src="{{asset('logo.png')}}" class="img-fluid rounded animated zoomIn" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

    <!-- Fact Start-->
    <div class="container-fluid faqt py-6">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-7">
                    <div class="row g-4">
                        <div class="col-sm-4 wow bounceInUp" data-wow-delay="0.3s">
                            <div class="faqt-item bg-primary rounded p-4 text-center">
                                <i class="fas fa-users fa-4x mb-4 text-white"></i>
                                <h1 class="display-4 fw-bold" data-toggle="counter-up">689</h1>
                                <p class="text-dark text-uppercase fw-bold mb-0">Users</p>
                            </div>
                        </div>
                        <div class="col-sm-4 wow bounceInUp" data-wow-delay="0.5s">
                            <div class="faqt-item bg-primary rounded p-4 text-center">
                                <i class="fas fa-users-cog fa-4x mb-4 text-white"></i>
                                <h1 class="display-4 fw-bold" data-toggle="counter-up">107</h1>
                                <p class="text-dark text-uppercase fw-bold mb-0">Resume Downloads</p>
                            </div>
                        </div>
                        <div class="col-sm-4 wow bounceInUp" data-wow-delay="0.7s">
                            <div class="faqt-item bg-primary rounded p-4 text-center">
                                <i class="fas fa-check fa-4x mb-4 text-white"></i>
                                <h1 class="display-4 fw-bold" data-toggle="counter-up">253</h1>
                                <p class="text-dark text-uppercase fw-bold mb-0">Resume Uploads</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 wow bounceInUp" data-wow-delay="0.1s">
                    <div class="video">
                        <button type="button" class="btn btn-play" data-bs-toggle="modal"
                            data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('components.footer')


<!-- Copyright Start -->
<div class="container-fluid mt-10 copyright bg-dark py-4" style="bottom: 0; left: 0; width: 100%; z-index: 1000;">
    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-md-12 text-center">
                <span class="text-light"><a href="#" style="text-decoration: none; color: inherit;"><i class="fas fa-copyright text-light me-2"></i>Career Catalyst</a>, All rights reserved.</span>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <script type="text/javascript">
        function openSelect(file) {
            $(file).trigger('click');
        }

        function editProfile() {
            // Redirect to the edit profile page
            window.location.href = "{{ route('profile.edit') }}";
        }
    </script>
</body>

</html>
