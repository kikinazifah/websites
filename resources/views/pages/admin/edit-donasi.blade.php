<x-admin-layout>
    <div class="min-h-screen bg-[#FBF8F5] p-8">

        <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Barang Donasi</h1>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm max-w-4xl mx-auto p-8">

            <h2 class="text-lg font-semibold text-center text-gray-900 mb-8">
                Edit Data Barang Donasi (Hardcode)
            </h2>

            {{-- FOTO BARANG BESAR --}}
            <div class="flex justify-center mb-8">
                <div class="w-60 h-60 rounded-2xl overflow-hidden shadow">
                    <img src="{{ asset('images/bg.png') }}" class="w-full h-full object-cover">
                </div>
            </div>

            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- NAMA --}}
                    <div>
                        <label class="block text-sm font-semibold text-emerald-800 mb-2">Nama</label>
                        <input type="text" name="nama" value="Budi Santoso"
                            class="w-full rounded-xl border border-gray-200 bg-[#F7F1E9] px-4 py-2.5 text-gray-800 text-sm">
                    </div>

                    {{-- TELEPON --}}
                    <div>
                        <label class="block text-sm font-semibold text-emerald-800 mb-2">Nomor Telepon</label>
                        <input type="text" name="telepon" value="0821-1234-5678"
                            class="w-full rounded-xl border border-gray-200 bg-[#F7F1E9] px-4 py-2.5 text-gray-800 text-sm">
                    </div>

                    {{-- ALAMAT --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-emerald-800 mb-2">Alamat</label>
                        <textarea name="alamat" rows="2"
                            class="w-full rounded-xl border border-gray-200 bg-[#F7F1E9] px-4 py-2.5 text-gray-800 text-sm resize-none">Jl. Melati No. 22</textarea>
                    </div>

                    {{-- JENIS BARANG --}}
                    <div>
                        <label class="block text-sm font-semibold text-emerald-800 mb-2">Jenis Barang</label>
                        <input type="text" name="jenis" value="Pakaian"
                            class="w-full rounded-xl border border-gray-200 bg-[#F7F1E9] px-4 py-2.5 text-gray-800 text-sm">
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-emerald-800 mb-2">Deskripsi Barang</label>
                        <textarea name="deskripsi" rows="3"
                            class="w-full rounded-xl border border-gray-200 bg-[#F7F1E9] px-4 py-2.5 text-gray-800 text-sm resize-none">Baju layak pakai ukuran L</textarea>
                    </div>

                    {{-- UPLOAD FOTO BARU --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-emerald-800 mb-2">Foto Barang (Opsional)</label>
                        <input type="file" name="foto"
                            class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-gray-800 text-sm">
                        <small class="text-gray-600 text-xs">Jika tidak memilih foto baru, foto lama tetap
                            digunakan.</small>
                    </div>

                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="px-8 py-2.5 rounded-xl bg-[#2F5D50] text-white text-sm font-medium shadow hover:bg-[#244b40] transition">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>

    </div>
</x-admin-layout>
