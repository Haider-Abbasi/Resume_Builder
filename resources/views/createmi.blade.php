<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mock Interview Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Mock Interview Form</h1>
    <form action="{{url('/')}}/mockinterview" method="post">
        @csrf
        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" id="question" name="question" required>
        </div>
        <div class="form-group">
            <label for="job_name">Job Name</label>
            <input type="text" id="job_name" name="job_name" required>
        </div>
        <div class="form-group">
            <label for="skill_name">Skill Name</label>
            <input type="text" id="skill_name" name="skill_name" required>
        </div>
        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
