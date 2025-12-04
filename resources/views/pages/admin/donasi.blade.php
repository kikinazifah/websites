<x-admin-layout>
    <div class="min-h-screen bg-[#FBF8F5] p-8">

        <h1 class="text-3xl font-bold text-gray-900 mb-8">Data Barang Donasi</h1>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

            <h2 class="text-xl font-semibold mb-6 text-center text-slate-900">
                Tabel Barang Donasi
            </h2>

            @php
                // Dua data hardcode
                $items = [
                    [
                        'id' => 1,
                        'nama' => 'Budi Santoso',
                        'telepon' => '0821-1234-5678',
                        'alamat' => 'Jl. Melati No. 22',
                        'jenis' => 'Pakaian',
                        'jenis_pengantaran' => 'Antar Donasi',
                        'deskripsi' => 'Baju layak pakai ukuran L',
                        'foto' => asset('images/bg.png'),
                    ],
                    [
                        'id' => 2,
                        'nama' => 'Siti Aminah',
                        'telepon' => '0812-9988-7766',
                        'alamat' => 'Gg. Cempaka RT 03',
                        'jenis' => 'Elektronik',
                        'jenis_pengantaran' => 'Jemput Donasi',
                        'deskripsi' => 'Rice cooker bekas namun berfungsi',
                        'foto' => 'https://via.placeholder.com/80',
                    ],
                ];
            @endphp

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
                            <th class="border px-3 py-2 whitespace-nowrap">Deskripsi</th>
                            <th class="border px-3 py-2 whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($items as $index => $item)
                            <tr>

                                <td class="border px-3 py-2 text-center whitespace-nowrap">
                                    {{ $index + 1 }}
                                </td>

                                <td
                                    class="border px-3 py-2 max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap">
                                    {{ $item['nama'] }}
                                </td>

                                <td
                                    class="border px-3 py-2 text-center max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap">
                                    {{ $item['telepon'] }}
                                </td>

                                <td
                                    class="border px-3 py-2 max-w-[200px] overflow-hidden text-ellipsis whitespace-nowrap">
                                    {{ $item['alamat'] }}
                                </td>

                                <td class="border px-3 py-2 text-center whitespace-nowrap">
                                    {{ $item['jenis'] }}
                                </td>

                                <td class="border px-3 py-2 text-center whitespace-nowrap">
                                    {{ $item['jenis_pengantaran'] }}
                                </td>

                                <td
                                    class="border px-3 py-2 max-w-[200px] overflow-hidden text-ellipsis whitespace-nowrap">
                                    {{ $item['deskripsi'] }}
                                </td>

                                <td class="border px-3 py-2 text-center whitespace-nowrap">
                                    <a href="{{ route('admin.donasi.edit', $item['id']) }}"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1 rounded-lg shadow text-sm">
                                        Edit
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

    </div>
</x-admin-layout>
