<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Career Catalyst - CV Analyzer</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playball&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    @vite(['resources/css/bootstrap.min.css'])

    <style>
        .main-body {
            font-family: 'Open Sans', sans-serif;
            background-image: url('https://images.unsplash.com/photo-1531923508017-950c43a0eef0');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        .main-content {
            max-width: 90%;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .main-content h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .main-content form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .main-content input[type="file"] {
            width: 100%;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .main-content button[type="submit"] {
            width: 50%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .main-content button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .features {
            margin-top: 30px;
        }

        .feature-item {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .hh3 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
            text-align: center;
        }

        .feature-item p {
            text-align: center;
            color: #666;
            font-size: 18px;
            line-height: 1.6;
        }
    </style>
</head>

<body class="main-body">

    @include('components.header')

    <div class="main-content">
        <div class="features">
            <div class="feature-item">
                <h2>CV Analyzer</h2>
                <p>Upload your CV to analyze your skills and qualifications. Our system extracts key information to help you understand your strengths.</p>
            </div>
        </div>
        <div class="hh3">
        <h3>Upload Your CV</h3>
        </div>

        <form action="{{url('/uploadResume')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="pdfFile" accept=".pdf" required>
            <button type="submit">Upload</button>
        </form>
    </div>

    @include('components.footer')

</body>

</html>
