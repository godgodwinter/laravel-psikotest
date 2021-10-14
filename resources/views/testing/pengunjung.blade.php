@extends('layouts.layoutluar')

@section('container')


<section x-data="introSectionState" class="relative min-h-screen intro">


    <div class="relative px-6 pb-24 mx-auto md:pt-24 max-w-7xl">
        <div class="flex flex-col items-center justify-end pt-20 space-y-10 pb-18">

            @php
            $tipe=session('tipe');
            $message=session('status');
            @endphp
                    @if (session('status'))

                    <div class="bg-white rounded-lg border-blue-600 border p-3 shadow-lg" id="notif">
                        <div class="flex flex-row">
                          <div class="px-2">
                            <svg width="24" height="24" viewBox="0 0 1792 1792" fill="#44C997" xmlns="http://www.w3.org/2000/svg">
                              <path d="M1299 813l-422 422q-19 19-45 19t-45-19l-294-294q-19-19-19-45t19-45l102-102q19-19 45-19t45 19l147 147 275-275q19-19 45-19t45 19l102 102q19 19 19 45t-19 45zm141 83q0-148-73-273t-198-198-273-73-273 73-198 198-73 273 73 273 198 198 273 73 273-73 198-198 73-273zm224 0q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"/>
                              </svg>
                          </div>
                          <div class="ml-2 mr-6">
                            <span class="font-semibold">{{$message}}!</span>
                            {{-- <span class="block text-gray-500">Anyone with a link can now view this file</span> --}}
                          </div>
                        </div>
                      </div>

                    @endif



            <h2
                class="text-4xl font-extrabold leading-snug text-center text-transparent tex md:text-6xl lg:text-4xl bg-gradient-to-tr from-pink-500 to-indigo-600 via-blue-600-300 bg-clip-text ">



 <div class="typing-container">
    <span id="sentence" class="sentence">SISTEM PERPUSTAKAAN </span>
    {{-- <span id="feature-text"></span>
    <span class="input-cursor"></span> --}}
  </div>

            </h2>

        </div>



        <script type="text/javascript">
            $(document).ready(function () {
                $('.selectpicker').select2();
            });

        </s>

        <script type="text/javascript">
            $(document).ready(function () {
                $('.js-example-basic-multiple').select2();
            });

        </script>

        <div class="flex justify-center p-4 px-3 py-10">
            <div class="w-full max-w-lg">
                <div class="bg-white rounded shadow shadow-drop-center">
                    <div class="py-4 text-xl tracking-wider text-center text-gray-700 border-b uppercase">
                        ISI DATA PENGUNJUNG
                    </div>

                    <form action="pengunjung/proses" class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md"
                        method="GET" autocomplete="on" novalidate>


                    {{-- <div  class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md"> --}}
                        <div class="mb-4">
                            <label class="block mb-2 font-bold text-red-300 text-sm" for="pair">
                                Cari jika sudah menjadi anggota perpus<br>
                                Jika belum menjadi anggota langsung isi data saja.
                            </label>

                            <input
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 search"
                                id="inline-full-name" type="text" placeholder="Cari . . . " name="cari" >

                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 font-bold text-gray-700 text-md" for="pair">
                                Nomer Identitas
                            </label>

                            <input
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 nomeridentitas"
                                id="inline-full-name" type="text" placeholder="" name="nomeridentitas" required value="{{old('nomeridentitas')}}">
                                @error('nomeridentitas')
                                <label class="block mb-2 font-bold text-red-300 text-sm" for="pair">
                                    {{$message}}
                                </label>
                                @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 font-bold text-gray-700 text-md" for="pair">
                                Nama
                            </label>

                            <input
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 nama"
                                id="inline-full-name" type="text" placeholder="" name="nama" required  value="{{old('nama')}}">
                                @error('nama')
                                <label class="block mb-2 font-bold text-red-300 text-sm" for="pair">
                                    {{$message}}
                                </label>
                                @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 font-bold text-red-200 text-md" for="pair">
                                Tanggal (untuk testing)
                            </label>
                                @if(old('tgl')!=null)
                                    @php
                                        $tgl=old('tgl');
                                    @endphp
                                @else
                                    @php
                                        $tgl=date('Y-m-d');
                                    @endphp
                                @endif
                            <input
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 nama"
                                id="inline-full-name" type="date" placeholder="" name="tgl" required  value="{{$tgl}}">
                                @error('nama')
                                <label class="block mb-2 font-bold text-red-300 text-sm" for="pair">
                                    {{$message}}
                                </label>
                                @enderror
                        </div>
                        <div class="flex items-center justify-between">

                            <button class="px-4 py-2 font-semibold text-yellow-700 bg-transparent border border-yellow-500 rounded hover:bg-yellow-600 active:bg-yellow-700 hover:text-white hover:border-transparent focus:outline-none focus:shadow-outline transform hover:scale-150 transition duration-500 ease-in-out"
                            href="#" id="clear"> Clear
                        </button>

                            <button
                                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:shadow-outline transform hover:scale-150 transition duration-500 ease-in-out "
                                href="#"> Submit
                            </button>

                        </div>
                    {{-- </div> --}}
                </form>
                </div>

                <script>
                    $(document).ready(function(){

                    //  fetch_customer_data();
                    cari = $("input[name=cari]").val();

                     function fetch_customer_data(query = '')
                     {
                      $.ajax({
                       url:"{{ route('anggota.proses') }}",
                       method:'GET',
                       data:{
                                "_token": "{{ csrf_token() }}",
                                cari: cari,
                            },
                       dataType:'json',
                       success:function(data)
                       {
                           $('#tampil').html(data.show);

                           if(data.first!==null){
                                $("input[name=nomeridentitas]").val(data.first.nomeridentitas);
                                $("input[name=nama]").val(data.first.nama);
                           }else{
                                $("input[name=nomeridentitas]").val('');
                                $("input[name=nama]").val('');
                           }
                        //  $("input[name=cari]").val('');
                            // console.log($('#tampil').html(data.datas);
                            // console.log(data.datas);
                        // $('tbody').html(data.table_data);
                        // $('#total_records').text(data.total_data);
                       }
                      })
                     }

                     $(document).on('keyup', '.search', function(){
                    cari = $("input[name=cari]").val();
                            // console.log(cari);
                      var query = $(this).val();
                      fetch_customer_data(query);
                     });


                     $("button#clear").click(function(){

                        //  alert('');
                         $("input[name=cari]").val('');
                         $("input[name=nomeridentitas]").val('');
                         $("input[name=nama]").val('');
                         $("input[name=tgl]").val('{{date('Y-m-d')}}')

                         return false;
                     });
                    });
                    </script>



            </div>
        </div>

        <div class="flex flex-wrap" id="tampil">
            {{-- <div id="tampil">

            </div> --}}

{{--
            @for ($i=0;$i<5;$i++)
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 mb-4 bg-white">
                <div class="max-w-lg rounded overflow-hidden shadow-lg">
                    <img class="w-full" src="https://ui-avatars.com/api/?name=casd&color=7F9CF5&background=EBF4FF" alt="Sunset in the mountains">
                    <div class="px-6 py-4">
                      <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                      <p class="text-gray-700 text-base">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                      </p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                      <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                      <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                      <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
                    </div>
                  </div>
            </div>

            @endfor --}}


            {{-- <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/2 xl:w-1/6 mb-4 bg-gray-400"></div> --}}
          </div>




        <div x-ref="showCase"
            class="relative origin-bottom pointer-events-none select-none dashboard-showcase md:px-20 md:-mt-20 opacity-30">
            {{-- <img x-show="!isDark" class="block w-full"
                src="/assets/landing/dashboard-showcase.3432ade5.svg" alt="" />
            <img x-show="isDark" class="block w-full"
                src="/assets/landing/dashboard-showcase-dark.ba0c479a.svg" alt="" /> --}}
        </div>
    </div>
</section>

@endsection
