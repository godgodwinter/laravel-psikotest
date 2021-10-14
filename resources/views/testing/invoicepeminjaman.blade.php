
@extends('layouts.layoutluar')

@section('container')
<script>
    const carouselText = [
  {text: "Apple", color: "red"},
  {text: "Orange", color: "orange"},
  {text: "Lemon", color: "yellow"}
]

$( document ).ready(async function() {
  carousel(carouselText, "#feature-text")
});

async function typeSentence(sentence, eleRef, delay = 100) {
  const letters = sentence.split("");
  let i = 0;
  while(i < letters.length) {
    await waitForMs(delay);
    $(eleRef).append(letters[i]);
    i++
  }
  return;
}

async function deleteSentence(eleRef) {
  const sentence = $(eleRef).html();
  const letters = sentence.split("");
  let i = 0;
  while(letters.length > 0) {
    await waitForMs(100);
    letters.pop();
    $(eleRef).html(letters.join(""));
  }
}

async function carousel(carouselList, eleRef) {
    var i = 0;
    while(true) {
      updateFontColor(eleRef, carouselList[i].color)
      await typeSentence(carouselList[i].text, eleRef);
      await waitForMs(1500);
      await deleteSentence(eleRef);
      await waitForMs(500);
      i++
      if(i >= carouselList.length) {i = 0;}
    }
}

function updateFontColor(eleRef, color) {
  $(eleRef).css('color', color);
}

function waitForMs(ms) {
  return new Promise(resolve => setTimeout(resolve, ms))
}
</script>

<section x-data="introSectionState" class="relative min-h-screen intro">
    <div class="relative px-6 pb-24 mx-auto md:pt-24 max-w-7xl">
       

		<div class="flex justify-between">
			<h2 class="text-2xl font-bold mb-6 pb-2 tracking-wider uppercase">Perpustakaan</h2>
            
{{-- <div class="typing-container">
    <span id="sentence" class="sentence">Here, take this </span>
    <span id="feature-text"></span>
    <span class="input-cursor"></span>
  </div> --}}
			<div>
				<div class="relative mr-4 inline-block">
					<a class="text-gray-500 cursor-pointer w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-300 inline-flex items-center justify-center" href="{{url('/cetak/peminjamanshow/'.$datas->kodetrans)}}">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<rect x="0" y="0" width="24" height="24" stroke="none"></rect>
							<path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
							<path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
							<rect x="7" y="13" width="10" height="8" rx="2" />
						</svg>				  
					</a>
				</div>
				
				<div class="relative inline-block">
				</div>
			</div>
		</div>

	

        
		<div class="flex mb-8 justify-between">
			<div class="w-1/3">
                <div class="mb-2 md:mb-1 md:flex items-center">
					<label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Nama</label>
					<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-xs" id="inline-full-name" type="text" placeholder="eg. #INV-100001" value="{{$datas->nama}}" disabled>
				</div>
                <div class="mb-2 md:mb-1 md:flex items-center">
					<label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Nomer Identitas</label>
					<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-xs" id="inline-full-name" type="text" placeholder="eg. #INV-100001" value="{{$datas->nomeridentitas}}" disabled>
				</div>
                <div class="mb-2 md:mb-1 md:flex items-center">
					<label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Jaminan</label>
					<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-xs" id="inline-full-name" type="text" placeholder="eg. #INV-100001" value="{{$datas->jaminan_tipe}}" disabled>
				</div>
                @php
                    if($datas->jaminan_nama==null){
                        $jaminan_nama=$datas->nomeridentitas;
                    }else{
                        $jaminan_nama=$datas->jaminan_nama;
                    }
                @endphp
                <div class="mb-2 md:mb-1 md:flex items-center">
					<label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Jaminan</label>
					<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-xs" id="inline-full-name" type="text" placeholder="eg. #INV-100001" value="{{$jaminan_nama}}" disabled>
				</div>
            </div>
			<div class="w-1/3">
            </div>
                <div class="w-1/3">
                
                <div class="mb-2 md:mb-1 md:flex items-center">
					<label class="w-40 text-gray-800 block font-bold text-xs uppercase tracking-wide">Kode Transaksi</label>
					<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-xs" id="inline-full-name" type="text" placeholder="eg. #INV-100001" value="{{$datas->kodetrans}}" disabled>
				</div>
                <div class="mb-2 md:mb-1 md:flex items-center">
					<label class="w-40 text-gray-800 block font-bold text-xs uppercase tracking-wide">Tanggal Pinjam</label>
					<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-xs" id="inline-full-name" type="text" placeholder="eg. #INV-100001" value="{{Fungsi::tanggalgaring($datas->tgl_pinjam)}}" disabled>
				</div>
                <div class="mb-2 md:mb-1 md:flex items-center">
					<label class="w-40 text-gray-800 block font-bold text-xs uppercase tracking-wide">Tanggal Harus kembali</label>
					<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-xs" id="inline-full-name" type="text" placeholder="eg. #INV-100001" value="{{Fungsi::tanggalgaring($datas->tgl_harus_kembali)}}" disabled>
				</div>
            </div>
        </div>


        

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                          Jumlah
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Judul Buku
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ISBN
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Penerbit
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Denda
                        </th>
                       
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                        @php
                        $totaldenda=0;
                      @endphp
                    @foreach ($detaildatas as $dd)
                      <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            
                        @php
                        $jmldatapinjam=DB::table('peminjamandetail')->where('kodetrans',$datas->kodetrans)->where('buku_kode',$dd->buku_kode)->orderBy('created_at', 'desc')->count();
                        @endphp
                        {{$jmldatapinjam}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                              <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                            </div>
                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900">
                               {{$dd->buku_nama}}
                              </div>
                              <div class="text-sm text-gray-500">
                                Pengarang : {{$dd->buku_pengarang}}
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm text-gray-900">{{$dd->buku_isbn}}</div>
                          {{-- <div class="text-sm text-gray-500">Optimization</div> --}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{$dd->buku_penerbit}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            @if($dd->statuspengembalian===null)
                                @php
                                    $statuspengembalian='Belum Kembali';
                                @endphp
                            @else
                                @php
                                    $statuspengembalian='Sudah Kembali';
                                @endphp
                            @endif
                            {{$statuspengembalian}}
                          </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            
                            @if($dd->statuspengembalian===null)
                                @php
                                    $denda=Fungsi::periksadenda($dd->tgl_harus_kembali);
                                @endphp
                            @else
                                @php
                                    $denda=$dd->denda;    
                                @endphp
                            @endif
                            @php
                                $dendatotalbuku=$denda*$jmldatapinjam;
                                $totaldenda+=$dendatotalbuku;
                            @endphp
                            <div class="text-sm text-gray-900"> {{Fungsi::rupiah($dendatotalbuku)}}</div>
                            <div class="text-sm text-gray-500">Terlambat {{Fungsi::periksaterlambat($dd->tgl_harus_kembali)}} Hari</div>
                             {{-- {{Fungsi::periksaterlambat($dd->tgl_harus_kembali)}} Hari  {{Fungsi::rupiah($dendatotalbuku)}} --}}
                        </td>
                      </tr>
                      @endforeach
          
                      <!-- More people... -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="flex mb-8 justify-between mt-10">
			<div class="w-2/4">
				<div class="mb-2 md:mb-1 md:flex items-center">
					{{-- <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Kode Transaksi</label>
					<span class="mr-4 inline-block hidden md:block">:</span>
					<div class="flex-1">
					<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-xs" id="inline-full-name" type="text" placeholder="eg. #INV-100001" value="{{$datas->kodetrans}}" disabled>
					</div> --}}
				</div>

			

			
			</div>
			<div>
                 
                <div class="mb-2 md:mb-1 md:flex items-center">
					<label class="w-56 text-gray-800 block font-bold text-xs uppercase tracking-wide"> Denda terlambat per hari  </label>
					<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-xs" id="inline-full-name" type="text" placeholder="eg. #INV-100001" value="{{Fungsi::rupiah($datas->denda)}}" disabled>
				</div>
                
                <div class="mb-2 md:mb-1 md:flex items-center">
					<label class="w-56 text-gray-800 block font-bold text-xs uppercase tracking-wide"> Total Denda  </label>
					<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-xs" id="inline-full-name" type="text" placeholder="eg. #INV-100001" value="{{Fungsi::rupiah($totaldenda)}}" disabled>
				</div>

				<div class="w-32 h-32 mb-1 border rounded-lg overflow-hidden relative bg-gray-100 mt-12 float-right">
					{{-- <img id="image" class="object-cover w-full h-32" src="https://placehold.co/300x300/e2e8f0/e2e8f0" /> --}}
                    <img src="data:image/png;base64,{{DNS2D::getBarcodePNG(url('/invoice/'.$datas->kodetrans), 'QRCODE')}}" alt="barcode" class="object-cover w-full h-32"/>
              	
				
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