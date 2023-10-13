<!-- Transparent Modal -->
<!-- Modal template -->
<div class="modal modal-transparent fade" id="modalAddData" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content modal-top">
      <form class="add-new pt-0" id="addFormBerkas" action="{{ route('layanan_store') }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" hidden id="layananjenis_id" name="layananjenis_id" class="form-control">
        <input type="hidden" hidden id="layanan_tab_id" name="layanan_tab_id" class="form-control">

        <div class="modal-body p-0 m-0">
          <a href="javascript:void(0);" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></a>
          <p class="text-white text-large fw-bold mb-3">Pilih dan Upload Berkas Pelayanan</p>
          <div class="row mt-0 mb-0 px-0 ">
            <div class="nav-align-top mb-4">
              @php
                $jenis_berkas = config('global.jenis_berkas');
              @endphp
              <ul class="nav nav-tabs" id="nav_tab" role="tablist">
                @foreach ($jenis_berkas as $key => $value)
                  {{-- <li data-id="{{ $key }}" class="{{ $key == 1 ? 'active' : '' }} klik_tab"><a href="#tab_{{ $key }}" data-toggle="tab">{{ $value['title'] }}</a></li> --}}
                  <li class="nav-item">
                    <button type="button" data-id="{{ $key }}" class="nav-link {{ $key == 1 ? 'active' : '' }} klik_tab" role="tab" data-bs-toggle="tab" data-bs-target="#tab_{{ $key }}" aria-controls="tab_{{ $key }}" aria-selected="true">{{ $value['title'] }}</button>
                  </li>
                @endforeach
              </ul>
              <div class="tab-content">
                @foreach ($jenis_berkas as $key => $value)
                  <div class="tab-pane fade {{ $key == 1 ? 'show active' : '' }}" id="tab_{{ $key }}" role="tabpanel">
                    <p>
                      {{ $key }} <br>
                      Icing pastry pudding oat cake. Lemon drops cotton candy caramels cake caramels sesame snaps powder. Bear
                      claw
                      candy topping.
                    </p>
                    <p class="mb-0">
                      Tootsie roll fruitcake cookie. Dessert topping pie. Jujubes wafer carrot cake jelly. Bonbon jelly-o
                      jelly-o ice
                      cream jelly beans candy canes cake bonbon. Cookie jelly beans marshmallow jujubes sweet.
                    </p>
                  </div>
                @endforeach
                {{-- <div class="tab-pane fade show active" id="tab_1" role="tabpanel">
                  <p>
                    Icing pastry pudding oat cake. Lemon drops cotton candy caramels cake caramels sesame snaps powder. Bear
                    claw
                    candy topping.
                  </p>
                  <p class="mb-0">
                    Tootsie roll fruitcake cookie. Dessert topping pie. Jujubes wafer carrot cake jelly. Bonbon jelly-o
                    jelly-o ice
                    cream jelly beans candy canes cake bonbon. Cookie jelly beans marshmallow jujubes sweet.
                  </p>
                </div>
                <div class="tab-pane fade" id="tab_2" role="tabpanel">
                  <p>
                    Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice cream. Gummies
                    halvah
                    tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream cheesecake fruitcake.
                  </p>
                  <p class="mb-0">
                    Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah cotton candy
                    liquorice caramels.
                  </p>
                </div>
                <div class="tab-pane fade" id="tab_3" role="tabpanel">
                  <p>
                    Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies cupcake gummi
                    bears
                    cake chocolate.
                  </p>
                  <p class="mb-0">
                    Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet roll icing
                    sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly jelly-o tart brownie
                    jelly.
                  </p>
                </div> --}}
              </div>
            </div>
          </div>
          <input type="file" class="form-control bg-white border-0" hidden id="file" name="file">
          <span id="berkas_esktensi" class="text-white" style="font-size: 12px"></span>
          <div class="input-group input-group-lg mb-3">
            {{-- <span class="badge bg-label-secondary form-control" width="30px">
            <i class="bx bx-upload bx-sm fs-4 pb-1"></i>
            <small class="text-capitalize">Pilih File</small>
          </span> --}}
            <button class="btn btn-secondary" type="button" id="btn_pilih">
              <i class="bx bx-file-find bx-sm fs-4 pb-1"></i>
              <small class="text-capitalize">Pilih File</small>
            </button>
            <input type="text" class="form-control bg-white border-0" id="title" name="title" placeholder="Nama File (boleh dikosongkan)" aria-describedby="subscribe">
            <button class="btn btn-primary" type="submit" id="subscribe">
              <i class="bx bx-upload bx-sm fs-4 pb-1"></i>
              <small class="text-capitalize">Upload</small>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  .pd_r_10 {
    padding-right: 10px;
  }
</style>
