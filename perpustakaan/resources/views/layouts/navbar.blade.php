<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-gradient-info topbar static-top shadow">

    <div style="display: flex; justify-content: center; align-items: center;">
        <button id="sidebarToggleTop" class="btn rounded-circle text-white" style="font-size: 25px; display: flex; justify-content: center; align-items: center;">
            <i class="fa fa-bars"></i>
        </button>
    </div>


    <div class="topbar-divider d-none d-sm-block"></div>
    <!-- Sidebar Toggle (Topbar) -->


    <h4 class="text-white" style="font-size: 25px;"><b>Perpustakaan SMK Negeri 1 Ketapang</b></h4>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" style="font-size: 25px;" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-white small">{{ Auth::user()->nama }}</span>
                @if(Auth::user()->foto)
                <img src="{{ asset('ppimages/'. Auth::user()->foto) }}" alt="" style="width: 50px; height: 50px; border-radius: 50%;">
                @else
                <img src="{{ asset('ppimages/user4.png') }}" alt="Default User" style="width: 50px; height: 50px; border-radius: 50%;">
                @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>

            </div>
        </li>
    </ul>

</nav>