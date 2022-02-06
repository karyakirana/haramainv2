
<div data-kt-menu-trigger="click" class="menu-item  {{request()->is('tax/*') ? 'here show' : ''}} menu-accordion">
										<span class="menu-link">
										<span class="menu-icon fas fa-money-check-alt">
											<!--begin::Svg Icon | path: icons/duotune/files/fil025.svg-->

                                            <!--end::Svg Icon-->
										</span>
										<span class="menu-title">TAX</span>
										<span class="menu-arrow"></span>
									</span>
    <div class="menu-sub menu-sub-accordion">
        <div class="menu-item">
            <a class="menu-link {{request()->is('tax/perusahaan') ? 'active' : ''}}" href="{{ route('tax.perusahaan') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                <span class="menu-title">Perusahaan</span>
            </a>
        </div>
    </div>
</div>
