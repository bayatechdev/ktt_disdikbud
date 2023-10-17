{{-- SIDEBAR --}}
<div id="sidebar" class="leaflet-sidebar collapsed">
  <!-- nav tabs -->
  <div class="leaflet-sidebar-tabs">
    <!-- top aligned tabs -->
    <ul role="tablist">
      <li><a href="#home" role="tab"><i class="fa fa-bars active"></i></a></li>
      {{-- <li><a href="#" role="tab"><i class="fa fa-arrows"></i></a></li> --}}
    </ul>
    <!-- bottom aligned tabs -->
    {{-- <ul role="tablist">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-user"></i></a></li>
    </ul> --}}
  </div>
  <!-- panel content -->
  <div class="leaflet-sidebar-content">
    <div class="leaflet-sidebar-pane" id="home">
      <h1 class="leaflet-sidebar-header">
        SiBang<span class="text-warning">Taka</span>
        {{-- <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span> --}}
      </h1>
      {{-- tree --}}
      <div class="container mb-4 mt-2">
        <h5>Peta Dasar</h5>
        <div class="row">
          <div class="col-6 d-grid">
            <input type="radio" class="btn-check" name="base-layer" id="layerKecamatan" value="layerKecamatan"
              autocomplete="off" checked>
            <label class="btn btn-outline-secondary p-0" for="layerKecamatan">Kecamatan</label>
          </div>
          <div class="col-6 d-grid ps-0">
            <input type="radio" class="btn-check" name="base-layer" id="layerDesa" value="layerDesa"
              autocomplete="off">
            <label class="btn btn-outline-secondary" for="layerDesa">Desa</label>
          </div>

        </div>
        <div class="row mt-3">
          <div class="col-12">
            <div class="peta-dasar">
              <ul id="list2"></ul>
            </div>
          </div>
        </div>
      </div>
      <hr />
      <div id="treeview_container" class="hummingbird-treeview">
        <div class="container">
          <h1>Peta Pembangunan</h1>
        </div>
        {{-- <ul id="treeview" class="hummingbird-base" style="max-height: 300px; overflow:scroll">
          @foreach ($categories as $category)
            <li data-id="0" class="category">
              <i class="fa fa-plus"></i>&nbsp;
              <label class="form-check-label p-1" for="">
                {{ $category->title }}
              </label> --}}
        {{-- <ul id="treeview" class="hummingbird-base" style="max-height: 250px; overflow:scroll">
          @foreach ($sub_categories as $sub_category)
            <li data-id="1" class="subCategory">
              <i class="fa fa-plus"></i>&nbsp;
              <label class="form-check-label p-1" for="">
                {{ $sub_category->title }}
              </label>
              <ul>
                @foreach ($maps as $map)
                  @if ($map->sub_category_id === $sub_category->id)
                    <li class="isi">
                      <input class="hummingbird-end-node shpCheck" type="checkbox" value="{{ $map->file }}"
                        id="{{ $loop->iteration }}" data-id="custom-0-1-1" name="shp">&nbsp;
                      <label class="form-check-label p-1">
                        {{ $map->title }}
                      </label>
                      <input type="text" hidden id="shape_type{{ $loop->iteration }}" value="{{ $map->shape_type }}">
                      <input type="hidden" id="field{{ $loop->iteration }}" value="{{ $map->field_index }}">
                      <input type="hidden" id="icons{{ $loop->iteration }}" value="{{ $map->icons }}">
                      <input type="hidden" id="icons_color{{ $loop->iteration }}" value="{{ $map->icons_color }}">
                    </li>
                  @endif
                @endforeach
              </ul>
          @endforeach
        </ul> --}}
        {{-- </li> --}}
        {{-- @endforeach --}}
        {{-- </ul> --}}
      </div>

      <hr />
      {{-- tree --}}

      <table>
        <tr>
          <td></td>
        </tr>
      </table>
      <div class="flyTo">
        <ul id="list"></ul>
      </div>


    </div>
  </div>
</div>
{{-- SIDEBAR --}}
