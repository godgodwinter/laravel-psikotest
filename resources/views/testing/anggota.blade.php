@extends('layouts.layoutluar')

@section('container')


<section x-data="introSectionState" class="relative min-h-screen intro">
    <div class="relative px-6 pb-24 mx-auto md:pt-24 max-w-7xl">
        <div class="flex flex-col items-center justify-end pt-20 space-y-10 pb-18">
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

        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('.js-example-basic-multiple').select2();
            });

        </script>

        <div class="flex justify-center p-4 px-3 py-10">
            <div class="w-full max-w-lg">
                <div class="bg-white rounded shadow shadow-drop-center">
                    <div class="py-4 text-xl tracking-wider text-center text-gray-700 border-b uppercase">
                        Mts Shirothul Fuqoha
                    </div>

                    {{-- <form action="cari/proses" class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md"
                        method="GET" autocomplete="on" novalidate> --}}

                    <div  class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
                        <div class="mb-4">
                            <label class="block mb-2 font-bold text-gray-700 text-md" for="pair">
                                Pencarian:
                            </label>

                            <input
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 search"
                                id="inline-full-name" type="text" placeholder="Cari Anggota. . . " name="cari" >

                        </div>
                        <div class="flex items-center justify-between">

                            <button class="px-4 py-2 font-semibold text-yellow-700 bg-transparent border border-yellow-500 rounded hover:bg-yellow-600 active:bg-yellow-700 hover:text-white hover:border-transparent focus:outline-none focus:shadow-outline transform hover:scale-150 transition duration-500 ease-in-out"
                            href="#" id="clear"> Clear
                        </button>

                            {{-- <button
                                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:shadow-outline transform hover:scale-150 transition duration-500 ease-in-out "
                                href="#"> Submit
                            </button> --}}

                        </div>
                    </div>
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
                     });
                    });
                    </script>



            </div>
        </div>

        <div class="flex flex-wrap" id="tampil">
            {{-- <div id="tampil">

            </div> --}}




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
