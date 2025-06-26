@extends('admin.layout.main')

@Section('main-container')


        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 row-cols-xxl-4">
                    @if (in_array(session('usertype'), ['Admin', 'Superadmin']))
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Admin</p>
                                        <h4 class="my-1">{{$admin}}</h4>
                                    </div>
                                    <div class="text-primary ms-auto font-35"><i class="bi bi-person-check-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Mentor</p>
                                        <h4 class="my-1">{{$mentor}}</h4>
                                    </div>
                                    <div class="text-danger ms-auto font-35"><i class="bi bi-person-check-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Students</p>
                                        <h4 class="my-1">{{$mentee}}</h4>
                                    </div>
                                    <div class="text-warning ms-auto font-35"><i class="bi bi-people-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Mentorless</p>
                                        <h4 class="my-1">{{$mentorlessStudentsCount}}</h4>
                                    </div>
                                    <div class="text-success ms-auto font-35"><i class="bi bi-person-dash-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif


                     @if (session('usertype') == 'Mentor')
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Mentor</p>
                                        <h4 class="my-1">{{$mentor}}</h4>
                                    </div>
                                    <div class="text-primary ms-auto font-35"><i class="bi bi-person-check-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Assigned Mentees</p>
                                        <h4 class="my-1">{{$assigned_mentor}}</h4>
                                    </div>
                                    <div class="text-danger ms-auto font-35"><i class="bi bi-person-plus-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Mentoring Info (Pending)</p>
                                        <h4 class="my-1">{{$pendingCount}}</h4>
                                    </div>
                                    <div class="text-warning ms-auto font-35"><i class="bi bi-info-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Modify Request (Pending)</p>
                                        <h4 class="my-1">{{$pendingUpdateRequestCount}}</h4>
                                    </div>
                                    <div class="text-gray ms-auto font-35"><i class="bi bi-clock-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <!--end row-->

                <div class="row mt-4">
                    <div class="col-12 col-lg-12">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">

                                </div>
                                <!-- <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
								<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 text-info"></i>Downloads</span>
								<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 text-danger"></i>Earnings</span>
							</div> -->
                                <!-- <div class="chart-container-1">
								<canvas id="chart5"></canvas>
							  </div>
						  </div> -->
                                <!-- <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-0 row-group text-center border-top">
							<div class="col">
							  <div class="p-3">
								<h4 class="mb-0">$168</h4>
								<small class="mb-0">Today's Sales <span> <i class="bx bx-up-arrow-alt align-middle"></i> 2.43%</span></small>
							  </div>
							</div>
							<div class="col">
							  <div class="p-3">
								<h4 class="mb-0">$856</h4>
								<small class="mb-0">This Week Sales <span> <i class="bx bx-up-arrow-alt align-middle"></i> 12.65%</span></small>
							  </div>
							</div>
							<div class="col">
							  <div class="p-3">
								<h4 class="mb-0">$2400</h4>
								<small class="mb-0">This Month Sales <span> <i class="bx bx-up-arrow-alt align-middle"></i> 5.62%</span></small>
							  </div>
							</div>
							<div class="col">
								<div class="p-3">
								  <h4 class="mb-0">$4,562</h4>
								  <small class="mb-0">This Year Sales <span> <i class="bx bx-up-arrow-alt align-middle"></i> 12.62%</span></small>
								</div>
							  </div>
						  </div>
					  </div>
				   </div> -->
                                <!-- </div>end row -->

                                <!-- <div class="row">
					<div class="col-12 col-lg-6">
						<div class="card radius-10">
							<div class="card-body">
							 <div class="d-flex align-items-center">
								 <div>
									 <h6 class="mb-0">Top Categories</h6>
								 </div>
								 <div class="dropdown ms-auto">
									 <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
									 </a>
									 <ul class="dropdown-menu">
										 <li><a class="dropdown-item" href="javascript:;">Action</a>
										 </li>
										 <li><a class="dropdown-item" href="javascript:;">Another action</a>
										 </li>
										 <li>
											 <hr class="dropdown-divider">
										 </li>
										 <li><a class="dropdown-item" href="javascript:;">Something else here</a>
										 </li>
									 </ul>
								 </div>
							 </div>
							 <div class="chart-container-1 mt-4">
								 <canvas id="chart6"></canvas>
							   </div>
							</div>
						</div>
					</div> -->
                                <!-- <div class="col-12 col-lg-6">
						<div class="card radius-10">
							<div class="card-body">
							 <div class="d-flex align-items-center">
								 <div>
									 <h6 class="mb-0">Product Views</h6>
								 </div>
								 <div class="dropdown ms-auto">
									 <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
									 </a>
									 <ul class="dropdown-menu">
										 <li><a class="dropdown-item" href="javascript:;">Action</a>
										 </li>
										 <li><a class="dropdown-item" href="javascript:;">Another action</a>
										 </li>
										 <li>
											 <hr class="dropdown-divider">
										 </li>
										 <li><a class="dropdown-item" href="javascript:;">Something else here</a>
										 </li>
									 </ul>
								 </div>
							 </div> -->
                                <!-- <div class="chart-container-1 mt-4">
								 <canvas id="chart7"></canvas>
							   </div>
							</div>
						</div>
					</div> -->
                                <!-- </div>end row -->

                                <!-- <div class="card radius-10">
                         <div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Recent Orders</h6>
								</div>
								<div class="dropdown ms-auto">
									<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
									</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="javascript:;">Action</a>
										</li>
										<li><a class="dropdown-item" href="javascript:;">Another action</a>
										</li>
										<li>
											<hr class="dropdown-divider">
										</li>
										<li><a class="dropdown-item" href="javascript:;">Something else here</a>
										</li>
									</ul>
								</div> -->
                                <!-- </div> -->
                                @if (session('usertype') == 'Mentor')
                                  <div class="table-responsive">
                                    <h6 class="mb-3 text-primary">Mentoring Info</h6>
                                    <table class="table table-striped table-bordered">
                                        <thead class="table-primary">
                                            <tr>
                                                {{-- <th>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="select-all">

                                                      </div>
                                                </th> --}}
                                                <th>SL No.</th>
                                                <th>Picture</th>
                                                <th>Session</th>
                                                <th>Department</th>
                                                <th>Semester</th>
                                                <th>Student Name</th>

                                                <th>Submitted At</th>
                                                <th>Last Modified</th>
                                                <th>Remark</th>
                                                <th>Status</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($mentoring as $key => $item)

                                            <tr>
                                                {{-- <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input item-checkbox" name="selected_ids[]" type="checkbox" value="{{ $item->id }}" id="flexCheckDefault">

                                                      </div>
                                                </td> --}}
                                                <td>{{$key+1}}</td>

                                                 <td>
                                                    @if ($item->user_image == null)
                                                        <img src="{{ url('admin-assets/images/avatars/avatar4.png') }}"
                                                            class="product-img-2 img-thumbnail"
                                                            alt="product img"

                                                            data-bs-toggle="modal"
                                                            data-bs-target="#imageModal"
                                                            data-img="{{ url('admin-assets/images/avatars/avatar4.png') }}">
                                                    @else
                                                        <img src="{{ asset('img/' . $item->user_image) }}"
                                                            class="product-img-2 img-thumbnail"
                                                            alt="product img"

                                                            data-bs-toggle="modal"
                                                            data-bs-target="#imageModal"
                                                            data-img="{{ asset('img/' . $item->user_image) }}">
                                                    @endif
                                                </td>
                                                 <td>{{$item->session}}</td>
                                                <td>{{$item->department_name ?? 'N/A'}}</td>
                                                <td>{{$item->semister_name ?? 'N/A'}}</td>
                                                {{-- <td><img src="{{url('admin-assets/images/products/image1.png')}}" class="product-img-2" alt="product img"></td> --}}
                                                <td>{{$item->name ?? 'N/A'}}</td>

                                                <td>{{$item->created_at ?? 'N/A'}}</td>
                                                <td>{{$item->updated_at ?? 'N/A'}}</td>
                                                {{-- <td>{{$item->remark ?? 'N/A'}}</td> --}}
                                                <td>
                                                    @if (!empty($item->remark))
                                                        {{ \Illuminate\Support\Str::words($item->remark, 5, '...') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                @if($item->status == 1)
                                                <td><a href=""><span class="badge bg-success text-white shadow-sm w-100">Approved</span></a></td>
                                                @elseif($item->status == 0)
                                                <td><a href=""><span class="badge bg-warning text-white shadow-sm w-100">Pending</span></a></td>
                                                 @elseif($item->status == 2)
                                                <td><a href=""><span class="badge bg-danger text-white shadow-sm w-100">Rejected</span></a></td>
                                                 @elseif($item->status == 3)
                                                <td><a href=""><span class="badge bg-success text-white shadow-sm w-100">Completed</span></a></td>
                                                @endif

                                                <td>
                                                    <div>
                                                        <a class="dropdown-toggle dropdown-toggle-nocaret btn btn-light btn-sm" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i>
									</a>
                                                        <ul class="dropdown-menu">

                                                            <li><a class="dropdown-item" href="{{url('/admin/mentoring-info-view')}}/{{encrypt($item->id)}}"><i class="bi bi-info-square"></i> Info</a>
                                                            </li>
                                                            @if ($item->status != 3)
                                                             <li>
                                                                <!-- <i class="fa-solid fa-info"></i> -->
                                                                <a class="dropdown-item" href="{{url('/admin/mentoring-update')}}/{{encrypt($item->id)}}"><i class="bi bi-pencil-square"></i> Modify</a>
                                                            </li>
                                                            <li>
                                                                <!-- <i class="fa-solid fa-info"></i> -->
                                                                <a class="dropdown-item" href="{{url('/admin/mentoring-info-approval')}}/{{encrypt($item->id)}}"><i class="bi bi-pencil-square"></i> Approval</a>
                                                            </li>
                                                            @endif
                                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete('{{url('/admin/mentoring-info-delete')}}/{{encrypt($item->id)}}')"><i class="bi bi-trash3"></i> Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            @endforeach


                                        </tbody>
                                        {{-- <tfoot>
                                            <tr>
                                                <th></th>
                                                <th>SL No.</th>
                                                <th>Department</th>
                                                <th>Student Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>

                                                <th>Action</th>
                                            </tr>
                                        </tfoot> --}}
                                    </table>
                                </div>
                                 <div class="vm">
                                    {{-- <button class="btn btn-outline-primary btn-sm">View More</button> --}}
                                    <a href="{{route('admin_mentoring_data')}}" class="btn btn-light text-primary btn-sm">View More</a>
                                </div>
                                @endif

                                @if (in_array(session('usertype'), ['Admin', 'Superadmin']))
                                 <div class="table-responsive">
                                    <h6 class="mb-3 text-primary">Mentee's Info</h6>
                                    <table class="table table-striped table-bordered">
                                        <thead class="table-primary">
                                            <tr>
                                                {{-- <th>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="select-all">

                                                      </div>
                                                </th> --}}
                                                <th>SL No.</th>
                                                <th>Picture</th>
                                                <th>Department</th>
                                                <th>Student Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($mentees_info_admin as $key => $item)

                                            <tr>
                                                {{-- <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input item-checkbox" name="selected_ids[]" type="checkbox" value="{{ $item->id }}" id="flexCheckDefault">

                                                      </div>
                                                </td> --}}
                                                <td>{{$key+1}}</td>
                                                <td>
                                                    @if ($item->user_image == null)
                                                        <img src="{{ url('admin-assets/images/avatars/avatar4.png') }}"
                                                            class="product-img-2 img-thumbnail"
                                                            alt="product img"

                                                            data-bs-toggle="modal"
                                                            data-bs-target="#imageModal"
                                                            data-img="{{ url('admin-assets/images/avatars/avatar4.png') }}">
                                                    @else
                                                        <img src="{{ asset('img/' . $item->user_image) }}"
                                                            class="product-img-2 img-thumbnail"
                                                            alt="product img"

                                                            data-bs-toggle="modal"
                                                            data-bs-target="#imageModal"
                                                            data-img="{{ asset('img/' . $item->user_image) }}">
                                                    @endif
                                                </td>
                                                <td>{{$item->department_name}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->email}}</td>
                                                <td>{{$item->contact}}</td>

                                                <td>
                                                    <div>
                                                        <a class="dropdown-toggle dropdown-toggle-nocaret btn btn-light btn-sm" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i>
									</a>
                                                        <ul class="dropdown-menu">

                                                            <li><a class="dropdown-item" href="{{url('/admin/mentee-info')}}/{{encrypt($item->id)}}"><i class="bi bi-info-square"></i> Info</a>
                                                            </li>
                                                            <li>
                                                                <!-- <i class="fa-solid fa-info"></i> -->
                                                                <a class="dropdown-item" href="{{url('/admin/mentee-modify')}}/{{encrypt($item->id)}}"><i class="bi bi-pencil-square"></i> Modify Mentee</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete('{{url('/admin/mentee-delete')}}/{{encrypt($item->id)}}')"><i class="bi bi-trash3"></i> Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            @endforeach


                                        </tbody>

                                    </table>
                                </div>

                                 <div class="vm">
                                    {{-- <button class="btn btn-outline-primary btn-sm">View More</button> --}}
                                    <a href="{{route('mentee')}}" class="btn btn-light text-primary btn-sm">View More</a>
                                </div>
                                @endif


                            </div>
                        </div>


                        <!--end page wrapper -->
                        <!--start overlay-->
                        <div class="overlay toggle-icon"></div>
                        <!--end overlay-->
                        <!--Start Back To Top Button--><a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
                        <!--End Back To Top Button-->
                        <footer class="page-footer">
                        <p class="mb-0 text-muted">Developed by <a href="https://www.linkedin.com/in/souvikmukherjee98?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">Souvik Mukherjee</a>, <a href="">Surya Narayan Paul</a>, <a href="">Swapnil Dewanjee</a>, and <a href="">Arit Biswas</a> – Department: BCA, Batch: 2022–2025</p>
                    </footer>
                    </div>
                    <!--end wrapper-->

@endsection
