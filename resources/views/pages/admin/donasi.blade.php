<x-admin-layout>
    <div class="min-h-screen bg-[#FBF8F5] p-8">

        <h1 class="text-3xl font-bold text-gray-900 mb-8">Data Barang Donasi</h1>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

            <h2 class="text-xl font-semibold mb-6 text-center text-slate-900">
                Tabel Barang Donasi
            </h2>

            {{-- SEARCH (opsional, kalau mau dipakai) --}}
            <div class="mb-4 flex justify-end">
                <form method="GET" action="{{ route('admin.donasi') }}" class="relative w-full md:w-1/3">
                    <input type="text" name="search" value="{{ $search }}"
                        class="w-full border border-gray-300 rounded-xl py-2 pl-10 pr-4 focus:ring-2 focus:ring-emerald-400"
                        placeholder="Cari nama, telepon, alamat, jenis barang...">

                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-4.35-4.35M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16z" />
                    </svg>
                </form>
            </div>

            {{-- WRAPPER SCROLL --}}
            <div class="w-full overflow-x-auto">

                {{-- TABLE --}}
                <table class="min-w-[900px] w-full text-sm border-collapse">
                    <thead>
                        <tr class="bg-card text-slate-900 text-center">
                            <th class="border px-3 py-2 whitespace-nowrap">No</th>
                            <th class="border px-3 py-2 whitespace-nowrap">Nama</th>
                            <th class="border px-3 py-2 whitespace-nowrap">Nomor Telepon</th>
                            <th class="border px-3 py-2 whitespace-nowrap">Alamat</th>
                            <th class="border px-3 py-2 whitespace-nowrap">Jenis Barang</th>
                            <th class="border px-3 py-2 whitespace-nowrap">Jenis Pengantaran</th>
                            <th class="border px-3 py-2 whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($donations as $index => $donation)
                            <tr>
                                {{-- No urut global sesuai pagination --}}
                                <td class="border px-3 py-2 text-center whitespace-nowrap">
                                    {{ $donations->firstItem() + $index }}
                                </td>

                                <td
                                    class="border px-3 py-2 max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap">
                                    {{ $donation->donor_name }}
                                </td>

                                <td
                                    class="border px-3 py-2 text-center max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap">
                                    {{ $donation->phone }}
                                </td>

                                <td
                                    class="border px-3 py-2 max-w-[200px] overflow-hidden text-ellipsis whitespace-nowrap">
                                    {{ $donation->address }}
                                </td>

                                <td class="border px-3 py-2 text-center whitespace-nowrap">
                                    {{ $donation->item_type }}
                                </td>

                                <td class="border px-3 py-2 text-center whitespace-nowrap">
                                    {{ $donation->delivery_type === 'jemput' ? 'Jemput Donasi' : 'Antar Donasi' }}
                                </td>

                                <td class="border px-3 py-2 whitespace-nowrap">

                                    <div class="flex items-center justify-center gap-3">

                                        {{-- TOMBOL EDIT --}}
                                        <a href="{{ route('admin.donasi.edit', $donation->id) }}"
                                            class="inline-flex items-center gap-1 bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1.5 rounded-lg shadow text-xs font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 512 512">
                                                <path fill="currentColor" fill-rule="evenodd"
                                                    d="M469.334 85.333v341.333H42.667V85.333zM426.667 128H85.334v256h341.333zM384 298.666v32H277.334v-32zm0-64v32H277.334v-32zm-149.333-64V256H128v-85.334zm149.333 0v32H277.334v-32z" />
                                            </svg>
                                            Detail
                                        </a>

                                        {{-- DROPDOWN UBAH STATUS --}}
                                        <form action="{{ route('admin.donasi.update-status', $donation->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <select name="status" onchange="this.form.submit()"
                                                class="text-xs px-3 py-1.5 rounded-lg border border-gray-300 bg-white focus:ring-emerald-400 focus:border-emerald-400 cursor-pointer">
                                                <option value="pending"
                                                    {{ $donation->status == 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="diproses"
                                                    {{ $donation->status == 'diproses' ? 'selected' : '' }}>Diproses
                                                </option>
                                                <option value="selesai"
                                                    {{ $donation->status == 'selesai' ? 'selected' : '' }}>Selesai
                                                </option>
                                                <option value="dibatalkan"
                                                    {{ $donation->status == 'dibatalkan' ? 'selected' : '' }}>
                                                    Dibatalkan
                                                </option>
                                            </select>
                                        </form>

                                    </div>

                                </td>




                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-gray-500">
                                    Belum ada data donasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-4">
                {{ $donations->links() }}
            </div>

        </div>

    </div>
</x-admin-layout>
