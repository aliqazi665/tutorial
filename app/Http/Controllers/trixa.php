<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Image;
use App\Models\Country;
use App\Models\DegreeLevel;
use App\Models\Experience;
use App\Models\Job;
use App\Models\Profile;
use App\Models\Award;
use App\Models\Certificate;
use App\Models\Education;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Salary;
use App\Models\Skill;
use App\Models\Summary;
use App\Models\WorkExperience;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;
use SebastianBergmann\Environment\Console;

use function PHPSTORM_META\type;

class HomeController extends Controller
{
/**
* Create a new controller instance.
*
* @return void
*/
private $userId;

public function __construct()
{
$this->middleware('auth');
$this->middleware('role:candidate');
$this->userId = auth()->id();
}

/**
* Show the application dashboard.
*
* @return \Illuminate\Contracts\Support\Renderable
*/
public function index()
{
$userId = auth()->id();
$profile = Profile::with('country')->where('candidate_id','=', $userId)->first();
$summaries=Summary::where('candidate_id',$userId)->first();
$workexperience = WorkExperience::with('countries')->where('candidate_id','=', $userId)->get();
$workexperience= WorkExperience::with('countries')->where('candidate_id','=', $userId)->get();
$awards=DB::table('awards')->where('candidate_id',$userId)->get();
$certificates=DB::table('certificates')->where('candidate_id',$userId)->get();
$education=DB::table('educations')->where('candidate_id',$userId)->get();
$project=DB::table('projects')->where('candidate_id',$userId)->get();
$skill=DB::table('skills')->where('candidate_id',$userId)->get(['skill','rating','candidate_id','id']);
$countries=DB::table('countries')->get(['country_name', 'id']);
$image = Image::where('candidate_id' , $userId)->first(['imagename','id']);
return view('home')->with([
'profile' => $profile,

'summar' => $summaries,
'work'=>$workexperience ,
'award'=>$awards,
'certificates'=>$certificates,
'education'=>$education,
'project'=>$project,
'skills'=>$skill,
'country'=>$countries,
'countries'=>$countries,
'image' => $image
]);
}

public function save(Request $request)
{
return $request['video_filename'];

if (!empty($request)) {
return $request['video_filename'];
}
return "false";
// $tmp_name = $_FILES['video_filename'];
// return $tmp_name;

// foreach($request->formData.values()as $value) {
// return response()->json($value);
// }

// $file = $request->file("video-filename");
// return $file;

// return response()->json($request->file("formData"));
//
// foreach($request as $value) {
// return response()->json($value);
// }

// if(empty($request['video-filename'])) {
// return "true";
// }
// else{
// return "false";
// }
//

$fileName = '';
$tempName = '';

if (isset($request['audio_filename'])) {
$fileName = $request['audio_filename'];
$tempName = $_FILES['audio_blob']['tmp_name'];
} else {
$fileName = $request['video_filename'];
$tempName = $_FILES['video_blob']['tmp_name'];
}

if (empty($fileName) || empty($tempName)) {
echo 'PermissionDeniedError';
return;
}
$filePath = 'vidoes/' . $fileName;

// make sure that one can upload only allowed audio/video files
$allowed = array(
'webm',
'wav',
'mp4',
'mp3',
'ogg'
);
$extension = pathinfo($filePath, PATHINFO_EXTENSION);
if (!$extension || empty($extension) || !in_array($extension, $allowed)) {
// echo 'PermissionDeniedError';
return "PermissionDeniedError";
// continue;
}

if (!move_uploaded_file($tempName, $filePath)) {
// echo ('Problem saving file.');
return 'Problem saving file.';
}

return $filePath;
}

//insert data in profile

public function profiledata(Request $request)
{
// $request->validate([
// 'firstname' => 'required',
// 'lastname' => 'required',
// 'currentcompany' => 'required',
// 'country_id' => 'required',
// 'city' => 'required',
// 'date_of_birth' => 'required',
// 'gender' => 'required',
// 'experience' => 'required',
// 'degree_level' => 'required',
// 'salary' => 'required',
// 'job_city' => 'required',

// ]);
$userprofileid = $request->userprofile;
try {
$userId = auth()->id();

DB::beginTransaction();
$country= new Country();
$country->name =$request->input('country');
$profile = Profile::updateOrCreate(

['id' => $userprofileid],

[
'candidate_id'=>$userId,
'first_name' => $request->input('firstname'),
'last_name' => $request->input('lastname'),
'current_company' => $request->input('currentcompany'),
'date_of_birth'=>$request->input('date_of_birth'),
'gender' => $request->input('gender'),
'experience' => $request->input('experience'),
'salary' => $request->input('salary'),
'job_city' => $request->input('job_city'),
'degree_level' => $request->input('degree_level'),
'country_id' => $request->input('country'),
'city'=>$request->input('city')

]);
DB::commit();
return redirect('home');
} catch (\Exception $e) {
DB::rollback();
return $e->getMessage();
}
}

//insert data in awards

public function awarddata(Request $request)
{
$request->validate([
'title' => 'required',
'authority' => 'required',
'authority_date' => 'required',
'authority_url' => 'required',
]);

$awardid = $request->awardid;
try {
$userId = auth()->id();
DB::beginTransaction();

$award = Award::updateOrCreate(
['id' => $awardid],

[
'candidate_id' => $userId,
'title' => $request->input('title'),
'authority'=>$request->input('authority'),
'authority_date' => $request->input('authority_date'),
'authority_url' => $request->input('authority_url'),
]);
DB::commit();
return redirect('home');
} catch (\Exception $e) {
DB::rollback();
return $e->getMessage();
}
}

//insert data in summary

public function summary(Request $request)
{
$request->validate([
'summary' => 'required',
]);

try {

$userId = auth()->id();
DB::beginTransaction();

$summary = Summary::updateOrCreate(
['candidate_id' => $userId],

[
'summary' => $request->input('summary'),
]);
DB::commit();
return redirect('home');
} catch (\Exception $e) {
DB::rollback();
return $e->getMessage();
}
}

//insert data in project
public function project(Request $request) //insert data in project
{
$request->validate([
'title' => 'required',
'companyname' => 'required',
'projecturl' => 'required',
'clienturl' => 'required',
'clienname' => 'required',
'tools' => 'required',
'start_date' => 'required',
'end_date' => 'required',
'description' => 'required',
]);
$projectid = $request->userproject;
try {

$userId = auth()->id();
DB::beginTransaction();

$project = Project::updateOrCreate(
['id' => $projectid],

[
'candidate_id' => $userId,
'project_title' => $request->input('title'),
'company_name' => $request->input('companyname'),
'project_url' => $request->input('projecturl'),
'client_url' => $request->input('clienturl'),
'client_name' => $request->input('clienname'),
'tools' => $request->input('tools'),
'start_date' => $request->input('start_date'),
'End_date' => $request->input('end_date'),
'description' => $request->input('description')
]);
DB::commit();

return redirect('home');
} catch (\Exception $e) {
DB::rollback();
return $e->getMessage();
}
}

//insert data in certificate
public function certificate(Request $request)
{
$request->validate([
'certificate_name' => 'required',
'license_number' => 'required',
'certificate_authority' => 'required',
'certificate_url' => 'required',
'date' => 'required'
]);
$certificateid=$request->usercertificate;
try {

$userId = auth()->id();
DB::beginTransaction();

$certificate = Certificate::updateOrCreate(
['id'=>$certificateid,
],

[
'candidate_id' => $userId,
'certificate_name' => $request->input('certificate_name'),
'license_number' => $request->input('license_number'),
'certificate_authority' => $request->input('certificate_authority'),
'certificate_url' => $request->input('certificate_url'),
'completion_date' => $request->input('date'),
]);
DB::commit();

return redirect('home');
} catch (\Exception $e) {
DB::rollback();
return $e->getMessage();
}
}

//insert data in work experience
public function workex(Request $request)
{
$request->validate([
'jobtitle' => 'required',
'companyname' => 'required',
'referenceemail' => 'required',
'referencenumber' => 'required',
'country' => 'required',
'city' => 'required',
'startdate' => 'required',
'enddate' => 'required',
'description' => 'required',
]);
$userexprienceid=$request->userexperience;
try {
DB::beginTransaction();

$userId = auth()->id();
$workexperience = WorkExperience::updateOrCreate(
['id'=>$userexprienceid,
],
[
'candidate_id' => $userId,
'job_titile' => $request->input('jobtitle'),
'company_name' => $request->input('companyname'),
'reference_email' => $request->input('referenceemail'),
'reference_number' => $request->input('referencenumber'),
'country_id' => $request->input('country'),
'city' => $request->input('city'),
'start_date' => $request->input('startdate'),
'end_date' => $request->input('enddate'),
'description' => $request->input('description')
]);
DB::commit();
return redirect('home',);
} catch (\Exception $e) {
DB::rollback();
return $e->getMessage();
}
}


//insert data in education
public function educations(Request $request)
{
$request->validate([
'degreetitle' => 'required',
'degreelevel' => 'required',
'major' => 'required',
'institute' => 'required',
'location' => 'required',
'yearcomplete'=>'required'
]);
$educationid = $request->usereducation;
try {
$userId = auth()->id();
DB::beginTransaction();
$education = Education::updateOrCreate(

['id'=>$educationid,
],
[
'candidate_id' => $userId,
'degree_title' => $request->input('degreetitle'),
'degree_level' => $request->input('degreelevel'),
'major' => $request->input('major'),
'institute' => $request->input('institute'),
'location' => $request->input('location'),
'yearcomplete' => $request->input('yearcomplete'),
'type' => ( $request->input('method') == 'cgpa' ) ? 'cgpa' : 'percentage',
'marks' => $request->input('marks'),
]);
DB::commit();
return redirect('home');
} catch (\Exception $e) {
DB::rollback();
return $e->getMessage();
}
}
// create and update skills
public function skills(Request $request)
{
$userskillid = $request->userskill;
try{

$userId = auth()->id();

$skill = Skill::updateOrCreate(
['id' => $userskillid],
[
'candidate_id'=> $userId,
'skill' => $request->input('skill'),
'rating'=> $request->input('rating')
]);
return redirect('home');
}
catch (\Exception $e) {
DB::rollback();
return $e->getMessage();
}
}
//create and update image
public function imageupload(Request $request)
{
if ($request->hasFile('files')) {
$imagePath = $request->file('files');
$imageName = $imagePath->getClientOriginalName();
$path = $request->file('files')->storeAs('uploads', $imageName, 'public');
}
$imagePath = asset('storage/uploads/'.$imageName);
$imageid = $request->imageid;
$image = Image::updateOrCreate(
[
'id' => $imageid,
],
[
'candidate_id' => auth()->id(),
'imagename' => $imageName,
]);
return response()->json(
['imagepath' => $imageName] , 200);
}
public function show(Request $request)
{

$record = DB::table('awards')->where('id',$request->awardid)->first();

return response()->json($record);
}
public function certificateshow(Request $request)
{

$record = DB::table('certificates')->where('id' , $request->certificateid)->first();

return response()->json($record);
}

public function projectshow(Request $request)
{

$record = DB::table('projects')->where('id',$request->projectid)->first();

return response()->json($record);
}
public function educationshow(Request $request)
{
$record = DB::table('educations')->where('id',$request->educationid)->first();

return response()->json($record);

}
public function profileshow(Request $request)
{
$id = $request->countryid;

$country = DB::table('countries')->where('id',$id)->first('country_name');

$record = DB::table('profiles')->where('id',$request->profileid)->first();

return response()->json(array(
'record' => $record,
'country' => $country
));
}
public function experienceshow(Request $request)
{
$record = DB::table('workexperiences')->where('id',$request->workexperienceid)->first();

return response()->json($record);
}
public function skillshow(Request $request)
{
$record = DB::table('skills')->where('id',$request->skillsid)->first();
return response()->json($record);
}
}


