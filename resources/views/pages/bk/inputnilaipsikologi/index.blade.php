@extends('layouts.default')

@section('title')
Data Nilai Psikologi Siswa
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
            {{-- <div class="breadcrumb-item"><a href="#">Layout</a></div> --}}
            <div class="breadcrumb-item">@yield('title')</div>
        </div>
    </div>



    <div class="card-body">

        <form action="{{route('bk.inputnilaipsikologi.cari')}}" method="GET" class="babeng-form">
            <div class="row mb-2">

                <div class="col-12 col-md-3 col-sm-5">
                    {{-- <input type="text" class="babeng babeng-select  ml-0" name="cari"> --}}
                    <select class="js-example-basic-single  form-control @error('kelas_id')
                    is-invalid
                @enderror" name="kelas_id"  style="width: 75%"  style="width: 100%" required>
                    <option disabled selected value=""> Pilih kelas</option>
                    @foreach ($kelas as $t)
                        <option value="{{ $t->id }}"> {{ $t->nama }}</option>
                    @endforeach
                  </select>
                </div>
                @push('before-script')
                <script type="text/javascript">
                    $(document).ready(function() {
                        let testData='';
                        let item='';

                        // In your Javascript (external .js resource or <script> tag)
                            $(document).ready(function() {
                                $('.js-example-basic-single').select2({
                                    // theme: "classic",
                                    // allowClear: true,
                                    width: "resolve"
                                });
                            });
                    });
                   </script>
                @endpush
                <div class="col-12 col-md-3 col-sm-5">
                    <span>
                        <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit" value="Pilih">
                    </span>
                </div>
            </div>
        </form>

    </div>

<div class="card" id="settings-card">
    <div class="card-header">
        <h4>Master Nilai Psikologi kelas :  {{ $kelaspertama!=null?$kelaspertama->nama:'Kelas tidak ditemukan' }} </h4>
        @csrf
    </div>
    <div class="card-body babengcontainer">

        @push('before-script')
<script>
    function getData(link='#',id=null){
        //  console.log(link);

        (async()=>{
        const requestOptions = {
        method: 'POST',
        headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-Token": $('input[name="_token"]').val()
        },
        };
        const response = await fetch(link, requestOptions);
        let data = await response.json();
        if (response.ok){
        // console.log(data);
        // document.getElementById('sukses').innerText = sukses;
        setData(data,id);
        }else{
        console.log('error!');
        }
        })();
    }
    function setData(datas=null,id=null){
        // console.log(datas);
        datas.data.forEach(element => {

            testData = !!document.getElementById(id+'-'+element.kunci);
                            if (testData===true){
                                // console.log(id+'-'+element.kunci);
                        (async () => {
                             item = element.isi;
                          document.getElementById(id+'-'+element.kunci).innerText = await item;
                        })();
                            }
            // console.log(element.isi);
        });
    }
</script>
@endpush


        <table id="example" class="table table-striped table-bordered mt-0 table-sm" >
            <thead>
                <tr>
                    <th class="text-center babeng-min-row"> No</th>
                    <th class="th-table" >Nama </th>
                    @php
                    $master=DB::table('masternilaipsikologi')->whereNull('deleted_at')->get();
                    @endphp
                    @foreach ($master as $m)
                    <th class="text-center" style="width:5px">
                        {{$m->singkatan}}
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($datas as $data)
                <tr id="sid{{ $loop->index+1 }}">
                    <td class="text-center">
                        {{$loop->index+1}}
                    </td>
                    <td class="babeng-td">
                        {{$data->nama}}
                    </td>
                    @foreach ($master as $m)<td id="{{$data->id}}-{{$m->nama}}"></td>@endforeach
@push('before-script')
<script> getData('{{route('api.apiprobk_sertifikat',$data->apiprobk_id)}}',{{$data->id}}); </script>
@endpush
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>
</div>
</div>
</div>

          </div>
        </div>
    </div>
</section>
@endsection
