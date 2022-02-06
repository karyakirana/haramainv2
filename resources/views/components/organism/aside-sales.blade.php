<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
<div data-kt-menu-trigger="click" class="menu-item {{request()->is('sales/*') ? 'here show' : ''}} menu-accordion">
									<span class="menu-link">
										<span class="menu-icon fas fa-people-carry">
											<!--begin::Svg Icon | path: icons/duotune/files/fil025.svg-->

                                            <!--end::Svg Icon-->
										</span>
										<span class="menu-title">Sales</span>
										<span class="menu-arrow"></span>
									</span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('sales/penjualan*') ? 'here show' : ''}} menu-accordion">
								 <span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Penjualan</span>
												<span class="menu-arrow"></span>
											</span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">

                <div class="menu-item">
                <a class="menu-link {{request()->is('sales/penjualan') ? 'active' : ''}}" href="{{ route('penjualan') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                    <span class="menu-title">Penjualan List</span>
                </a>
                </div>
                <div class="menu-item">
                <a class="menu-link {{request()->is('sales/penjualan/new') ? 'active' : ''}}" href="{{ route('penjualan.create') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                    <span class="menu-title">Penjualan Baru</span>
                </a>
                </div>
                <div class="menu-item">
                <a class="menu-link {{request()->is('sales/penjualan/biaya') ? 'active' : ''}}" href="{{ route('penjualan.biaya') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                    <span class="menu-title">Penjualan Biaya</span>
                </a>
                </div>
                </div>
        </div>
        </div>
    </div>
    <div class="menu-sub menu-sub-accordion menu-active-bg">
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('sales/retur*') ? 'here show' : ''}} menu-accordion">
								 <span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Retur Penjualan</span>
												<span class="menu-arrow"></span>
											</span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">

                    <div class="menu-item">
                        <a class="menu-link {{request()->is('sales/retur/baik') ? 'active' : ''}}" href="{{ route('returbaik') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Retur Baik</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('sales/retur/baik/transaksi') ? 'active' : ''}}" href="{{ route('returbaik.create') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Retur Baik Baru</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('sales/retur/rusak') ? 'active' : ''}}" href="{{ route('returrusak') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Retur Rusak</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('sales/retur/rusak/transaksi') ? 'active' : ''}}" href="{{ route('returrusak.create') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Retur Rusak Baru</span>
                        </a>
                    </div>
                </div>
        </div>
        </div>
    </div>
</div>
</div>
