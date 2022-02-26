
<div data-kt-menu-trigger="click" class="menu-item  {{request()->is('keuangan/*') ? 'here show' : ''}} menu-accordion">
										<span class="menu-link">
										<span class="menu-icon fas fa-file-invoice">
											<!--begin::Svg Icon | path: icons/duotune/files/fil025.svg-->

                                            <!--end::Svg Icon-->
										</span>
										<span class="menu-title">Keuangan</span>
										<span class="menu-arrow"></span>
									</span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('keuangan/master*') ? 'here show' : ''}} menu-accordion">
                                            <span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Master Keuangan</span>
												<span class="menu-arrow"></span>
											</span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('keuangan/master/akun') ? 'active' : ''}}" href="{{ route('master.akun') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                            <span class="menu-title">Akun List</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('keuangan/master/akun/kategori') ? 'active' : ''}}" href="{{ route('master.akun.kategori') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                            <span class="menu-title">Akun Kategori</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('keuangan/master/akun/tipe') ? 'active' : ''}}" href="{{ route('master.akun.tipe') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                            <span class="menu-title">Akun Type</span>
                        </a>
                    </div>
                </div>
            </div>


            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('keuangan/neraca*') ? 'here show' : ''}} menu-accordion">
                                            <span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Neraca</span>
												<span class="menu-arrow"></span>
											</span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('keuangan/neraca') ? 'active' : ''}}" href="{{ route('neraca.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Neraca List</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('keuangan/neraca/awal') ? 'active' : ''}}" href="{{ route('neraca.saldo.awal') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Neraca Saldo Awal</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('keuangan/neraca/akhir') ? 'active' : ''}}" href="{{ route('neraca.saldo.akhir') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Neraca Saldo Akhir</span>
                        </a>
                    </div>
                </div>
            </div>


            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('keuangan/saldo*') ? 'here show' : ''}} menu-accordion">
                                            <span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Saldo Piutang</span>
												<span class="menu-arrow"></span>
											</span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('keuangan/saldo/piutang') ? 'active' : ''}}" href="{{ route('saldo.piutang.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Saldo Piutang Pembelian</span>
                        </a>
                    </div>
                </div>
            </div>


            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('jurnal*') ? 'here show' : ''}} menu-accordion">
                                            <span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Jurnal</span>
												<span class="menu-arrow"></span>
											</span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">

                </div>
            </div>


            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('laporan*') ? 'here show' : ''}} menu-accordion">
                                            <span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Laporan</span>
												<span class="menu-arrow"></span>
											</span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">

                </div>
            </div>
        </div>
    </div>
</div>
