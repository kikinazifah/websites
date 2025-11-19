<header class="fixed inset-x-0 top-4 z-50 flex justify-center px-4">
    <nav
        class="backdrop-blur-md bg-green border border-white/30 shadow-lg
           px-4 py-2 md:px-4 md:py-1 rounded-2xl flex items-center gap-3 md:gap-10 relative">

        {{-- Hamburger Menu Checkbox --}}
        <input type="checkbox" id="menu-toggle" class="hidden peer" />

        {{-- Hamburger Icon --}}
        <label for="menu-toggle" class="md:hidden cursor-pointer text-white text-2xl select-none">
            ☰
        </label>

        {{-- Logo --}}
        <span class="text-white text-lg md:text-xl">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-9 md:h-11 md:mr-20" />
        </span>

        {{-- Menu Items --}}
        <div
            class="hidden peer-checked:flex md:flex
             flex-col md:flex-row
             gap-4 md:gap-8
             fixed md:static top-14 left-0 right-0
             bg-green md:bg-transparent
             p-6 md:p-0
             rounded-xl
             items-start md:items-center shadow-xl md:shadow-none">

            {{-- Link: Beranda --}}
            <a href="/"
                class="group relative inline-block text-sm md:text-md transition-colors duration-300
               {{ request()->is('/') ? 'text-green-300 font-semibold' : 'text-white hover:text-green-200' }}">
                Beranda
                {{-- Garis Animasi (Center Out) --}}
                <span
                    class="absolute -bottom-1 left-0 w-full h-[2px] bg-green-300 rounded-full
                       origin-center transform transition-transform duration-300 ease-out
                       {{ request()->is('/') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                </span>
            </a>

            {{-- Link: Peta Donasi --}}
            <a href="/maps"
                class="group relative inline-block text-sm md:text-md transition-colors duration-300
               {{ request()->is('maps') ? 'text-green-300 font-semibold' : 'text-white hover:text-green-200' }}">
                Peta Donasi
                <span
                    class="absolute -bottom-1 left-0 w-full h-[2px] bg-green-300 rounded-full
                       origin-center transform transition-transform duration-300 ease-out
                       {{ request()->is('maps') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                </span>
            </a>

            {{-- Link: Kirim Donasi --}}
            <a href="/donate"
                class="group relative inline-block text-sm md:text-md transition-colors duration-300
               {{ request()->is('donate') ? 'text-green-300 font-semibold' : 'text-white hover:text-green-200' }}">
                Kirim Donasi
                <span
                    class="absolute -bottom-1 left-0 w-full h-[2px] bg-green-300 rounded-full
                       origin-center transform transition-transform duration-300 ease-out
                       {{ request()->is('donate') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                </span>
            </a>

            {{-- Link: Tentang --}}
            <a href="/about"
                class="group relative inline-block text-sm md:text-md transition-colors duration-300
               {{ request()->is('about') ? 'text-green-300 font-semibold' : 'text-white hover:text-green-200' }}">
                Tentang
                <span
                    class="absolute -bottom-1 left-0 w-full h-[2px] bg-green-300 rounded-full
                       origin-center transform transition-transform duration-300 ease-out
                       {{ request()->is('about') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                </span>
            </a>

            {{-- Tombol CTA --}}
            <a href="#"
                class="text-white text-sm md:text-md px-5 py-2 md:ml-20
               border border-white/50 rounded-xl transition-all duration-300
               hover:bg-green-300 hover:text-green hover:border-transparent hover:shadow-[0_0_15px_rgba(134,239,172,0.6)] active:scale-95">
                Mulai Donasi
            </a>

        </div>
    </nav>
</header>
