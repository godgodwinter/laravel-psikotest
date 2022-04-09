<div class="text-white d-none d-lg-block
 ">
    {{-- d-none d-lg-block --}}
    <h1 class="ml12">
        <span class="text-wrapper">
            @php
                $getCount = \App\Models\katabijak::where('status', 'Ditampilkan')->count();
            @endphp
            @if ($getCount > 0)
                @php
                    $item = \App\Models\katabijak::where('status', 'Ditampilkan')->get();
                    $getTgl = date('d');
                    $hasilbagi = $getTgl % $getCount;
                    if ($hasilbagi == 0) {
                        $hasilbagi = $getCount;
                    }
                @endphp

                <span class="letters">{{ $item[$hasilbagi - 1]->judul }} : {{ $item[$hasilbagi - 1]->penjelasan }}
                    {{-- - {{$hasilbagi}} --}}
                    {{-- - {{$getCount}} - {{$getTgl}} --}}
                </span>
            @endif
            {{-- <span class="letters">   Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui sint quia sapiente, at soluta magni aut enim fuga veritatis rem asperiores officiis sit aliquam nemo? Iusto quaerat ut eius dicta.
            </span> --}}
        </span>
    </h1>
</div>
{{-- https://tobiasahlin.com/moving-letters/ --}}
