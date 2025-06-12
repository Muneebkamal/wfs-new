<aside id="layout-menu" class="layout-menu menu-vertical menu">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                <span class="text-primary">
                  <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                      fill="currentColor" />
                    <path
                      opacity="0.06"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                      fill="#161616" />
                    <path
                      opacity="0.06"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                      fill="#161616" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                      fill="currentColor" />
                  </svg>
                </span>
              </span>
              <span class="app-brand-text demo menu-text fw-bold ms-3">WFS</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="icon-base ti menu-toggle-icon d-none d-xl-block"></i>
              <i class="icon-base ti tabler-x d-block d-xl-none"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>
            <ul class="menu-inner py-1">
                <li class="menu-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-smart-home"></i>
                        <div data-i18n="Home">Home</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('orders.index') ? 'active' : '' }}">
                    <a href="{{ route('orders.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-shopping-cart"></i>
                        <div data-i18n="Orders">Orders</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('products.index') ? 'active' : '' }}">
                    <a href="{{ route('products.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-package"></i>
                        <div data-i18n="Products">Products</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('po.order.*') ? 'active open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon icon-base ti tabler-receipt"></i>
                        <div data-i18n="PO Orders">PO Orders</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->routeIs('po.order.index') ? 'active' : '' }}">
                            <a href="{{ route('po.order.index') }}" class="menu-link">
                                <div data-i18n="PO List">PO List</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('po.order.create') ? 'active' : '' }}">
                            <a href="{{ route('po.order.create') }}" class="menu-link">
                                <div data-i18n="Create Po">Create Po</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item {{ request()->routeIs('reconciliation.report.*') ? 'active open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base ti tabler-report"></i>
                    <div data-i18n="Reports">Reports</div>
                    </a>
                    <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('reconciliation.report.*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Reconciliation Report">Reconciliation Report</div>
                        </a>
                        <ul class="menu-sub">
                        <li class="menu-item {{ request()->routeIs('reconciliation.report.index') ? 'active' : '' }}">
                            <a href="{{ route('reconciliation.report.index') }}" class="menu-link">
                            <div data-i18n="Add Reconciliation Report">Add Reconciliation Report</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('reconciliation.report.storage-fee') ? 'active' : '' }}">
                            <a href="{{ route('reconciliation.report.storage-fee') }}" class="menu-link">
                            <div data-i18n="WFS Storage Fee">WFS Storage Fee</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('reconciliation.report.shipping-label-service-charge') ? 'active' : '' }}">
                            <a href="{{ route('reconciliation.report.shipping-label-service-charge') }}" class="menu-link">
                            <div data-i18n="WFS Walmart Shipping Label Service Charge">WFS Walmart Shipping Label Service Charge</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('reconciliation.report.wfs-lost-inventory') ? 'active' : '' }}">
                            <a href="{{ route('reconciliation.report.wfs-lost-inventory') }}" class="menu-link">
                            <div data-i18n="WFS Lost Inventory">WFS Lost Inventory</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('reconciliation.report.wfs-found-inventory') ? 'active' : '' }}">
                            <a href="{{ route('reconciliation.report.wfs-found-inventory') }}" class="menu-link">
                            <div data-i18n="WFS Found Inventor">WFS Found Inventor</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('reconciliation.report.wfs-inbound-transportation-fee') ? 'active' : '' }}">
                            <a href="{{ route('reconciliation.report.wfs-inbound-transportation-fee') }}" class="menu-link">
                            <div data-i18n="WFS Inbound Transportation Fee">WFS Inbound Transportation Fee</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('reconciliation.report.wfs-rc-inventory-disposal-fee') ? 'active' : '' }}">
                            <a href="{{ route('reconciliation.report.wfs-rc-inventory-disposal-fee') }}" class="menu-link">
                            <div data-i18n="WFS RC_Inventory Disposal Fee">WFS RC_Inventory Disposal Fee</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('reconciliation.report.deposit-hyperwallet-account') ? 'active' : '' }}">
                            <a href="{{ route('reconciliation.report.deposit-hyperwallet-account') }}" class="menu-link">
                            <div data-i18n="Deposited in HYPERWALLET account">Deposited in HYPERWALLET account</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('reconciliation.report.wfs-refund') ? 'active' : '' }}">
                            <a href="{{ route('reconciliation.report.wfs-refund') }}" class="menu-link">
                            <div data-i18n="WFS Refund">WFS Refund</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('reconciliation.report.walmart-product-advertising') ? 'active' : '' }}">
                            <a href="{{ route('reconciliation.report.walmart-product-advertising') }}" class="menu-link">
                            <div data-i18n="Product Advertising">Product Advertising</div>
                            </a>
                        </li>
                        </ul>
                    </li>
                    <li class="menu-item {{ request()->routeIs('reconciliation.report.sales-report-by-state') ? 'active' : '' }}">
                        <a href="{{ route('reconciliation.report.sales-report-by-state') }}" class="menu-link">
                        <div data-i18n="SR by state">SR by state</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('reconciliation.report.montly-report') ? 'active' : '' }}">
                        <a href="{{ route('reconciliation.report.montly-report') }}" class="menu-link">
                        <div data-i18n="Monthly Reports">Monthly Reports</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('reconciliation.report.inventory-valuation-report') ? 'active' : '' }}">
                        <a href="{{ route('reconciliation.report.inventory-valuation-report') }}" class="menu-link">
                        <div data-i18n="Inventory Valuation Report">Inventory Valuation Report</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                        <div data-i18n="PO Order Reports">PO Order Reports</div>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base ti tabler-truck"></i>
                    <div data-i18n="Shipping Cost">Shipping Cost</div>
                    <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
                    </a>
                    <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                        <div data-i18n="Shipping Cost">Shipping Cost</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                        <div data-i18n="Add Shipping Cost">Add Shipping Cost</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                        <div data-i18n="Daily Shipping Cost">Daily Shipping Cost</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                        <div data-i18n="Missing Shipping Cost">Missing Shipping Cost</div>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base ti tabler-tag"></i>
                    <div data-i18n="Product Price">Products</div>
                    </a>
                    <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                        <div data-i18n="Product Price">Product Price</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                        <div data-i18n="Add Product">Add Product</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                        <div data-i18n="PO Items">PO Items</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                        <div data-i18n="Add Product Price">Add Product Price</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                        <div data-i18n="Missing Product Price">Missing Product Price</div>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="menu-item {{ request()->is('users*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="menu-link">
                        <i class="menu-icon icon-base ti tabler-users"></i>
                        <div data-i18n="Users">Users</div>
                    </a>
                </li>

                @php
                    $isVendorMenuOpen = request()->is('vendors*') || request()->is('locations*') || request()->is('payment/terms*') || request()->is('ship/via*');
                @endphp
                <li class="menu-item {{ $isVendorMenuOpen ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base ti tabler-building-store"></i>
                    <div data-i18n="Vendors">Vendors</div>
                    </a>
                    <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('vendors*') ? 'active' : '' }}">
                        <a href="{{ route('vendors.index') }}" class="menu-link">
                        <div data-i18n="Vendors">Vendors</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('locations*') ? 'active' : '' }}">
                        <a href="{{ route('locations.index') }}" class="menu-link">
                        <div data-i18n="Locations">Locations</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('payment/terms*') ? 'active' : '' }}">
                        <a href="{{ url('payment/terms') }}" class="menu-link">
                        <div data-i18n="Payment Terms">Payment Terms</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('ship/via*') ? 'active' : '' }}">
                        <a href="{{ url('ship/via') }}" class="menu-link">
                        <div data-i18n="Ship Via">Ship Via</div>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base ti tabler-box"></i>
                    <div data-i18n="Inventory">Inventory</div>
                    </a>
                    <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                        <div data-i18n="WFS Inventory">WFS Inventory</div>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base ti tabler-cash"></i>
                    <div data-i18n="Add Walmart Item">Add Walmart Item</div>
                    </a>
                    <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                        <div data-i18n="Activity Feeds">Activity Feeds</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                        <div data-i18n="Walmart Items">Walmart Items</div>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                    <i class="menu-icon icon-base ti tabler-refresh"></i>
                    <div data-i18n="Refund">Refund</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('settings*') ? 'active' : '' }}">
                    <a href="{{ url('settings') }}" class="menu-link">
                    <i class="menu-icon icon-base ti tabler-settings"></i>
                    <div data-i18n="Global Settings">Global Settings</div>
                    </a>
                </li>
            </ul>
        </aside>