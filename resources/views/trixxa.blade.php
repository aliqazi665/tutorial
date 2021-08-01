@extends('frontend.layouts.app' , ['header' => false, 'footer' => false])

@section('title', 'Page Title')

@section('customCSS')
    {{-- Your custome css... --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap2/bootstrap-switch.css"rel="stylesheet" /> --}}
@endsection

@section('content')
    @include('frontend.layouts.navbar')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        /*.btn {*/
        /*  border: 2px solid gray;*/
        /*  color: gray;*/
        /*  background-color: white;*/
        /*  padding: 8px 20px;*/
        /*  border-radius: 8px;*/
        /*  font-size: 20px;*/
        /*  font-weight: bold;*/
        /*}*/
        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }

    </style>

    <div class="container-fluid profile-wrapper p-0">
        <div class="row mar-width-0 purple-bg">
        </div>
        <div class="row mar-width-0 profile-wrap">
            <div class="col-md-3 profile-wrap-left">
                <div class="row mar-width-0 profilePic__">
                    <form    id="upload-image-form" enctype="multipart/form-data">
                        @csrf
                        <div class="image-container" style="margin-left: 32%;">
                            @if ($image)
                                <img src="{{ URL::asset('storage/uploads/' . $image->imagename) }}"
                                    style="  border-radius: 50%;width:180px;height: 180px;margin-top: -41px;" alt=""
                                    id="imageurl">
                                <input type="hidden" value="{{ $image->id }}" name="imageid" id="imageid">
                            @else
                                <input type="hidden" name="" id="">
                            @endif
                            <div class="after" style="margin-top: -23%;">
                                <div class="upload-btn-wrapper">
                                    <a id="upload_link">change or upload a photo</a>
                                    <input id="fileupload" type="file" name="files">
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="row mar-width-0 mt-5 skills__">
                    <div class="row mar-width-0 mb-4">
                        <div class="col-md-8">
                            <h4 class="short-line">Skills</h4>
                        </div>
                        <div class="col-md-4 text-right">
                            <img data-toggle="modal" data-target="#exampleModalSkills" onclick="myfunction(0)"
                                src="{{ asset('images/editIcon.png') }}" class="edit-icon" alt="">
                        </div>
                    </div>
                    @foreach ($skills as $item)
                        <div class="col-md-4 text-right" style="margin-left: 56%;">
                            <img data-toggle="modal" data-target="#exampleModalSkills " data-skill="{{ $item->id ?? '' }}"
                                src="{{ asset('images/editIcon.png') }}" class="edit-icon" alt="" style="width: 20px">
                        </div>
                        <div class="row mar-width-0 pl-3">
                            <div class="col-12 mb-3">
                                <h6>{{ $item->skill }}</h6>
                                <div class="col-12">
                                    @for ($d = 1; $d <= 5; $d++)
                                        <span class="@if ($d <=$item->rating) skill_1
                                        @else skill_0 @endif" ></span>
                                    @endfor
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-9 profile-wrap-right p-0">
                <div class="row mar-width-0 profile-summary bg-white mb-3 p-3">
                    <div class="col-md-4 b2 profile-summary-left">
                        <div class="row mar-width-0">
                            <div class="col-md-12 ">
                                <p class="m-0 text-right">

                                    <img data-toggle="modal" data-profile="{{ $profile->id ?? '' }}"
                                        data-target="#exampleModalProfile" src="{{ asset('images/editIcon.png') }}"
                                        class="edit-icon2" alt="">
                                </p>
                                <input type="hidden" id="countryid" value="{{ $profile->country_id ?? '' }}   ">
                                <div>
                                    <label style="font-size: 20px;font-weight: 600;" for="">Name :</label>
                                    <span>{{ $profile->first_name ?? '' }}</span>
                                    <span>{{ $profile->last_name ?? '' }}</span>
                                </div>
                                <div>
                                    <label style="font-size: 20px;font-weight: 600;" for="">Current company :</label>
                                    <span> {{ $profile->current_company ?? '' }}</span>
                                </div>
                                <div>
                                    <label style="font-size: 20px;font-weight: 600;" for="">Total Experience :</label>
                                    <span>{{ $profile->experience ?? '' }}</span>
                                </div>
                                <div>
                                    <label style="font-size: 20px;font-weight: 600;" for="">Country :</label>
                                    <span>{{ $profile->country->country_name ?? '' }}</span>
                                </div>
                                <div>
                                    <label style="font-size: 20px;font-weight: 600;" for="">Your City :</label>
                                    <span>{{ $profile->city ?? '' }}</span>
                                </div>
                                <div>
                                    <label style="font-size: 20px;font-weight: 600;" for="">Job City :</label>
                                    <span>{{ $profile->job_city ?? '' }}</span>
                                </div>
                                <div>
                                    <label style="font-size: 20px;font-weight: 600;" for="">Date of Birth :</label>
                                    <span>{{ $profile->date_of_birth ?? '' }}</span>
                                </div>
                                <div>
                                    <label style="font-size: 20px;font-weight: 600;" for="">Gender :</label>
                                    <span>{{ $profile->gender ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 profile-summary-right">
                        <div class="row mar-width-0">
                            <div class="col-md-12 text-right mb-4">
                                <a href="#" class="Cv_1"><i class="fa fa-camera"></i> Record your CV?</a>
                                <a href="#" class="Cv_2">Already Have CV?</a>
                            </div>
                        </div>
                        <div class="row mar-width-0">
                            <div class="col-md-6">
                                <h3 class="short-line">Summary</h3>
                            </div>
                            <div class="col-md-6 text-right pt-2">
                                <img data-toggle="modal" data-target="#exampleModalSummary"
                                    src="{{ asset('images/editIcon.png') }}" class="edit-icon2" alt="">
                            </div>
                            <div class="col-md-12 pt-3">
                                <p class="color-1">
                                    {{ $summar->summary ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <label for="time-interval">Time Interval (milliseconds):</label>
                <input type="text" id="time-interval" value="60000">
                <select id="video-recorderType" style="font-size:22px;vertical-align: middle;margin-right: 5px;">
                    <option value="[Best Available Recorder]">[Best Available Recorder]</option>
                    <option value="MediaRecorder API">MediaRecorder API</option>
                    <option value="WebP encoding into WebM">WebP encoding into WebM</option>
                </select>
                <button id="start-recording">Start</button>
                <button id="stop-recording" disabled>Stop</button>
                <button id="pause-recording" disabled>Pause</button>
                <button id="resume-recording" disabled>Resume</button>
                <button id="save-recording" disabled>Save</button>
                <br>
                <br>
                <label for="video-width">Video Width:</label>
                <input type="text" id="video-width" value="320">
                <label for="video-height">Video Height:</label>
                <input type="text" id="video-height" value="240">
                <section class="experiment">
                    <div id="videos-container">
                    </div>
                </section>
                <div class="row mar-width-0 profile-work bg-white mb-3 p-3">
                    <div class="row mar-width-0">
                        <div class="col-md-6">
                            <h4 class="short-line">
                                <img src="{{ asset('images/profile-1.png') }}" class="pro-icon" alt=""> Work Experience
                            </h4>
                        </div>
                        <div class="col-md-6 ">
                            <p class="m-0 text-right">
                                <img data-toggle="modal" data-target="#exampleModalWork"
                                    src="{{ asset('images/editIcon.png') }}" class="edit-icon2" alt="">
                            </p>
                        </div>

                        @foreach ($work as $item)
                            <div style=" width: 23%;margin-left: 74%;margin-top: 2%;">
                                <p class="m-0 text-right">
                                    <img data-toggle="modal" data-workid="{{ $item->id }}"
                                        data-target="#exampleModalWork" src="{{ asset('images/editIcon.png') }}"
                                        class="edit-icon2" alt="">
                                </p>
                                <input type="hidden" id="experiencecountryid" value="{{ $item->country_id }}">

                            </div>
                            <div style="width: 19%; ">
                                <label style="font-size: 20px;font-weight: 600;" for="">Job Title :</label>
                                <span> {{ $item->job_titile }}</span>
                            </div>

                            <br>
                            <div style="margin-left: 7%;">
                                <label style="font-size: 20px;font-weight: 600;" for="">Company Name :</label>
                                <span> {{ $item->company_name }}</span>
                            </div>

                            <div style="width: 32%;margin-left: 5%;">
                                <label style="font-size: 20px;font-weight: 600;" for="">Reference Email :</label>
                                <span> {{ $item->reference_email }}</span>
                            </div>
                            <div style="width: 25%">
                                <label style="font-size: 20px;font-weight: 600;" for="">Reference Number :</label>
                                <span> {{ $item->reference_number }}</span>
                            </div>
                            <div style="width: 28%; margin-left: 11px;">
                                <label style="font-size: 20px;font-weight: 600;" for="">Countrty :</label>
                                <span>{{ $item->countries->country_name }}</span>

                            </div>

                            <div style="width: 34%">
                                <label style="font-size: 20px;font-weight: 600;" for="">City :</label>
                                <span> {{ $item->city }}</span>
                            </div>
                            <div style="width: 26%">
                                <label style="font-size: 20px;font-weight: 600;" for="">Joining Date :</label>
                                <span> {{ $item->start_date }}</span>
                            </div>
                            <div>
                                <label style="font-size: 20px;font-weight: 600;" for="">Leaving Date :</label>
                                <span> {{ $item->end_date }}</span>
                            </div>
                            <div style="width: 100%">
                                <label style="font-size: 20px;font-weight: 600;" for="">Job Description :</label>
                                <span> {{ $item->description }}</span>
                            </div>
                            <br> <br> <br>

                        @endforeach
                    </div>
                </div>
                <div class="row mar-width-0 profile-education bg-white mb-3 p-3">
                    <div class="row mar-width-0">
                        <div class="col-md-6 pb-2">
                            <h4 class="short-line">
                                <img src="{{ asset('images/profile-4.png') }}" class="pro-icon" alt=""> Education Detail
                            </h4>
                        </div>
                        <div class="col-md-6 ">
                            <p class="m-0 text-right">
                                <img data-toggle="modal" data-toggle="modal" data-target="#exampleModalEducation"
                                    src="{{ asset('images/editIcon.png') }}" class="edit-icon2" alt="">
                            </p>
                        </div>
                        <div class="card" style="width: 18rem;">
                            @foreach ($education as $edu)

                                <div class="card-body">
                                    <div class="col-md-6 " style=" width: 23%;margin-left: 74%;margin-top: 2%;">
                                        <p class="m-0 text-right">
                                            <img data-toggle="modal" data-education="{{ $edu->id }}"
                                                data-target="#exampleModalEducation"
                                                src="{{ asset('images/editIcon.png') }}" class="edit-icon2" alt="">
                                        </p>
                                    </div>
                                    <div class="col-md-12 pt-2 profile-education-inner__">
                                        <strong>{{ $edu->degree_level }}</strong>
                                        <strong>Degree Title</strong>
                                        <p>{{ $edu->degree_title }}</p>
                                        <strong>Major subject</strong>
                                        <p>{{ $edu->major }}</p>
                                        <strong>Institute Name</strong>
                                        <p>{{ $edu->institute }}</p>
                                        <strong>Institute Address</strong>
                                        <p>{{ $edu->location }}</p>
                                        <strong>Year Complete</strong>
                                        <p>{{ $edu->yearcomplete }}</p>
                                        @if ($edu->type == 'percentage')
                                            <strong>Percentage</strong>
                                            <p>{{ $edu->marks }}</p>
                                        @else
                                            <strong>cpga</strong>
                                            <p>{{ $edu->marks }}</p>
                                        @endif
                                    </div>

                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
                <div class="row mar-width-0 profile-education bg-white mb-3 p-3">
                    <div class="row mar-width-0">
                        <div class="col-md-6 pb-2">
                            <h4 class="short-line">
                                <img src="{{ asset('images/profile-2.png') }}" class="pro-icon" alt=""> Certificates
                            </h4>
                        </div>
                        <div class="col-md-6 ">
                            <p class="m-0 text-right">
                                <img data-toggle="modal" data-target="#exampleModalCertificates"
                                    src="{{ asset('images/editIcon.png') }}" class="edit-icon2" alt="">
                            </p>
                        </div>
                        <div class="card" style="width: 18rem;">
                            @foreach ($certificates as $certificate)
                                <div class="card-body">
                                    <div class="col-md-6 " style=" width: 23%;margin-left: 74%;margin-top: 2%;">
                                        <p class="m-0 text-right">
                                            <img data-toggle="modal" data-certificateid="{{ $certificate->id }}"
                                                data-target="#exampleModalCertificates"
                                                src="{{ asset('images/editIcon.png') }}" class="edit-icon2" alt="">
                                        </p>
                                    </div>
                                    <div class="col-md-12 pt-2 profile-education-inner__">
                                        <strong for="">Certificate Name</strong>
                                        <p>{{ $certificate->certificate_name ?? '' }}</p>
                                        <strong for="">License Number</strong>
                                        <p>{{ $certificate->license_number ?? '' }}</p>
                                        <strong for="">Certificate Owner</strong>
                                        <p>{{ $certificate->certificate_authority ?? '' }}</p>
                                        <strong for="">Certificate Url</strong>
                                        <a href="">
                                            <p>{{ $certificate->certificate_url ?? '' }}</p>
                                        </a>
                                        <strong for="">Certificate Date</strong>
                                        <p>{{ $certificate->completion_date ?? '' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row mar-width-0 profile-education bg-white mb-3 p-3">
                    <div class="row mar-width-0">
                        <div class="col-md-6 pb-2">
                            <h4 class="short-line">
                                <img src="{{ asset('images/profile-3.png') }}" class="pro-icon" alt=""> Awards
                            </h4>
                        </div>
                        <div class="col-md-6 ">
                            <p class="m-0 text-right">
                                <img data-toggle="modal" data-target="#exampleModalAwards"
                                    src="{{ asset('images/editIcon.png') }}" class="edit-icon2" alt="">
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @foreach ($award as $awards)
                                <div class="card">
                                    <div class="col-md-6 " style=" width: 23%;margin-left: 74%;margin-top: 2%;">
                                        <p class="m-0 text-right userAwards">
                                            <img data-toggle="modal" data-award="{{ $awards->id }}"
                                                data-target="#exampleModalAwards"
                                                src="{{ asset('images/editIcon.png') }}" class="edit-icon2" alt="">
                                        </p>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12 pt-2 profile-education-inner__">
                                            <strong for="">Award Date</strong>
                                            <p>{{ $awards->authority_date ?? '' }}</p>
                                            <strong for="">Award title</strong>
                                            <p>{{ $awards->title ?? '' }}</p>
                                            <strong for="">Award Url</strong>
                                            <p>{{ $awards->authority_url ?? '' }}</p>
                                            <strong for="">Award Authority</strong>
                                            <p>{{ $awards->authority ?? '' }}</p>

                                        </div>
                                    </div>
                                </div>
                                <br>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row mar-width-0 profile-education bg-white mb-3 p-3">
                    <div class="row mar-width-0">
                        <div class="col-md-6 pb-2">
                            <h4 class="short-line">
                                <img src="{{ asset('images/profile-2.png') }}" class="pro-icon" alt="">
                                Projects
                            </h4>
                        </div>
                        <div class="col-md-6 ">
                            <p class="m-0 text-right">
                                <img data-toggle="modal" data-target="#exampleModalProjects"
                                    src="{{ asset('images/editIcon.png') }}" class="edit-icon2" alt="">
                            </p>
                        </div>

                        <div class="col-md-5  pt-3">
                            <div class="row mar-width-0">
                                @foreach ($project as $project)
                                    <div class="col-md-6 " style=" width: 23%;margin-left: 84%;margin-top: 2%;">
                                        <p class="m-0 text-right">
                                            <img data-toggle="modal" data-target="#exampleModalProjects"
                                                data-project="{{ $project->id }}"
                                                src="{{ asset('images/editIcon.png') }}" class="edit-icon2" alt="">
                                        </p>
                                    </div>
                                    <div class="col-md-5">
                                        <strong>Project Name:</strong>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $project->project_title }}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <strong>Company Name:</strong>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $project->company_name }}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <strong> Project url</strong>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $project->project_url }}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <strong>Client Url:</strong>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $project->client_url }}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <strong>Client Name:</strong>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $project->client_name }}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <strong>Tool Name:</strong>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $project->tools }}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <strong>Tool Name:</strong>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $project->tools }}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <strong>Start Date:</strong>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $project->start_date }}</p>
                                    </div>

                                    <div class="col-md-5">
                                        <strong>End Date:</strong>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $project->End_date }}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <strong>Description:</strong>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $project->description }}</p>
                                    </div>
                                @endforeach
                                <br> <br> <br>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalSkills" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-dark">
                    <form class="w-100" method="POST" action="{{ url('home/skills') }}" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="row mar-width-0 modal-head">
                                    <h4>Add Skills</h4>
                                </div>
                                <div class="row mar-width-0 modal-body-data">
                                    <div class="form-group">
                                        <label for="skillsname">Add Skill</label>
                                        <select class="form-control" id="skillsname" name="skill">
                                            <option selected disabled>Enter Skill</option>
                                            <option>Mysql</option>
                                            <option>Database Administration</option>
                                            <option>Laravel</option>
                                            <option>Vuejs</option>
                                            <option>Python</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            please provide you skill
                                        </div>
                                        <div class="valid-feedback">
                                        </div>
                                    </div>

                                </div>
                                <div id="showUserSkill">
                                    <span class="skill_0 "></span>
                                    <span class="skill_0 "></span>
                                    <span class="skill_0 "></span>
                                    <span class="skill_0 "></span>
                                    <span class="skill_0 "></span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="rating" id="ratingid" value="">
                        <input type="hidden" name="userskill" id="userskills" value="">
                        <div class="modal-footer modal-foot">
                            <button type="submit" class="btn btn-primary btn-modal-save">Save</button>
                            <button type="button" class="btn btn-secondary btn-modal-cancel"
                                data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-dark">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row mar-width-0 modal-head">
                                <h4> <img src="{{ asset('images/modal-profile.png') }}" class="edit-icon3" alt=""> Edit
                                    Profile
                                </h4>
                            </div>
                            <div class="row mar-wi
                                dth-0 modal-body-data">
                                <form id="profileFormData" method="POST" action="{{ url('home/profiles') }}"
                                    class="needs-validation" novalidate>
                                    @csrf
                                    <div class="row mar-width-0">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="firstname">First Name</label>
                                                <input type="text" class="form-control firstname" name="firstname"
                                                    id="firstname" required value="">
                                                <div class="invalid-feedback">
                                                    please provide a valid first name
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lastname">Last Name</label>
                                                <input type="text" class="form-control lastname" name="lastname"
                                                    id="lastname" required value="">
                                            </div>
                                            <div class="invalid-feedback">
                                                please provide a valid last name
                                            </div>
                                            <div class="valid-feedback">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="ccompany">Current Company</label>
                                                <input type="text" class="form-control currentcompany" name="currentcompany"
                                                    id="ccompany" required value="">
                                                <div class="invalid-feedback">
                                                    please provide a your company name
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                @if ($profile)
                                                    <select class="form-control country selectpicker countrypicker"
                                                        name="country" id="country" required>
                                                        @foreach ($country as $item)
                                                            <option @if ($item->id == $profile->country->id) selected @endif
                                                                value="{{ $item->id }}">{{ $item->country_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select class="form-control country selectpicker countrypicker"
                                                        name="country" id="country" required>
                                                        @foreach ($country as $item)
                                                            <option value="{{ $item->id }}">{{ $item->country_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif

                                                <div class="invalid-feedback">
                                                    please provide a your country name
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control city" name="city" id="city" required
                                                    value="">
                                                <div class="invalid-feedback">
                                                    please provide a your city name
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dob">Date of Birth</label>
                                                <input type="date" class="form-control date_of_birth" name="date_of_birth"
                                                    id="dob" required value="">
                                                <div class="invalid-feedback">
                                                    please provide your date of birth
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select class="form-control gender" name="gender" id="gender" required>
                                                    <option value="">
                                                        Select your option
                                                    </option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    please provide a your gender
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="experience">Experience</label>
                                                <select class="form-control experience" name="experience" id="experience"
                                                    required value="">
                                                    <option value="">
                                                        Select your year of expeerience
                                                    </option>
                                                    <option>1 Year</option>
                                                    <option>2 Year</option>
                                                    <option>3 Year</option>
                                                    <option>4 Year</option>
                                                    <option>6 Year</option>
                                                    <option>7 Year</option>
                                                    <option>8 Year</option>
                                                    <option>9 Year</option>
                                                    <option>10 Year</option>
                                                    <option>11Year</option>
                                                    <option>12 Year</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    please provide your total experience
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="degreel">Degree Level</label>
                                                <select class="form-control degree_level" name="degree_level" id="degreel"
                                                    required value="">
                                                    <option value="">Select your Highest Degree</option>
                                                    <option>School</option>
                                                    <option>High School</option>
                                                    <option>Bachelor</option>
                                                    <option>Masters</option>
                                                    <option>Php</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    please provide your degree level
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="salary">Salary </label>
                                                <select class="form-control salary" name="salary" id="salary" required>
                                                    <option value="">
                                                    </option>
                                                    <option value="10000">10000</option>
                                                    <option value="20000">20000</option>
                                                    <option value="30000">30000</option>
                                                    <option value="40000">40000</option>
                                                    <option value="50000"> 50000</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    please provide your salary
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jobcity">Job City</label>
                                                <input type="text" class="form-control job_city" name="job_city"
                                                    id="jobcity" required value="">
                                                <div class="invalid-feedback">
                                                    please provide your job city
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="userprofile" name="userprofile" value="">
                                    <div class="modal-footer modal-foot">
                                        <button type="submit" class="btn btn-primary btn-modal-save  savedata"
                                            id="hello">Save</button>
                                        <button type="button" class="btn btn-secondary btn-modal-cancel"
                                            data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalSummary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-dark">
                    <form method="POST" action="{{ url('home/summary') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="row mar-width-0 modal-head">
                                    <h4><img src="{{ asset('images/modal-summary.png') }}" alt=""> Summary</h4>
                                </div>
                                <div class="row mar-width-0 modal-body-data">
                                    <div class="form-group" style="width: 100%">
                                        <label for="summary">Enter summary here</label>
                                        <textarea class="form-control" type="text" id="summary" name="summary"
                                            required>{{ $summar->summary ?? '' }}</textarea>
                                        <div class="invalid-feed
                                                please provide a detailed summary
                                            </div>
                                            <div class=" valid-feedback">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modal-foot">
                            <button type="submit" class="btn btn-primary btn-modal-save">Save</button>
                            <button type="button" class="btn btn-secondary btn-modal-cancel"
                                data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalWork" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-dark">
                    <div class="modal-body">
                        <form method="POST" action="{{ url('home/workexperience') }}" class="needs-validation"
                            novalidate>
                            @csrf
                            <div class="col-md-12">
                                <div class="row mar-width-0 modal-head">
                                    <h4> <img src="{{ asset('images/modal-work.png') }}" class="edit-icon3" alt=""> Work
                                        Experience
                                    </h4>
                                </div>
                                <div class="row mar-width-0 modal-body-data">
                                    <div class="row mar-width-0">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jobtitle">Job Title</label>
                                                <select class="form-control" id="jobtitle" name="jobtitle" required>
                                                    <option value="" disabled selected>Select your job title</option>
                                                    <option>CEO</option>
                                                    <option>Develper</option>
                                                    <option>Quality Assurance</option>
                                                    <option>jr Developer</option>
                                                    <option>Sr Developer</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    please provide a job title
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="compamyname">Company Name</label>
                                                <input type="text" class="form-control" name="companyname" id="compamyname"
                                                    required>
                                                <div class="invalid-feedback">
                                                    please provide a company name
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="remail">Reference Email</label>
                                                <input type="email" class="form-control" name="referenceemail" id="remail"
                                                    required>
                                                <div class="invalid-feedback">
                                                    please provide a reference email
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rnumber">Reference Number</label>
                                                <input type="number" class="form-control" name="referencenumber"
                                                    id="rnumber" required>
                                                <div class="invalid-feedback">
                                                    please provide a reference number
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <select class="form-control country selectpicker countrypicker"
                                                    name="country" id="country" required>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">
                                                            {{ $country->country_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    please provide a your country name
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="expcity">City</label>
                                                <input type="text" class="form-control" name="city" id="expcity" required>
                                                <div class="invalid-feedback">
                                                    please provide a city name
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sdate">Start Date</label>
                                                <input type="date" class="form-control" name="startdate" id="sdate"
                                                    placeholder="From" required>
                                                <div class="invalid-feedback">
                                                    please provide start date
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="edate">End Date</label>
                                                <input type="date" class="form-control" id="edate" name="enddate"
                                                    placeholder="From" required>
                                                <div class="invalid-feedback">
                                                    please provide a end date
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="7"
                                                    placeholder="Type text here" required></textarea>
                                                <div class="invalid-feedback">
                                                    please provide description
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="userexperience" name="userexperience" value="">
                            <div class="modal-footer modal-foot">
                                <button type="submit" class="btn btn-primary btn-modal-save">Save</button>
                                <button type="button" class="btn btn-secondary btn-modal-cancel"
                                    data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalEducation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-dark">
                    <form action="{{ url('home/education') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="row mar-width-0 modal-head">
                                    <h4> <img src="{{ asset('images/modal-edu.png') }}" class="edit-icon3" alt=""> Add
                                        Education
                                    </h4>
                                </div>
                                <div class="row mar-width-0 modal-body-data">
                                    <div class="row mar-width-0">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="degreename">Degree Title</label>
                                                <input type="text" class="form-control" name="degreetitle" id="degreename"
                                                    required>
                                                <div class="invalid-feedback">
                                                    please add degree title
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="level">Degree Level</label>
                                                <select class="form-control" name="degreelevel" id="level" required>
                                                    <option value="" disabled selected>Select your degree</option>
                                                    <option>Matric</option>
                                                    <option>Intermidiate</option>
                                                    <option>bachelor</option>
                                                    <option>Masters</option>
                                                    <option>Phd</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    please provide degree level
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="subjects">Majors</label>
                                                <select class="form-control" name="major" id="subjects" required>
                                                    <option>Computer</option>
                                                    <option>Physics</option>
                                                    <option>Chemistry</option>
                                                    <option>Biology</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    please add your major subject
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="institute">Institute</label>
                                                <input type="text" class="form-control" name="institute" id="institute"
                                                    <label for="institute">Institute</label>

                                                required>
                                                <div class="invalid-feedback">
                                                    Enter your institute name
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="location">Location</label>
                                                <input type="text" class="form-control" name="location" id="location"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Entere your location
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="completeyear">Year Completion</label>
                                                <input type="text" class="form-control" name="yearcomplete"
                                                    id="completeyear" required>
                                                <div class="invalid-feedback">
                                                    Enter your degree completion year
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail3">Method</label>
                                                <div class="w-100"></div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="method" value="cgpa"
                                                        id="inlineRadio1" value="option1" required>
                                                    <label class="form-check-label" for="inlineRadio1">CGPA</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="method"
                                                        value="percentage" id="inlineRadio2" value="option2" required>
                                                    <label class="form-check-label" for="inlineRadio2">Percentage</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="cpga">
                                            <div class="form-group">
                                                <label for="mark">CGPA / Percentage</label>
                                                <input step="any" type="number" class="form-control" name="marks" id="mark"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="usereducationid" name="usereducation" value="">
                        <div class="modal-footer modal-foot">
                            <button type="submit" class="btn btn-primary btn-modal-save">Save</button>
                            <button type="button" class="btn btn-secondary btn-modal-cancel"
                                data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalAwards" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-dark">
                    <form method="POST" action="{{ url('home/awards') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="row mar-width-0 modal-head">
                                    <h4> <img src="{{ asset('images/modal-awards.png') }}" class="edit-icon3" alt=""> Add
                                        Awards
                                    </h4>
                                </div>
                                <div class="row mar-width-0 modal-body-data">
                                    <div class="row mar-width-0">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" id="title" class="form-control" name="title" required>
                                                <div class="invalid-feedback">
                                                    please add your title
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="owner">Authority</label>
                                                <input type="text" id="owner" class="form-control" name="authority"
                                                    required>
                                                Please enter owner of award
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="date">Date</label>
                                                <input type="date" class="form-control" name="authority_date" id="date"
                                                    required>
                                                <div class="invalid-feedback">
                                                    please add date of award
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="url">Award URL</label>
                                                <input type="text" class="form-control" name="authority_url" id="url"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Enter award url
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="userAwardId" name="awardid" value="">
                        <div class="modal-footer modal-foot">
                            <button type="submit" class="btn btn-primary btn-modal-save">Save</button>
                            <button type="button" class="btn btn-secondary btn-modal-cancel"
                                data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalProjects" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-dark">
                    <div class="modal-body">
                        <form method="POST" action="{{ url('home/projects') }}" class="needs-validation" novalidate>
                            @csrf
                            <div class="col-md-12">
                                <div class="row mar-width-0 modal-head">
                                    <h4> <img src="{{ asset('images/modal-summary.png') }}" class="edit-icon3" alt="">
                                        Add
                                        Project
                                    </h4>
                                </div>
                                <div class="row mar-width-0 modal-body-data">
                                    <div class="row mar-width-0">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projecttitle">Project Title</label>
                                                <input type="text" class="form-control" name="title" id="projecttitle"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Enter your project title
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="companyname">Company Name</label>
                                                <input type="text" class="form-control" name="companyname" id="companyname"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Enter your company name
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projecturl">Project URL</label>
                                                <input type="text" class="form-control" name="projecturl" id="projecturl"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Enter you project url
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="clienturl">Client URL</label>
                                                <input type="text" class="form-control" name="clienturl" id="clienturl"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Enter your client url
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="clientname">Client Name</label>
                                                <input type="text" class="form-control" name="clienname" id="clientname"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Enter your client name
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projecttools">Tools</label>
                                                <input type="text" class="form-control" name="tools" id="projecttools"
                                                    required>
                                                <div class="invalid-feedback">
                                                    please enter tools that used
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectstartdate">Start Project Date</label>
                                                <input type="date" class="form-control" name="start_date"
                                                    id="projectstartdate" placeholder="From" required>
                                                <div class="invalid-feedback">
                                                    Enter the start date of project
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectenddate">End project date</label>
                                                <input type="date" class="form-control" name="end_date" id="projectenddate"
                                                    placeholder="From" required>
                                                <div class="invalid-feedback">
                                                    Enter your project end date
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectdescription">Description</label>
                                                <textarea class="form-control" id="projectdescription" name="description"
                                                    rows="7" placeholder="Type text here" required></textarea>
                                                <div class="invalid-feedback">
                                                    please provide a description of project
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="userprojectid" name="userproject" value="">
                            <div class="modal-footer modal-foot">
                                <button type="submit" class="btn btn-primary btn-modal-save">Save</button>
                                <button type="button" class="btn btn-secondary btn-modal-cancel"
                                    data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalCertificates" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-dark">
                    <form method="POST" action="{{ url('home/certificates') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="row mar-width-0 modal-head">
                                    <h4> <img src="{{ asset('images/modal-summary.png') }}" class="edit-icon3" alt="">
                                        Add
                                        Certification
                                    </h4>
                                </div>
                                <div class="row mar-width-0 modal-body-data">
                                    <div class="row mar-width-0">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="certificatename">Certification Name</label>
                                                <input type="text" class="form-control" name="certificate_name"
                                                    id="certificatename" required>
                                                <div class="invalid-feedback">
                                                    please provide a certificate name
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="licensenumber">License Number / Enrollment Number</label>
                                                <input type="number" class="form-control" name="license_number"
                                                    id="licensenumber" required>
                                                <div class="invalid-feedback">
                                                    please provide a License Number / Enrollment Number
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="certificateowner">Certification Authority</label>
                                                <input type="text" class="form-control" name="certificate_authority"
                                                    id="certificateowner" required>
                                                <div class="invalid-feedback">
                                                    please provide a owner of certificate
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="certificateurl">Certification URL</label>
                                                <input type="url" class="form-control" name="certificate_url"
                                                    id="certificateurl" required>
                                                <div class="invalid-feedback">
                                                    please provide a certificate url
                                                </div>
                                                <div class="valid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="enddate">Completion Date</label>
                                                <input type="date" class="form-control" name="date" id="enddate" required>
                                                <div class="invalid-feedback">
                                                    please provide a completion date
                                                </div>
                                                <div class="valid-fead_raedback">
                                                    <div class="valid-fead_raedback">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="usercertificateid" name="usercertificate" value="">
                            <div class="modal-footer modal-foot">
                                <button type="submit" class="btn btn-primary btn-modal-save">Save</button>
                                <button type="button" class="btn btn-secondary btn-modal-cancel"
                                    data-dismiss="modal">Cancel</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>


    @endsection

    @push('javascript')

        <script type="text/javascript">
            function myfunction(param) {
                $('#showUserSkill').empty()
                if (param == 0) {
                    for (var i = 0; i < 5; i++) {
                        var data = '<span class="skill_0"></span>'
                        $('#showUserSkill').append(data);
                    }
                    var skillArr = $("#showUserSkill  span");
                    skillArr.each(function(i, e) {
                        $(this).on('click', function() {
                            for (var d = 0; d <= i; d++) {
                                $(skillArr[d]).removeClass('skill_0').addClass('skill_1');
                            }
                            for (j = i + 1; j <= 5; j++) {
                                $(skillArr[j]).removeClass('skill_1').addClass('skill_0');
                            }
                            var rating = i + 1;
                            $('#ratingid').val(rating);
                        });
                    });
                } else {
                    for (var i = 0; i < param; i++) {
                        var data = '<span class="skill_1"></span>'
                        $('#showUserSkill').append(data);
                    }
                    for (var j = 0; j < 5 - param; j++) {
                         var data = '<span class="skill_0"></span>'
                        $('#showUserSkill').append(data);
                    }
                    var skillArr = $("#showUserSkill  span");
                    skillArr.each(function(i, e) {
                        $(this).on('click', function() {
                            for (var d = 0; d <= i; d++) {
                                $(skillArr[d]).removeClass('skill_0').addClass('skill_1');
                            }
                            for (j = i + 1; j <= 5; j++) {
                                $(skillArr[j]).removeClass('skill_1').addClass('skill_0');
                            }
                            var rating = i + 1;
                            $('#ratingid').val(rating);
                        });
                    });
                }
            }

            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document).on('change', '#fileupload', function(e) {
                    var elt = document.getElementById('upload-image-form');

                    e.preventDefault();
                    let formData = new FormData(elt);
                    $('#image-input-error').text('');

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('upload.image') }}',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: (response) => {
                            console.log(response.imagepath);
                            $("#imageurl").attr('src', ('storage/uploads/' + response
                                .imagepath));

                        },
                        error: function(response) {

                        }
                    });

                });
                // Create and edit Awards
                $('#exampleModalAwards').on('show.bs.modal', function(e) {
                    let awardId = $(e.relatedTarget).data('award');

                    $('#title').val('');
                    $('#owner').val('');
                    $('#date').val('');
                    $('#url').val('');

                    if (awardId) {
                        $.ajax({
                            url: '{{ route('awards.show') }}',
                            type: 'GET',
                            data: {
                                'awardid': awardId,
                            },
                            success: function(response) {
                                console.log(response);
                                $('#userAwardId').val(response.id);
                                $('#title').val(response.title);
                                $('#owner').val(response.authority);
                                $('#date').val(response.authority_date);
                                $('#url').val(response.authority_url);
                            }
                        });
                    }
                });
                //Create and Edit Certificates
                $('#exampleModalCertificates').on('show.bs.modal', function(e) {
                    let certificateId = $(e.relatedTarget).data('certificateid');

                    $('#certificatename').val('');
                    $('#licensenumber').val('');
                    $('#certificateowner').val('');
                    $('#certificateurl').val('');
                    $('#enddate').val('');

                    if (certificateId) {
                        $.ajax({
                            url: '{{ route('certificate.show') }}',
                            type: 'GET',
                            data: {
                                'certificateid': certificateId,
                            },
                            success: function(response) {
                                console.log(response.id);
                                $('#usercertificateid').val(response.id);
                                $('#certificatename').val(response.certificate_name);
                                $('#licensenumber').val(response.license_number);
                                $('#certificateowner').val(response.certificate_authority);
                                $('#certificateurl').val(response.certificate_url);
                                $('#enddate').val(response.completion_date);

                            }
                        });
                    }
                });
                //Create and update skills
                $('#exampleModalSkills').on('show.bs.modal', function(e) {
                    let skillsId = $(e.relatedTarget).data('skill');
                    $('#skillsname').val('');

                    if (skillsId) {
                        $.ajax({
                            url: '{{ route('skill.show') }}',
                            type: 'GET',

                            data: {
                                'skillsid': skillsId,
                            },
                            success: function(data) {
                                console.log(data);
                                $('#userskills').val(data.id);
                                $('#skillsname').val(data.skill);
                                $('#ratingid').val(data.rating);


                                let ratings = data.rating;
                                myfunction(ratings);

                            }
                        });
                    }
                });
                // Create and Edit Projects
                $('#exampleModalProjects').on('show.bs.modal', function(e) {
                    let projectId = $(e.relatedTarget).data('project');
                    console.log(projectId)
                    $('#projecttitle').val('');
                    $('#companyname').val('');
                    $('#projecturl').val('');
                    $('#clienturl').val('');
                    $('#clientname').val('');
                    $('#projecttools').val('');
                    $('#projectstartdate').val('');
                    $('#projectenddate').val('');
                    $('#projectdescription').val('');
                    if (projectId) {
                        $.ajax({
                            url: '{{ route('project.show') }}',
                            type: 'GET',
                            data: {
                                'projectid': projectId,
                            },
                            success: function(response) {
                                $('#userprojectid').val(response.id);
                                $('#projecttitle').val(response.project_title);
                                $('#companyname').val(response.company_name);
                                $('#projecturl').val(response.project_url);
                                $('#clienturl').val(response.client_url);
                                $('#clientname').val(response.client_name);
                                $('#projecttools').val(response.tools);
                                $('#projectstartdate').val(response.start_date);
                                $('#projectenddate').val(response.End_date);
                                $('#projectdescription').val(response.description);
                            }
                        });
                    }
                });
                //Create and Edit Education details
                $('#exampleModalEducation').on('show.bs.modal', function(e) {
                    let educationId = $(e.relatedTarget).data('education');
                    $('#degreename').val('');
                    $('#institute').val('');
                    $('#level').val('');
                    $('#subjects').val('');
                    $('#school').val('');
                    $('#location').val('');
                    $('#completeyear').val('');
                    $('#inlineRadio1').val('');
                    $('#inlineRadio2').val('');
                    $('#mark').val('');
                    if (educationId) {
                        $.ajax({
                            url: '{{ route('education.show') }}',
                            type: 'GET',
                            data: {
                                'educationid': educationId,
                            },
                            success: function(response) {
                                console.log(response);
                                $('#usereducationid').val(response.id);
                                $('#degreename').val(response.degree_title);
                                $('#institute').val(response.institute);
                                $('#level').val(response.degree_level);
                                $('#subjects').val(response.major);
                                $('#location').val(response.location);
                                $('#completeyear').val(response.yearcomplete);
                                if (response.type == "cgpa") {
                                    $('#inlineRadio1').prop("checked", 1);
                                } else {
                                    $('#inlineRadio2').prop("checked", 1);
                                }
                                $('#mark').val(response.marks);
                            }
                        });
                    }
                });
                //Create and Edit Profile data
                $('#exampleModalProfile').on('show.bs.modal', function(e) {
                    let profileId = $(e.relatedTarget).data('profile');
                    $('#firstname').val('');
                    $('#lastname').val('');
                    $('#ccompany').val('');
                    $('#city').val('');
                    $('#dob').val('');
                    $('#gender').val('');
                    $('#experience').val('');
                    $('#degreel').val('');
                    $('#salary').val('');
                    $('#jobcity').val('');
                    if (profileId) {
                        $.ajax({
                            url: '{{ route('profile.show') }}',
                            type: 'GET',
                            data: {
                                'profileid': profileId
                            },
                            success: function(response) {
                                $('#userprofile').val(response.record.id);
                                $('#firstname').val(response.record.first_name);
                                $('#lastname').val(response.record.last_name);
                                $('#ccompany').val(response.record.current_company);
                                $('#city').val(response.record.city);
                                $('#dob').val(response.record.date_of_birth);
                                $('#gender').val(response.record.gender);
                                $('#experience').val(response.record.experience);
                                $('#degreel').val(response.record.degree_level);
                                $('#salary').val(response.record.salary);
                                $('#jobcity ').val(response.record.job_city);
                            }
                        });
                    }
                });
                //Create and Edit Work Experience
                $('#exampleModalWork').on('show.bs.modal', function(e) {
                    let workexperienceId = $(e.relatedTarget).data('workid');
                    $('#jobtitle').val('');
                    $('#compamyname').val('');
                    $('#remail').val('');
                    $('#rnumber').val('');
                    $('#expcity').val('');
                    $('#sdate').val('');
                    $('#edate').val('');
                    $('#description').val('');
                    if (workexperienceId) {
                        $.ajax({
                            url: '{{ route('experience.show') }}',
                            type: 'GET',
                            data: {
                                'workexperienceid': workexperienceId
                            },
                            success: function(response) {
                                console.log(response);
                                $('#userexperience').val(response.id);
                                $('#jobtitle').val(response.job_titile);
                                $('#compamyname').val(response.company_name);
                                $('#remail').val(response.reference_email);
                                $('#rnumber').val(response.reference_number);
                                $('#expcity').val(response.city);
                                $('#sdate').val(response.start_date);
                                $('#edate').val(response.end_date);
                                $('#description').val(response.description);

                            }
                        });
                    }
                });



            });


            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();

            // work done by ali
            function captureUserMedia(mediaConstraints, successCallback, errorCallback) {
                navigator.mediaDevices.getUserMedia(mediaConstraints).then(successCallback).catch(errorCallback);
            }

            var mediaConstraints = {
                audio: true, // record both audio/video in Firefox/Chrome
                video: true
            };

            document.querySelector('#start-recording').onclick = function() {
                this.disabled = true;
                captureUserMedia(mediaConstraints, onMediaSuccess, onMediaError);
            };

            document.querySelector('#stop-recording').onclick = function() {
                this.disabled = true;
                console.warn('Just stopped the recording');

                mediaRecorder.stop();
                // mediaRecorder.stream.stop();

                document.querySelector('#pause-recording').disabled = true;
                document.querySelector('#start-recording').disabled = false;
            };

            document.querySelector('#pause-recording').onclick = function() {
                this.disabled = true;
                mediaRecorder.pause();

                document.querySelector('#resume-recording').disabled = false;
            };

            document.querySelector('#resume-recording').onclick = function() {
                this.disabled = true;
                mediaRecorder.resume();

                document.querySelector('#pause-recording').disabled = false;
            };

            document.querySelector('#save-recording').onclick = function() {
                this.disabled = true;
                mediaRecorder.save();


                // alert('Drop WebM file on Chrome or Firefox. Both can play entire file. VLC player or other players may not work.');
            };

            var mediaRecorder;

            function onMediaSuccess(stream) {
                var video = document.createElement('video');

                var videoWidth = document.getElementById('video-width').value || 320;
                var videoHeight = document.getElementById('video-height').value || 240;

                video = mergeProps(video, {
                    // controls: true,
                    // muted: true,
                    width: videoWidth,
                    height: videoHeight
                });
                video.srcObject = stream;
                video.play();

                videosContainer.appendChild(video);
                videosContainer.appendChild(document.createElement('hr'));

                mediaRecorder = new MediaStreamRecorder(stream);
                mediaRecorder.stream = stream;

                var recorderType = document.getElementById('video-recorderType').value;

                if (recorderType === 'MediaRecorder API') {
                    mediaRecorder.recorderType = MediaRecorderWrapper;
                }

                if (recorderType === 'WebP encoding into WebM') {
                    mediaRecorder.recorderType = WhammyRecorder;
                }

                // don't force any mimeType; use above "recorderType" instead.
                // mediaRecorder.mimeType = 'video/webm'; // video/webm or video/mp4


                mediaRecorder.videoWidth = videoWidth;
                mediaRecorder.videoHeight = videoHeight;
                mediaRecorder.ondataavailable = function(blob) {
                    console.info('blob', blob);

                    var a = document.createElement('a');
                    a.target = '_blank';
                    a.innerHTML = 'Open Recorded Video No. ' + (index++) + ' (Size: ' + bytesToSize(blob.size) +
                        ') Time Length: ' + getTimeLength(timeInterval);

                    a.href = URL.createObjectURL(blob);

                    uploadToPHPServer(blob);


                    videosContainer.appendChild(a);
                    videosContainer.appendChild(document.createElement('hr'));
                };

                var timeInterval = document.querySelector('#time-interval').value;
                if (timeInterval) timeInterval = parseInt(timeInterval);
                else timeInterval = 5 * 1000;

                // get blob after specific time interval
                mediaRecorder.start(timeInterval);

                document.querySelector('#stop-recording').disabled = false;
                document.querySelector('#pause-recording').disabled = false;
                document.querySelector('#save-recording').disabled = false;
            }

            function onMediaError(e) {
                console.error('media error', e);
            }

            var videosContainer = document.getElementById('videos-container');
            var index = 1;

            // below function via: http://goo.gl/B3ae8c
            function bytesToSize(bytes) {
                var k = 1000;
                var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                if (bytes === 0) return '0 Bytes';
                var i = parseInt(Math.floor(Math.log(bytes) / Math.log(k)), 10);
                return (bytes / Math.pow(k, i)).toPrecision(3) + ' ' + sizes[i];
            }

            // below function via: http://goo.gl/6QNDcI
            function getTimeLength(milliseconds) {
                var data = new Date(milliseconds);
                return data.getUTCHours() + " hours, " + data.getUTCMinutes() + " minutes and " + data.getUTCSeconds() +
                    " second(s)";
            }

            window.onbeforeunload = function() {
                document.querySelector('#start-recording').disabled = false;
            };



            function uploadToPHPServer(blob) {
                var file = new File([blob], 'msr-' + (new Date).toISOString().replace(/:|\./g, '-') + '.webm', {
                    type: 'video/webm'
                });

                // create FormData
                // var formData = new FormData();
                // formData.append('video_filename', file.name);
                // formData.append('video_blob', file);

                // var json = JSON.stringify(formData);

                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var video_filename = file.name;
                $.ajax({

                    /* the route pointing to the post function */
                    url: '/save-file',
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,

                    /* send the csrf-token and the input to the controller */
                    data: {
                        _token: CSRF_TOKEN,
                        message: video_filename
                    },
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function(data) {
                        console.log("data", data);
                    }
                });

                // invokeSaveAsDialog(file, file.name);
                /*
                makeXMLHttpRequest('{{ url('/') }}/save-file', formData, function() {
                    var downloadURL = '{{ url('/') }}/videos/' + file.name;
                    console.log('File uploaded to this path:', downloadURL);
                });
                */
            }


            // function makeXMLHttpRequest(url, data, callback) {
            // var request = new XMLHttpRequest();
            // request.onreadystatechange = function() {
            // if (request.readyState == 4 && request.status == 200) {
            // callback();
            // }
            // };
            // // console.log(url);
            // request.open('POST', url);
            // request.setRequestHeader('x-csrf-token', $('meta[name="csrf-token"]').attr('content'));
            // request.setRequestHeader("Content-Type", "application/json; charset=utf-8");
            // request.setRequestHeader("Accept", "application/json");
            // request.send(data);

            // for (var value of result.values()) {
            // console.log(value);
            // }




            // var formValues= $(data).serialize();
            // console.log('values :'+ formValues);
            // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            // $.ajax({
            // /* the route pointing to the post function */
            // url: '/save-file',
            // type: 'POST',
            // /* send the csrf-token and the input to the controller */
            // data: {_token: CSRF_TOKEN, message: formValues},
            // dataType: 'JSON',
            // /* remind that 'data' is the response of the AjaxController */
            // success: function (data) {
            // console.log("data",data);
            // }
            // });
            // }

        </script>
    @endpush
