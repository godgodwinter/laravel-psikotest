<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('dashboard')}}">{{Fungsi::app_nama()}}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('dashboard')}}">{{Fungsi::app_namapendek()}}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Layout v2.0</li>
            @if(Auth::user()!=null)
            @if((Auth::user()->tipeuser)=='admin')
                @include('includes.sidebar_admin')
            @elseif((Auth::user()->tipeuser)=='bk')
                @include('includes.sidebar_bk')
            @elseif((Auth::user()->tipeuser)=='yayasan')
                @include('includes.sidebar_yayasan')
            @elseif((Auth::user()->tipeuser)=='siswa')
                @include('includes.sidebar_siswa')
            @else
            @endif
            @endif
        </ul>


    </aside>
</div>
