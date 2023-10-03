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
  <div class="title-with-button d-flex justify-content-between align-items-center">
    <h4 class="fw-bold py-3">
      <span class="text-muted fw-light">Kepegawaian / Pegawai /</span> Detail
    </h4>
    <div class="text-muted float-end">
      <a href="javascript:history.back()" class="btn"><span class="d-md-inline-block"><i class="bx bx-arrow-back"></i></span></a></span>
    </div>
  </div>
  <div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-4 col-lg-5 col-md-5 order-0">
      <!-- User Card -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="user-avatar-section">
            <div class=" d-flex align-items-center flex-column">
              @if ($item)
                @if ($item->gambar)
                  <img class="img-fluid rounded my-4" src="{{ Storage::url('assets/pegawai/images/') . $item->gambar }}" height="110" width="110" alt="User avatar" />
                @else
                  <img class="img-fluid rounded my-4" src="https://ui-avatars.com/api/?name={{ $item->nama }}" height="110" width="110" alt="User avatar" />
                @endif
              @endif
              @if ($user)
                <div class="user-info text-center">
                  <h4 class="mb-2">{{ $user->name }}</h4>
                  <span class="badge bg-label-warning">{{ config('global.user_role')[$user->role] }}</span>
                </div>
              @else
                <div class="user-info text-center">
                  <span>Data User Belum ada</span>
                </div>
              @endif
            </div>
          </div>
          @if ($user)
            <h5 class="pb-2 border-bottom mb-2 mt-4">Details</h5>
            <div class="info-container">
              <ul class="list-unstyled">
                <li class="mb-3">
                  <span class="fw-bold me-2">Username:</span>
                  <span>{{ $user->username }}</span>
                </li>
                <li class="mb-3">
                  <span class="fw-bold me-2">Email:</span>
                  <span>{{ $user->email }}</span>
                </li>
                <li class="mb-3">
                  <span class="fw-bold me-2">Status:</span>
                  <span class="badge {{ $user->publish == 0 ? 'bg-label-danger' : 'bg-label-success' }}">{{ $user->publish == 0 ? 'Inactive' : 'Active' }}</span>
                </li>
                <li class="mb-3">
                  <span class="fw-bold me-2">Role:</span>
                  <span>{{ config('global.user_role')[$user->role] }}</span>
                </li>
              </ul>
              {{-- <div class="d-flex justify-content-center pt-3">
              <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser"
                data-bs-toggle="modal">Edit</a>
              <a href="javascript:;" class="btn btn-label-danger suspend-user">Suspended</a>
            </div> --}}
            </div>
          @endif
        </div>
      </div>
      <!-- /User Card -->
    </div>
    <!--/ User Sidebar -->


    <!-- User Content -->
    <div class="col-xl-8 col-lg-7 col-md-7 order-1">
      <div class="nav-align-top mb-4">
        <div class="tab-content">
          <div class="tab-pane fade show active" id="nav-pegawai" role="tabpanel">
            @if ($item)
              {{-- <h6 class="m-0 mb-2"></h6> --}}
              <h5 class="card-header mb-4">Data Pegawai:</h5>
              <table class="table p-0 mb-3 borderles">
                <tbody>
                  <tr>
                    <td class="p-1" width="10px" nowrap>NIP</td>
                    <td class="p-1"><span class="pl-2">:</span> {{ $item->nip ?? '-' }}</td>
                  </tr>
                  <tr>
                    <td class="p-1" width="10px" nowrap>Nama</td>
                    <td class="p-1"><span class="pl-2">:</span> {{ $item->nama }}</td>
                  </tr>
                  <tr>
                    <td class="p-1" width="10px" nowrap>Jenis Kelamin</td>
                    <td class="p-1"><span class="pl-2">:</span> {{ $item->jkel == 0 ? 'Perempuan' : 'Laki-Laki' }}
                    </td>
                  </tr>
                  <tr>
                    <td class="p-1" width="10px" nowrap>Tempat Lahir</td>
                    <td class="p-1">
                      <span class="pl-2">:</span> {{ $item->lahir_tempat }}
                    </td>
                  </tr>
                  <tr>
                    <td class="p-1" width="10px" nowrap>Tanggal Lahir</td>
                    <td class="p-1">
                      <span class="pl-2">:</span>
                      {{ \Carbon\Carbon::parse($item->lahir_tanggal)->settings(['formatFunction' => 'translatedFormat'])->format('j F Y') }}
                    </td>
                  </tr>
                  <tr>
                    <td class="p-1" width="10px" nowrap>Agama</td>
                    <td class="p-1"><span class="pl-2">:</span> {{ $item->agama }}</td>
                  </tr>
                  <tr>
                    <td class="p-1" width="10px" nowrap>No Handphone</td>
                    <td class="p-1"><span class="pl-2">:</span> {{ $item->notelp }}</td>
                  </tr>
                  <tr>
                    <td class="p-1" width="10px" nowrap>Jabatan</td>
                    <td class="p-1"><span class="pl-2">:</span> {{ @$item->jabatan->title }}</td>
                  </tr>
                  <tr>
                    <td class="p-1" width="10px" nowrap>Bidang</td>
                    <td class="p-1"><span class="pl-2">:</span> {{ @$item->bidang->title }}</td>
                  </tr>
                  <tr>
                    <td class="p-1" width="10px" nowrap>Golongan</td>
                    <td class="p-1"><span class="pl-2">:</span>
                      {{ @$item->golongan->title ? @$item->golongan->title . '/' : '' }}
                      {{ @$item->golongan->description }}</td>
                  </tr>
                  <tr>
                    <td class="p-1" width="10px" nowrap>Eselon</td>
                    <td class="p-1"><span class="pl-2">:</span> {{ @$item->eselon->title }}</td>
                  </tr>
                  <tr>
                    <td class="p-1" width="10px" nowrap>Status</td>
                    <td class="p-1"><span class="pl-2">:</span>
                      <span class="badge {{ $item->publish == 0 ? 'bg-label-danger' : 'bg-label-success' }}">{{ $item->publish == 0 ? 'Inactive' : 'Active' }}</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            @else
              <h6 class="m-0 mb-2">Data pegawai tidak ditemukan</h6>
            @endif
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
