                    <!-- Start Sidebar -->
                    <div class="sidebar sidebar--style-3 no-border stickyfill p-0">
                        <div class="profi-user-akun__ d-flex align-items-center m-4">
                            <div class="img-profil-akun__ mr-4">
                                <img class="big-img-akun__" src="{{my_asset('images/icon/ic_dokter.jpg')}}" alt="">
                            </div>
                            <div class="info-akun-role__">
                                <span class="tag-username-akun__">Dr <span>ALex Max</span></span>
                                <div class="my-1">
                                    <span class="role-user">Regular Physician</span>
                                </div>
            
                                <a href="" class="editprofil-pp__" style="text-decoration: none;"><i
                                        class="fas fa-pencil-alt"></i> Ubah Foto Profil</a>
                            </div>
                            <hr>
                        </div>
            
                        <ul class="list-group">
                            <a href="#submenu1" data-toggle="collapse" aria-expanded="false"
                                class=" list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-start align-items-center">
                                    <img class="img-sidebar-akun__ mr-3" src="{{my_asset('images/icon/ic_user.png')}}" alt="">
                                    <span class="menu-collapsed">Akun Saya</span>
                                    <span class="submenu-icon ml-auto"><i class="fa fa-chevron-down"></i> </span>
                                </div>
                            </a>
                            <div id='submenu1' class="collapse sidebar-submenu">
                                <a href="#" class="list-group-item list-group-item-action  text-white">
                                    <span class="menu-collapsed ml-3">Profil</span>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action  text-white">
                                    <span class="menu-collapsed ml-3">Alamat</span>
                                </a>
                            </div>
                            <a href="#submenu2" data-toggle="collapse" aria-expanded="false"
                                class=" list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-start align-items-center">
                                    <img class="img-sidebar-akun__ mr-3" src="{{my_asset('images/icon/ic_pesanan.png')}}" alt="">
                                    <span class="menu-collapsed">Pesanan</span>
                                    <span class="submenu-icon ml-auto"></span>
                                </div>
                            </a>
                            <a href="#submenu3" data-toggle="collapse" aria-expanded="false"
                                class=" list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-start align-items-center">
                                    <img class="img-sidebar-akun__ mr-3" src="{{my_asset('images/icon/ic_disimpan.png')}}" alt="">
                                    <span class="menu-collapsed">Wishlist</span>
                                    <span class="submenu-icon ml-auto"></span>
                                </div>
                            </a>
                            <a href="#submenu4" data-toggle="collapse" aria-expanded="false"
                                class=" list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-start align-items-center">
                                    <img class="img-sidebar-akun__ mr-3" src="{{my_asset('images/icon/ic_referal.png')}}" alt="">
                                    <span class="menu-collapsed">Kode Referal</span>
                                    <span class="submenu-icon ml-auto"></span>
                                </div>
                            </a>
                            <a href="#submenu5" data-toggle="collapse" aria-expanded="false"
                                class=" list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-start align-items-center">
                                    <img class="img-sidebar-akun__ mr-3" src="{{my_asset('images/icon/ic_poin.png')}}" alt="">
                                    <span class="menu-collapsed">Poin History</span>
                                    <span class="submenu-icon ml-auto"></span>
                                </div>
                            </a>
                            <a href="#submenu6" data-toggle="collapse" aria-expanded="false"
                                class=" list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-start align-items-center">
                                    <img class="img-sidebar-akun__ mr-3" src="{{my_asset('images/icon/ic_dropship.png')}}" alt="">
                                    <span class="menu-collapsed">Dropshipper</span>
                                    <span class="submenu-icon ml-auto"></span>
                                </div>
                            </a>
                            <a href="{{route('membership_dr')}}"
                                class=" list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-start align-items-center">
                                    <img class="img-sidebar-akun__ mr-3" src="{{my_asset('images/icon/ic_membership.png')}}"
                                        alt="">
                                    <span class="menu-collapsed">Membership</span>
                                    <span class="submenu-icon ml-auto"></span>
                                </div>
                            </a>
            
                        </ul>
                    </div> <!-- End Sidebar -->

            <div class="col-lg-8">
                @yield('sidebar')
            </div>
