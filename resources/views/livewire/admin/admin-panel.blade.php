            <main class="app-main"> <!--begin::App Content Header-->
                <div class="app-content-header"> <!--begin::Container-->
                    <div class="container-fluid"> <!--begin::Row-->
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">{{ $title ?? 'Page Title' }}</h3>
                            </div>
                        </div> <!--end::Row-->
                    </div> <!--end::Container-->
                </div> <!--end::App Content Header--> <!--begin::App Content-->
                <div class="app-content"> <!--begin::Container-->
                    <div class="container-fluid"> <!--begin::Row-->
                        <div class="row">
                            <div class="col-12"> <!-- Default box -->
                                <div class="card">
                                    <div class="card-header">
                                        {{-- <h3 class="card-title">{{ $title ?? 'Page Title' }}</h3> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="row"> <!--begin::Col-->
                                            <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 1-->
                                                <div class="small-box bg-pink text-white">
                                                    <div class="inner">
                                                        <h3>{{ $schoolsCounter }}</h3>
                                                        <p>Schools</p>
                                                    </div> <svg class="small-box-icon" fill="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        aria-hidden="true">
                                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                    </svg> <a href="#"
                                                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                                        New in the last week: {{ $newSchoolsCounter }}</a>
                                                </div> <!--end::Small Box Widget 1-->
                                            </div> <!--end::Col-->
                                            <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 2-->
                                                <div class="small-box text-bg-success">
                                                    <div class="inner">
                                                        <h3>53<sup class="fs-5">%</sup></h3>
                                                        <p>Bounce Rate</p>
                                                    </div> <svg class="small-box-icon" fill="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        aria-hidden="true">
                                                        <path
                                                            d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z">
                                                        </path>
                                                    </svg> <a href="#"
                                                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                                        More info <i class="bi bi-link-45deg"></i> </a>
                                                </div> <!--end::Small Box Widget 2-->
                                            </div> <!--end::Col-->
                                            <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 3-->
                                                <div class="small-box text-bg-warning">
                                                    <div class="inner">
                                                        <h3>44</h3>
                                                        <p>User Registrations</p>
                                                    </div> <svg class="small-box-icon" fill="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        aria-hidden="true">
                                                        <path
                                                            d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                                        </path>
                                                    </svg> <a href="#"
                                                        class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                                                        More info <i class="bi bi-link-45deg"></i> </a>
                                                </div> <!--end::Small Box Widget 3-->
                                            </div> <!--end::Col-->
                                            <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 4-->
                                                <div class="small-box text-bg-danger">
                                                    <div class="inner">
                                                        <h3>65</h3>
                                                        <p>Unique Visitors</p>
                                                    </div> <svg class="small-box-icon" fill="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        aria-hidden="true">
                                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                                            d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z">
                                                        </path>
                                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                                            d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z">
                                                        </path>
                                                    </svg> <a href="#"
                                                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                                        More info <i class="bi bi-link-45deg"></i> </a>
                                                </div> <!--end::Small Box Widget 4-->
                                            </div> <!--end::Col-->
                                        </div> <!--end::Row--> <!--begin::Row-->
                                    </div> <!-- /.card-body -->
                                    <div class="card-footer">Footer</div> <!-- /.card-footer-->
                                </div> <!-- /.card -->
                            </div>
                        </div> <!--end::Row-->
                    </div>
                </div> <!--end::App Content-->
            </main> <!--end::App Main--> <!--begin::Footer-->
