@php
    $page = 'mapel';
    $page_variable = 'mapel';
    $page_title = 'mata pelajaran';
    $data_colum = 5;
@endphp

<x-app :page='$page'>
    <div class="p-2 sm:p-5 sm:py-0 md:pt-5 space-y-5">
        <div class="p-5 space-y-4 flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <nav class="flex justify-between gap-1 relative after:absolute after:bottom-0 after:inset-x-0" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                <p class="flex flex-col text-lg font-medium text-gray-900 dark:text-neutral-100">
                    Daftar {{ $page_title }}
                    <span class="text-xs font-normal text-gray-500 dark:text-neutral-500">{{ ucfirst($page_title) }} yang terdaftar pada sistem.</span>
                </p>

                <div class="flex justify-end items-center gap-x-2">
                    <a href="{{ route($page.'.create') }}" class="py-1.5 sm:py-2 px-2.5 inline-flex items-center gap-x-1.5 text-sm sm:text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 0 1 7.38 16.75"/><path d="M12 8v8"/><path d="M16 12H8"/><path d="M2.5 8.875a10 10 0 0 0-.5 3"/><path d="M2.83 16a10 10 0 0 0 2.43 3.4"/><path d="M4.636 5.235a10 10 0 0 1 .891-.857"/><path d="M8.644 21.42a10 10 0 0 0 7.631-.38"/></svg>
                        Tambah <span class="hidden sm:block">{{ $page_title }}</span>
                    </a>
                </div>
            </nav>

            <div class="grid md:grid-cols-2 gap-y-2 md:gap-y-0 md:gap-x-5">
                <div>
                    <div class="relative">
                        <div id="search-icon" class="w-full absolute inset-y-0 start-0 flex items-center justify-between pointer-events-none z-20 px-3.5">
                            <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.3-4.3" />
                            </svg>
                        </div>
                        <input id="search" type="text" class="py-1 sm:py-1.5 ps-10 pe-8 block w-full bg-gray-100 border-transparent rounded-lg sm:text-sm focus:bg-white focus:ring-0 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:bg-neutral-800 dark:focus:ring-neutral-600" placeholder="Cari kode atau nama..." autocomplete="off" value="{{ $search ?? '' }}">
                    </div>
                </div>
            </div>

            <div>
                <div class="overflow-x-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                    <div class="min-w-full inline-block align-middle">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead>
                                <tr class="border-t border-gray-200 divide-x divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">
                                    <th scope="col" class="px-3 py-2.5 text-start text-sm text-gray-500 dark:text-neutral-500">Kode</th>
                                    <th scope="col" class="px-5 py-2.5 text-start text-sm text-gray-500 dark:text-neutral-500">Nama</th>
                                    <th scope="col" class="px-5 py-2.5 text-center text-sm text-gray-500 dark:text-neutral-500">Guru</th>
                                    <th scope="col" class="px-5 py-2.5 text-center text-sm text-gray-500 dark:text-neutral-500">Komponen Nilai</th>
                                    <th scope="col" class="px-5 py-2.5"></th>
                                </tr>
                            </thead>

                            <tbody id="data-container" class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse ($data as $item)
                                <tr class="divide-x divide-gray-200 dark:divide-neutral-700">
                                    <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-700 dark:text-neutral-300">{{ $item->kode_mapel }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-neutral-300">{{ $item->nama_mapel }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-700 dark:text-neutral-300">{{ $item->gurus_count }}</td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-700 dark:text-neutral-300">{{ $item->komponen_nilai_harian_count + $item->komponen_nilai_assesmen_count }}</td>
                                    <td class="whitespace-nowrap px-4 py-3 text-sm">
                                        <div class="relative inline-flex">
                                            <a href="{{ route($page.'.setting', [$item->id_mapel]) }}" aria-label="Edit {{ $item->nama_mapel }}" class="size-7 inline-flex justify-center items-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 shadow-2xs hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="{{ $data_colum }}" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-neutral-400">
                                        Tidak ada mata pelajaran.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- Footer -->
                            <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-neutral-300">
                                        <span class="font-semibold text-gray-800 dark:text-neutral-200">{{ $data->total() }}</span> Hasil
                                    </p>
                                </div>

                                <div>
                                    <div class="inline-flex gap-x-2">
                                        @if (!$data->onFirstPage())
                                        <a href="{{ $data->url(1) }}" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 text-gray-800 dark:text-white shadow-2xs hover:bg-gray-50 dark:hover:bg-neutral-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:focus:bg-neutral-700">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-left-icon lucide-chevrons-left"><path d="m11 17-5-5 5-5"/><path d="m18 17-5-5 5-5"/></svg>
                                        </a>
                                        @else
                                        <button type="button" disabled class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 text-gray-800 dark:text-white shadow-2xs hover:bg-gray-50 dark:hover:bg-neutral-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:focus:bg-neutral-700">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-left-icon lucide-chevrons-left"><path d="m11 17-5-5 5-5"/><path d="m18 17-5-5 5-5"/></svg>
                                        </button>
                                        @endif

                                        @if (!$data->onFirstPage())
                                        <a href="{{ $data->previousPageUrl() }}" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 text-gray-800 dark:text-white shadow-2xs hover:bg-gray-50 dark:hover:bg-neutral-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:focus:bg-neutral-700">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                                            <span class="hidden sm:block">Prev</span>
                                        </a>
                                        @else
                                        <button type="button" disabled class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 text-gray-800 dark:text-white shadow-2xs hover:bg-gray-50 dark:hover:bg-neutral-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:focus:bg-neutral-700">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                                            <span class="hidden sm:block">Prev</span>
                                        </button>
                                        @endif

                                        @php
                                            $current = $data->currentPage();
                                            $lastPage = $data->lastPage();
                                            $range = 1;
                                            $start = max($current - $range, 1);
                                            $end = min($current + $range, $lastPage);
                                        @endphp

                                        @for ($i = $start; $i <= $end; $i++)
                                            @if ($i == $current)
                                                <span class="py-1.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-gray-200 text-gray-800 dark:bg-neutral-700 dark:text-white">
                                                    {{ $i }}
                                                </span>
                                            @else
                                                <a href="{{ $data->url($i) }}" class="py-1.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 text-gray-800 dark:text-white shadow-2xs hover:bg-gray-50 dark:hover:bg-neutral-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:focus:bg-neutral-700">
                                                    {{ $i }}
                                                </a>
                                            @endif
                                        @endfor

                                        @if ($data->hasMorePages())   
                                        <a href="{{ $data->nextPageUrl() }}" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 text-gray-800 dark:text-white shadow-2xs hover:bg-gray-50 dark:hover:bg-neutral-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:focus:bg-neutral-700">
                                            <span class="hidden sm:block">Next</span>
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                        </a>
                                        @else
                                        <button type="button" disabled class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 text-gray-800 dark:text-white shadow-2xs hover:bg-gray-50 dark:hover:bg-neutral-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:focus:bg-neutral-700">
                                            <span class="hidden sm:block">Next</span>
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                        </button>
                                        @endif

                                        @if ($data->hasMorePages())
                                        <a href="{{ $data->url($lastPage) }}" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 text-gray-800 dark:text-white shadow-2xs hover:bg-gray-50 dark:hover:bg-neutral-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:focus:bg-neutral-700">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-right-icon lucide-chevrons-right"><path d="m6 17 5-5-5-5"/><path d="m13 17 5-5-5-5"/></svg>
                                        </a>
                                        @else
                                        <button type="button" disabled class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 text-gray-800 dark:text-white shadow-2xs hover:bg-gray-50 dark:hover:bg-neutral-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:focus:bg-neutral-700">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-right-icon lucide-chevrons-right"><path d="m6 17 5-5-5-5"/><path d="m13 17 5-5-5-5"/></svg>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- End Footer -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>

<script>
    let debounceTimer = null;
    const searchInput = document.getElementById('search');
    searchInput.addEventListener('input', (e) => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            window.location.href = "{{ route('mapel') }}?search=" + encodeURIComponent(e.target.value);
        }, 600);
    });
</script>
