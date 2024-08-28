<nav class="container mx-auto px-20">
  <div class="navbar text-white">
      <div class="navbar-start">
        <div class="dropdown">
          <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h8m-8 6h16" />
            </svg>
          </div>
          <ul
            tabindex="0"
            class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
            <li><a href="/">Home</a></li>
            <li><a href="barang">Daftar Alat</a></li>
            <li>
              <a>Kategori Alat</a>
              <ul class="p-2">
                <li><a>Submenu 1</a></li>
                <li><a>Submenu 2</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <a href="/">
          <img src="{{ asset("landpage") }}/asset/logo_light.png" alt="Logo" class="h-20 w-auto">
        </a>
      </div>
      <div class="navbar-end">
          <ul class="menu menu-horizontal px-1 hidden lg:flex">
              <li><a href="/">Home</a></li>
              <li><a href="barang">Daftar Alat</a></li>
              <li>
                <details>
                  <summary>Kategori Alat</summary>
                  <ul class="p-2">
                    <li><a>Submenu 1</a></li>
                    <li><a>Submenu 2</a></li>
                  </ul>
                </details>
              </li>
            </ul>

          @auth
              <!-- Jika user sudah login, tampilkan tombol Dashboard -->
              <a class="ml-2 rounded-2xl py-2 px-8 bg-[#429C4A]" href="{{ route('dashboard') }}">Dashboard</a>
          @else
              <!-- Jika user belum login, tampilkan tombol Login -->
              <a class="ml-2 rounded-2xl py-2 px-8 bg-[#429C4A] hover:bg-green-700" href="{{ route('login') }}">Login</a>
          @endauth
      </div>
    </div>
</nav>
