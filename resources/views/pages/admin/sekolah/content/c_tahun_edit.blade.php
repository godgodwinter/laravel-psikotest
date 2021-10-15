
            <form id="setting-form" method="POST" action="{{route('sekolah.tahun.update',[$id->id,$data->id])}}">
                @method('put')
                @csrf
                <div class="card" id="settings-card">
                  <div class="card-header">
                    <h4>Tahun Ajaran</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Pilih Tahun</label>
                      <div class="col-sm-6 col-md-9">
@push('after-style')
{{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script> --}}

    {{-- <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> --}}

    <script src="{{asset('assets/jquery-year-picker/js/yearpicker.js')}}" type="text/javascript"></script>
    {{-- <script src="{{asset('assets/jquery-year-picker/js/yearpicker.js')}}" type="text/javascript"></script> --}}
    <link href="{{asset('assets/jquery-year-picker/css/yearpicker.css')}}" rel="stylesheet" type="text/css" />
@endpush
    <input type="text" name="nama" class="yearpicker form-control @error('nama') is-invalid @enderror" value="{{old('nama') ? old('nama') : $data->nama}}" />
      @error('nama')<div class="invalid-feedback"> {{$message}}</div>
      @enderror
<script>
  $(document).ready(function() {
    $('.yearpicker').yearpicker({
        selectedClass: 'selected',
        disabledClass: 'disabled',
        hideClass: 'hide',
        highlightedClass: 'highlighted',
      });
    });
</script>

                      </div>
                    </div>

                  </div>
                  <div class="card-footer bg-whitesmoke text-md-right">
                    <button class="btn btn-primary" id="save-btn">Simpan</button>
                  </div>
                </div>
              </form>
