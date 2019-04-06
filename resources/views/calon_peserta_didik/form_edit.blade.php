@extends('layouts.main')

@section('title')
Dasbor &raquo; Calon peserta didik | PPDB
@endsection

@section('css')
<link
  rel="stylesheet"
  href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css"
/>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Calon peserta didik
    </h1>
</div>
<!-- Content Row -->
<div class="row">
  <div class="col-lg-12 col-md-12 col-xs-12">
    <!-- Default Card Example -->
      <div class="card mb-4">
        <div class="card-header">
            Data calon peserta didik
        </div>
        <div class="card-body">
          <form action="/calon-peserta-didik/ubah/{{ $calonPesertaDidik->id }}" method="post">
            <input
              type="hidden"
              name="_token"
              value="{{ csrf_token() }}"
            />
            <input
              type="hidden"
              name="_method"
              value="put"
            />
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-md-12 col-xs-12">
                  <label for="">
                    NISN *
                  </label>
                  <input
                    type="number"
                    name="nisn"
                    class="form-control {{ $errors->first('nisn') ? 'is-invalid' : '' }}"
                    value="{{ $calonPesertaDidik->nisn }}"
                  />
                  @if($errors->first('nisn'))
                    <div class="invalid-feedback">
                      {{ $errors->first('nisn') }}
                    </div>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-md-12 col-xs-12">
                  <label for="">
                    Skor Jarak
                  </label>
                  <input
                    type="number"
                    name="skor_jarak"
                    id="skor-jarak"
                    class="form-control"
                    value="{{ $calonPesertaDidik->skor_jarak }}"
                    readonly
                  />
                </div>
                <div class="col-lg-3 col-md-12 col-xs-12">
                  <label for="">
                    Nilai NHUN *
                  </label>
                  <input
                    type="number"
                    name="nilai_nhun"
                    id="nilai-nhun"
                    class="form-control {{ $errors->first('nilai_nhun') ? 'is-invalid' : '' }}"
                    value="{{ $calonPesertaDidik->nilai_nhun }}"
                  />
                  @if($errors->first('nilai_nhun'))
                    <div class="invalid-feedback">
                      {{ $errors->first('nilai_nhun') }}
                    </div>
                  @endif
                </div>
                <div class="col-lg-3 col-md-12 col-xs-12">
                  <label for="">
                    Skor Total
                  </label>
                  <input
                    type="number"
                    name="skor_total"
                    id="skor-total"
                    class="form-control"
                    value="{{ $calonPesertaDidik->skor_total }}"
                    readonly
                  />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-md-12 col-xs-12">
                  <label for="">
                    Provinsi *
                  </label>
                  <input
                    type="text"
                    name="provinsi"
                    id="provinsi"
                    class="form-control"
                    value="{{ $calonPesertaDidik->alamat->provinsi }}"
                  />
                </div>
                <div class="col-lg-3 col-md-12 col-xs-12">
                  <label for="">
                    Kabupaten / Kota *
                  </label>
                  <input
                    type="text"
                    id="kabupaten-kota"
                    name="kabupaten_kota"
                    class="form-control"
                    value="{{ $calonPesertaDidik->alamat->kabupaten_kota }}"
                  />
                </div>
                <div class="col-lg-3 col-md-12 col-xs-12">
                  <label for="">
                    Kecamatan *
                  </label>
                  <input
                    type="text"
                    id="kecamatan"
                    name="kecamatan"
                    class="form-control"
                    value="{{ $calonPesertaDidik->alamat->kecamatan }}"
                  />
                </div>
                <div class="col-lg-3 col-md-12 col-xs-12">
                  <label for="">
                    Kode Pos
                  </label>
                  <input
                    type="number"
                    name="kode_pos"
                    id="kode-pos"
                    class="form-control"
                    value="{{ $calonPesertaDidik->alamat->kode_pos }}"
                  />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-md-12 col-xs-12">
                  <label for="">
                    Alamat Lengkap *
                  </label>
                  <textarea
                    name="alamat"
                    id="alamat"
                    class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}"
                    rows="5"
                  >{{ $calonPesertaDidik->alamat->alamat }}</textarea>
                  @if($errors->first('alamat'))
                    <div class="invalid-feedback">
                      {{ $errors->first('alamat') }}
                    </div>
                  @endif
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12">
                  <label for="">
                    <small>
                      <code>
                        Alamat berdasarkan isian Provinsi, Kabupaten/Kota, Kecamatan, Kode Pos
                      </code>
                    </small>
                  </label>
                  <a href="#cari-alamat" id="find-address" class="btn btn-primary">
                    <i class="fas fa-search" id="icon-find-address"></i> Temukan alamat
                  </a>
                </div>
              </div>
            </div>
            <div class="row" id="map-container">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <small>
                  <code>
                    Geserkan tanda yang non-<i>marker</i> jika lokasi tidak sesuai
                  </code>
                </small>
                <div id="map"></div>
                <input
                  type="hidden"
                  id="latitude-address"
                  name="latitude"
                  value="{{ $calonPesertaDidik->alamat->latitude }}"
                />
                <input
                  type="hidden"
                  id="longitude-address"
                  name="longitude"
                  value="{{ $calonPesertaDidik->alamat->longitude }}"
                />
              </div>
            </div>
            <br />
            <button
              type="submit"
              id="save-button"
              class="btn btn-primary"
            >
              <i class="fas fa-check"></i> Simpan
            </button>
          </form>
        </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script
  type="text/javascript"
  src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
></script>
<script
  type="text/javascript"
  src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"
></script>
<script>
  var map = $('#map').hide();
  var mapContainerID = $('#map-container').hide();
  var saveButton = $('#save-button').hide();
  var latitudeAddress = $('#latitude-address').val();
  var longitudeAddress = $('#longitude-address').val();
  var skorJarak = $('#skor-jarak').val();
  var nilai_nhun = $('#nilai-nhun').val();

  if (skorJarak !== '') {
    var skor_total = ((skorJarak / 30) * 100) + ((nilai_nhun / 70) * 100);
    $('#skor-total').val(Math.trunc(skor_total));
  }

  if (latitudeAddress !== '' && longitudeAddress !== '') {
    var latitudeDestination   = -6.854278;
    var longitudeDestination  = 107.517729;
    var leafletURL = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
    var mapContainerID = $('#map-container').show();
    var mapContainer = $('#map').show();
    var saveButton = $('#save-button').show();

    $('#latitude-address').val(latitudeAddress);
    $('#longitude-address').val(longitudeAddress);

    //calculate distance;
    calculateDistance(latitudeAddress, longitudeAddress);

    var map = new L.map('map');
    var mapContainer = L.DomUtil.get('map');

    if(mapContainer != null){
      mapContainer._leaflet_id = null;
    }

    L.tileLayer(leafletURL, {
        maxZoom: 15,
        id: 'mapbox.streets'
    }).addTo(map);

    L.Routing.control({
      waypoints: [
        L.latLng(latitudeDestination, longitudeDestination),
        L.latLng(latitudeAddress, longitudeAddress)
      ]
    }).addTo(map);

    L.circleMarker([
        latitudeDestination,
        longitudeDestination
      ],10
    ).addTo(map);
  }

  $('#find-address').click(function(event){
    // button effect
    event.preventDefault();
    $('#find-address').addClass('disabled');
    $('#icon-find-address').removeClass('fas fa-search').addClass('fas fa-sync fa-spin');

    // set variable for address
    var provinsi = $('#provinsi').val();
    var kabupaten_kota = $('#kabupaten-kota').val();
    var kecamatan = $('#kecamatan').val();
    var kode_pos = $('#kode-pos').val();
    var address = kecamatan+', '+kabupaten_kota+', '+provinsi+', '+kode_pos;
    console.log(address);

    // set leaflet url
    var leafletURL = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

    $.ajax({
      url: 'https://nominatim.openstreetmap.org/search/'+address+'?format=json',
      data: 'get',
      timeout: 5000,
      success: function(result){
        $('#find-address').removeClass('disabled');
        $('#icon-find-address').removeClass('fas fa-sync fa-spin').addClass('fas fa-search');
        if (result.length === 0) {
          alert('Alamat tidak ditemukan, mohon cek kembali alamat yang akan dicari');
        }else{
          var mapContainerID = $('#map-container').show();
          var mapContainer = $('#map').show();
          var saveButton = $('#save-button').show();

          var latitudeDestination   = -6.854278;
          var longitudeDestination  = 107.517729;
          var latitudeAddress       = result[0].lat;
          var longitudeAddress      = result[0].lon;

          $('#latitude-address').val(latitudeAddress);
          $('#longitude-address').val(longitudeAddress);

          //calculate distance;
          calculateDistance(latitudeAddress, longitudeAddress);

          var map = new L.map('map');
          var mapContainer = L.DomUtil.get('map');

          if(mapContainer != null){
            mapContainer._leaflet_id = null;
          }

          L.tileLayer(leafletURL, {
              maxZoom: 15,
              id: 'mapbox.streets'
          }).addTo(map);

          L.Routing.control({
            waypoints: [
              L.latLng(latitudeDestination, longitudeDestination),
              L.latLng(latitudeAddress, longitudeAddress)
            ]
          }).addTo(map);

          L.circleMarker([
              latitudeDestination,
              longitudeDestination
            ],10
          ).addTo(map);
        }
      },
      error: function(xmlhttprequest, textstatus, message){
        if (textstatus == 'timeout') {
            alert('Waktu mencari alamat terlalu lama, silahkan mencari alamat kembali')
        }

        alert('Gagal mendapatkan alamat, terjadi kesalahan teknis');

        $('#find-address').removeClass('disabled');
        $('#icon-find-address').removeClass('fas fa-sync fa-spin').addClass('fas fa-search');
      }
    });
  });

  $('#nilai-nhun').keyup(function(event){
    var skor_jarak = $('#skor-jarak').val();
    var nilai_nhun = $('#nilai-nhun').val();
    var skor_total = ((skor_jarak / 30) * 100) + ((nilai_nhun / 70) * 100);

    if(skor_jarak !== '') {
      $('#skor-total').val(Math.trunc(skor_total));
    }else{
      $('#skor-total').val(0);
    }
  });

  function calculateDistance(latitudeAddress, longitudeAddress)
  {
    var radius = 6378.137;
    var latitudeDestination   = -6.854278;
    var longitudeDestination  = 107.517729;

    var totalLatitude   = latitudeAddress * Math.PI / 180 - latitudeDestination * Math.PI / 180;
    var totalLongitude  = longitudeDestination * Math.PI / 180 - longitudeAddress * Math.PI / 180;
    var a = Math.sin(totalLatitude/2) * Math.sin(totalLatitude/2) + Math.cos(latitudeDestination * Math.PI / 180) * Math.cos(latitudeAddress * Math.PI / 180) * Math.sin(totalLongitude/2) * Math.sin(totalLongitude/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    var d = Math.trunc((radius * c) * 1000);

    checkSkorJarak(d);
  }

  function checkSkorJarak(d)
  {
    var skor_jarak;

    if (d > 10000) {
      skor_jarak = 350;
    }else if(d < 10000 && d > 9001){
      skor_jarak = 355;
    }else if(d < 9000 && d > 8001){
      skor_jarak = 360;
    }else if(d < 8000 && d > 7001){
      skor_jarak = 365;
    }else if(d < 7000 && d > 6001){
      skor_jarak = 370;
    }else if(d < 6000 && d > 5001){
      skor_jarak = 375;
    }else if(d < 5000 && d > 4001){
      skor_jarak = 380;
    }else if(d < 3000 && d > 2001){
      skor_jarak = 385;
    }else if(d < 2000 && d > 1001){
      skor_jarak = 390;
    }else if(d < 1000 && d > 0){
      skor_jarak = 395;
    }

    $('#skor-jarak').val(skor_jarak);
  }
</script>
@endsection
