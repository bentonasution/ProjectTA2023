            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center" href="https://smkn1ketapang.sch.id/">
                    <img src="{{ asset('bgimages/logo smk.png') }}" style="width: 50px;" alt="Foto">
                    <div class="sidebar-brand-text mr-4" style="font-size: 14px;">SMK Negeri 1 Ketapang<sup></sup></div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('dashboard')}}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Heading -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'petugas'))
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-book"></i>
                        <span>Data Buku</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-gradient-info py-2 collapse-inner rounded">
                            <a class="collapse-item text-white" href="{{ route('buku') }}"><i class="fas fa-asterisk" style="font-size:10px ;"></i> Buku</a>
                            <a class="collapse-item text-white" href="{{ route('kategori') }}"><i class="fas fa-asterisk" style="font-size:10px ;"></i> Kategori</a>
                        </div>
                    </div>
                </li>
                <hr class="sidebar-divider">
                @endif

               

                <li class="nav-item">
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Data Pengguna</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-gradient-info py-2 collapse-inner rounded">
                            <a class="collapse-item text-white" href="{{ route('users') }}"><i class="fas fa-asterisk" style="font-size:10px ;"></i> Pengguna</a>
                            <a class="collapse-item text-white" href="{{ route('jurusan') }}"><i class="fas fa-asterisk" style="font-size:10px ;"></i> Jurusan</a>
                        </div>
                </li>
                <hr class="sidebar-divider">
                @endif


                

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'petugas'))
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-exchange-alt"></i>
                        <span>Data Transaksi</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-gradient-info py-2 collapse-inner rounded">
                        <a class="collapse-item text-white" href="{{ route('transaksi') }}"><i class="fas fa-asterisk" style="font-size:10px ;"></i> Transaksi</a>
                            <a class="collapse-item text-white" href="{{ route('transaksidipesan') }}"><i class="fas fa-asterisk" style="font-size:10px ;"></i> Pemesanan</a>
                        </div>
                    </div>
                </li>
                @endif

                @if(auth()->check() && auth()->user()->role === 'user')
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('bukusiswa') }}">
                        <i class="fas fa-book"></i>
                        <span>Data Buku</span></a>
                </li>

                <hr class="sidebar-divider">

                
                @endif
                <!-- <hr class="sidebar-divider">

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('userssiswa') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Data Pengguna</span></a>
                </li>

                <hr class="sidebar-divider">

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('transaksisiswa') }}">
                        <i class="fas fa-fw fa-exchange-alt"></i>
                        <span>Data Transaksi</span></a>
                </li> -->
                

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">


            </ul>