@extends('layouts.dashboard_layout')
@section('content')
<style>
    .my-properties table tbody tr td .inner figure {
        margin-bottom: 5px;
    }
</style>
<!-- START SECTION DASHBOARD -->
<section class="user-page section-padding">
    <div class="container-fluid">
        <div class="row">
            @include('pages.admin.auth.admin_dashboard_menu')
            <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
                <div class="col-lg-12 mobile-dashbord dashbord">
                    <div class="dashboard_navigationbar dashxl">
                        <div class="dropdown">
                            <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10 mr-2"></i> Dashboard Navigation</button>
                            <ul id="myDropdown" class="dropdown-content">
                                <li>
                                    <a class="active" href="dashboard.html">
                                        <i class="fa fa-map-marker mr-3"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="user-profile.html">
                                        <i class="fa fa-user mr-3"></i>Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="my-listings.html">
                                        <i class="fa fa-list mr-3" aria-hidden="true"></i>My Properties
                                    </a>
                                </li>
                                <li>
                                    <a href="favorited-listings.html">
                                        <i class="fa fa-heart mr-3" aria-hidden="true"></i>Favorited Properties
                                    </a>
                                </li>
                                <li>
                                    <a href="add-property.html">
                                        <i class="fa fa-list mr-3" aria-hidden="true"></i>Add Property
                                    </a>
                                </li>
                                <li>
                                    <a href="payment-method.html">
                                        <i class="fas fa-credit-card mr-3"></i>Payments
                                    </a>
                                </li>
                                <li>
                                    <a href="invoice.html">
                                        <i class="fas fa-paste mr-3"></i>Invoices
                                    </a>
                                </li>
                                <li>
                                    <a href="change-password.html">
                                        <i class="fa fa-lock mr-3"></i>Change Password
                                    </a>
                                </li>
                                <li>
                                    <a href="index-2.html">
                                        <i class="fas fa-sign-out-alt mr-3"></i>Log Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <h2>Dealer Listing</h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <a href="{{ route('add_dealer') }}" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Add Dealer</a>
                    </div>
                </div>
                <br>
                @if(Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif

                @if(Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <div class="my-properties">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Dealer Details</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Reg Date</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userList as $list)
                                <tr>
                                    <td>
                                        <!-- class="first-col-align" -->
                                        <div class="pl-3">
                                            @if($list->profile_picture == "")
                                            <a href="#" class="text-dark">
                                                <img alt="my-properties-3" width="50" src="{{ asset(MyApp::ASSET_IMG.'profile.png') }}" class="img-fluid">
                                                &nbsp;&nbsp;
                                                {{ $list->first_name }}
                                            </a>
                                            @else:
                                            <a href="#"><img alt="my-properties-3" src="images/feature-properties/fp-1.jpg" class="img-fluid"></a>
                                            @endif
                                            
                                        </div>
                                    </td>
                                    {{-- <td>
                                        <div class="inner">
                                            <a href="single-property-1.html"><h2>{{ $list->first_name . $list->last_name }}</h2></a>
                                            <figure><i class="lni-map-marker"></i><b>City :</b> Islamabad</figure>
                                            <figure><i class="lni-map-marker"></i> <b>Phone : </b> {{ $list->phone }}</figure>
                                            <figure><i class="lni-map-marker"></i> <b>Gender : </b> {{ $list->gender }}</figure>
                                            <figure><i class="lni-map-marker"></i> <b>Address : </b> {{ $list->address }}</figure>
                                        </div>
                                    </td> --}}
                                    <td class="text-center">{{ $list->email }}</td>
                                    <td class="text-center">{{ PlotDateFormater($list->created_at) }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-{{$list->is_active == 1 ? 'success' : 'danger'}} btn-sm">
                                            {{ getAccountStatus($list->is_active) }}
                                        </button> 
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('edit_dealer', base64_encode($list->user_id)) }}" class="btn btn-success text-white"><i class="far fa-edit"></i></a>
                                        <a onclick="return confirm('Are you sure you want to delete this record?')" href="{{ route('delete_dealer', base64_encode($list->user_id)) }}" class="btn btn-danger text-white"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-container">
                        {{-- <nav>
                            <ul class="pagination">
                                <li class="page-item"><a class="btn btn-common" href="#"><i class="lni-chevron-left"></i> Previous </a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="btn btn-common" href="#">Next <i class="lni-chevron-right"></i></a></li>
                            </ul>
                        </nav> --}}
                    </div>
                </div>

                <!-- START FOOTER -->
                <div class="second-footer">
                    <div class="container">
                        <p>{{ date('Y') }} © Copyright - All Rights Reserved.</p>
                        <p>Made With <i class="fa fa-heart" aria-hidden="true"></i> By ZeeAr</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION DASHBOARD -->
@endsection