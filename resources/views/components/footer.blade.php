    {{-- Footer ges --}}
        <footer class="bg-white mt-10">
            <div class="max-w-6xl mx-auto px-6 py-10 md:py-12">
                <div class="grid gap-10 md:grid-cols-4">
                    {{-- Brand + Deskripsi --}}
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('images/logo.png') }}" alt="logo"
                                    class="w-13 h-13 object-contain">
                            </div>

                            <span class="text-xl font-semibold text-[#195b3b]">
                                Green Drop
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 leading-relaxed max-w-xs">
                            Menghubungkan barang layak pakai dengan mereka yang membutuhkan.
                        </p>
                    </div>

                    {{-- Navigasi --}}
                    <div>
                        <h3 class="text-sm font-semibold text-gray-800 mb-3">Navigasi</h3>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li>
                                <a href="#" class="hover:text-green hover:underline">
                                    Beranda
                                </a>
                            </li>
                            <li>
                                <a href="#" class="hover:text-green hover:underline">
                                    Peta Donasi
                                </a>
                            </li>
                            <li>
                                <a href="#" class="hover:text-green hover:underline">
                                    Kirim Donasi
                                </a>
                            </li>
                            <li>
                                <a href="#" class="hover:text-green hover:underline">
                                    Tentang
                                </a>
                            </li>
                        </ul>
                    </div>

                    {{-- Kontak --}}
                    <div>
                        <h3 class="text-sm font-semibold text-gray-800 mb-3">Kontak</h3>
                        <div class="flex items-center gap-2 text-sm text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24">
                                <path fill="none" stroke="#2d6a4f" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 6.75A2.75 2.75 0 0 1 6.75 4h10.5A2.75 2.75 0 0 1 20 6.75v10.5A2.75 2.75 0 0 1 17.25 20H6.75A2.75 2.75 0 0 1 4 17.25z" />
                                <path fill="none" stroke="#2d6a4f" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m5.5 7.5l5.636 3.523a2.75 2.75 0 0 0 2.728 0L19.5 7.5" />
                            </svg>
                            <span>info.mygreendrop@gmail.com</span>
                        </div>
                    </div>

                    {{-- Tentang Kami --}}
                    <div>
                        <h3 class="text-sm font-semibold text-gray-800 mb-3">Tentang Kami</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Platform berbasis peta untuk memudahkan distribusi barang donasi ke tangan yang tepat.
                        </p>
                    </div>
                </div>
            </div>

            <div class=" bg-[#fbf7f0]"></div>
        </footer>