<aside id="sidebar-left" class="sidebar-left">
      <div class="sidebar-header">
            <div class="sidebar-title"> Menu </div>
            <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                  <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
      </div>
      <div class="nano">
            <div class="nano-content">
                  <nav id="menu" class="nav-main" role="navigation">
                        <ul class="nav nav-main">
                              <li class="{{ Request::is('dashboard') || Request::is('profil') ? 'nav-active' : '' }}">
                                    <a href="{{ url('/dashboard') }}" style="{{ Request::is('dashboard') || Request::is('profil') ? 'color: #0088cc;' : '' }}">
                                          <i class="fa fa-home" aria-hidden="true"></i>
                                          <span>Dashboard</span>
                                    </a>
                              </li>
                              @if(auth()->user()->role == 0)
                              <li class="nav-parent {{ Request::is('tarif*') ? 'nav-expanded nav-active' : '' }}">
                                    <a class="text-muted" style="{{ Request::is('tarif*') ? 'color: #0088cc !important;' : '' }}">
                                          <i class="fa fa-server" aria-hidden="true"></i>
                                          <span>Master Data</span>
                                    </a>
                                    <ul class="nav nav-children">
                                          <li class="{{ Request::is('tarif*') ? 'nav-active' : '' }}">
                                                <a href="{{ route('tarif.index') }}">Tarif Daya</a>
                                          </li>
                                    </ul>
                              </li>
                              <li class="{{ Request::is('penggunaan*') ? 'nav-active' : '' }}">
                                    <a href="{{ route('penggunaan.index') }}" style="{{ Request::is('penggunaan*') ? 'color: #0088cc;' : '' }}">
                                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                          <span>Penggunaan Bulanan</span>
                                    </a>
                              </li>
                              <li class="{{ Request::is('approval*') ? 'nav-active' : '' }}">
                                    <a href="{{ url('/approval') }}" style="{{ Request::is('approval*') ? 'color: #0088cc;' : '' }}">
                                          <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                          <span>Approval Pembayaran</span>
                                    </a>
                              </li>
                              <li class="{{ Request::is('laporan*') ? 'nav-active' : '' }}">
                                    <a href="{{ url('/laporan') }}" style="{{ Request::is('laporan*') ? 'color: #0088cc;' : '' }}">
                                          <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                          <span>Laporan Pelanggan Bulan Ini</span>
                                    </a>
                              </li>
                              @elseif(auth()->user()->role == 1)
                              <li class="{{ Request::is('tagihan*') ? 'nav-active' : '' }}">
                                    <a href="{{ url('/tagihan') }}" style="{{ Request::is('tagihan*') ? 'color: #0088cc;' : '' }}">
                                          <i class="fa fa-list-alt" aria-hidden="true"></i>
                                          <span>Tagihan</span>
                                    </a>
                              </li>
                              <li class="{{ Request::is('pembayaran*') ? 'nav-active' : '' }}">
                                    <a href="{{ url('/pembayaran') }}" style="{{ Request::is('pembayaran*') ? 'color: #0088cc;' : '' }}">
                                          <i class="fa fa-credit-card" aria-hidden="true"></i>
                                          <span>Pembayaran</span>
                                    </a>
                              </li>
                              @endif
                        </ul>
                  </nav>
            </div>
            <script>
                  // Maintain Scroll Position
                  if (typeof localStorage !== 'undefined') {
                        if (localStorage.getItem('sidebar-left-position') !== null) {
                              var initialPosition = localStorage.getItem('sidebar-left-position'),
                                    sidebarLeft = document.querySelector('#sidebar-left .nano-content');
                              sidebarLeft.scrollTop = initialPosition;
                        }
                  }
            </script>
      </div>
</aside>