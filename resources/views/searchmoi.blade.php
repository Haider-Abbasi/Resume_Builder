<!doctype html>
<html lang="en">
<head>
    <title>Mock Interview View</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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

    <!-- <form action="">

    <div class="form-group">
      <label for="">Search</label>
      <input type="search" name="search" id="search" class="form-control" value="" />
    </div>
    <button>Searchasdfasfdfsfasfasdfasfasdf</button>

    </form> -->

    <h1 class="text-center mb-5">Mock Interview Question</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Question</th>
                    <th class="text-center">Job Title</th>
                    <th class="text-center">Skill Name</th>
                </tr>
            </thead>
            <tbody>
    @php
$counter = 1; // Initialize counter variable
    @endphp
    @foreach ($mockinterview as $interview)
    <tr>
        <td>{{ $counter }}</td>
        <td>{{ $interview->question }}</td>
        <td>{{ $interview->job_name }}</td>
        <td>{{ $interview->skill_name }}</td>
    </tr>
    @php
    $counter++; // Increment counter variable
    @endphp
    @endforeach


</tbody>        </table>
    </div>
    @include('components.footer')

</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
