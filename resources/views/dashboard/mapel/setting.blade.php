@php
    $page = 'mapel';
    $page_variable = 'mapel';
    $page_title = 'mapel';
    $action_param = $data->id_mapel;
@endphp

<x-app :page='$page'>
    <div class="p-2 sm:p-5 sm:py-0 md:pt-5 space-y-5">
        <div class="flex flex-col pt-3 gap-y-5 max-w-xl mx-auto">
            <div class="flex gap-x-3">
                <div class="grow">
                    <h1 class="font-semibold text-xl text-gray-800 dark:text-neutral-200">Pengaturan {{ $page_title }}</h1>
                    <p class="text-sm text-gray-500 dark:text-neutral-500">Halaman akses pengaturan {{ $page_title }}</p>
                </div>
            </div>

            <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <form action="{{ route($page.'.update.action', $action_param) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="py-2 sm:py-4 px-2">
                        <div class="p-4 space-y-5">
                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">Kode Mapel</label>
                                </div>
                                <div class="sm:col-span-9">
                                    <input type="text" name="kode_mapel" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Masukkan kode mapel" value="{{ old('kode_mapel', $data->kode_mapel) }}" autocomplete="off">
                                </div>
                            </div>

                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">Nama Mapel</label>
                                </div>
                                <div class="sm:col-span-9">
                                    <input type="text" name="nama_mapel" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Masukkan nama mapel" value="{{ old('nama_mapel', $data->nama_mapel) }}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 pt-0 flex justify-end gap-x-2">
                        <div class="w-full flex justify-end items-center gap-x-2">
                            <a href="{{ route($page) }}" class="py-2 px-3 inline-flex justify-center items-center text-start text-xs bg-white border border-gray-200 text-gray-800 text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                Kembali
                            </a>
                            <button type="submit" class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-start text-xs bg-blue-600 border border-blue-600 text-white text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-blue-700">Perbarui</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="space-y-5">
                <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                    <div class="p-5">
                        <div class="flex items-start justify-between gap-x-3">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-800 dark:text-neutral-100">Daftar Guru Pengajar</h3>
                                <p class="text-xs text-gray-500 dark:text-neutral-500 mt-1">Daftar guru yang mengajar mata pelajaran ini.</p>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-neutral-400">{{ $data->gurus->count() }} guru</span>
                        </div>

                        <ul class="mt-4 space-y-3">
                            @forelse ($data->gurus as $guru)
                            <li class="py-3 border-b last:border-b-0 border-gray-200 dark:border-neutral-700">
                                <div class="flex items-center justify-between gap-x-3">
                                    <div class="min-w-0 space-y-1">
                                        <p class="font-medium text-sm text-gray-800 dark:text-neutral-100">{{ $guru->nama ?? $guru->username ?? 'Nama guru tidak tersedia' }}</p>
                                        <p class="text-xs text-gray-500 dark:text-neutral-400">{{ $guru->username ?? '-' }}</p>
                                    </div>
                                </div>
                            </li>
                            @empty
                            <li class="rounded-xl border border-dashed border-gray-200 bg-white/70 px-4 py-4 text-sm text-gray-500 dark:border-neutral-700 dark:bg-neutral-900/50 dark:text-neutral-400">
                                Belum ada guru yang mengajar mata pelajaran ini.
                            </li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                    <div class="p-5">
                        <div class="flex items-start justify-between gap-x-3">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-800 dark:text-neutral-100">Detail Komponen Nilai</h3>
                                <p class="text-xs text-gray-500 dark:text-neutral-500 mt-1">Rincian komponen nilai harian dan assesmen untuk mapel ini.</p>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-neutral-400">{{ $komponenNilai->total() }} komponen</span>
                        </div>

                        <ul class="mt-4 space-y-3">
                            @forelse ($komponenNilai as $komponen)
                            <li class="py-3 border-b last:border-b-0 border-gray-200 dark:border-neutral-700">
                                <div class="flex items-center justify-between gap-x-3">
                                    <div class="min-w-0 space-y-1">
                                        <div class="flex items-center gap-2">
                                            <p class="font-medium text-sm text-gray-800 dark:text-neutral-100">{{ $komponen->nama_komponen }}</p>
                                            <span class="rounded-full bg-gray-100 px-2 py-1 text-[11px] font-semibold text-gray-600 dark:bg-neutral-900 dark:text-neutral-300">{{ $komponen->type }}</span>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-neutral-400">{{ $komponen->type === 'Harian' ? $komponen->kode_komponen_harian : $komponen->kode_komponen_assesmen }} • {{ $komponen->guru->nama ?? '-' }}</p>
                                    </div>
                                    <span class="text-xs font-medium {{ $komponen->is_active ? 'text-emerald-600' : 'text-rose-600' }}">{{ $komponen->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                                </div>
                            </li>
                            @empty
                            <li class="rounded-xl border border-dashed border-gray-200 bg-white/70 px-4 py-4 text-sm text-gray-500 dark:border-neutral-700 dark:bg-neutral-900/50 dark:text-neutral-400">
                                Belum ada komponen nilai untuk mata pelajaran ini.
                            </li>
                            @endforelse
                        </ul>

                        @if ($komponenNilai->hasPages())
                        <div class="mt-5 flex items-center justify-center gap-2">
                            <a href="{{ $komponenNilai->previousPageUrl() }}" class="py-2 px-3 inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700" @if($komponenNilai->onFirstPage()) aria-disabled="true" @endif>
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
                            </a>

                            <span class="py-2 px-3 inline-flex items-center justify-center text-xs font-semibold rounded-lg bg-gray-100 text-gray-700 dark:bg-neutral-900 dark:text-neutral-300">{{ $komponenNilai->currentPage() }}/{{ $komponenNilai->lastPage() }}</span>

                            <a href="{{ $komponenNilai->nextPageUrl() }}" class="py-2 px-3 inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700" @if(!$komponenNilai->hasMorePages()) aria-disabled="true" @endif>
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <form action="{{ route($page.'.delete.action', $action_param) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="p-6 w-full flex justify-between">
                        <div class="w-full text-sm">
                            <p class="font-semibold text-gray-800 dark:text-neutral-200">Hapus data</p>
                            <p class="text-xs text-gray-500 dark:text-neutral-500">Menghapus permanen data {{ $page_title }}</p>
                        </div>
                        <div>
                            <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700" onclick="return confirm('Hapus mata pelajaran ini?')">Hapus</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app>
