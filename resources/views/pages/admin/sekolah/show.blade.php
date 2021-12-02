@extends('layouts.default')

@section('title')
Detail Sekolah
@endsection

@push('before-script')

@if (session('status'))
<x-sweetalertsession tipe="{{session('tipe')}}" status="{{session('status')}}"/>
@endif
@endpush


@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('sekolah')}}">Sekolah</a></div>
            <div class="breadcrumb-item">{{ $id->nama }}</div>
        </div>
    </div>

    <div class="section-body">

        <div id="output-status"></div>
        <div class="row">
          <div class="col-md-3">
              @include('pages.admin.sekolah.component.sidebarsekolah')
          </div>
          <div class="col-md-9">

            <button type="button" class="btn btn-icon btn-primary btn-sm ml-0 ml-sm-0"
            data-toggle="modal" data-target="#importExcel"><i class="fas fa-upload"></i>
            Import Detail Data Sekolah
        </button>

        <a href="{{ route('detailsekolah.export',$id->id) }}" type="submit" value="Import"
            class="btn btn-icon btn-primary btn-sm mr-0"><span class="pcoded-micon"> <i
                    class="fas fa-download"></i> Export </span></a>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                  <div class="card profile-widget">
                    <div class="profile-widget-header">
                        @php
                        $sekolah_logo=asset('/storage/').'/'.$id->sekolah_logo;
                        $randomimg='https://ui-avatars.com/api/?name='.$id->nama.'&color=7F9CF5&background=EBF4FF';
                        // dd($sekolah_logo)
                        @endphp
                      <img alt="image" src="{{$id->sekolah_logo!=null ? $sekolah_logo : $randomimg}}" class="rounded-circle profile-widget-picture" style="object-fit:cover;" >
                      <div class="profile-widget-items">

                        <div class="profile-widget-item">
                          {{-- <div class="profile-widget-item-label">Following</div> --}}
                          <div class="profile-widget-item-value py-2">{{$id->nama}}</div>
                        </div>
                      </div>
                    </div>

                <form action="{{route('sekolah.update',$id->id)}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="profile-widget-description">
                        <div class="row">
                            <div class="col-11 col-lg-3  col-md-11 offset-0 py-3 ">
                                <div class="row d-flex justify-content-center" >


                                <div class="user-details py-1 px-4 ml-0 text-center">
                                    @php
                                    $kepsek_photo=asset('/storage/').'/'.$id->kepsek_photo;
                                    @endphp
                                <img alt="image" src="{{$id->kepsek_photo!=null  ? $kepsek_photo : $randomimg}}" class="img-thumbnail" data-toggle="tooltip" title="Syahdan Ubaidillah" width="150px" height="150px" style="object-fit:cover;">
                                    <div class="user-name mt-2"><h4>{{$id->kepsek_nama}}</h4></div>
                                    <div class="text-job text-muted">Kepala Sekolah</div>
                                    <div class="user-cta">

                                        <input name="status" type="button" class="btn btn-{{$id->status!='Aktif' ? 'danger' : 'success' }}" id="btnstatus" value="{{$id->status}}">


                                        <script type="text/javascript">
        $(function () {

            let btnstatus=$('#btnstatus');
            // alert(btnstatus.val();)
            btnstatus.click(function () {
                // alert('test')
                fetch_customer_data();
            });

                 //fungsi kirim data
                 function fetch_customer_data(query = '') {
                            console.log(query);
                                $.ajax({
                                    url: "{{ route('api.sekolah.updatestatus',$id->id) }}",
                                    method: 'GET',
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                    query:query,
                                    },
                                    dataType: 'json',
                                    success: function (data) {
                                        // console.log(query);
                                        btnstatus.val(data.output);
                                        btnstatus.prop('class',data.warna);
                                        // console.log(data.output);
                                        // $("#datasiswa").html(data.output);
                                        // console.log(data.output);
                                        // console.log(data.datas);
                                    }
                                })
                            }

        });
                                        </script>
                                    </div>

                                  </div>




                                </div>

                                @push('after-script')
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                      $.uploadPreview({
                                        input_field: "#image-upload",   // Default: .image-upload
                                        preview_box: "#image-preview",  // Default: .image-preview
                                        label_field: "#image-label",    // Default: .image-label
                                        label_default: "Logo Sekolah",   // Default: Choose File
                                        label_selected: "Ganti Logo Sekolah",  // Default: Change File
                                        no_label: false                 // Default: false
                                      });


                                      $.uploadPreview({
                                        input_field: "#image-upload2",   // Default: .image-upload
                                        preview_box: "#image-preview2",  // Default: .image-preview
                                        label_field: "#image-label2",    // Default: .image-label
                                        label_default: "Photo Kepala Sekolah",   // Default: Choose File
                                        label_selected: "Ganti Photo Kepala Sekolah",  // Default: Change File
                                        no_label: false                 // Default: false
                                      });
                                    });
                                    </script>
                                @endpush




                                {{-- <div class="avatar-badge" title="Editor" data-toggle="tooltip"><i class="fas fa-wrench"></i></div> --}}
                                {{-- <img alt="image" src="https://ui-avatars.com/api/?name={{ $id->nama }}&color=7F9CF5&background=EBF4FF" class="img-thumbnail profile-widget-picture"> --}}
                                {{-- <div class="clearfix"></div>
                                <a href="#" class="btn btn-primary mt-3 follow-btn" data-follow-action="alert('follow clicked');" data-unfollow-action="alert('unfollow clicked');">Edit</a> --}}

                                {{-- <div class="clearfix"></div>
                                <a href="#" class="btn btn-{{ $id->status=='Aktif' ? 'success' : 'danger'}}  mt-3 follow-btn" data-follow-action="alert('follow clicked');" data-unfollow-action="alert('unfollow clicked');">{{$id->status}}</a> --}}

                            </div>
                            <input type="hidden" name="status" value="{{$id->status?$id->status:'Nonaktif'}}">
                            <div class="col-11 col-lg-8 py-0 col-md-12">
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Sekolah</label>
                                    <div class="col-sm-3 col-md-9">
                                      <input type="text"  class="form-control @error('nama')
                                          is_invalid
                                      @enderror" id="site-title"  name="nama" value="{{old('nama') ? old('nama') : $id->nama}}">
                                      @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                                      @enderror
                                    </div>
                                  </div>

                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Alamat Sekolah</label>
                                    <div class="col-sm-3 col-md-9">
                                      <input type="text"  class="form-control @error('alamat')
                                          is_invalid
                                      @enderror" id="site-title"   name="alamat" value="{{old('alamat') ? old('alamat') : $id->alamat}}">
                                      @error('alamat')<div class="invalid-feedback"> {{$message}}</div>
                                      @enderror
                                    </div>
                                  </div>

                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama Kepala Sekolah</label>
                                    <div class="col-sm-3 col-md-9">
                                      <input type="text"  class="form-control @error('kepsek_nama')
                                          is_invalid
                                      @enderror" id="site-title"   name="kepsek_nama" value="{{old('kepsek_nama') ? old('kepsek_nama') : $id->kepsek_nama}}">
                                    </div>
                                    @error('kepsek_nama')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                  </div>

                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Tahun Ajaran</label>
                                    <div class="col-sm-3 col-md-9">
                                      <input type="text"  class="form-control @error('tahunajaran_nama')
                                          is_invalid
                                      @enderror" id="site-title"   name="tahunajaran_nama" value="{{old('tahunajaran_nama') ? old('tahunajaran_nama') : $id->tahunajaran_nama}}">
                                      @error('tahun_ajaran_nama')<div class="invalid-feedback"> {{$message}}</div>
                                      @enderror
                                    </div>
                                  </div>

                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Semester</label>
                                    <div class="col-sm-3 col-md-9">
                                      <input type="text"  class="form-control @error('semester_nama')
                                          is_invalid
                                      @enderror" id="site-title"   name="semester_nama" value="{{old('semester_nama') ? old('semester_nama') : $id->semester_nama}}">
                                      @error('semester_nama')<div class="invalid-feedback"> {{$message}}</div>
                                      @enderror
                                    </div>
                                  </div>


                    <input type="hidden" name="provinsi_nama" id="provinsi_nama" value="{{old('provinsi_nama')?old('provinsi_nama'):$id->provinsi}}">
                    <input type="hidden" name="kabupaten_nama" id="kabupaten_nama" value="{{old('kabupaten_nama')?old('kabupaten_nama'):$id->kabupaten}}">
                    <input type="hidden" name="kecamatan_nama" id="kecamatan_nama" value="{{old('kecamatan_nama')?old('kecamatan_nama'):$id->kecamatan}}">

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Provinsi</label>
                        <div class="col-sm-3 col-md-9">
                            @if ($id->provinsi!=null AND $id->provinsi!=null)
                            @php
                                $datasebelumnya=$id->provinsi;
                            @endphp
                            @else
                            @php
                                $datasebelumnya='Data tidak ditemukan';
                            @endphp
                            @endif
                            <select class="js-example-basic-single form-control-sm @error('provinsi')
                                is-invalid
                            @enderror" name="provinsi"  style="width: 75%" id="dataProvinsi" onchange="getDataKabupaten(this)" required>
                                <option  selected value="{{old('provinsi_nama')?old('provinsi_nama'):$datasebelumnya}}"> {{old('provinsi_nama')?old('provinsi_nama'):$datasebelumnya}}</option>

                              </select>

                          @error('provinsi')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                        </div>


                        @push('before-script')
                        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
                        {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
                        <script type="text/javascript">
                            $(document).ready(function() {
// variable
let provinsi_nama=document.getElementById("provinsi_nama");
let kabupaten_nama=document.getElementById("kabupaten_nama");
let kecamatan_nama=document.getElementById("kecamatan_nama");

let dataProvinsi=document.getElementById("dataProvinsi");
let dataKabupaten=document.getElementById("dataKabupaten");
let kab = document.getElementsByClassName("kab");
let kec = document.getElementsByClassName("kec");

//fungsi
// function addOption(id='0',data='Data tidak ditemukan'){
// //     var node = document.createElement("OPTION");
// //     var textSelect= document.createTextNode(data);
// //     var idSelect= document.createIdNode(idc);
// //     node.appendChild(textSelect);
// //     dataprovinsi.appendChild(node);

// }

//Select2
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            // theme: "classic",
            // allowClear: true,
            width: "resolve"
        });
    });


// console.log(dataprovinsi);

    //ambildatanconst
getDatas = async () => {
//  axios.get('https://reqres.in/api/users')
await axios.get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')
 .then(response => {
  let datas =  response.data.provinsi;

//   dataKabupaten.remove();
//     dataKecamatan.remove();
// dataKabupaten.innerHTML=`<option disabled selected value=""> Pilih Kabupaten</option>`;
// dataKecamatan.innerHTML=`<option disabled selected value=""> Pilih Kecamatan</option>`;
  datas.forEach(function(data){
    // console.log(data);
    // addOption(data.id,data.nama);

    dataProvinsi.innerHTML += `
    <option value="${data.id}"> ${data.nama}</option>
    `;
  })
//   console.log(`GET data`, datas);

})
 .catch(error => console.error(error));
};

//ambildataKab
getDatasKab = async (id='1') => {
//  axios.get('https://reqres.in/api/users')
await axios.get(`https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=${id}`)
 .then(response => {
  let datas =  response.data.kota_kabupaten;

dataKabupaten.innerHTML=`<option disabled selected value=""> Pilih Kabupaten</option>`;
dataKecamatan.innerHTML=`<option disabled selected value=""> Pilih Kecamatan</option>`;
  datas.forEach(function(data){
    // console.log(data);
    dataKabupaten.innerHTML += `
    <option value="${data.id}" class="kab"> ${data.nama}</option>
    `;
  })
//   console.log(`GET data`, datas);

})
 .catch(error => console.error(error));
};


//ambildataKab
getDatasKec = async (id='1') => {
//  axios.get('https://reqres.in/api/users')
await axios.get(`https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=${id}`)
 .then(response => {
  let datas =  response.data.kecamatan;

// dataKecamatan.innerHTML=``;
  datas.forEach(function(data){
    // console.log(data);
    dataKecamatan.innerHTML += `
    <option value="${data.id}" class="kec"> ${data.nama}</option>
    `;
  })
  console.log(`GET data`, datas);

})
 .catch(error => console.error(error));
};


//running
getDatas();

// onchange
getDataKabupaten=(sel)=>{

    let value = sel.value;
    let text = sel.options[sel.selectedIndex].text;
    provinsi_nama.value=text;
//   console.log(value+' '+text);

    //ambildataKabupaten
    getDatasKab(value);


}


getDataKecamatan=(sel)=>{
    let value = sel.value;
    let text = sel.options[sel.selectedIndex].text;
    getDatasKec(value);
    kabupaten_nama.value=text;
//   console.log(value+' '+text);
}

inputDataKecamatan=(sel)=>{
    let value = sel.value;
    let text = sel.options[sel.selectedIndex].text;
    getDatasKec(value);
    kecamatan_nama.value=text;
//   console.log(value+' '+text);
}

// activities.addEventListener("click", function() {
//     var options = activities.querySelectorAll("option");
//     var count = options.length;
//     if(typeof(count) === "undefined" || count < 2)
//     {
//         addActivityItem();
//     }
// });

// activities.addEventListener("change", function() {
//     if(activities.value == "addNew")
//     {
//         addActivityItem();
//     }
// });


                            });
                           </script>
                        @endpush

                        <div class="form-group row align-items-center">
                            <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kabupaten</label>
                            <div class="col-sm-3 col-md-9">

                                @if ($id->kabupaten!=null || $id->kabupaten!='')
                                @php
                                    $datasebelumnya=$id->kabupaten;
                                @endphp
                                @else
                                @php
                                    $datasebelumnya='Data tidak ditemukan';
                                @endphp
                                @endif
                            <select class="js-example-basic-single form-control-sm @error('kabupaten')
                                is-invalid
                            @enderror" name="kabupaten"  style="width: 75%" id="dataKabupaten" onchange="getDataKecamatan(this)"  required>
                                <option selected value="{{old('kabupaten_nama')?old('kabupaten_nama'):$datasebelumnya}}">{{old('kabupaten_nama')?old('kabupaten_nama'):$datasebelumnya}}</option>

                              </select>

                          @error('kabupaten')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Kecamatan</label>
                        <div class="col-sm-3 col-md-9">

                            @if ($id->kecamatan!=null AND $id->kecamatan!=null)
                            @php
                                $datasebelumnya=$id->kecamatan;
                            @endphp
                            @else
                            @php
                                $datasebelumnya='Data tidak ditemukan';
                            @endphp
                            @endif
                            <select class="js-example-basic-single form-control-sm @error('kecamatan')
                                is-invalid
                            @enderror" name="kecamatan"  style="width: 75%" id="dataKecamatan"  onchange="inputDataKecamatan(this)" required>
                                <option selected value="{{old('kecamatan_nama')?old('kecamatan_nama'):$datasebelumnya}}">{{old('kecamatan_nama')?old('kecamatan_nama'):$datasebelumnya}}</option>

                              </select>

                          @error('kecamatan')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                    </div>

                                  <div class="row">

                                <div class="form-group row mb-4 mt-3">
                                    <div class="col-sm-4 col-md-4">
                                      <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label2">Logo Sekolah</label>
                                        <input type="file" name="sekolah_logo" id="image-upload" class="@error('sekolah_logo')
                                        is_invalid
                                    @enderror"  accept="image/png, image/gif, image/jpeg" />

                                    @error('sekolah_logo')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                      </div>
                                    </div>
                                  </div>


                                <div class="form-group row mb-4 mt-3 ml-3">
                                    <div class="col-sm-4 col-md-4">
                                      <div id="image-preview2" class="image-preview">
                                        <label for="image-upload2" id="image-label">Foto Kepala Sekolah</label>
                                        <input type="file" name="kepsek_photo" id="image-upload2" class="@error('kepsek_photo')
                                            is_invalid
                                        @enderror" accept="image/png, image/gif, image/jpeg" />

                                    @error('kepsek_photo')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                      </div>
                                    </div>
                                  </div>

                                </div>
                  <div class="card-footer text-md-right">
                    <button class="btn btn-primary" id="save-btn">Simpan</button>
                  </div>
                            </div>
                        </div>

                    </div>

                </form>

                  </div>
                </div>

          </div>
        </div>
    </div>
</section>
@endsection


@section('containermodal')

              <!-- Import Excel -->
              <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form method="post" action="{{ route('detailsekolah.import',$id->id) }}" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Detail Data Sekolag</h5>
                      </div>
                      <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel(.xlsx)</label>
                        <div class="form-group">
                          <input type="file" name="file" required="required">
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

@endsection
