<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Recommendations</title>

    <!-- Customized Bootstrap Stylesheet -->
    @vite(['resources/css/bootstrap.min.css'])
    @vite(['resources/css/table.css'])
    @vite(['resources/css/card.css'])

    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            /* Default font family */
        }

        .job-skills {
            background-color: #4CAF50;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .job-skills h3 {
            color: #fff;
            font-size: 1.5em;
            margin-bottom: 15px;
        }

        .job-skills pre {
            font-family: 'Courier New', Courier, monospace;
            white-space: pre-wrap;
            word-wrap: break-word;
            max-width: 100%;
            color: #fff;
            margin: 0;
        }

        /* Table Styles */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            background-color: #DAA520;
            /* Golden Background Color */
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #000;
            /* Black border */
            color: #000;
            /* Text Color */
            font-weight: bold;
            /* Bold Text */
        }

        th {
            background-color: #DAA520;
            /* Header Background Color */
            text-align: center;
            /* Center align header text */
            border: 3px solid #000;
            /* Big border */
        }

        td {
            border-right: 1px solid #000;
            /* Big border */
        }

        /* th:first-child {
            border-left: none;
        }

        th:last-child {
            border-right: none;
        }

        th:first-child, th:last-child {
            border-top: 3px solid #000;
        } */

        tr {
            border: 1px solid #000;
            /* Black border around each row */
        }

        tr:first-child {
            border-top: none;
        }

        tr:last-child {
            border-bottom: 3px;
        }

        tr td:first-child {
            border-left: 3px;
        }

        tr td:last-child {
            border-right: 3px;
        }

        table tr:hover {
            background-color: #511 !important;
            /* Change background color on hover */
        }

        .generate-btn {
            text-align: center;
        }


        .pagination-container {
    display: flex;
    justify-content: center; /* Center align pagination */
}

.pagination {
    display: flex;
    flex-wrap: wrap; /* Allow buttons to wrap */
}

.pagination button {
    margin: 5px; /* Add some spacing between pagination buttons */
}
   </style>
</head>

<body>

    @include('components.header')

    <div class="job-skills">
        <h3><span class="text-dark">Skills Extracted:</span></h3>
        <!-- <span class="text-primary"><pre>{{ $output }}</pre></span> -->
        <span class="text-primary">{{ $output }}</span>
    </div>

    <div class="job-skills">
        <h3><span class="text-dark">Total Jobs:</span></h3>
        <!-- <span class="text-primary"><pre>{{ $output }}</pre></span> -->
        <span class="text-primary">{{ $jobs['total_jobs'] }}</span>
    </div>





    <div class="table-card has-table m-5">
        <header class="card-header">
            <p class="card-header-title" style="text-align: center;"> <!-- Center align -->
                <span class="icon mr-2"><i class="mdi mdi-account-multiple"></i></span>
                Job Recommendations
            </p>



            <a href="users" class="card-header-icon">
                <span class="icon"><i class="mdi mdi-reload"></i></span>
            </a>
        </header>
        <div class="card-content">
            <table>
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Company</th>
                        <th>Experience</th>
                        <th>Location</th>
                        <th>Salary</th>
                        <th>Job Posted</th>
                        <th>Link</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs['jobs_data'] as $job)
                        <tr>
                            <td data-label="Job Title">{{$job['job_title']}}</td>
                            <td data-label="Company">{{$job['company_name']}}</td>
                            <td data-label="Experience">{{$job['job_experience']}}</td>
                            <td data-label="Location">{{$job['job_location']}}</td>
                            <td data-label="Salary">{{$job['job_salary']}}</td>

                            <td data-label="Job Posted">
                                <small class="text-gray-500" title="Oct 25, 2021">{{$job['job_posted_time']}}</small>
                            </td>
                            <td data-label="Link">
                                <a href="{{$job['job_link']}}">Link</a>
                            </td>
                            <td class="generate-btn">
                                <a href="{{ url('/moi?search=' . urlencode($job['job_title'])) }}" class="btn btn-primary">
                                    Generate Mock Interview Questions
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


            <div class="pagination-container">
    <div class="pagination">
        @php
            $totalPages = ceil($jobs['total_jobs'] / 10); // Calculate total pages
        @endphp
        @for($i = 1; $i <= $totalPages; $i++)
            <form method="POST" action="{{ url('/uploadResume') }}">
                @csrf
                <input type="hidden" name="search" value="{{ $i }}">
                <button type="submit" class="btn btn-primary">Pg {{ $i }}</button>
            </form>
        @endfor
    </div>
</div>










        </div>
    </div>

</body>

@include('components.footer')

</html>