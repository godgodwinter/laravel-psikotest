@extends('layouts.default')

@section('title')
Sekolah
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
            <div class="breadcrumb-item"><a href="{{route('sekolah')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Tambah</h5>
            </div>
            <div class="card-body">

                <form action="{{route('sekolah.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="nama">Nama Sekolah <code>*)</code></label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{old('nama')}}" required>
                        @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="alamat">Alamat  Sekolah <code></code></label>
                        <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{old('alamat')}}" >
                        @error('alamat')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="status">Status <code>*)</code></label>

                        <select class="form-control  @error('status') is-invalid @enderror" name="status" required>
                            <option>Aktif</option>
                            <option>Nonaktif</option>
                        </select>
                        @error('status')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="kepsek_nama">Nama  Kepala  Sekolah <code></code></label>
                        <input type="text" name="kepsek_nama" id="kepsek_nama" class="form-control @error('kepsek_nama') is-invalid @enderror" value="{{old('kepsek_nama')}}" >
                        @error('kepsek_nama')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="tahunajaran_nama">Tahun  Ajaran <code></code></label>
                        <input type="text" name="tahunajaran_nama" id="tahunajaran_nama" class="form-control @error('tahunajaran_nama') is-invalid @enderror" value="{{old('tahunajaran_nama')}}" >
                        @error('tahunajaran_nama')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="semester_nama">Semester <code></code></label>
                        <input type="text" name="semester_nama" id="kepsek_nama" class="form-control @error('semester_nama') is-invalid @enderror" value="{{old('semester_nama')}}" >
                        @error('semester_nama')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="provinsi_nama" id="provinsi_nama" value="">
                    <input type="hidden" name="kabupaten_nama" id="kabupaten_nama" value="">
                    <input type="hidden" name="kecamatan_nama" id="kecamatan_nama" value="">
                    <div class="form-group col-md-3 col-6 col-lg-3 mt-0 ml-3">
                        <label for="status">Provinsi <code>*)</code></label>

                        <div class="col-sm-6 col-md-12">

                            <select class="js-example-basic-single form-control-sm @error('provinsi')
                                is-invalid
                            @enderror" name="provinsi"  style="width: 75%" id="dataProvinsi" onchange="getDataKabupaten(this)" required>
                                <option disabled selected value=""> Pilih Provinsi</option>

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
dataKabupaten.innerHTML=`<option disabled selected value=""> Pilih Kabupaten</option>`;
dataKecamatan.innerHTML=`<option disabled selected value=""> Pilih Kecamatan</option>`;
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

                    <div class="form-group col-md-3 col-6 col-lg-3 mt-0 ml-0">
                        <label for="status">Kabupaten <code>*)</code></label>
                        <div class="col-sm-6 col-md-12">

                            <select class="js-example-basic-single form-control-sm @error('kabupaten')
                                is-invalid
                            @enderror" name="kabupaten"  style="width: 75%" id="dataKabupaten" onchange="getDataKecamatan(this)"  required>
                                <option disabled selected value=""> Pilih Kabupaten</option>

                              </select>

                          @error('kabupaten')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                    </div>

                    <div class="form-group col-md-3 col-3 mt-0 ml-0">
                        <label for="status">Kecamatan <code>*)</code></label>
                        <div class="col-sm-6 col-md-12">

                            <select class="js-example-basic-single form-control-sm @error('kecamatan')
                                is-invalid
                            @enderror" name="kecamatan"  style="width: 75%" id="dataKecamatan"  onchange="inputDataKecamatan(this)" required>
                                <option disabled selected value=""> Pilih Kecamatan</option>

                              </select>

                          @error('kecamatan')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

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
                                <div class="form-group col-md-5 col-5 mt-0 ml-5">
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
                      </div>

                      <div class="form-group col-md-5 col-5 mt-0 ml-5">
                    <div class="form-group row mb-4 mt-3">
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

                    </div>

                    <div class="card-footer text-right mr-5">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</section>
@endsection
