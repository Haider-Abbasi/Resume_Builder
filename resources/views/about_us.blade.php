<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

            <!-- Google Web Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playball&display=swap" rel="stylesheet">
    @vite(['resources/css/bootstrap.min.css'])
    @vite(['resources/css/style.css'])
    
</head>
<body>
@include('components.header')


            <!-- About Satrt -->
            <div class="container-fluid py-6">
            <div class="container">
                <div class="row g-0">
                    <div class="col-lg-0 wow bounceInUp" data-wow-delay="0.1s">
                        <img src="img/about.jpg" class="img-fluid rounded" alt="">
                    </div>
                    <div class="col-lg-7 wow bounceInUp" data-wow-delay="0.3s">
                        <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">About Us</small>
                        <h1 class="display-5 mb-4">Trusted By 200 + satisfied clients</h1>
                        <p class="mb-4">The project aims to empower job seekers with a versatile tool that enhances their employability and job search outcomes, bridging the gap between their qualifications and career aspirations.</p>
                        <div class="row g-3 text-dark mb-5">
                            <div class="col-sm-6">
                                <i class="fas fa-share text-primary me-2"></i>CV Builder with Multiple Templates

                            </div>
                            <div class="col-sm-6">
                                <i class="fas fa-share text-primary me-2"></i>AI-Driven CV Analysis

                            </div>
                            <div class="col-sm-6">
                                <i class="fas fa-share text-primary me-2"></i>Job Search and Recommendation

                            </div>
                            <div class="col-sm-6">
                                <i class="fas fa-share text-primary me-2"></i>Dynamic Mock Interview Generation

                            </div>
                        </div>
                        <a href="" class="btn btn-primary py-3 px-5 rounded-pill">About Us<i class="fas fa-arrow-right ps-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        @include('components.footer')
</body>
</html>