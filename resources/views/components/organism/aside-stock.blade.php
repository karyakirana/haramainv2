
<div data-kt-menu-trigger="click" class="menu-item  {{request()->is('stock/*') ? 'here show' : ''}} menu-accordion">
									<span class="menu-link">
										<span class="menu-icon fas fa-cubes">
											<!--begin::Svg Icon | path: icons/duotune/files/fil025.svg-->

                                            <!--end::Svg Icon-->
										</span>
										<span class="menu-title">Stock</span>
										<span class="menu-arrow"></span>
									</span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('stock/inventory*') ? 'here show' : ''}} menu-accordion">
                              <span class="menu-link">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Daftar Stock</span>
                                                            <span class="menu-arrow"></span>
                                                        </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                        <a class="menu-link {{request()->is('stock/inventory') ? 'active' : ''}}" href="{{ route('stock.inventory.index') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                            <span class="menu-title">Stock Inventory List</span>
                        </a>
                    </div>
                    @php
                        $gudang = \App\Models\Master\Gudang::all();
                    @endphp
                    @forelse($gudang as $item)
                        <div class="menu-item">
                            <a class="menu-link {{request()->is('stock/inventory/gudang') ? 'active' : ''}}" href="{{ url('stock/inventory/gudang/'.$item->id) }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                <span class="menu-title">Stock {{$item->nama}}</span>
                            </a>
                        </div>
                    @empty
                    @endforelse
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('stock/inventory/rusak') ? 'active' : ''}}" href="{{ url('stock/inventory/rusak') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                            <span class="menu-title">Stock Inventory Rusak</span>
                        </a>
                    </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('stock/masuk*') ? 'here show' : ''}} menu-accordion">
                              <span class="menu-link">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Stock Masuk</span>
                                                            <span class="menu-arrow"></span>
                                                        </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">

                                <div class="menu-item">
                                    <a class="menu-link {{request()->is('stock/masuk/baik') ? 'active' : ''}}" href="{{ route('stockmasuk.baik') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">Stock Baik List</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{request()->is('stock/masuk/baik/trans') ? 'active' : ''}}" href="{{ route('stockmasuk.baik.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">Stock Baik Baru</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{request()->is('stock/masuk/rusak') ? 'active' : ''}}" href="{{ route('stockmasuk.rusak') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">Stock Rusak List</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{request()->is('stock/masuk/rusak/trans') ? 'active' : ''}}" href="{{ route('stockmasuk.rusak.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">Stock Rusak Baru</span>
                                    </a>
                                </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('stock/keluar*') ? 'here show' : ''}} menu-accordion">
                              <span class="menu-link">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Stock Keluar</span>
                                                            <span class="menu-arrow"></span>
                                                        </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('stock/keluar/baik') ? 'active' : ''}}" href="{{ route('stockkeluar.baik') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Stock Baik List</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('stock/keluar/baik/trans') ? 'active' : ''}}" href="{{ route('stockkeluar.baik.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Stock Baik Baru</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('stock/keluar/rusak') ? 'active' : ''}}" href="{{ route('stockkeluar.rusak') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Stock Rusak List</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('stock/keluar/rusak/trans') ? 'active' : ''}}" href="{{ route('stockkeluar.rusak.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Stock Rusak Baru</span>
                        </a>
                    </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('stock/mutasi*') ? 'here show' : ''}} menu-accordion">
                              <span class="menu-link">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Stock Mutasi</span>
                                                            <span class="menu-arrow"></span>
                                                        </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('stock/mutasi/baik/baik') ? 'active' : ''}}" href="{{ route('mutasibaik.baik') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Mutasi Baik Ke Baik</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('stock/mutasi/baik/baik/trans') ? 'active' : ''}}" href="{{ route('mutasibaik.baik.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Mutasi Baik Ke Baik Baru</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('stock/mutasi/baik/rusak') ? 'active' : ''}}" href="{{ route('mutasibaik.rusak') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Mutasi Baik Ke Rusak</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('stock/mutasi/baik/rusak/trans') ? 'active' : ''}}" href="{{ route('mutasibaik.rusak.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Mutasi Baik Ke Rusak Baru</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('stock/mutasi/rusak/rusak') ? 'active' : ''}}" href="{{ route('mutasirusak.rusak') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Mutasi Rusak Ke Rusak</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('stock/mutasi/rusak/rusak/trans') ? 'active' : ''}}" href="{{ route('mutasirusak.rusak.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Mutasi Rusak Ke Rusak Baru</span>
                        </a>
                    </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('stock/opname*') ? 'here show' : ''}} menu-accordion">
                              <span class="menu-link">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Stock Opname</span>
                                                            <span class="menu-arrow"></span>
                                                        </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link  {{request()->is('stock/opname') ? 'active' : ''}}" href="{{ route('stockopname.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Stock Opname List</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('stock/opname/baik') ? 'active' : ''}}" href="{{ route('stockopname.baik.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Stock Opname Baik List</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('stock/opname/baik/trans') ? 'active' : ''}}" href="{{ route('stockopname.baik.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Stock Opname Baik Baru</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('stock/opname/rusak') ? 'active' : ''}}" href="{{ route('stockopname.rusak.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Stock Opname Rusak List</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{request()->is('stock/opname/rusak/trans') ? 'active' : ''}}" href="{{ route('stockopname.rusak.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                            <span class="menu-title">Stock Opname Rusak Baru</span>
                        </a>
                    </div>
                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('stock/lost*') ? 'here show' : ''}} menu-accordion">
                              <span class="menu-link">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Stock Lost</span>
                                                            <span class="menu-arrow"></span>
                                                        </span>
                <div class="menu-sub menu-sub-accordion">

                </div>
            </div> <div data-kt-menu-trigger="click" class="menu-item  {{request()->is('stock/*') ? 'here show' : ''}} menu-accordion">
                              <span class="menu-link">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Laporan Stock</span>
                                                            <span class="menu-arrow"></span>
                                                        </span>
                <div class="menu-sub menu-sub-accordion">

                </div>
            </div>
        </div>
    </div>
</div>
