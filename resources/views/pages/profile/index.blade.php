@php
    /** @var \App\Models\User $user */
    // Pastikan controller mengirimkan $myDonations
@endphp

<x-layout>
    <main class="bg-gray-50 min-h-screen relative pb-20">

        {{-- 1. Header Background --}}
        <div class="h-72 w-full bg-cover bg-center relative group"
            style="background-image: url('{{ asset('images/bg.png') }}');">
            {{-- Overlay Hijau dengan Gradient --}}
            <div class="absolute inset-0 bg-linear-to-b from-green to-[#1a3c33]/90"></div>

            {{-- Dekorasi Pattern --}}
            <div
                class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cube-coat.png')]">
            </div>

            {{-- Konten Header --}}
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4">
                <h1 class="text-white text-3xl md:text-5xl font-bold mb-3 tracking-tight drop-shadow-md">Profil Saya</h1>
                <p class="text-green-100 text-lg max-w-xl font-light">
                    Halo, <span class="font-bold text-white">{{ $user->name }}</span>! Pantau status donasi dan kelola
                    akun Anda.
                </p>
            </div>
        </div>

        {{-- 2. Kontainer Utama --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10 -mt-24">

            {{-- === ALERT KHUSUS ID DONASI BARU === --}}
            @if (session('success_donation_id'))
                <div
                    class="mb-6 bg-white border-l-4 border-green p-6 rounded-r-xl shadow-lg animate-bounce-in flex flex-col md:flex-row items-center gap-4">
                    <div class="flex-shrink-0 bg-green/10 p-3 rounded-full">
                        <svg class="h-8 w-8 text-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1 text-center md:text-left">
                        <h3 class="text-lg font-bold text-gray-900">Donasi Berhasil Dibuat!</h3>
                        <p class="text-sm text-gray-600 mt-1">
                            Silakan catat ID Donasi Anda atau langsung masukkan di form verifikasi di bawah.
                        </p>
                    </div>
                    <div class="bg-green/10 border-2 border-dashed border-green rounded-xl px-6 py-2">
                        <span class="text-xs text-green font-bold uppercase block text-center">ID ANDA</span>
                        <span
                            class="text-3xl font-black text-green tracking-widest">#{{ session('success_donation_id') }}</span>
                    </div>
                </div>
            @endif

            {{-- ALERT UMUM (Sukses/Error) --}}
            @if (session('success') && !session('success_donation_id'))
                <div
                    class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800 flex items-center gap-3 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
            @endif


            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                <div class="md:flex">

                    {{-- === BAGIAN KIRI: SIDEBAR INFO & VERIFIKASI === --}}
                    <div class="bg-slate-50 md:w-5/12 lg:w-1/3 p-8 flex flex-col items-center border-r border-gray-100">

                        {{-- Avatar Section --}}
                        <div class="relative group mb-4">
                            <div
                                class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg ring-2 ring-[#90C5BA]/50">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2f5d50&color=fff&size=128"
                                    alt="{{ $user->name }}"
                                    class="w-full h-full object-cover transform transition duration-500 group-hover:scale-110">
                            </div>
                        </div>

                        {{-- Nama & Email --}}
                        <h2 class="text-xl font-bold text-gray-800 mb-1 text-center tracking-tight">{{ $user->name }}
                        </h2>
                        <div
                            class="inline-flex items-center gap-1 bg-white px-3 py-1 rounded-full border border-gray-200 shadow-sm mb-6">
                            <p class="text-gray-500 text-xs">{{ $user->email }}</p>
                        </div>

                        {{-- Stat Donasi --}}
                        <div class="w-full mb-6">
                            <div
                                class="bg-white p-4 rounded-2xl border border-emerald-100 shadow-sm flex items-center justify-between">
                                <div class="text-left">
                                    <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Total
                                        Donasi</span>
                                    <span
                                        class="block text-2xl font-extrabold text-green mt-1">{{ $totalDonations ?? 0 }}x</span>
                                </div>
                                <div
                                    class="h-10 w-10 bg-emerald-50 rounded-full flex items-center justify-center text-green">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- FORM UPLOAD BUKTI (Active) --}}
                        <div class="w-full">
                            {{-- Route Verifikasi --}}
                            <form action="{{ route('donation.uploadProof') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div
                                    class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm relative overflow-hidden">
                                    {{-- Hiasan --}}
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
                                                {{-- Value otomatis terisi jika ada session success_donation_id --}}
                                                <input type="number" name="donation_id"
                                                    value="{{ session('success_donation_id') }}"
                                                    placeholder="Contoh: 5" required
                                                    class="w-full pl-7 pr-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:bg-white focus:border-green focus:ring-1 focus:ring-green outline-none transition">
                                            </div>
                                        </div>

                                        {{-- Input File --}}
                                        <div>
                                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1">Bukti
                                                Transfer/Barang</label>
                                            <label
                                                class="mt-1 flex flex-col items-center justify-center w-full h-24 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-green/5 hover:border-green transition-colors group">
                                                <div
                                                    class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-400 group-hover:text-green">
                                                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                        </path>
                                                    </svg>
                                                    <p class="text-[10px] font-medium">Klik Upload Bukti</p>
                                                </div>
                                                <input type="file" name="proof_photo" class="hidden"
                                                    accept="image/*" required />
                                            </label>
                                        </div>

                                        <button type="submit"
                                            class="w-full bg-green text-white font-bold py-2.5 rounded-xl text-xs shadow-md hover:bg-[#254a40] transition-all flex justify-center items-center gap-2">
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

                    {{-- === BAGIAN KANAN: RIWAYAT & EDIT === --}}
                    <div class="md:w-7/12 lg:w-2/3 p-8 md:p-10 bg-white">

                        {{-- 1. SECTION RIWAYAT DONASI (CARD MEMANJANG) --}}
                        <div class="mb-12">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                        </path>
                                    </svg>
                                    Riwayat Donasi
                                </h3>
                                <span class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded-md">Terbaru</span>
                            </div>

                            {{-- Container Scrollable --}}
                            <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                                @forelse($myDonations as $donation)
                                    {{-- Card Item --}}
                                    <div
                                        class="group relative bg-white rounded-2xl border border-gray-100 p-4 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">

                                        {{-- Kiri: Icon ID & Info --}}
                                        <div class="flex items-center gap-4 w-full">
                                            {{-- Box ID --}}
                                            <div
                                                class="flex-shrink-0 w-14 h-14 bg-gray-50 rounded-xl flex flex-col items-center justify-center border border-gray-200 text-gray-500 group-hover:border-green/30 group-hover:bg-green/5 transition-colors">
                                                <span class="text-[9px] uppercase font-bold text-gray-400">ID</span>
                                                <span
                                                    class="text-lg font-black text-gray-700 group-hover:text-green">#{{ $donation->id }}</span>
                                            </div>

                                            <div class="flex-1">
                                                <h4 class="font-bold text-gray-800 text-sm">{{ $donation->item_type }}
                                                </h4>
                                                <p class="text-xs text-gray-500 line-clamp-1 mt-0.5">
                                                    {{ $donation->item_description }}</p>

                                                <div class="flex items-center gap-3 mt-2">
                                                    <span class="text-[10px] text-gray-400 flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                        {{ $donation->created_at->format('d M Y') }}
                                                    </span>

                                                    {{-- Status Bukti --}}
                                                    @if ($donation->proof_photo)
                                                        <span
                                                            class="text-[10px] text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full font-medium flex items-center gap-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                            Bukti Ada
                                                        </span>
                                                    @else
                                                        <span
                                                            class="text-[10px] text-orange-600 bg-orange-50 px-2 py-0.5 rounded-full font-medium flex items-center gap-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                                                </path>
                                                            </svg>
                                                            Butuh Verifikasi
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Kanan: Badge Status --}}
                                        <div
                                            class="flex-shrink-0 self-start sm:self-center w-full sm:w-auto text-right">
                                            @php
                                                $statusClass = match ($donation->status) {
                                                    'selesai' => 'bg-green text-white border-green',
                                                    'diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                    'dibatalkan' => 'bg-red-100 text-red-700 border-red-200',
                                                    default
                                                        => 'bg-yellow-100 text-yellow-700 border-yellow-200', // Pending
                                                };
                                            @endphp
                                            <span
                                                class="inline-block px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $statusClass }}">
                                                {{ $donation->status }}
                                            </span>
                                        </div>

                                    </div>
                                @empty
                                    <div
                                        class="text-center py-8 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                                        <p class="text-gray-400 text-sm">Belum ada donasi yang dilakukan.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- Divider --}}
                        <div class="border-t border-gray-100 my-8"></div>

                        {{-- 2. SECTION EDIT PROFILE --}}
                        <div>
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">Edit Informasi Akun</h3>
                                    <p class="text-sm text-gray-400">Perbarui nama atau password login.</p>
                                </div>
                            </div>

                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                <div class="space-y-5">
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
                                            <input type="text" name="name"
                                                value="{{ old('name', $user->name) }}"
                                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-green focus:ring-2 focus:ring-green/20 transition duration-200 outline-none text-gray-700 bg-gray-50 focus:bg-white"
                                                placeholder="Masukkan nama anda">
                                        </div>
                                        @error('name')
                                            <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Input Email --}}
                                    <div>
                                        <label
                                            class="text-xs font-bold text-gray-500 uppercase mb-2 block ml-1">Email</label>
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
                                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-green focus:ring-2 focus:ring-green/20 transition duration-200 outline-none text-gray-700 bg-gray-50 focus:bg-white"
                                                placeholder="nama@email.com">
                                        </div>
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Input Password --}}
                                    <div>
                                        <label
                                            class="text-xs font-bold text-gray-500 uppercase mb-2 block ml-1">Password
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
                                                class="w-full pl-10 pr-12 py-3 rounded-xl border border-gray-200 focus:border-green focus:ring-2 focus:ring-green/20 transition duration-200 outline-none text-gray-700 bg-gray-50 focus:bg-white"
                                                placeholder="Kosongkan jika tidak ingin mengubah">

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

                                    {{-- Button Simpan --}}
                                    <div class="pt-4 flex justify-end">
                                        <button type="submit"
                                            class="bg-green text-white font-bold px-8 py-3 rounded-xl shadow-lg shadow-green/30 flex items-center gap-2 transition-all duration-300 transform hover:scale-105 hover:bg-[#254a40]">
                                            <span>Simpan Perubahan</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z">
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
