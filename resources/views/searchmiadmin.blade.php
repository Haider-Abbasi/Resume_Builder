<!doctype html>
<html lang="en">

<head>
    <title>Mock Interview View Admin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playball&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    @vite(['resources/css/bootstrap.min.css'])
    @vite(['resources/css/style.css'])


    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .table {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: #007bff;
            color: #fff;
        }

        .table th,
        .table td {
            vertical-align: middle !important;
        }

        .table tbody tr:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    @include('components.header')

    <div class="container">


        <a href="/mockinterview/create"
            class="btn btn-primary border-0 rounded-pill py-3 px-4 px-md-5 me-4 animated bounceInLeft">Create or Add Questions</a>


        <form action="">

            <div class="form-group">
                <label for="">Search by Skill Name</label>
                <input type="search" name="searchbyskill" id="searchbyskill" class="form-control"
                    value="{{$searchbyskill}}" />
            </div>
            <button>Search</button>

        </form>

        <form action="">

            <div class="form-group">
                <label for="">Search by Job Name</label>
                <input type="search" name="searchbyjobtitle" id="searchjobtitle" class="form-control"
                    value="{{$searchbyjobtitle}}" />
            </div>
            <button>Search</button>

        </form>

        <h1 class="text-center mb-5">Mock Interview View Skills Based Admin</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <!-- <th class="text-center">Id</th> -->
                        <th class="text-center">Question</th>
                        <th class="text-center">Job Name</th>
                        <th class="text-center">Skill Name</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $questionNo = 1;
                    @endphp
                    @foreach ($mockinterview as $mock)
                                        <tr>
                                            <td>{{$questionNo}}</td>
                                            <!-- <td>{{$mock->id}}</td> -->
                                            <td>{{$mock->question}}</td>
                                            <td>{{$mock->job_name}}</td>
                                            <td>{{$mock->skill_name}}</td>
                                        </tr>
                                        @php
                                            $questionNo++;
                                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    @include('components.footer')

</body>

</html>