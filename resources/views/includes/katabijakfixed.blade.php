<div class="text-white d-none d-lg-block
 ">
    {{-- d-none d-lg-block --}}
    <h1 class="ml12">
        <span class="text-wrapper">
            @php
                $getCount = \App\Models\katabijakdetail::whereHas('katabijak', function ($query) {
                    $query->where('katabijak.status', 'like', '%' . 'Ditampilkan' . '%');
                })->count();
                // dd($getCount);
            @endphp
            @if ($getCount > 0)
                @php
                    $item = \App\Models\katabijakdetail::whereHas('katabijak', function ($query) {
                        $query->where('katabijak.status', 'like', '%' . 'Ditampilkan' . '%');
                    })->get();
                    $getTgl = date('d');
                    $hasilbagi = $getTgl % $getCount;
                    if ($hasilbagi == 0) {
                        $hasilbagi = $getCount;
                    }
                @endphp

                <span class="letters">{{ $item[$hasilbagi - 1]->katabijak->judul }} :
                    {{ $item[$hasilbagi - 1]->penjelasan }}
                </span>
            @endif
            {{-- <span class="letters">   Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui sint quia sapiente, at soluta magni aut enim fuga veritatis rem asperiores officiis sit aliquam nemo? Iusto quaerat ut eius dicta.
            </span> --}}
        </span>
    </h1>
</div>
{{-- https://tobiasahlin.com/moving-letters/ --}}
