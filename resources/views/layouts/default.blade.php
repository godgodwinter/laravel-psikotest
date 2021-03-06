<!DOCTYPE html>

<html lang="en">
<head>


</style>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{Fungsi::app_nama()}}</title>


    {{-- style --}}

    @stack('before-style')
    @include('includes.style')
    @stack('after-style')

</head>

<body>
  <div id="app">
    
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar position-fixed bg-primary">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            {{-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> --}}
          </ul>
        </form>
        
      @include('includes.katabijakfixed')
      
        <ul class="navbar-nav navbar-right  ml-auto">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('/') }}assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">{{ Auth::user()!=null?Auth::user()->name:'' }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{ route('profile') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
                {{-- @if (Auth::user()->tipeuser=='admin')
                {{$url=route('profile');}}
                @elseif (Auth::user()->tipeuser=='bk')
                {{$url=route('bk.settingpengguna.edit');}}
                @endif --}}
              {{-- <a href="{{Auth::user()->tipeuser=='admin' ? route('settings') : '#' }}"  class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a> --}}

              <div class="dropdown-divider"></div>
              <form method="POST" action="{{ route('logout') }}">
                @csrf


                    <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt">
                        </i> Logout
                      </a>
            </form>
            </div>
          </li>
        </ul>
      </nav>

    {{-- sidebar --}}
    @include('includes.sidebar')


      <!-- Main Content -->
      <div class="main-content">
        {{-- <div class="section"> --}}
        {{-- <div class="mlaku">
              <div class="section-header-mlaku">
                <marquee><h4>	
                @php
                  $datas=DB::table('katabijak')->where('judul', 'Tertawa')->first();
                @endphp
                @foreach($datas as $aa)
                  {{ $aa->penjelasan }}
                @endforeach
                </h4></marquee>
              </div>
            </div> --}}
        {{-- </div> --}}
        @yield('content')
        @yield('containermodal')
      </div>


      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2021 <div class="bullet"></div> @ <a href="{{url('/')}}">Ypmt psikotes</a>
        </div>

        @php
        // exec('git rev-parse --verify HEAD 2> /dev/null', $output);
        // $hash = $output[0];
        // dd($hash)

        $commitHash = trim(exec('git log --pretty="%h" -n1 HEAD'));

        $commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
        $commitDate->setTimezone(new \DateTimeZone('UTC'));

        // dd($commitDate);
        // dd($commitDate->format('Y-m-d H:i:s'));
        $versi=$commitDate->format('Ymd.H.i.s');
    @endphp
        <div class="footer-right">
          v0. {{ $versi }}
        </div>
      </footer>
    </div>
  </div>



    {{-- script --}}
    @stack('before-script')
    @include('includes.script')
    @stack('after-script')


</body>
</html>
