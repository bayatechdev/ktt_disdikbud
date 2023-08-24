@extends('layouts/layoutMaster')

@section('title', 'User View - Pages')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('page-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-user-view.css') }}" />
@endsection

@section('vendor-script')
  <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/jszip/jszip.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/pdfmake/pdfmake.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons/buttons.html5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-buttons/buttons.print.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
@endsection

{{-- @section('page-script')
  <script src="{{ asset('assets/js/modal-edit-user.js') }}"></script>
  <script src="{{ asset('assets/js/app-user-view.js') }}"></script>
  <script src="{{ asset('assets/js/app-user-view-account.js') }}"></script>
@endsection --}}

@section('content')
  <div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-4 col-lg-5 col-md-5 order-0">
      <!-- User Card -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="user-avatar-section">
            <div class=" d-flex align-items-center flex-column">
              <img class="img-fluid rounded my-4" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" height="110" width="110" alt="User avatar" />
              <div class="user-info text-center">
                <h4 class="mb-2">{{ Auth::user()->name }}</h4>
                <span class="badge bg-label-warning">{{ config('global.user_role')[Auth::user()->role] }}</span>
              </div>
            </div>
          </div>
          <h5 class="pb-2 border-bottom mb-2 mt-4">Details</h5>
          <div class="info-container">
            <ul class="list-unstyled">
              <li class="mb-3">
                <span class="fw-bold me-2">Username:</span>
                <span>{{ Auth::user()->username }}</span>
              </li>
              <li class="mb-3">
                <span class="fw-bold me-2">Email:</span>
                <span>{{ Auth::user()->email }}</span>
              </li>
              <li class="mb-3">
                <span class="fw-bold me-2">Status:</span>
                <span class="badge {{ Auth::user()->publish == 0 ? 'bg-label-danger' : 'bg-label-success' }}">{{ Auth::user()->publish == 0 ? 'Inactive' : 'Active' }}</span>
              </li>
              <li class="mb-3">
                <span class="fw-bold me-2">Role:</span>
                <span>{{ config('global.user_role')[Auth::user()->role] }}</span>
              </li>
            </ul>
            {{-- <div class="d-flex justify-content-center pt-3">
              <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser"
                data-bs-toggle="modal">Edit</a>
              <a href="javascript:;" class="btn btn-label-danger suspend-user">Suspended</a>
            </div> --}}
          </div>
        </div>
      </div>
      <!-- /User Card -->
    </div>
    <!--/ User Sidebar -->


    <!-- User Content -->
    <div class="col-xl-8 col-lg-7 col-md-7 order-1">
      <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3" role="tablist">
          <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#nav-security" aria-controls="nav-security" aria-selected="false"><i class="tf-icons bx bx-lock"></i> Security</button>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="nav-security" role="tabpanel">
            <h5 class="card-header mb-4">Ubah Password</h5>
            <div class="card-body">
              <form id="formChangePassword" method="POST" action="{{ route('user_update_password') }}">
                @csrf
                <div class="alert alert-warning" role="alert">
                  <h6 class="alert-heading fw-bold mb-1">Password minimal 6 karakter</h6>
                  <span>Password dirahasiakan, Admin tidak dapat mengetahui password anda</span>
                </div>
                <div class="row">
                  <input type="hidden" hidden class="form-control" id="token" name="token" value="{{ Auth::user()->token }}" />
                  <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                    <label class="form-label" for="password">New Password</label>
                    <div class="input-group input-group-merge">
                      <input class="form-control" type="password" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    @error('password')
                      <span class="text-danger"><small>{{ $message }}</small></span>
                    @enderror
                  </div>

                  <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                    <label class="form-label" for="password_confirmation">Confirm New Password</label>
                    <div class="input-group input-group-merge">
                      <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    @error('password_confirmation')
                      <span class="text-danger"><small>{{ $message }}</small></span>
                    @enderror
                  </div>
                  <div>
                    <button type="submit" class="btn btn-primary me-2">Update Password</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!--/ User Content -->
  </div>
@endsection

@push('addon-style')
  <style>
    .borderles tbody tr td {
      border: none;
    }
  </style>
@endpush
