@php
    /** @var \App\Models\User $user */
@endphp

<x-layout>
    <main class="bg-gray-50 min-h-screen relative pb-20">

        {{-- 1. Header Background --}}
        <div class="h-72 w-full bg-cover bg-center relative group"
            style="background-image: url('{{ asset('images/bg.png') }}');">
            {{-- Overlay Hijau dengan Gradient --}}
            <div class="absolute inset-0 bg-linear-to-b from-green to-[#1a3c33]/90"></div>

            {{-- Dekorasi Pattern (Opsional) --}}
            <div
                class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cube-coat.png')]">
            </div>

            {{-- Konten Header --}}
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4">
                <h1 class="text-white text-3xl md:text-5xl font-bold mb-3 tracking-tight drop-shadow-md">Profil Saya</h1>
                <p class="text-green-100 text-lg max-w-xl font-light">
                    Halo, <span class="font-bold text-white">{{ $user->name }}</span>! Kelola informasi akun dan donasi
                    Anda.
                </p>
            </div>
        </div>

        {{-- 2. Kontainer Utama (Card Profil) --}}
        <div class="max-w-5xl mx-auto px-4 sm:px-6 relative z-10 -mt-24">

            {{-- ALERT SUKSES --}}
            @if (session('success'))
                <div
                    class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-lg animate-fade-in-down">
                    <div class="bg-emerald-100 p-2 rounded-full text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm">Berhasil!</h4>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                <div class="md:flex">

                    {{-- === BAGIAN KIRI: SIDEBAR INFO === --}}
                    <div class="bg-slate-50 md:w-5/12 lg:w-1/3 p-8 flex flex-col items-center border-r border-gray-100">

                        {{-- Avatar Section --}}
                        <div class="relative group mb-4">
                            <div
                                class="w-36 h-36 rounded-full overflow-hidden border-4 border-white shadow-lg ring-2 ring-[#90C5BA]/50">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2f5d50&color=fff&size=128"
                                    alt="{{ $user->name }}"
                                    class="w-full h-full object-cover transform transition duration-500 group-hover:scale-110">
                            </div>
                            <div
                                class="absolute bottom-2 right-2 bg-green text-white p-2 rounded-full shadow-md border-2 border-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                        </div>

                        {{-- Nama & Email --}}
                        <h2 class="text-2xl font-bold text-gray-800 mb-1 text-center tracking-tight">{{ $user->name }}
                        </h2>
                        <div
                            class="inline-flex items-center gap-1 bg-white px-3 py-1 rounded-full border border-gray-200 shadow-sm mb-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" class="text-gray-400"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                            </svg>
                            <p class="text-gray-500 text-xs">{{ $user->email }}</p>
                        </div>

                        {{-- CARD STATISTIK --}}
                        <div class="w-full mb-6">
                            <div
                                class="bg-linear-to-br from-white to-emerald-50 p-4 rounded-2xl border border-emerald-100 shadow-sm flex items-center justify-between group hover:shadow-md transition">
                                <div class="text-left">
                                    <span class="text-xs text-emerald-600 font-bold uppercase tracking-wider">Total
                                        Donasi</span>
                                    <span
                                        class="block text-3xl font-extrabold text-gray-800 mt-1">{{ $totalDonations }}x</span>
                                </div>
                                <div
                                    class="h-12 w-12 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- FORM UPLOAD BUKTI --}}
                        <div class="w-full">
                            {{-- Gunakan route yang sesuai, misal: route('donation.uploadProof') --}}
                            <form action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div
                                    class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm relative overflow-hidden">
                                    {{-- Hiasan Background --}}
                                    <div
                                        class="absolute top-0 right-0 -mt-2 -mr-2 w-12 h-12 bg-green/10 rounded-full blur-xl">
                                    </div>

                                    <div class="flex items-center gap-2 mb-4 border-b border-gray-100 pb-3">
                                        <div class="p-1.5 bg-green rounded-lg text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                </path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="16" y1="13" x2="8" y2="13">
                                                </line>
                                                <line x1="16" y1="17" x2="8" y2="17">
                                                </line>
                                                <polyline points="10 9 9 9 8 9"></polyline>
                                            </svg>
                                        </div>
                                        <h3 class="text-xs font-bold text-gray-700 uppercase tracking-wider">Verifikasi
                                            Donasi</h3>
                                    </div>

                                    <div class="space-y-4">
                                        {{-- Input ID --}}
                                        <div>
                                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1">Kode
                                                Donasi</label>
                                            <div class="relative mt-1">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                                    <span class="text-xs">#</span>
                                                </div>
                                                <input type="number" name="donation_id" placeholder="Contoh: 5"
                                                    required
                                                    class="w-full pl-7 pr-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:bg-white focus:border-green focus:ring-1 focus:ring-green outline-none transition">
                                            </div>
                                        </div>

                                        {{-- Input File Custom --}}
                                        <div>
                                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1">Bukti
                                                Transfer/Barang</label>
                                            <label
                                                class="mt-1 flex flex-col items-center justify-center w-full h-24 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-green/5 hover:border-green transition-colors group">
                                                <div
                                                    class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-400 group-hover:text-green">
                                                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                        </path>
                                                    </svg>
                                                    <p class="text-[10px] font-medium"><span class="font-bold">Klik
                                                            upload</span></p>
                                                </div>
                                                <input type="file" name="proof_photo" class="hidden"
                                                    accept="image/*" required />
                                            </label>
                                        </div>

                                        <button type="submit"
                                            class="w-full bg-green text-white font-bold py-2.5 rounded-xl text-xs shadow-md hover:bg-[#254a40] hover:shadow-lg transition-all duration-300 flex justify-center items-center gap-2">
                                            <span>Kirim Verifikasi</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="22" y1="2" x2="11" y2="13">
                                                </line>
                                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- === BAGIAN KANAN: FORM EDIT === --}}
                    <div class="md:w-7/12 lg:w-2/3 p-8 md:p-10 bg-white">
                        <div class="flex justify-between items-center mb-8 border-b border-gray-100 pb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">Edit Informasi</h3>
                                <p class="text-sm text-gray-400">Perbarui data pribadi Anda di sini.</p>
                            </div>
                        </div>

                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            <div class="space-y-6">

                                {{-- Input Nama --}}
                                <div class="relative">
                                    <label class="text-xs font-bold text-gray-500 uppercase mb-2 block ml-1">Nama
                                        Lengkap</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-green">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                        </div>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-green focus:ring-2 focus:ring-green/20 transition duration-200 outline-none placeholder-gray-300 text-gray-700 bg-gray-50 focus:bg-white"
                                            placeholder="Masukkan nama anda">
                                    </div>
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Input Email --}}
                                <div>
                                    <label class="text-xs font-bold text-gray-500 uppercase mb-2 block ml-1">Alamat
                                        Email</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-green">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                </path>
                                                <polyline points="22,6 12,13 2,6"></polyline>
                                            </svg>
                                        </div>
                                        <input type="email" name="email"
                                            value="{{ old('email', $user->email) }}"
                                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-green focus:ring-2 focus:ring-green/20 transition duration-200 outline-none placeholder-gray-300 text-gray-700 bg-gray-50 focus:bg-white"
                                            placeholder="nama@email.com">
                                    </div>
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Input Password --}}
                                <div>
                                    <label class="text-xs font-bold text-gray-500 uppercase mb-2 block ml-1">Password
                                        Baru</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-green">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="11" width="18" height="11" rx="2"
                                                    ry="2"></rect>
                                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                            </svg>
                                        </div>
                                        <input type="password" id="password" name="password"
                                            class="w-full pl-10 pr-12 py-3 rounded-xl border border-gray-200 focus:border-green focus:ring-2 focus:ring-green/20 transition duration-200 outline-none placeholder-gray-300 text-gray-700 bg-gray-50 focus:bg-white"
                                            placeholder="Kosongkan jika tidak ingin mengubah">

                                        {{-- Toggle Icon --}}
                                        <button type="button" onclick="togglePassword()"
                                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-green cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-2 ml-1">*Minimal 8 karakter jika diisi.</p>
                                    @error('password')
                                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Button Action --}}
                                <div class="pt-6 flex justify-end">
                                    <button type="submit"
                                        class="bg-green text-white font-bold px-8 py-3 rounded-xl shadow-lg shadow-green/30 flex items-center gap-2 transition-all duration-300 transform hover:scale-105 hover:bg-[#254a40]">
                                        <span>Simpan Perubahan</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z">
                                            </path>
                                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                            <polyline points="7 3 7 8 15 8"></polyline>
                                        </svg>
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Tombol Logout --}}
            <div class="mt-8 text-center pb-8">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2 rounded-full border border-red-200 text-red-500 hover:bg-red-50 hover:text-red-700 text-sm font-semibold transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Keluar dari Akun
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</x-layout>
