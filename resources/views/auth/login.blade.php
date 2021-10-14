@extends('layouts.layoutluar')

@section('container')

<section x-data="introSectionState" class="relative min-h-screen intro">
    <div class="relative px-6 pb-24 mx-auto md:pt-24 max-w-7xl">
        <div class="flex flex-col items-center justify-end pt-20 space-y-10 pb-18">
            <h2
                class="text-4xl font-extrabold leading-snug text-center text-transparent tex md:text-6xl lg:text-4xl bg-gradient-to-tr from-pink-500 to-indigo-600 via-blue-600-300 bg-clip-text ">
                SISTEM PERPUSTAKAAN

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
                    <div class="py-4 text-xl tracking-wider text-center text-gray-700 border-b">
                        {{ Fungsi::sekolahalamat() }}
                    </div>

                    {{-- <form action="cari/proses" class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md"
                        method="GET" autocomplete="on" novalidate> --}}
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                    <div  class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
                        <div class="mb-4">
                            <label class="block mb-2 font-bold text-gray-700 text-md" for="pair">
                                Username / Email :
                            </label>

                            <input
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 search"
                                id="inline-full-name" type="text" placeholder="Username / Email " name="identity"  required>

                                @error('identity')
                                <label class="block mb-2 font-bold text-red-400 text-sm" for="pair">
                                    {{ $message}}
                                </label>
                                @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 font-bold text-gray-700 text-md" for="pair">
                                Password :
                            </label>

                            <input
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 search"
                                id="inline-full-name"  placeholder="Password" name="password" type="password" required>

                                @error('password')
                                <label class="block mb-2 font-bold text-red-400 text-sm" for="pair">
                                    {{ $message}}
                                </label>
                                @enderror
                        </div>
                         
                        <div class="flex items-center justify-between">

                            <button class="px-4 py-2 font-semibold text-white bg-transparent border border-white rounded hover:bg-white active:bg-white hover:text-white hover:border-transparent focus:outline-none focus:shadow-outline"
                                id="clear"> 
                            </button>

                            <button type="submit"
                                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:shadow-outline transform hover:scale-150 transition duration-500 ease-in-out "
                                href="#"> Masuk
                            </button>

                        </div>
                        
                        @if($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="mb-4 mt-2">
                            <label class="block mb-2 font-bold text-red-400 text-sm" for="pair">
                                {{ $error }}
                            </label>
                        </div>    
                        @endforeach
                        @endif
                    </div>
                        </form>
                </div>

                <script>
                    $(document).ready(function(){

                     
                    //  $("button#clear").click(function(){
                         
                    //     //  alert('');
                    //      $("input[name=identity]").val('');
                    //      $("input[name=password]").val('');
                    //  });
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