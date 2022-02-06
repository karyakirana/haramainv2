<div class="menu-item">
    <div class="menu-content pt-8 pb-2">
        <span class="menu-section text-muted text-uppercase fs-8 ls-1">Stock</span>
    </div>
</div>
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
									<span class="menu-link">
										<span class="menu-icon fas fa-cubes">
											<!--begin::Svg Icon | path: icons/duotune/files/fil025.svg-->

                                            <!--end::Svg Icon-->
										</span>
										<span class="menu-title">Stock Inventory</span>
										<span class="menu-arrow"></span>
									</span>
    <div class="menu-sub menu-sub-accordion">
        <div class="menu-item">
            <a class="menu-link" href="{{ route('stock.inventory.index') }}">
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
                <a class="menu-link" href="{{ url('stock/inventory/gudang/'.$item->id) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                    <span class="menu-title">Stock {{$item->nama}}</span>
                </a>
            </div>
        @empty
        @endforelse
        <div class="menu-item">
            <a class="menu-link" href="{{ url('stock/inventory/rusak') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Stock Inventory Rusak</span>
            </a>
        </div>

    </div>
</div>
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
									<span class="menu-link">
										<span class="menu-icon fas fa-cubes">
											<!--begin::Svg Icon | path: icons/duotune/files/fil025.svg-->

                                            <!--end::Svg Icon-->
										</span>
										<span class="menu-title">Stock Masuk</span>
										<span class="menu-arrow"></span>
									</span>
    <div class="menu-sub menu-sub-accordion">
        <div class="menu-item">
            <a class="menu-link" href="{{ route('stockmasuk.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Stock Masuk List</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('stockmasuk.baik') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Stock Baik List</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('stockmasuk.baik.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Stock Baik Baru</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('stockmasuk.rusak') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Stock Rusak List</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('stockmasuk.rusak.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Stock Rusak Baru</span>
            </a>
        </div>
    </div>
</div>
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
									<span class="menu-link">
										<span class="menu-icon fas fa-cubes">
											<!--begin::Svg Icon | path: icons/duotune/files/fil025.svg-->

                                            <!--end::Svg Icon-->
										</span>
                                        <!--end::Svg Icon-->
										<span class="menu-title">Stock Keluar</span>
										<span class="menu-arrow"></span>
									</span>
    <div class="menu-sub menu-sub-accordion">
        <div class="menu-item">
            <a class="menu-link" href="{{ route('stockkeluar.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Stock Keluar List</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('stockkeluar.baik') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Stock Baik List</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('stockkeluar.baik.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Stock Baik Baru</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('stockkeluar.rusak') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Stock Rusak List</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('stockkeluar.rusak.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Stock Rusak Baru</span>
            </a>
        </div>
    </div>
</div>
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
									<span class="menu-link">
										<span class="menu-icon fas fa-cubes">
											<!--begin::Svg Icon | path: icons/duotune/files/fil025.svg-->

                                            <!--end::Svg Icon-->
										</span>
										<span class="menu-title">Stock Mutasi</span>
										<span class="menu-arrow"></span>
									</span>
    <div class="menu-sub menu-sub-accordion">
        <div class="menu-item">
            <a class="menu-link" href="{{ route('mutasibaik.baik') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Mutasi Baik Ke Baik</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('mutasibaik.baik.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Mutasi Baik Ke Baik Baru</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('mutasibaik.rusak') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Mutasi Baik Ke Rusak</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('mutasibaik.rusak.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Mutasi Baik Ke Rusak Baru</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('mutasirusak.rusak') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Mutasi Rusak Ke Rusak</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('mutasirusak.rusak.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Mutasi Rusak Ke Rusak Baru</span>
            </a>
        </div>
    </div>
</div>
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
									<span class="menu-link">
										<span class="menu-icon fas fa-cubes">
											<!--begin::Svg Icon | path: icons/duotune/files/fil025.svg-->

                                            <!--end::Svg Icon-->
										</span>
                                        <!--end::Svg Icon-->
										<span class="menu-title">Stock Opname</span>
										<span class="menu-arrow"></span>
									</span>
    <div class="menu-sub menu-sub-accordion">
        <div class="menu-item">
            <a class="menu-link" href="{{ route('stockopname.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Stock Opname List</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('stockopname.baik.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Stock Opname Baik List</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('stockopname.baik.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Stock Opname Baik Baru</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('stockopname.rusak.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Stock Opname Rusak List</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{ route('stockopname.rusak.trans') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Stock Opname Rusak Baru</span>
            </a>
        </div>
    </div>
</div>
