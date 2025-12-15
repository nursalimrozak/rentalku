@extends('layouts.admin')

@section('content')
				<!-- Breadcrumb -->
				<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
					<div class="my-auto mb-2">
						<h4 class="mb-1">Dashboard</h4>
						<nav>
							<ol class="breadcrumb mb-0">
								<li class="breadcrumb-item">
									<a href="index.html">Home</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
							</ol>
						</nav>
					</div>
					<div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
						<div class="input-icon-start position-relative topdatepicker mb-2">
							<span class="input-icon-addon">
								<i class="ti ti-calendar"></i>
							</span>
							<input type="text" class="form-control date-range bookingrange" placeholder="dd/mm/yyyy - dd/mm/yyyy">
						</div>
					</div>
				</div>
				<!-- /Breadcrumb -->

				<div class="row">
					<div class="col-xl-8 d-flex flex-column">

						<!-- Welcome Wrap -->
						<div class="card flex-fill">
							<div class="card-body">
								<div class="row align-items-center row-gap-3">
									<div class="col-sm-7">
										<h4 class="mb-1">Welcome, {{ $user->name }} </h4>
										<p>High quality cars available for rent</p>
										<div class="d-flex align-items-center flex-wrap gap-4 mb-3">
											<div>
												<p class="mb-1">Total No of Cars</p>
												<h3>{{ $stats['total_cars'] }}</h3>
											</div>
											<div>
												<p class="d-flex align-items-center mb-2"><span class="line-icon bg-violet me-2"></span><span class="fw-semibold text-gray-9 me-1">{{ $stats['cars_rented'] }}</span>In Rental</p>
												<p class="d-flex align-items-center"><span class="line-icon bg-orange me-2"></span><span class="fw-semibold text-gray-9 me-1">{{ $stats['cars_available'] }}</span> Available</p>
											</div>
										</div>
										<div class="d-flex align-items-center gap-3 flex-wrap">
											<a href="reservations.html" class="btn btn-primary d-flex align-items-center"><i class="ti ti-eye me-1"></i>Reservations</a>
											<a href="add-car.html" class="btn btn-dark d-flex align-items-center"><i class="ti ti-plus me-1"></i>Add New Car</a>
										</div>
									</div>
									<div class="col-sm-5">
										<img src="{{ asset('admin_assets/images/car.svg') }}" alt="img">
									</div>
								</div>
							</div>
						</div>
						<!-- /Welcome Wrap -->

						<div class="row">

							<!-- Total Reservations -->
							<div class="col-md-4 d-flex">
								<div class="card flex-fill">
									<div class="card-body pb-1">
										<div class="border-bottom mb-0 pb-2">
											<div class="d-flex align-items-center">
												<span class="avatar avatar-sm bg-secondary-100 text-secondary me-2">
													<i class="ti ti-calendar-time fs-14"></i>
												</span> 
												<p>Total Reservations</p>
											</div>
										</div>
										<div class="d-flex align-items-center justify-content-between gap-2">
											<div class="py-2">
												<h5 class="mb-1">{{ $stats['total_bookings'] }}</h5>
												<p><span class="text-success fw-semibold"></span> All Time</p>
											</div>
											<div id="reservation-chart"></div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Total Reservations -->

							<!-- Total Earnings -->
							<div class="col-md-4 d-flex">
								<div class="card flex-fill">
									<div class="card-body pb-1">
										<div class="border-bottom mb-0 pb-2">
											<div class="d-flex align-items-center">
												<span class="avatar avatar-sm bg-orange-100 text-orange me-2">
													<i class="ti ti-moneybag fs-14"></i>
												</span> 
												<p>Total Earnings</p>
											</div>
										</div>
										<div class="d-flex align-items-center justify-content-between gap-2">
											<div class="py-2">
												<h5 class="mb-1">IDR {{ number_format($stats['total_earnings'], 0, ',', '.') }}</h5>
												<p><span class="text-success fw-semibold"></span> All Time</p>
											</div>
											<div id="earning-chart"></div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Total Earnings -->

							<!-- Total Cars -->
							<div class="col-md-4 d-flex">
								<div class="card flex-fill">
									<div class="card-body pb-1">
										<div class="border-bottom mb-0 pb-2">
											<div class="d-flex align-items-center">
												<span class="avatar avatar-sm bg-violet-100 text-violet me-2">
													<i class="ti ti-car fs-14"></i>
												</span> 
												<p>Total Cars</p>
											</div>
										</div>
										<div class="d-flex align-items-center justify-content-between gap-2">
											<div class="py-2">
												<h5 class="mb-1">{{ $stats['total_cars'] }}</h5>
												<p><span class="text-success fw-semibold"></span> All Time</p>
											</div>
											<div id="car-chart"></div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Total Cars -->

						</div>
					</div>

					<!-- Newly Added Cars -->
					<div class="col-xl-4 d-flex">
						<div class="card flex-fill">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
									<h5>Newly Added Cars</h5>
									<a href="{{ route('admin.cars.index') }}" class="text-decoration-underline fw-medium">View All</a>
								</div>
                                @if($stats['new_car'])
								<div class="mb-2">
									<img src="{{ $stats['new_car']->photo ? asset($stats['new_car']->photo) : asset('admin_assets/images/car.jpg') }}" alt="img" class="rounded w-100" style="height: 200px; object-fit: cover;">
								</div>
								<div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
									<div>
										<p class="fs-13 mb-1">{{ $stats['new_car']->type ?? 'Sedan' }}</p>
										<h6 class="fs-14 fw-semibold">{{ $stats['new_car']->name }}</h6>
									</div>
									<h6 class="fs-14 fw-semibold">IDR {{ number_format($stats['new_car']->price_per_day, 0, ',', '.') }} <span class="fw-normal text-gray-5">/day</span></h6>
								</div>
								<div class="row g-2 justify-content-center mb-3">
									<div class="col-sm-4 col-6 d-flex">
										<div class="bg-light border p-2 br-5 flex-fill text-center">
											<h6 class="fs-14 fw-semibold">Fuel Type</h6>
											<span class="fs-13">{{ $stats['new_car']->fuel_type ?? 'Petrol' }}</span>
										</div>
									</div>
									<div class="col-sm-4 col-6 d-flex">
										<div class="bg-light border p-2 br-5 flex-fill text-center">
											<h6 class="fs-14 fw-semibold">Passengers</h6>
											<span class="fs-13">{{ $stats['new_car']->seating_capacity ?? '4' }}</span>
										</div>
									</div>
									<div class="col-sm-4 col-6 d-flex">
										<div class="bg-light border p-2 br-5 flex-fill text-center">
											<h6 class="fs-14 fw-semibold">Transmission</h6>
											<span class="fs-13">{{ $stats['new_car']->transmission ?? 'Auto' }}</span>
										</div>
									</div>
								</div>
								<a href="{{ route('admin.cars.show', $stats['new_car']->id) }}" class="btn btn-white d-flex align-items-center justify-content-center">View Details<i class="ti ti-chevron-right ms-1"></i></a>
                                @else
								<div class="mb-2">
									<img src="{{ asset('admin_assets/images/car.jpg') }}" alt="img" class="rounded w-100">
								</div>
								<div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
									<div>
										<p class="fs-13 mb-1">Sedan</p>
										<h6 class="fs-14 fw-semibold">1.5 Eco Sports ST-Line 115CV</h6>
									</div>
									<h6 class="fs-14 fw-semibold">$280 <span class="fw-normal text-gray-5">/day</span></h6>
								</div>
								<div class="row g-2 justify-content-center mb-3">
									<div class="col-sm-4 col-6 d-flex">
										<div class="bg-light border p-2 br-5 flex-fill text-center">
											<h6 class="fs-14 fw-semibold">Fuel Type</h6>
											<span class="fs-13">Petrol</span>
										</div>
									</div>
									<div class="col-sm-4 col-6 d-flex">
										<div class="bg-light border p-2 br-5 flex-fill text-center">
											<h6 class="fs-14 fw-semibold">Passengers</h6>
											<span class="fs-13">03</span>
										</div>
									</div>
									<div class="col-sm-4 col-6 d-flex">
										<div class="bg-light border p-2 br-5 flex-fill text-center">
											<h6 class="fs-14 fw-semibold">Driving Type</h6>
											<span class="fs-13">Self</span>
										</div>
									</div>
								</div>
								<a href="car-details.html" class="btn btn-white d-flex align-items-center justify-content-center">View Details<i class="ti ti-chevron-right ms-1"></i></a>
                                @endif
							</div>
						</div>
					</div>
					<!-- /Newly Added Cars -->

				</div>

				<div class="row">					
					
					<!-- Live Tracking -->
					<div class="col-xl-6 d-flex">
						<div class="card flex-fill">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-3">
									<h5 class="mb-1">Live Tracking</h5>
									<div class="dropdown mb-1">
										<a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
											<i class="ti ti-map-pin me-1"></i>Washington
										</a>
										<ul class="dropdown-menu  dropdown-menu-end p-2">
											<li>
												<a href="javascript:void(0);" class="dropdown-item rounded-1">Washington</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="dropdown-item rounded-1">Chicago</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="dropdown-item rounded-1">Houston</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="dropdown-item rounded-1">Las Vegas</a>
											</li>
										</ul>
									</div>
								</div>
								<div class="map-wrap position-relative">
									<div id="map" class="tracking-map w-100 z-1"></div>	
									<div class="position-absolute top-0 start-0 w-100 z-2 p-3">										
										<div class="input-icon-start position-relative">
											<span class="input-icon-addon">
												<i class="ti ti-search"></i>
											</span>
											<input type="text" class="form-control" placeholder="Search by Car Name">
										</div>
									</div>	
								</div>				
							</div>
						</div>
					</div>
					<!-- /Live Tracking -->

					<!-- Recent Reservations -->
					<div class="col-xl-6 d-flex">
						<div class="card flex-fill">
							<div class="card-body pb-1">
								<div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-1">
									<h5>Recent Reservations</h5>
									<a href="reservations.html" class="text-decoration-underline fw-medium">View All</a>
								</div>
								<div class="table-responsive">
									<table class="table custom-table1">
										<tbody>
                                            @forelse($stats['recent_bookings'] as $booking)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('admin.cars.show', $booking->car_id) }}" class="avatar flex-shrink-0">
                                                            <img src="{{ $booking->car->photo ? asset($booking->car->photo) : asset('admin_assets/images/car-01.jpg') }}" alt="img" class="rounded" style="object-fit:cover; width: 40px; height: 40px;">
                                                        </a>
                                                        <div class="flex-grow-1 ms-2">
                                                            <p class="d-flex align-items-center fs-13 text-default mb-1">{{ ceil($booking->start_date->floatDiffInDays($booking->end_date)) }} Hari<i class="ti ti-circle-filled text-primary fs-5 mx-1"></i>{{ ucfirst($booking->service_type ?? 'Rental') }}</p>
                                                            <h6 class="fs-14 fw-semibold mb-1"><a href="{{ route('admin.cars.show', $booking->car_id) }}">{{ $booking->car->name }}</a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-1 mb-1">
                                                        <h6 class="fs-14 fw-semibold">{{ $booking->user->name }}</h6>
                                                    </div>
                                                    <p class="fs-13 text-default">{{ $booking->start_date->format('d M Y, H:i') }}</p>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <h6 class="fs-14 fw-semibold">IDR {{ number_format($booking->total_price, 0, ',', '.') }}</h6>
                                                        <span class="badge {{ match($booking->status) { 'completed' => 'bg-success-transparent', 'cancelled' => 'bg-danger-transparent', 'pending_payment' => 'bg-warning-transparent', 'confirmed' => 'bg-info-transparent', default => 'bg-secondary-transparent' } }}">{{ ucfirst(str_replace('_', ' ', $booking->status)) }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
											<td>
												<div class="d-flex align-items-center">
													<a href="car-details.html" class="avatar flex-shrink-0">
														<img src="{{ asset('admin_assets/images/car-01.jpg') }}" alt="img">
													</a>
													<div class="flex-grow-1 ms-2">
														<p class="d-flex align-items-center fs-13 text-default mb-1">3 Days<i class="ti ti-circle-filled text-primary fs-5 mx-1"></i>Self</p>
														<h6 class="fs-14 fw-semibold mb-1"><a href="car-details.html">Ford Endeavour</a></h6>
													</div>
												</div>
											</td>
											<td>
												<div class="d-flex align-items-center gap-1 mb-1">
													<h6 class="fs-14 fw-semibold">Newyork</h6>
													<span class="connect-line"></span>
													<h6 class="fs-14 fw-semibold">Las Vegas</h6>
												</div>
												<p class="fs-13 text-default">15 Jan 2025, 01:00 PM</p>
											</td>
											<td>
												<div class="d-flex align-items-center gap-3">
													<h6 class="fs-14 fw-semibold">$280 <span class="fw-normal text-default">/day</span></h6>
													<a href="javascript:void(0);" class="avatar avatar-sm">
														<img src="{{ asset('admin_assets/images/avatar-05.jpg') }}" alt="img" class="rounded-circle">
													</a>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex align-items-center">
													<a href="car-details.html" class="avatar flex-shrink-0">
														<img src="{{ asset('admin_assets/images/car-02.jpg') }}" alt="img">
													</a>
													<div class="flex-grow-1 ms-2">
														<p class="d-flex align-items-center fs-13 text-default mb-1">4 Days<i class="ti ti-circle-filled text-primary fs-5 mx-1"></i>Self</p>
														<h6 class="fs-14 fw-semibold mb-1"><a href="car-details.html">Ferrari 458 MM</a></h6>
													</div>
												</div>
											</td>
											<td>
												<div class="d-flex align-items-center gap-1 mb-1">
													<h6 class="fs-14 fw-semibold">Chicago</h6>
													<span class="connect-line"></span>
													<h6 class="fs-14 fw-semibold">Houston</h6>
												</div>
												<p class="fs-13 text-default">07 Feb 2025, 10:25 AM</p>
											</td>
											<td>
												<div class="d-flex align-items-center gap-3">
													<h6 class="fs-14 fw-semibold">$225 <span class="fw-normal text-default">/day</span></h6>
													<a href="javascript:void(0);" class="avatar avatar-sm">
														<img src="{{ asset('admin_assets/images/avatar-22.jpg') }}" alt="img" class="rounded-circle">
													</a>
												</div>
											</td>
										</tr>
                                        @endforelse
									</tbody></table>
								</div>
								
							</div>
						</div>
					</div>
					<!-- /Recent Reservations -->

				</div>

				<div class="row">

					<!-- Customers -->
					<div class="col-xl-4 d-flex">
						<div class="card flex-fill">
							<div class="card-body pb-1">
								<div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-1">
									<h5>Customers</h5>
									<a href="customers.html" class="text-decoration-underline fw-medium">View All</a>
								</div>
								<div class="table-responsive">
									<table class="table custom-table1">
										<tbody>
                                            @forelse($stats['recent_customers'] as $customer)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                                            <img src="{{ $customer->profile_photo_path ? asset('storage/' . $customer->profile_photo_path) : asset('admin_assets/images/avatar-20.jpg') }}" class="rounded-circle" alt="">
                                                        </a>
                                                        <div class="flex-grow-1 ms-2">
                                                            <h6 class="fs-14 fw-semibold mb-1"><a href="javascript:void(0);">{{ $customer->name }}</a></h6>
                                                            <span class="badge badge-sm bg-secondary-transparent rounded-pill">{{ ucfirst($customer->role) }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <p class="fs-13 mb-1 text-default">Jumlah Rental</p>
                                                    <h6 class="fs-14 fw-semibold">{{ $customer->bookings_count }} X</h6>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
											<td>
												<div class="d-flex align-items-center">
													<a href="customer-details.html" class="avatar flex-shrink-0">
														<img src="{{ asset('admin_assets/images/customer-01.jpg') }}" class="rounded-circle" alt="">
													</a>
													<div class="flex-grow-1 ms-2">
														<h6 class="fs-14 fw-semibold mb-1"><a href="customer-details.html">Reuben Keen</a></h6>
														<span class="badge badge-sm bg-secondary-transparent rounded-pill">Client</span>
													</div>
												</div>
											</td>
											<td class="text-end">
												<p class="fs-13 mb-1 text-default">No of Bookings</p>
												<h6 class="fs-14 fw-semibold">89</h6>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex align-items-center">
													<a href="customer-details.html" class="avatar flex-shrink-0">
														<img src="{{ asset('admin_assets/images/customer-02.jpg') }}" class="rounded-circle" alt="">
													</a>
													<div class="flex-grow-1 ms-2">
														<h6 class="fs-14 fw-semibold mb-1"><a href="customer-details.html">William Jones</a></h6>
														<span class="badge badge-sm bg-violet-transparent rounded-pill">Company</span>
													</div>
												</div>
											</td>
											<td class="text-end">
												<p class="fs-13 mb-1 text-default">No of Bookings</p>
												<h6 class="fs-14 fw-semibold">45</h6>
											</td>
										</tr>
                                        @endforelse
									</tbody></table>
								</div>
							</div>
						</div>
					</div>
					<!-- /Customers -->

					<!-- Income & Expenses -->
					<div class="col-xl-8 d-flex">
						<div class="card flex-fill">
							<div class="card-body pb-0">
								<div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-3">
									<h5 class="mb-1">Income & Expenses</h5>
									<div class="chart-icon d-flex align-items-center gap-4 mb-1">
										<p class="mb-0 d-flex align-items-center"><span class="chart-color bg-primary me-1"></span>Income</p>
										<p class=" d-flex align-items-center mb-0"><span class="chart-color bg-primary-300 me-1"></span>Expense</p>
									</div>
									<div class="dropdown mb-1">
										<a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
											<i class="ti ti-calendar me-1"></i>This Week
										</a>
										<ul class="dropdown-menu  dropdown-menu-end p-2">
											<li>
												<a href="javascript:void(0);" class="dropdown-item rounded-1">This Week</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="dropdown-item rounded-1">Last Week</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="dropdown-item rounded-1">This Month</a>
											</li>
										</ul>
									</div>
								</div>
								<div class="d-flex align-items-center flex-wrap gap-4">
									<div class="border br-5 p-2">
										<p class="mb-1">Income This Week</p>
										<h5>$96896<span class="fs-13 fw-semibold text-success ms-2">+34%</span></h5>
									</div>
									<div class="border br-5 p-2">
										<p class="mb-1">Expenses This Week</p>
										<h5>$12489<span class="fs-13 fw-semibold text-danger ms-2">+34%</span></h5>
									</div>
								</div>
								<div id="sales-statistics"></div>
							</div>
						</div>
					</div>
					<!-- /Income & Expenses -->

				</div>

				<div class="row">

					<!-- Maintenance -->
					<div class="col-xl-4 d-flex">
						<div class="card flex-fill">
							<div class="card-body pb-1">
								<div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-1">
									<h5>Maintenance</h5>
									<a href="maintenance.html" class="text-decoration-underline fw-medium">View All</a>
								</div>
								<div class="table-responsive">
									<table class="table custom-table1">
										<tbody><tr>
											<td>
												<div class="d-flex align-items-center">
													<a href="car-details.html" class="avatar flex-shrink-0">
														<img src="{{ asset('admin_assets/images/car-01.jpg') }}" alt="img">
													</a>
													<div class="flex-grow-1 ms-2">
														<h6 class="fs-14 fw-semibold mb-1"><a href="car-details.html">Ford Endeavour</a></h6>
														<p class="fs-13 text-default">Sedan</p>
													</div>
												</div>
											</td>
											<td class="text-end">
												<p class="fs-13 mb-1 text-default">Odometer</p>
												<h6 class="fs-14 fw-semibold">8656 KM</h6>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex align-items-center">
													<a href="car-details.html" class="avatar flex-shrink-0">
														<img src="{{ asset('admin_assets/images/car-02.jpg') }}" alt="img">
													</a>
													<div class="flex-grow-1 ms-2">
														<h6 class="fs-14 fw-semibold mb-1"><a href="car-details.html">Ferrari 458 MM</a></h6>
														<p class="fs-13 text-default">SUV</p>
													</div>
												</div>
											</td>
											<td class="text-end">
												<p class="fs-13 mb-1 text-default">Odometer</p>
												<h6 class="fs-14 fw-semibold">565 KM</h6>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex align-items-center">
													<a href="car-details.html" class="avatar flex-shrink-0">
														<img src="{{ asset('admin_assets/images/car-03.jpg') }}" alt="img">
													</a>
													<div class="flex-grow-1 ms-2">
														<h6 class="fs-14 fw-semibold mb-1"><a href="car-details.html">Ford Mustang </a></h6>
														<p class="fs-13 text-default">Sedan</p>
													</div>
												</div>
											</td>
											<td class="text-end">
												<p class="fs-13 mb-1 text-default">Odometer</p>
												<h6 class="fs-14 fw-semibold">698 KM</h6>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex align-items-center">
													<a href="car-details.html" class="avatar flex-shrink-0">
														<img src="{{ asset('admin_assets/images/car-04.jpg') }}" alt="img">
													</a>
													<div class="flex-grow-1 ms-2">
														<h6 class="fs-14 fw-semibold mb-1"><a href="car-details.html">Toyota Tacoma 4</a></h6>
														<p class="fs-13 text-default">Minivans</p>
													</div>
												</div>
											</td>
											<td class="text-end">
												<p class="fs-13 mb-1 text-default">Odometer</p>
												<h6 class="fs-14 fw-semibold">855 KM</h6>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex align-items-center">
													<a href="car-details.html" class="avatar flex-shrink-0">
														<img src="{{ asset('admin_assets/images/car-05.jpg') }}" alt="img">
													</a>
													<div class="flex-grow-1 ms-2">
														<h6 class="fs-14 fw-semibold mb-1"><a href="car-details.html">Chevrolet Truck</a></h6>
														<p class="fs-13 text-default">Hatchbacks</p>
													</div>
												</div>
											</td>
											<td class="text-end">
												<p class="fs-13 mb-1 text-default">Odometer</p>
												<h6 class="fs-14 fw-semibold">5889 KM</h6>
											</td>
										</tr>
									</tbody></table>
								</div>
							</div>
						</div>
					</div>
					<!-- /Maintenance -->

					<!-- Reservation Statistics -->
					<div class="col-xl-4 d-flex">
						<div class="card flex-fill">
							<div class="card-body pb-0">
								<div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-3">
									<h5 class="mb-1">Reservation Statistics</h5>
									<a href="reservations.html" class="text-decoration-underline fw-medium mb-1">View All</a>
								</div>
								<div id="statistics_chart"></div>
							</div>
						</div>
					</div>
					<!-- /Reservation Statistics -->

					<!-- Drivers -->
					<div class="col-xl-4 d-flex">
						<div class="card flex-fill">
							<div class="card-body pb-1">
								<div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-1">
									<h5>Drivers</h5>
									<a href="{{ route('drivers.index') }}" class="text-decoration-underline fw-medium">View All</a>
								</div>
								<div class="table-responsive">
									<table class="table custom-table1">
										<tbody>
                                            @forelse($stats['recent_drivers'] as $driver)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('drivers.show', $driver->id) }}" class="avatar flex-shrink-0">
                                                            <img src="{{ $driver->photo ? asset($driver->photo) : asset('admin_assets/images/driver-01.jpg') }}" class="rounded-circle" alt="">
                                                        </a>
                                                        <div class="flex-grow-1 ms-2">
                                                            <h6 class="fs-14 fw-semibold mb-1"><a href="{{ route('drivers.show', $driver->id) }}">{{ $driver->name }}</a></h6>
                                                            <p class="fs-13 text-default">{{ $driver->phone }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <span class="badge badge-md {{ $driver->status == 'available' ? 'bg-success-transparent' : 'bg-danger-transparent' }} d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-6 me-2"></i>{{ ucfirst($driver->status) }}</span>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
											<td>
												<div class="d-flex align-items-center">
													<a href="javascript:void(0);" class="avatar flex-shrink-0">
														<img src="{{ asset('admin_assets/images/driver-01.jpg') }}" class="rounded-circle" alt="">
													</a>
													<div class="flex-grow-1 ms-2">
														<h6 class="fs-14 fw-semibold mb-1"><a href="javascript:void(0);">William Jones</a></h6>
														<p class="fs-13 text-default">No of Raids : 90</p>
													</div>
												</div>
											</td>
											<td class="text-end">
												<span class="badge badge-md bg-success-transparent d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-6 me-2"></i>In Ride</span>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex align-items-center">
													<a href="javascript:void(0);" class="avatar flex-shrink-0">
														<img src="{{ asset('admin_assets/images/driver-02.jpg') }}" class="rounded-circle" alt="">
													</a>
													<div class="flex-grow-1 ms-2">
														<h6 class="fs-14 fw-semibold mb-1"><a href="javascript:void(0);">Leonard Jandreau</a></h6>
														<p class="fs-13 text-default">No of Raids : 64</p>
													</div>
												</div>
											</td>
											<td class="text-end">
												<span class="badge badge-md bg-success-transparent d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-6 me-2"></i>In Ride</span>
											</td>
										</tr>
                                        @endforelse
									</tbody></table>
								</div>
							</div>
						</div>
					</div>
					<!-- /Drivers -->

				</div>

				<div class="row">

					<!-- Recent Invoices -->
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-3">
									<h5 class="mb-1">Recent Invoices</h5>
									<a href="invoices.html" class="text-decoration-underline fw-medium mb-1">View All</a>
								</div>
								<div class="custom-table table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>INVOICE NO</th>
												<th>NAME</th>
												<th>EMAIL</th>
												<th>CREATED DATE</th>
												<th>DUE DATE</th>
												<th>INVOICE AMOUNT</th>
												<th>STATUS</th>
											</tr>
										</thead>
										<tbody>
                                            @forelse($stats['recent_payments'] as $payment)
                                            <tr>
                                                <td>
                                                    <a href="javascript:void(0);" class="fs-12 fw-medium">#{{ substr($payment->id, 0, 8) }}</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                                            <img src="{{ $payment->booking->user->profile_photo_path ? asset('storage/' . $payment->booking->user->profile_photo_path) : asset('admin_assets/images/avatar-20.jpg') }}" class="rounded-circle" alt="">
                                                        </a>
                                                        <div class="flex-grow-1 ms-2">
                                                            <h6 class="fs-14 fw-semibold mb-1"><a href="javascript:void(0);">{{ $payment->booking->user->name }}</a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="mailto:{{ $payment->booking->user->email }}" class="__cf_email__">{{ $payment->booking->user->email }}</a></td>
                                                <td>{{ $payment->created_at->format('d M Y') }}</td>
                                                <td>{{ $payment->created_at->addDays(1)->format('d M Y') }}</td>
                                                <td>IDR {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                                <td>
                                                    <span class="badge badge-sm {{ $payment->status == 'verified' ? 'bg-success-transparent' : ($payment->status == 'rejected' ? 'bg-danger-transparent' : 'bg-warning-transparent') }} d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-6 me-2"></i>{{ ucfirst($payment->status) }}</span>
                                                </td>
                                            </tr>
                                            @empty
											<tr>
												<td>
													<a href="invoice-details.html" class="fs-12 fw-medium">#12345</a>
												</td>
												<td>
													<div class="d-flex align-items-center">
														<a href="customer-details.html" class="avatar flex-shrink-0">
															<img src="{{ asset('admin_assets/images/avatar-20.jpg') }}" class="rounded-circle" alt="">
														</a>
														<div class="flex-grow-1 ms-2">
															<h6 class="fs-14 fw-semibold mb-1"><a href="customer-details.html">Andrew Simons </a></h6>
														</div>
													</div>
												</td>
												<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="5c3d32382e392b1c39243d312c3039723f3331">[emailprotected]</a></td>
												<td>24 Jan 2025</td>
												<td>24 Jan 2025</td>
												<td>$120.00</td>												
												<td>
													<span class="badge badge-md bg-success-transparent d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-6 me-2"></i>Paid</span>
												</td>
											</tr>
											<tr>
												<td>
													<a href="invoice-details.html" class="fs-12 fw-medium">#12346</a>
												</td>
												<td>
													<div class="d-flex align-items-center">
														<a href="customer-details.html" class="avatar flex-shrink-0">
															<img src="{{ asset('admin_assets/images/avatar-21.jpg') }}" class="rounded-circle" alt="">
														</a>
														<div class="flex-grow-1 ms-2">
															<h6 class="fs-14 fw-semibold mb-1"><a href="customer-details.html">David Steiger</a></h6>
														</div>
													</div>
												</td>
												<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="076366716e6347627f666a776b622964686a">[emailprotected]</a></td>
												<td>19 Dec 2024</td>
												<td>19 Dec 2024</td>
												<td>$85.00</td>												
												<td>
													<span class="badge badge-md bg-info-transparent d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-6 me-2"></i>Pending</span>
												</td>
											</tr>
											<tr>
												<td>
													<a href="invoice-details.html" class="fs-12 fw-medium">#12347</a>
												</td>
												<td>
													<div class="d-flex align-items-center">
														<a href="customer-details.html" class="avatar flex-shrink-0">
															<img src="{{ asset('admin_assets/images/avatar-12.jpg') }}" class="rounded-circle" alt="">
														</a>
														<div class="flex-grow-1 ms-2">
															<h6 class="fs-14 fw-semibold mb-1"><a href="customer-details.html">Virginia Phu</a></h6>
														</div>
													</div>
												</td>
												<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="6f1f071a2f0a170e021f030a410c0002">[emailprotected]</a></td>
												<td>11 Dec 2024</td>
												<td>11 Dec 2024</td>
												<td>$250.00</td>												
												<td>
													<span class="badge badge-md bg-success-transparent d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-6 me-2"></i>Paid</span>
												</td>
											</tr>
											<tr>
												<td>
													<a href="invoice-details.html" class="fs-12 fw-medium">#12348</a>
												</td>
												<td>
													<div class="d-flex align-items-center">
														<a href="customer-details.html" class="avatar flex-shrink-0">
															<img src="{{ asset('admin_assets/images/avatar-03.jpg') }}" class="rounded-circle" alt="">
														</a>
														<div class="flex-grow-1 ms-2">
															<h6 class="fs-14 fw-semibold mb-1"><a href="customer-details.html">Walter Hartmann</a></h6>
														</div>
													</div>
												</td>
												<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="8bfceae7ffeef9cbeef3eae6fbe7eea5e8e4e6">[emailprotected]</a></td>
												<td>29 Nov 2024</td>
												<td>229 Nov 2024</td>
												<td>$175.00</td>												
												<td>
													<span class="badge badge-md bg-purple-transparent d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-6 me-2"></i>Overdue</span>
												</td>
											</tr>
											<tr>
												<td>
													<a href="invoice-details.html" class="fs-12 fw-medium">#12349</a>
												</td>
												<td>
													<div class="d-flex align-items-center">
														<a href="customer-details.html" class="avatar flex-shrink-0">
															<img src="{{ asset('admin_assets/images/avatar-07.jpg') }}" class="rounded-circle" alt="">
														</a>
														<div class="flex-grow-1 ms-2">
															<h6 class="fs-14 fw-semibold mb-1"><a href="customer-details.html">Andrea Jermaine</a></h6>
														</div>
													</div>
												</td>
												<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="472d22352a262e292207223f262a372b226924282a">[emailprotected]</a></td>
												<td>03 Nov 2024</td>
												<td>03 Nov 2024</td>
												<td>$200.00</td>												
												<td>
													<span class="badge badge-md bg-success-transparent d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-6 me-2"></i>Paid</span>
												</td>
											</tr>
                                            @endforelse
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- /Recent Invoices -->

				</div>
@endsection
