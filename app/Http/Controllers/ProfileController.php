<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Mockinterview;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use PHPUnit\Framework\Constraint\IsEmpty;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Client\RequestException;

try {
    // Your API call
} catch (RequestException $e) {
    if ($e->response->status() === 401) {
        $errorMessage = "Authentication failed. Please check your credentials.";
    } else {
        $errorMessage = "Failed to fetch job recommendations.";
    }
    return redirect()->back()->with('error', $errorMessage);
} catch (\Exception $e) {
    // Handle other exceptions
}

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }



    public function home()
    {
        // Retrieve user ID from session using Session facade
        $userId = Session::get('user_id');
        // Now you can use $userId as needed
        // Find the user by ID
        $user = User::find($userId);


        // Check the user_type and redirect accordingly
        if ($user && $user->user_type === 'admin') {
            // Return admin dashboard view
            return view('indexadmin');

        } elseif ($user && $user->user_type === 'user') {
            // Return user dashboard view
            return view('index');
        } else {
            // Handle other user types or scenarios
            return redirect()->route('otherdashboard');
        }



    }

















    public function uploadResume(Request $request)
    {
        // Check if the page number parameter exists in the request
        if ($request->has('search')) {
            // Retrieve the page number from the request
            $pageNumber = $request->input('search');

            if (!empty($pageNumber)) {
                // Page number is not empty, proceed with your logic
                // ...
                // For example:
                // echo "Page number is: " . $pageNumber;

                // // Using session facade
                // $output = Session::get('output');
                $output = Session::get('output');

                // Api call for recommended jobs
                try {
                    //  replace $job variable with the output of skills extracted
//                for($i=1;$i<2;$i++)
//                {
                    // $r1 = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=".$job."&location=islamabad&page=".$page."");
                    // $page=2;
                    // $r2 = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=".$job."&location=islamabad&page=".$page."");
                    // $page=3;
                    // $r3 = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=".$job."&location=islamabad&page=".$page."");

                    $response = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=" . $output . "&location=islamabad&page=" . $pageNumber . "");
                    //               }
                } catch (\Exception $e) {
                    info($e->getMessage());
                    abort(503);
                }
                if ($response->status() == 401) {
                    throw new AuthenticationException();
                } else if (!$response->successful()) {
                    abort(503);
                }

                return view('job_recommendation')
                    ->with('jobs', json_decode($response, true))
                    ->with('output', $output);

            } else {
                // Page number is empty
                // echo "Page number is empty";
            }
        } else {
            // Page number parameter does not exist in the request
            // echo "Page number parameter does not exist";
            $uploadDir = public_path('cv_analyzer/uploads/');
            $textConvertedDir = public_path('cv_analyzer/text_converted_cvs/');

            $allowedExtensions = ['pdf'];

            $fileName = $request->file('pdfFile')->getClientOriginalName();
            $fileExt = strtolower($request->file('pdfFile')->getClientOriginalExtension());

            if (in_array($fileExt, $allowedExtensions)) {
                $userId = uniqid();
                $uploadedFileName = $userId . '_' . $fileName;
                $destination = $uploadDir . $uploadedFileName;
                $textConvertedFilePath = $textConvertedDir . $userId . '.txt';

                $request->file('pdfFile')->move($uploadDir, $uploadedFileName);

                $pythonScriptPath = base_path('cv_analyzer/cv_analysis.py');
                $pythonScriptPath = public_path('cv_analysis.py');
                $pdfFilePath = $destination;
                $textFilePath = $textConvertedFilePath;
                $command = "python3 cv_analysis.py \"$pdfFilePath\" \"$textFilePath\"";
                // $command = "python3 cv_analysis.py";
                // $command = "python3 " . base_path('cv_analyzer/cv_analysis.py');

                // $command = "python3 $pythonScriptPath";

                $output = shell_exec($command);
                // Using session facade
                Session::put('output', $output);

                // Retrieve user ID from session using Session facade
                $userId = Session::get('user_id');

                // Get the user with the specified ID
                $user = User::find($userId);


                // Save the skills to the user's extracted_skill_name column
                $user->extracted_skill_name = $output;

                // Save the user model to persist the changes
                $user->save();

                // echo '<h3>Skills Extracted:</h3>';
                // echo '<pre>' . $output . '</pre>';

                // echo '<div style="background-color: #4CAF50; padding: 20px; margin-top: 20px; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); text-align: center;">';
                // echo '<h3 style="color: #fff; font-size: 1.5em; margin-bottom: 15px;">Skills Extracted:</h3>';
                // echo '<div style="font-family: \'Courier New\', Courier, monospace; white-space: pre-wrap; word-wrap: break-word; max-width: 100%; color: #fff;">' . nl2br(htmlspecialchars($output)) . '</div>';
                // echo '</div>';

            }

            // Api call for recommended jobs
            try {
                //  replace $job variable with the output of skills extracted
//                for($i=1;$i<2;$i++)
//                {
                // $r1 = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=".$job."&location=islamabad&page=".$page."");
                // $page=2;
                // $r2 = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=".$job."&location=islamabad&page=".$page."");
                // $page=3;
                // $r3 = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=".$job."&location=islamabad&page=".$page."");

                // $response = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=" . $output . "&location=islamabad&page=1");
                // add this in job recommendation     http://127.0.0.1:5000/get_all_jobs?keyword=accounting,%20finance&location=islamabad&page=1&num_pages=10
               $response = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=" . $output . "&location=islamabad&page=1");
                // $response = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=" . $output . "&location=islamabad&page=1&num_pages=3&page_size=20");

                //               }
            } catch (\Exception $e) {
                info($e->getMessage());
                abort(503);
            }
            if ($response->status() == 401) {
                throw new AuthenticationException();
            } else if (!$response->successful()) {
                abort(503);
            }

            return view('job_recommendation')
                ->with('jobs', json_decode($response, true))
                ->with('output', $output);
            // return view('job_recommendation')->with([
            //     'jobs' => json_decode($response, true),
            //     'output' => $output
            // ]);

            // $users = new User;

            // $users->extracted_skill_name = $output;

            // $users->extracted_skill_name = $request['question'];

            // $mockinterview->question = $request['question'];
            // $mockinterview->job_name = $request['job_name'];
            // $mockinterview->skill_name = $request['skill_name'];

            // $users->save();

            //            return redirect('/mockinterview/view');


            // } else {
            //     echo '<p>Invalid file format. Only PDF files are allowed.</p>';
            // }
        }
    }



















































    public function jobRecommendationDB(Request $request)
    {
        // Check if the page number parameter exists in the request
        if ($request->has('search')) {
            // Retrieve the page number from the request
            $pageNumber = $request->input('search');

            if (!empty($pageNumber)) {

                $outputJR = Session::get('outputJR');
                // echo '<div style="background-color: #4CAF50; padding: 20px; margin-top: 20px; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); text-align: center;">';
                // echo '<h3 style="color: #fff; font-size: 1.5em; margin-bottom: 15px;">Skills Extracted:</h3>';
                // echo '<div style="font-family: \'Courier New\', Courier, monospace; white-space: pre-wrap; word-wrap: break-word; max-width: 100%; color: #fff;">' . nl2br(htmlspecialchars($outputJR)) . '</div>';
                // echo '</div>';

                // Api call for recommended jobs
                try {
                    //  replace $job variable with the output of skills extracted
//                for($i=1;$i<2;$i++)
//                {
                    // $r1 = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=".$job."&location=islamabad&page=".$page."");
                    // $page=2;
                    // $r2 = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=".$job."&location=islamabad&page=".$page."");
                    // $page=3;
                    // $r3 = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=".$job."&location=islamabad&page=".$page."");

                    $response = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=" . $outputJR . "&location=islamabad&page=" . $pageNumber . "");

                    //               }
                } catch (\Exception $e) {
                    info($e->getMessage());
                    abort(503);
                }
                if ($response->status() == 401) {
                    throw new AuthenticationException();
                } else if (!$response->successful()) {
                    abort(503);
                }

                return view('job_recommendation')
                    ->with('jobs', json_decode($response, true))
                    ->with('output', $outputJR);

            } else {
                // Page number is empty
                // echo "Page number is empty";
            }
        } else {
            // Page number parameter does not exist in the request
            // echo "Page number parameter does not exist";



            // Retrieve user ID from session using Session facade
            $userId = Session::get('user_id');

            // Get the user with the specified ID
            $user = User::find($userId);

            // Check if the user exists
            if ($user) {
                // Retrieve the extracted_skill_name column from the user model
                $extractedSkills = $user->extracted_skill_name;

                // Now $extractedSkills contains the value of the extracted_skill_name column for the user with the specified ID
                $outputJR = $extractedSkills;
            } else {
                // Handle the case where the user with the specified ID does not exist
                $outputJR = "User not found";
            }












            // // Retrieve user ID from session using Session facade
            // $userId = Session::get('user_id');
            //         // Get the currently authenticated user
            //         $user = Auth::user();

            //         // Retrieve the extracted skills from the user model
            //         $extractedSkills = $user->extracted_skill_name;

            //         $outputJR = $extractedSkills;

            // Using session facade
            Session::put('outputJR', $outputJR);


            // echo '<div style="background-color: #4CAF50; padding: 20px; margin-top: 20px; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); text-align: center;">';
            // echo '<h3 style="color: #fff; font-size: 1.5em; margin-bottom: 15px;">Skills Extracted:</h3>';
            // echo '<div style="font-family: \'Courier New\', Courier, monospace; white-space: pre-wrap; word-wrap: break-word; max-width: 100%; color: #fff;">' . nl2br(htmlspecialchars($outputJR)) . '</div>';
            // echo '</div>';



            // Api call for recommended jobs
            try {
                //  replace $job variable with the output of skills extracted
//                for($i=1;$i<2;$i++)
//                {
                // $r1 = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=".$job."&location=islamabad&page=".$page."");
                // $page=2;
                // $r2 = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=".$job."&location=islamabad&page=".$page."");
                // $page=3;
                // $r3 = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=".$job."&location=islamabad&page=".$page."");

                $response = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=" . $outputJR . "&location=islamabad&page=1");
                // $response = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=" . $outputJR . "&location=islamabad&page=1&num_pages=1&page_size=1");

                // $response = Http::get("http://127.0.0.1:5000/get_all_jobs?keyword=" . $outputJR . "&location=islamabad");

                //               }
            } catch (\Exception $e) {

                info($e->getMessage());
                abort(503);
            }
            if ($response->status() == 401) {
                throw new AuthenticationException();
            } else if (!$response->successful()) {
                abort(503);
            }

            return view('job_recommendation')
                ->with('jobs', json_decode($response, true))
                ->with('output', $outputJR);
            // return view('job_recommendation')->with([
            //     'jobs' => json_decode($response, true),
            //     'output' => $output
            // ]);

            // $users = new User;

            // $users->extracted_skill_name = $output;

            // $users->extracted_skill_name = $request['question'];

            // $mockinterview->question = $request['question'];
            // $mockinterview->job_name = $request['job_name'];
            // $mockinterview->skill_name = $request['skill_name'];

            // $users->save();

            //            return redirect('/mockinterview/view');


            // } else {
            //     echo '<p>Invalid file format. Only PDF files are allowed.</p>';
            // }
        }
    }
    // public function jobs(Request $request)
    // {
    //     $search = $request->query('search', '');
    //     // Your code here


    //     echo '<div style="background-color: #4CAF50; padding: 20px; margin-top: 20px; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); text-align: center;">';
    //     echo '<h3 style="color: #fff; font-size: 1.5em; margin-bottom: 15px;">Page Extracted:</h3>';
    //     echo '<div style="font-family: \'Courier New\', Courier, monospace; white-space: pre-wrap; word-wrap: break-word; max-width: 100%; color: #fff;">' . nl2br(htmlspecialchars($page)) . '</div>';
    //     echo '</div>';

    //     echo '<div style="background-color: #4CAF50; padding: 20px; margin-top: 20px; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); text-align: center;">';
    //     echo '<h3 style="color: #fff; font-size: 1.5em; margin-bottom: 15px;">Skills Extracted:</h3>';
    //     echo '<div style="font-family: \'Courier New\', Courier, monospace; white-space: pre-wrap; word-wrap: break-word; max-width: 100%; color: #fff;">' . nl2br(htmlspecialchars($output)) . '</div>';
    //     echo '</div>';


    // }
























































































    public function indexadmin()
    {
        return view('indexadmin');
    }

    //mock interview 

    public function mockinterview()
    {
        return view('mockinterview');
    }

    public function create()
    {
        return view('createmi');
    }

    public function store(Request $request)
    {

        // echo "<pre>";
        // print_r($request->all());

        //insert query

        $mockinterview = new Mockinterview;
        $mockinterview->question = $request['question'];
        $mockinterview->job_name = $request['job_name'];
        $mockinterview->skill_name = $request['skill_name'];

        $mockinterview->save();

        return redirect('/searchmiadmin');




    }



    public function view()
    {

        $mockinterview = Mockinterview::all();

        // echo "<pre>";
        // print_r($mockinterview);
        // echo "</pre>";
        // die;


        $data = compact('mockinterview');



        return view('viewmi')->with($data);



    }





    // public function search(Request $request)
    // {
    //     $search=$request['search'] ?? "";

    //     if($search!=""){

    //         //where clause
    //         $mockinterview= Mockinterview::where('skill_name', 'LIKE' , "%$search%")->get();

    //     }
    //     else{
    //         $mockinterview= Mockinterview::all();

    //     }


    //     $data=compact('mockinterview', 'search');



    //     return view('searchmi')->with($data);



    // }



    public function search(Request $request)
    {
        //        $search=$request['search'] ?? "";

        $searchbyskill = $request['searchbyskill'] ?? "";
        $searchbyjobtitle = $request['searchbyjobtitle'] ?? "";

        if ($searchbyskill != "") {

            //where clause
            // $mockinterview = Mockinterview::where('skill_name', 'LIKE', "%$searchbyskill%")->get();
            $mockinterview = Mockinterview::where('skill_name', 'LIKE', "%$searchbyskill%")
                ->inRandomOrder() // Randomize the order of retrieved rows
                ->limit(10) // Limit the result to 10 rows
                ->get();

        } else if ($searchbyjobtitle != "") {

            //where clause
            // $mockinterview = Mockinterview::where('job_name', 'LIKE', "%$searchbyjobtitle%")->get();
            $mockinterview = Mockinterview::where('job_name', 'LIKE', "%$searchbyjobtitle%")
                ->inRandomOrder() // Randomize the order of retrieved rows
                ->limit(10) // Limit the result to 10 rows
                ->get();

        } else {
            $mockinterview1 = Mockinterview::all();
            // Randomize the questions and limit to 30
            $mockinterview = $mockinterview1->shuffle()->take(30);
        }


        $data = compact('mockinterview', 'searchbyskill', 'searchbyjobtitle');



        return view('searchmi')->with($data);



    }


    public function moi(Request $request)
    {
        $search = $request->query('search', '');

        if ($search !== "") {
            // Perform search based on job title if provided
            $mockinterview = Mockinterview::where('job_name', 'LIKE', "%$search%")->get();
        } else {
            // Fetch all mock interviews if search query is empty
            $mockinterview = Mockinterview::all();
        }

        // Pass data to the view
        $data = compact('mockinterview', 'search');

        return view('searchmoi', $data);
    }








    public function manageusers(Request $request)
    {

        $search = $request['search'] ?? "";
        $id = $request['id'] ?? "";

        if ($id != "") {

            $user = User::findOrFail($id);

            // Delete the user
            $user->delete();
            // Set a success message in the session
            $request->session()->flash('success', 'User deleted successfully.');
            // Redirect back to the same page after deletion
//        return redirect()->route('manageusers');    
        }


        if ($search != "") {

            // Query the database to search for the term in multiple columns
            $results = User::where('id', 'LIKE', "%$search%")
                ->orWhere('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->get();

            $user = $results;

        } else {
            $user = User::all();
            // // Randomize the questions and limit to 30
            // $user = $user1->shuffle()->take(30);
        }








        // $data = compact('mockinterview');

        $data = compact('user', 'search');




        return view('manageusers')->with($data);

    }

    public function changetype(Request $request)
    {
        $search = $request['search'] ?? "";
        $id = $request['id'] ?? "";

        if ($id != "") {
            // Find the user by ID
            $user = User::findOrFail($id);

            // Check the current type and update it accordingly
            if ($user->user_type === 'user') {
                $user->user_type = 'admin';
            } elseif ($user->user_type === 'admin') {
                $user->user_type = 'user';
            }

            // Save the changes to the user
            $user->save();

            // Set a success message in the session
            $request->session()->flash('success', 'User type changed successfully.');
        }


        $user = User::all();
        // // Randomize the questions and limit to 30
        // $user = $user1->shuffle()->take(30);




        // $data = compact('mockinterview');

        $data = compact('user', 'search');




        return view('manageusers')->with($data);


    }










    public function deleteUser(Request $request)
    {
        // Retrieve the user ID from the request parameters
        $id = $request->input('id');

        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Optionally, you can add a flash message to indicate success
        // session()->flash('success', 'User deleted successfully.');

        // Redirect back to the page or wherever you want
        return view('manageusers');
    }




    // public function searchmiadmin()
    // {


    //     return view('searchmiadmin');


    // }

    public function searchmiadmin(Request $request)
    {
        //        $search=$request['search'] ?? "";

        $searchbyskill = $request['searchbyskill'] ?? "";
        $searchbyjobtitle = $request['searchbyjobtitle'] ?? "";

        if ($searchbyskill != "") {

            //where clause
            // $mockinterview = Mockinterview::where('skill_name', 'LIKE', "%$searchbyskill%")->get();
            $mockinterview = Mockinterview::where('skill_name', 'LIKE', "%$searchbyskill%")
                ->inRandomOrder() // Randomize the order of retrieved rows
                ->limit(10) // Limit the result to 10 rows
                ->get();

        } else if ($searchbyjobtitle != "") {

            //where clause
            // $mockinterview = Mockinterview::where('job_name', 'LIKE', "%$searchbyjobtitle%")->get();
            $mockinterview = Mockinterview::where('job_name', 'LIKE', "%$searchbyjobtitle%")
                ->inRandomOrder() // Randomize the order of retrieved rows
                ->limit(10) // Limit the result to 10 rows
                ->get();

        } else {
            $mockinterview1 = Mockinterview::all();
            // Randomize the questions and limit to 30
            $mockinterview = $mockinterview1->shuffle()->take(30);
        }


        $data = compact('mockinterview', 'searchbyskill', 'searchbyjobtitle');



        return view('searchmiadmin')->with($data);



    }









}





// class ResumeController extends Controller
// {
//     public function upload(Request $request)
//     {
//         $uploadDir = public_path('cv_analyzer/uploads/');
//         $textConvertedDir = public_path('cv_analyzer/text_converted_cvs/');

//         $allowedExtensions = ['pdf'];

//         $fileName = $request->file('pdfFile')->getClientOriginalName();
//         $fileExt = strtolower($request->file('pdfFile')->getClientOriginalExtension());

//         if (in_array($fileExt, $allowedExtensions)) {
//             $userId = uniqid();
//             $uploadedFileName = $userId . '_' . $fileName;
//             $destination = $uploadDir . $uploadedFileName;
//             $textConvertedFilePath = $textConvertedDir . $userId . '.txt';

//             $request->file('pdfFile')->move($uploadDir, $uploadedFileName);

//             $pythonScriptPath = base_path('cv_analyzer/cv_analysis.py');
//             $pdfFilePath = $destination;
//             $textFilePath = $textConvertedFilePath;
//             $command = "python3 $pythonScriptPath \"$pdfFilePath\" \"$textFilePath\" ";
//             $output = shell_exec($command);

//             echo '<h3>Skills Extracted:</h3>';
//             echo '<pre>' . $output . '</pre>';
//         } else {
//             echo '<p>Invalid file format. Only PDF files are allowed.</p>';
//         }
//     }
// }










































