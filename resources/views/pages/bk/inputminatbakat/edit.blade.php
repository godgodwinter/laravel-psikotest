@extends('layouts.default')

@section('title')
Edit Minat Bakat
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
            <div class="breadcrumb-item">@yield('title')</div>
        </div>
    </div>



           <form id="setting-form" method="POST" action="{{route('bk.inputminatbakat.update',[$data->id])}}">
            @method('put')
                @csrf
                <div class="card" id="settings-card">
                  <div class="card-header">
                    <h4>Analisa Minat Bakat Edit </h4>
                  </div>
                  <div class="card-body">

                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama</label>
                        <div class="col-sm-6 col-md-9">

                          <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama"  disabled value="{{ $data->nama }}">

                          @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>

                      @forelse ($master as $m)


                      <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{ $m->nama }}</label>
                        <div class="col-sm-6 col-md-9">
                            @php
                                $readonly='';
                                $isi='';
                                $periksadata=\App\Models\minatbakatdetail::where('siswa_id',$data->id)->where('sekolah_id',$sekolah_id)->where('minatbakat_id',$m->id)->first();
                                // dd($periksadata);
                                if($periksadata!=null){
                                    $isi=$periksadata->nilai;
                                }
                                if($m->menukhusus!='bk'){
                                    $readonly='readonly';
                                }
                            @endphp
                          <input type="text" class="form-control  @error('nomerinduk') is-invalid @enderror" name="{{ $m->id }}" value="{{ $isi }}" {{$readonly}}>

                          @error('nomerinduk')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                        </div>
                      </div>
                      @empty

                      @endforelse

                      </div>

                    </div>

                  <div class="card-footer bg-whitesmoke text-md-right">
                    <button class="btn btn-primary" id="save-btn">Simpan</button>
                  </div>
                </div>
              </form>
            </div>
        </section>
        @endsection
