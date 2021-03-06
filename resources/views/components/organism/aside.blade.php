\<div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Aside Toolbarl-->
    <div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
        <!--begin::Aside user-->
        <!--begin::User-->
        <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
            <!--begin::Symbol-->
            <div class="symbol symbol-50px">
                <img src="{{asset('assets/media/avatars/300-1.jpg')}}" alt="" />
            </div>
            <!--end::Symbol-->
            <!--begin::Wrapper-->
            <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
                <!--begin::Section-->
                <div class="d-flex">
                    <!--begin::Info-->
                    <div class="flex-grow-1 me-2">
                        <!--begin::Username-->
                        @php
                        $users = Auth::user();
                        @endphp
                        <a href="#" class="text-white text-hover-primary fs-6 fw-bold">{{$users->name}}</a>
                        <!--end::Username-->
                        <!--begin::Description-->
                        <span class="text-gray-600 fw-bold d-block fs-8 mb-1">{{$users->role}}</span>
                        <!--end::Description-->
                    </div>
                    <!--end::Info-->
                    <!--begin::User menu-->
                    <div class="me-n2">
                        <!--begin::Action-->
                        <a href="#" class="btn btn-icon btn-sm btn-active-color-primary mt-n2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-overflow="true">
                            <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                            <span class="svg-icon svg-icon-muted svg-icon-1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="black" />
													<path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="black" />
												</svg>
											</span>
                            <!--end::Svg Icon-->
                        </a>
                        <!--begin::User account menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px me-5">
                                        <img alt="Logo" src="{{asset('assets/media/avatars/300-1.jpg')}}" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Username-->
                                    <div class="d-flex flex-column">
                                        <div class="fw-bolder d-flex align-items-center fs-5">Max Smith
                                            <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span></div>
                                        <a href="#" class="fw-bold text-muted text-hover-primary fs-7">max@kt.com</a>
                                    </div>
                                    <!--end::Username-->
                                </div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="../../demo8/dist/account/overview.html" class="menu-link px-5">My Profile</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="../../demo8/dist/apps/projects/list.html" class="menu-link px-5">
                                    <span class="menu-text">My Projects</span>
                                    <span class="menu-badge">
														<span class="badge badge-light-danger badge-circle fw-bolder fs-7">3</span>
													</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                <a href="#" class="menu-link px-5">
                                    <span class="menu-title">My Subscription</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo8/dist/account/referrals.html" class="menu-link px-5">Referrals</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo8/dist/account/billing.html" class="menu-link px-5">Billing</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo8/dist/account/statements.html" class="menu-link px-5">Payments</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo8/dist/account/statements.html" class="menu-link d-flex flex-stack px-5">Statements
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="View your statements"></i></a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content px-3">
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
                                                <span class="form-check-label text-muted fs-7">Notifications</span>
                                            </label>
                                        </div>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="../../demo8/dist/account/statements.html" class="menu-link px-5">My Statements</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                <a href="#" class="menu-link px-5">
													<span class="menu-title position-relative">Language
													<span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">English
													<img class="w-15px h-15px rounded-1 ms-2" src="/assets/media/flags/united-states.svg" alt="" /></span></span>
                                </a>
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo8/dist/account/settings.html" class="menu-link d-flex px-5 active">
														<span class="symbol symbol-20px me-4">
															<img class="rounded-1" src="/assets/media/flags/united-states.svg" alt="" />
														</span>English</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo8/dist/account/settings.html" class="menu-link d-flex px-5">
														<span class="symbol symbol-20px me-4">
															<img class="rounded-1" src="/assets/media/flags/spain.svg" alt="" />
														</span>Spanish</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo8/dist/account/settings.html" class="menu-link d-flex px-5">
														<span class="symbol symbol-20px me-4">
															<img class="rounded-1" src="/assets/media/flags/germany.svg" alt="" />
														</span>German</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo8/dist/account/settings.html" class="menu-link d-flex px-5">
														<span class="symbol symbol-20px me-4">
															<img class="rounded-1" src="/assets/media/flags/japan.svg" alt="" />
														</span>Japanese</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo8/dist/account/settings.html" class="menu-link d-flex px-5">
														<span class="symbol symbol-20px me-4">
															<img class="rounded-1" src="/assets/media/flags/france.svg" alt="" />
														</span>French</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5 my-1">
                                <a href="../../demo8/dist/account/settings.html" class="menu-link px-5">Account Settings</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="../../demo8/dist/authentication/flows/basic/sign-in.html" class="menu-link px-5">Sign Out</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <div class="menu-content px-5">
                                    <label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="kt_user_menu_dark_mode_toggle">
                                        <input class="form-check-input w-30px h-20px" type="checkbox" value="1" name="mode" id="kt_user_menu_dark_mode_toggle" data-kt-url="../../demo8/dist/index.html" />
                                        <span class="pulse-ring ms-n1"></span>
                                        <span class="form-check-label text-gray-600 fs-7">Dark Mode</span>
                                    </label>
                                </div>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::User account menu-->
                        <!--end::Action-->
                    </div>
                    <!--end::User menu-->
                </div>
                <!--end::Section-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::User-->
        <!--end::Aside user-->
    </div>
    <!--end::Aside Toolbar-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
            <!--begin::Menu-->

            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                <div data-kt-menu-trigger="click" class="menu-item {{request()->is('dashboard/*') ? 'here show' : ''}} menu-accordion">
									<span class="menu-link">
										<span class="menu-icon fas fa-globe">
											<!--begin::Svg Icon | path: icons/duotune/files/fil025.svg-->

                                            <!--end::Svg Icon-->
										</span>
										<span class="menu-title">Dashboard</span>
										<span class="menu-arrow"></span>
									</span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <div class="menu-item">
                                <a class="menu-link" href="">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Admin</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Penjualan</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Kasir</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Keuangan</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Pajak</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('master/*') ? 'here show' : ''}} menu-accordion">
									<span class="menu-link">
										<span class="menu-icon fas fa-book-open">
											<!--begin::Svg Icon | path: icons/duotune/files/fil025.svg-->

                                            <!--end::Svg Icon-->
										</span>
										<span class="menu-title">Master</span>
										<span class="menu-arrow"></span>
									</span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
                            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('master/produk*') ? 'here show' : ''}} menu-accordion">
											<span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Produk</span>
												<span class="menu-arrow"></span>
											</span>
                                <div class="menu-sub menu-sub-accordion menu-active-bg">
                                        <div class="menu-item">
                                            <a class="menu-link {{request()->is('master/produk') ? 'active' : ''}}" href="/master/produk">
                                                  <span class="menu-bullet">
                                                      <span class="bullet bullet-dot"></span>
                                                      </span>
                                                <span class="menu-title">Produk list</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link {{request()->is('master/produk/kategori') ? 'active' : ''}}" href="/master/produk/kategori">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                                <span class="menu-title">Kategori Produk</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link {{request()->is('master/produk/kategoriharga') ? 'active' : ''}}" href="/master/produk/kategoriharga">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                                <span class="menu-title">Kategori Harga</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('master/supplier*') ? 'here show' : ''}} menu-accordion">
											<span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Supplier</span>
												<span class="menu-arrow"></span>
											</span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                                        <div class="menu-item">
                                            <a class="menu-link {{request()->is('master/supplier') ? 'active' : ''}}" href="/master/supplier">
                                                 <span class="menu-bullet">
                                                 <span class="bullet bullet-dot"></span>
                                                 </span>
                                                <span class="menu-title">Supplier List</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link {{request()->is('master/supplier/jenis') ? 'active' : ''}}" href="{{ route('master.supplier.jenis') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                                <span class="menu-title">Jenis Supplier</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('master/customer*') ? 'here show' : ''}} menu-accordion">
											<span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Customer</span>
												<span class="menu-arrow"></span>
											</span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                                        <div class="menu-item">
                                            <a class="menu-link {{request()->is('master/customer') ? 'active' : ''}}" href="/master/customer">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                                <span class="menu-title">Customer List</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('master/pegawai*') ? 'here show' : ''}} menu-accordion">
											<span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Pegawai</span>
												<span class="menu-arrow"></span>
											</span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                                        <div class="menu-item">
                                            <a class="menu-link {{request()->is('master/pegawai') ? 'active' : ''}}" href="{{ route('master.pegawai') }}">
                                        <span class="menu-bullet">
                                             <span class="bullet bullet-dot"></span>
                                        </span>
                                                <span class="menu-title">Pegawai List</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                @can('Sales')
                    <x-organism.aside-sales />
                @endcan
                <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('kasir*') ? 'here show' : ''}} menu-accordion">
									<span class="menu-link">
										<span class="menu-icon fas fa-cash-register">
											<!--begin::Svg Icon | path: icons/duotune/files/fil025.svg-->

                                            <!--end::Svg Icon-->
										</span>
										<span class="menu-title">Kasir</span>
										<span class="menu-arrow"></span>
									</span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
                            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('kasir/penerimaan*') ? 'here show' : ''}} menu-accordion">
											<span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Penerimaan</span>
												<span class="menu-arrow"></span>
											</span>
                                <div class="menu-sub menu-sub-accordion menu-active-bg">
                                    <div class="menu-item">
                                        <a class="menu-link {{request()->is('kasir/penerimaan')  ? 'active' : ''}} " href="{{ route('jurnal.penerimaan.index') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                            <span class="menu-title">Penerimaan Penjualan</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{request()->is('kasir/penerimaan/trans')  ? 'active' : ''}} " href="{{ route('jurnal.penerimaan.trans') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                            <span class="menu-title">Penerimaan Penjualan Baru</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{request()->is('kasir/penerimaan/lain')  ? 'active' : ''}} " href="{{ route('penerimaan.cash.index') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                            <span class="menu-title">Penerimaan Lain</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{request()->is('kasir/penerimaan/lain/transaksi')  ? 'active' : ''}} " href="{{ route('kasir.penerimaan.cash.transaksi') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                            <span class="menu-title">Penerimaan Lain Baru</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('kasir/pengeluaran*') ? 'here show' : ''}} menu-accordion">
											<span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Pengeluaran</span>
												<span class="menu-arrow"></span>
											</span>
                                <div class="menu-sub menu-sub-accordion menu-active-bg">
                                    <div class="menu-item">
                                        <a class="menu-link {{request()->is('kasir/pengeluaran')  ? 'active' : ''}}" href="{{ route('kasir.pengeluaran.index') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                            <span class="menu-title">Pengeluaran</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{request()->is('kasir/pengeluaran/trans')  ? 'active' : ''}}" href="{{ route('kasir.pengeluaran.trans') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                            <span class="menu-title">Pengeluaran Baru</span>
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('kasir/pembelian*') ? 'here show' : ''}} menu-accordion">
											<span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Pembelian</span>
												<span class="menu-arrow"></span>
											</span>
                                <div class="menu-sub menu-sub-accordion menu-active-bg">
                                    <div class="menu-item">
                                        <a class="menu-link {{request()->is('kasir/pembelian')  ? 'active' : ''}}" href="{{ route('kasir.pembelian.index') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                            <span class="menu-title">Pembelian</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{request()->is('kasir/pembelian/trans')  ? 'active' : ''}}" href="{{ route('kasir.pembelian.trans') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                            <span class="menu-title">Pembelian Baru</span>
                                        </a>
                                    </div>

                                    <div class="menu-item">
                                        <a class="menu-link {{request()->is('kasir/pembelian/retur/baik')  ? 'active' : ''}}" href="{{ route('kasir.retur.baik.pembelian.index') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                            <span class="menu-title">Retur Baik Pembelian</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{request()->is('kasir/pembelian/retur/baik/trans')  ? 'active' : ''}}" href="{{ route('kasir.retur.baik.pembelian.trans') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                            <span class="menu-title">Retur Baik Pembelian Baru</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{request()->is('kasir/pembelian/retur/rusak')  ? 'active' : ''}}" href="{{ route('kasir.retur.rusak.pembelian.index') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                            <span class="menu-title">Retur Rusak Pembelian Baru</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{request()->is('kasir/pembelian/retur/rusak/trans')  ? 'active' : ''}}" href="{{ route('kasir.retur.rusak.pembelian.trans') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                            <span class="menu-title">Retur Rusak Pembelian Baru</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('kasir/set*') ? 'here show' : ''}} menu-accordion">
											<span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Piutang</span>
												<span class="menu-arrow"></span>
											</span>
                                <div class="menu-sub menu-sub-accordion menu-active-bg">
                                    <div class="menu-item">
                                        <a class="menu-link {{request()->is('kasir/set/piutang')  ? 'active' : ''}}" href="{{ route('set.piutang.index') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                            <span class="menu-title">Set Piutang</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{request()->is('kasir/set/piutang/transaksi')  ? 'active' : ''}}" href="{{ route('set.piutang.transaksi') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                            <span class="menu-title">Set Piutang Baru</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('kasir/piutang*') ? 'here show' : ''}} menu-accordion">
											<span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Piutang Internal</span>
												<span class="menu-arrow"></span>
											</span>
                                <div class="menu-sub menu-sub-accordion menu-active-bg">
                                    <div class="menu-item">
                                        <a class="menu-link {{request()->is('kasir/piutang/pegawai')  ? 'active' : ''}}" href="{{ route('piutang.pegawai.index') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                            <span class="menu-title">Piutang Pegawai</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{request()->is('kasir/piutang/pegawai/trans')  ? 'active' : ''}}" href="/kasir/piutang/pegawai/trans">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                            <span class="menu-title">Piutang Pegawai Baru</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @can('Keuangan')
                    <x-organism.aside-keuangan />
                @endcan

                @can('Stock')
                    <x-organism.aside-stock />
                @endcan


                @can('SuperAdmin')
                    <x-organism.aside-tax />
                @endcan
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
</div>
