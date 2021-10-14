@extends('layouts.layoutluar')

@section('container')


<section x-data="introSectionState" class="relative min-h-screen intro">
    <div class="relative px-6 pb-24 mx-auto md:pt-24 max-w-7xl">
       

        
    
    <!-- ./ Breadcrumbs -->
  @php

  $jmlpinjam=DB::table('peminjaman')
  ->where('nomeridentitas',$datas->nomeridentitas)
  ->count();
  $jmlkembali=DB::table('pengembalian')
  ->where('nomeridentitas',$datas->nomeridentitas)
  ->count();

  if($jmlpinjam>0){
      $tersedia=$jmlpinjam." Kali";
  }else{
      $tersedia="Belum pernah pinjam";
  }

  if($jmlpinjam>$jmlkembali){
      $belumkembali=$jmlpinjam-$jmlkembali;
  }else{
      $belumkembali=0;
  }

      if($datas->gambar==null){
                        $gambar='https://ui-avatars.com/api/?name='.$datas->nama.'&color=7F9CF5&background=EBF4FF';
                    }else{
                        $gambar=asset("storage/").'/'.$datas->gambar;
                    }
  @endphp
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
      <div class="flex flex-col md:flex-row -mx-4">
        <div class="md:flex-1 px-4">
          <div x-data="{ image: 1 }" x-cloak>
            <div class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4">
              <div x-show="image === 1" class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                <img class="w-full object-cover h-96" src="{{$gambar}}" alt="Sunset in the mountains">
              </div>
  
            
            </div>
  
            <div class="flex -mx-2 mb-4">
              <template x-for="i in 4">
                <div class="flex-1 px-2">
                </div>
              </template>
            </div>
          </div>
        </div>
        <div class="md:flex-1 px-4">
          <h2 class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl">{{$datas->nama}}.</h2>
          {{-- <p class="text-gray-500 text-sm">Pengarang : <button  class="text-indigo-600 hover:underline transform hover:translate-x-2 hover:translate-y-2 transition duration-500 ease-in-out">{{$datas->pengarang}}</button></p> --}}
  
          <div class="flex items-center space-x-4 my-4">
            <div class="flex-1">
              <p class="text-green-500 text-xl font-semibold">Alamat : {{$datas->alamat}}</p>
              <p class="text-gray-400 text-sm">{{$datas->tempatlahir}}, {{$datas->tgllahir}} , {{$datas->jk}}</p>
            </div>
          </div>
          <table>
            <tr>
            <td style="padding-right:10px;">
                                 <p class="text-gray-700 dark:text-white text-base">Pinjam </td><td style="padding-right:10px;"> :</td><td> 
                                    {{$jmlpinjam}} Buku </td>
            </p>
            </tr>
            <tr>
            </tr>
            <tr>
            <td style="padding-right:10px;">
                                 <p class="text-gray-700 dark:text-white text-base">Belum dikembalikan </td><td style="padding-right:10px;"> :</td><td> 
                                    {{$belumkembali}} Buku </td>
            </p>
            </tr>
           
            </table>
  

          <div class="flex py-4 space-x-4">
            <div class="relative">
             

            <img w src="data:image/png;base64,{{DNS2D::getBarcodePNG(url('/anggotashow/'.$datas->nomeridentitas), 'QRCODE')}}" alt="barcode" class="transform hover:skew-x-12 hover:skew-y-12 transition duration-500 ease-in-out h-44"/>
              
            </div></div>


          {{-- <div class="flex py-4 space-x-4">
            <div class="relative">
             
  
              <svg class="w-5 h-5 text-gray-400 absolute right-0 bottom-0 mb-2 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
              </svg>
            </div>
  
            <button type="button" class="h-14 px-6 py-2 font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white">
              Add to Cart
            </button>
          </div> --}}
        </div>
      </div>
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
