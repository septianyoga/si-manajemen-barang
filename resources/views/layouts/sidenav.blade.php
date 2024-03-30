<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-80 img-radius" src="{{ asset('template/backend/assets/images/avatar-4.jpg') }}"
                    alt="User-Profile-Image">
                <div class="user-details">
                    <span id="more-details">John Doe<i class="fa fa-caret-down"></i></span>
                </div>
            </div>
            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="user-profile.html"><i class="ti-user"></i>View Profile</a>
                        <a href="#!"><i class="ti-settings"></i>Settings</a>
                        <a href="/logout"><i class="ti-layout-sidebar-left"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="p-15 p-b-0">
            <form class="form-material">
                <div class="form-group form-primary">
                    <input type="text" name="footer-email" class="form-control">
                    <span class="form-bar"></span>
                    <label class="float-label"><i class="fa fa-search m-r-10"></i>Search
                        Friend</label>
                </div>
            </form>
        </div>
        <div class="pcoded-navigation-label">Menu</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $title == 'Dashboard' ? 'active' : '' }}">
                <a href="/dashboard" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            @if (Auth::user()->role == 'Direktur')
                <li class="{{ $title == 'Kelola User' ? 'active' : '' }}">
                    <a href="/users" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-user"></i><b>D</b></span>
                        <span class="pcoded-mtext">User</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            @elseif(Auth::user()->role == 'Supply Chain')
                <li
                    class="pcoded-hasmenu {{ $title == 'Kelola Barang' || $title == 'Kelola Kategori' || $title == 'Kelola Bahan Baku' ? 'active pcoded-trigger' : '' }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-package"></i></span>
                        <span class="pcoded-mtext">Barang</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{ $title == 'Kelola Barang' ? 'active' : '' }}">
                            <a href="/barang" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                <span class="pcoded-mtext"><i class="bi bi-box-seam"></i> Stok Barang</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="breadcrumb.html" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                <span class="pcoded-mtext"><i class="bi bi-box-arrow-in-down"></i> Barang Masuk</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="button.html" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                <span class="pcoded-mtext"><i class="bi bi-box-arrow-up"></i> Barang Keluar</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        <li class="{{ $title == 'Kelola Bahan Baku' ? 'active' : '' }}">
                            <a href="/bahan_baku" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                <span class="pcoded-mtext"><i class="bi bi-box-arrow-up"></i> Bahan Baku</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        {{-- <li class="{{ $title == 'Kelola Kategori' ? 'active' : '' }}">
                        <a href="/kategori" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext"><i class="bi bi-tag"></i> Kategori Barang</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li> --}}
                    </ul>
                </li>
                <li class="{{ $title == 'Pemesanan' ? 'active' : '' }}">
                    <a href="/pemesanan" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="bi bi-cart-check"></i><b>D</b></span>
                        <span class="pcoded-mtext">Pemesanan</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="{{ $title == 'Kelola Supplier' ? 'active' : '' }}">
                    <a href="/supplier" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="bi bi-truck"></i><b>D</b></span>
                        <span class="pcoded-mtext">Kelola Supplier</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="{{ $title == 'Hitung EOQ' ? 'active' : '' }}">
                    <a href="/eoq" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="icofont icofont-calculations"></i><b>D</b></span>
                        <span class="pcoded-mtext">EOQ</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            @else
                <li class="{{ $title == 'Approve Pesanan Barang' ? 'active' : '' }}">
                    <a href="/approve_pesanan" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="bi bi-check2-circle"></i><b>D</b></span>
                        <span class="pcoded-mtext">Approve Pesanan Barang</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="{{ $title == 'Keuangan' ? 'active' : '' }}">
                    <a href="/approve_pesanan" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="bi bi-currency-dollar"></i><b>D</b></span>
                        <span class="pcoded-mtext">Keuangan</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            @endif
        </ul>
        {{-- <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu ">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-id-badge"></i><b>A</b></span>
                    <span class="pcoded-mtext">Pages</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="auth-normal-sign-in.html" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Login</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="">
                        <a href="auth-sign-up.html" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Registration</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="">
                        <a href="sample-page.html" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i><b>S</b></span>
                            <span class="pcoded-mtext">Sample Page</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul> --}}
    </div>
</nav>
