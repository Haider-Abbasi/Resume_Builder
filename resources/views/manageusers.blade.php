<!doctype html>
<html lang="en">
<head>
    <title>Manage Users View</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

    <form action="">

    <div class="form-group">
      <label for="">Enter Id, Name or Email</label>
      <input type="search" name="search" id="search" class="form-control" value="{{$search}}" />
    </div>
    <button>Search</button>

    </form>

    <form action="">


<h1 class="text-center mb-5">Userssssss</h1>
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <!-- <th class="text-center">No</th> -->
                <!-- <th class="text-center">Id</th> -->
                <th class="text-center">Id</th>
                <th class="text-center">Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Skills</th>
                <th class="text-center">Type</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($user as $user)
    <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->extracted_skill_name}}</td>
        <td>{{$user->user_type}}</td>
        <td>
<!-- Change Type Button -->

<form action="{{ route('changetype', ['id' => $user->id]) }}" method="post" class="d-inline">
    @csrf
    <!-- @method('post') -->
    <input type="hidden" name="id" value="{{$user->id}}">
    <!-- Other hidden input fields for name, email, etc. if needed -->
    <button type="submit" onclick="confirmChangeType({{$user->id}}, '{{$user->name}}', '{{$user->email}}', '{{$user->user_type}}')" class="btn btn-primary">Change Type</button>
</form>





<!-- Delete Button -->
<form action="{{ route('manageusers', ['id' => $user->id]) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="confirmDelete({{$user->id}}, '{{$user->name}}', '{{$user->email}}')">>Delete</button>
</form>







</td>
    </tr>
    @endforeach
</tbody>
    </table>
</div>

</div>
@include('components.footer')
<script>
function confirmDelete(id, name, email) {
    if (confirm(`Are you sure you want to delete user with ID: ${id}, Name: ${name}, Email: ${email}?`)) {
        // If user confirms, submit the form
        document.querySelector(`form[action="{{ route('manageusers', ['id' => $user->id]) }}"][method="POST"] input[name="id"][value="${id}"]`).parentNode.submit();
        // <form action="{{ route('manageusers', ['id' => $user->id]) }}" method="POST" class="d-inline">
    }
}


function confirmChangeType(id, name, email, user_type) {
    let new_type = user_type === 'user' ? 'admin' : 'user';
    if (confirm(`Are you sure you want to change the type of user ${name} with ID ${id} and email ${email} from "${user_type}" to "${new_type}"?`)) {
        // If user confirms, submit the form
        // document.getElementById(`changeTypeForm${id}`).submit();
        document.querySelector(`form[action="{{ route('changetype', ['id' => $user->id]) }}"][method="post"] input[name="id"][value="${id}"]`).parentNode.submit();
        // <form action="{{ route('changetype', ['id' => $user->id]) }}" method="POST" class="d-inline">
    }
}
</script> 
</body>
</html>
