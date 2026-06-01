@php
    $page = 'data-nilai';
    $page_variable = 'data-nilai';
    $page_title = 'data nilai';
@endphp
<x-app :page='$page'>
    <div class="p-2 sm:p-5 sm:py-0 md:pt-5 space-y-5">
        <!-- Table Card -->
        <div class="p-5 space-y-4 flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <!-- Nav Tab -->
            <nav class="flex justify-between gap-1 relative after:absolute after:bottom-0 after:inset-x-0" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                <p class="flex flex-col text-lg font-medium text-gray-900 dark:text-neutral-100">
                    <span>
                        <span class="font-mono">{{ $data['mapel']['kode_mapel'] }}</span> -
                        <span>{{ $data['mapel']['nama_mapel'] }} </span> 
                    </span> 
                    <span class="text-xs font-normal text-gray-500 dark:text-neutral-500">{{ $data['kelas']['nama_kelas'] }} - {{ count($data['siswa']) }} Siswa</span>
                </p>

                <div class="flex justify-end items-center gap-x-2">
                    <!-- Print Dropdown -->
                    <div class="hs-dropdown [--auto-close:inside] [--placement:bottom-right] relative inline-flex">
                        <button id="hs-pro-dbrrtchdd" class="py-1.5 sm:py-2 px-2.5 inline-flex items-center gap-x-1.5 text-sm sm:text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-output-icon lucide-folder-output"><path d="M2 7.5V5a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2a2 2 0 0 0 1.67.9H20a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-1.5"/><path d="M2 13h10"/><path d="m5 10-3 3 3 3"/></svg>
                            <span class="hidden xl:block">Export nilai</span>
                        </button>
        
                        <!-- Print Dropdown -->
                        <div class="hs-dropdown-menu hs-dropdown-open:opacity-100 w-60 transition-[opacity,margin] duration opacity-0 hidden z-20 bg-white rounded-xl shadow-xl dark:bg-neutral-900" role="menu" aria-orientation="vertical" aria-labelledby="hs-pro-dbrrtchdd">
                            <div class="p-3">
                                <div>
                                    <span class="block font-semibold text-gray-800 dark:text-neutral-200">
                                        Export nilai
                                    </span>
                                    <span class="block text-xs text-gray-500 dark:text-neutral-500">
                                        Nilai akan export dengan format <strong>.xlxs</strong>
                                    </span>
                                </div>
            
                                <a id="cetak" href="#" class="w-full mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:ring-2 focus:ring-blue-500">
                                    Export
                                </a>
                            </div>
                        </div>
                        <!-- End Print Dropdown -->
                    </div>
                    <!-- End Print Dropdown -->
                    <a href="#" class="py-1.5 sm:py-2 px-2.5 inline-flex items-center gap-x-1.5 text-sm sm:text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-combine-icon lucide-combine"><path d="M14 3a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1"/><path d="M19 3a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1"/><path d="m7 15 3 3"/><path d="m7 21 3-3H5a2 2 0 0 1-2-2v-2"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="3" width="7" height="7" rx="1"/></svg>
                        <span class="hidden xl:block">Akumulasi simpanan</span>
                    </a>
                    <a href="#{{ $data['pengaturan_nilai_akhir']['id_pengaturan_nilai_akhir'] ?? null }}" class="py-1.5 sm:py-2 px-2.5 inline-flex items-center gap-x-1.5 text-sm sm:text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sigma-icon lucide-sigma"><path d="M18 7V5a1 1 0 0 0-1-1H6.5a.5.5 0 0 0-.4.8l4.5 6a2 2 0 0 1 0 2.4l-4.5 6a.5.5 0 0 0 .4.8H17a1 1 0 0 0 1-1v-2"/></svg>
                        <span class="hidden xl:block">Akumulasi nilai akhir</span>
                    </a>
                    <a href="#" class="py-1.5 sm:py-2 px-2.5 inline-flex items-center gap-x-1.5 text-sm sm:text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        <svg class="shrink-0 size-3.5" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.0324 1.91994H9.45071C9.09999 1.91994 8.76367 2.05926 8.51567 2.30725C8.26767 2.55523 8.12839 2.89158 8.12839 3.24228V8.86395L20.0324 15.8079L25.9844 18.3197L31.9364 15.8079V8.86395L20.0324 1.91994Z" fill="#21A366"></path>
                            <path d="M8.12839 8.86395H20.0324V15.8079H8.12839V8.86395Z" fill="#107C41"></path>
                            <path d="M30.614 1.91994H20.0324V8.86395H31.9364V3.24228C31.9364 2.89158 31.7971 2.55523 31.5491 2.30725C31.3011 2.05926 30.9647 1.91994 30.614 1.91994Z" fill="#33C481"></path>
                            <path d="M20.0324 15.8079H8.12839V28.3736C8.12839 28.7243 8.26767 29.0607 8.51567 29.3087C8.76367 29.5567 9.09999 29.6959 9.45071 29.6959H30.6141C30.9647 29.6959 31.3011 29.5567 31.549 29.3087C31.797 29.0607 31.9364 28.7243 31.9364 28.3736V22.7519L20.0324 15.8079Z" fill="#185C37"></path>
                            <path d="M20.0324 15.8079H31.9364V22.7519H20.0324V15.8079Z" fill="#107C41"></path>
                            <path opacity="0.1" d="M16.7261 6.87994H8.12839V25.7279H16.7261C17.0764 25.7269 17.4121 25.5872 17.6599 25.3395C17.9077 25.0917 18.0473 24.756 18.0484 24.4056V8.20226C18.0473 7.8519 17.9077 7.51616 17.6599 7.2684C17.4121 7.02064 17.0764 6.88099 16.7261 6.87994Z" class="og88b dark:fill-neutral-200" fill="currentColor"></path>
                            <path opacity="0.2" d="M15.7341 7.87194H8.12839V26.7199H15.7341C16.0844 26.7189 16.4201 26.5792 16.6679 26.3315C16.9157 26.0837 17.0553 25.748 17.0564 25.3976V9.19426C17.0553 8.84386 16.9157 8.50818 16.6679 8.26042C16.4201 8.01266 16.0844 7.87299 15.7341 7.87194Z" class="og88b dark:fill-neutral-200" fill="currentColor"></path>
                            <path opacity="0.2" d="M15.7341 7.87194H8.12839V24.7359H15.7341C16.0844 24.7349 16.4201 24.5952 16.6679 24.3475C16.9157 24.0997 17.0553 23.764 17.0564 23.4136V9.19426C17.0553 8.84386 16.9157 8.50818 16.6679 8.26042C16.4201 8.01266 16.0844 7.87299 15.7341 7.87194Z" class="og88b dark:fill-neutral-200" fill="currentColor"></path>
                            <path opacity="0.2" d="M14.7421 7.87194H8.12839V24.7359H14.7421C15.0924 24.7349 15.4281 24.5952 15.6759 24.3475C15.9237 24.0997 16.0633 23.764 16.0644 23.4136V9.19426C16.0633 8.84386 15.9237 8.50818 15.6759 8.26042C15.4281 8.01266 15.0924 7.87299 14.7421 7.87194Z" class="og88b dark:fill-neutral-200" fill="currentColor"></path>
                            <path d="M1.51472 7.87194H14.7421C15.0927 7.87194 15.4291 8.01122 15.6771 8.25922C15.925 8.50722 16.0644 8.84354 16.0644 9.19426V22.4216C16.0644 22.7723 15.925 23.1087 15.6771 23.3567C15.4291 23.6047 15.0927 23.7439 14.7421 23.7439H1.51472C1.16402 23.7439 0.827672 23.6047 0.579686 23.3567C0.3317 23.1087 0.192383 22.7723 0.192383 22.4216V9.19426C0.192383 8.84354 0.3317 8.50722 0.579686 8.25922C0.827672 8.01122 1.16402 7.87194 1.51472 7.87194Z" fill="#107C41"></path>
                            <path d="M3.69711 20.7679L6.90722 15.794L3.96694 10.8479H6.33286L7.93791 14.0095C8.08536 14.3091 8.18688 14.5326 8.24248 14.68H8.26328C8.36912 14.4407 8.47984 14.2079 8.5956 13.9817L10.3108 10.8479H12.4822L9.46656 15.7663L12.5586 20.7679H10.2473L8.3932 17.2959C8.30592 17.148 8.23184 16.9927 8.172 16.8317H8.14424C8.09016 16.9891 8.01824 17.1399 7.92998 17.2811L6.02236 20.7679H3.69711Z" fill="white"></path>
                        </svg>
                        <span class="hidden xl:block">Import nilai</span>
                    </a>
                </div>
            </nav>
            <!-- End Nav Tab -->

            <!-- Datatable -->
            <div>
                <!-- Tab Content -->
                <div>
                    <!-- Table Section -->
                    <div class="max-h-170 overflow-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                        <div class="min-w-full inline-block align-middle">
                            <!-- Table -->
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead class="sticky top-0 z-2 bg-white dark:bg-neutral-800">
                                    <tr class="border-t border-gray-200 divide-x divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">
                                    <th rowspan="2" scope="col" class="sticky left-0 bg-white dark:bg-neutral-800 px-3 py-2.5 text-start min-w-100">
                                        <p class="py-2.5 text-start flex justify-center items-center gap-x-1 text-sm text-nowrap font-normal text-gray-90 dark:text-neutral-100">
                                            Siswa
                                        </p>
                                    </th>

                                    <th colspan="{{ count($data['komponen_nilai_harian'] ?? []) }}" scope="col" class="bg-amber-500/10">
                                        <p class="px-5 py-1 text-sm text-nowrap font-semibold text-gray-90 dark:text-neutral-100">
                                            Nilai Harian
                                        </p>
                                    </th>

                                    <th rowspan="2" scope="col" class="bg-amber-500/10 px-3 py-2.5 text-start">
                                        <p class="py-2.5 text-start flex items-center gap-x-1 text-sm font-normal text-gray-90 dark:text-neutral-100">
                                            Rerata harian
                                        </p>
                                    </th>

                                    <th colspan="{{ count($data['komponen_nilai_assesmen'] ?? []) }}" scope="col" class="bg-blue-500/10">
                                        <p class="px-5 py-1 text-start flex items-center justify-center gap-x-1 text-sm text-nowrap font-semibold text-gray-900 dark:text-neutral-100">
                                            Nilai Assesmen
                                        </p>
                                    </th>

                                    <th rowspan="2" scope="col" class="bg-blue-500/10 px-3 py-2.5 text-start">
                                        <p class="py-2.5 text-start flex items-center gap-x-1 text-sm font-normal text-gray-90 dark:text-neutral-100">
                                            Rerata assesmen
                                        </p>
                                    </th>


                                    <th rowspan="2" scope="col" class="bg-purple-500/10 px-3 py-2.5 text-start">
                                        <p class="py-2.5 text-start flex items-center gap-x-1 text-sm font-normal text-gray-90 dark:text-neutral-100">
                                            Nilai simpanan
                                        </p>
                                    </th>

                                    <th rowspan="2" scope="col" class="bg-green-500/10 px-3 py-2.5 text-start">
                                        <p class="py-2.5 text-start flex items-center gap-x-1 text-sm font-normal text-gray-90 dark:text-neutral-100">
                                            Nilai akhir
                                        </p>
                                    </th>
                                    </tr>
                                    
                                    <tr class="border-t border-gray-200 divide-x divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">

                                    @foreach ($data['komponen_nilai_harian'] as $item)
                                    <th scope="col" class="bg-amber-500/10">
                                        <div class="bpy-2 flex items-start px-3 gap-x-1">
                                            <a href="#{{ $item['id_komponen'] }}" class="p-1 inline-flex items-center gap-x-1.5 text-sm sm:text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings-icon lucide-settings"><path d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915"/><circle cx="12" cy="12" r="3"/></svg>
                                            </a>
                                            <div>
                                                <p class="text-start flex items-center gap-x-1 text-sm text-nowrap font-normal text-gray-900 dark:text-neutral-100">
                                                    {{ $item['nama_komponen'] }} ({{ $item['kkm'] }})
                                                </p>
                                                <p class="text-xs text-start flex items-center gap-x-1 text-nowrap font-normal text-gray-500 dark:text-neutral-500">
                                                    {{ $item['kode_komponen'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </th>
                                    @endforeach

                                    @foreach ($data['komponen_nilai_assesmen'] as $item)
                                    <th scope="col" class="bg-blue-500/10">
                                        <div class="py-2 flex items-start px-3 gap-x-1">
                                            <a href="#{{ $item['id_komponen'] }}" class="p-1 inline-flex items-center gap-x-1.5 text-sm sm:text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings-icon lucide-settings"><path d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915"/><circle cx="12" cy="12" r="3"/></svg>
                                            </a>
                                            <div>
                                                <p class="text-start flex items-center gap-x-1 text-sm text-nowrap font-normal text-gray-900 dark:text-neutral-100">
                                                    {{ $item['nama_komponen'] }} ({{ $item['kkm'] }})
                                                </p>
                                                <p class="text-sm text-start flex items-center gap-x-1 text-nowrap font-normal text-gray-500 dark:text-neutral-500">
                                                    {{ $item['kode_komponen'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </th>
                                    @endforeach

                                    </tr>

                                </thead>

                                <tbody id="data-container" class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @forelse ($data['siswa'] as $item)
                                    <tr class="group divide-x divide-gray-200 dark:divide-neutral-700">
                                        <td class="sticky left-0 bg-white dark:bg-neutral-800 size-px px-4 py-1 group-hover:bg-gray-100 group-hover:dark:bg-neutral-900">
                                            <div class="py-1 w-full flex items-start gap-x-2">
                                                 <a href="#{{ $item['id_siswa'] }}" class="p-1 inline-flex items-center gap-x-1.5 text-sm sm:text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-cog-icon lucide-user-cog"><path d="M10 15H6a4 4 0 0 0-4 4v2"/><path d="m14.305 16.53.923-.382"/><path d="m15.228 13.852-.923-.383"/><path d="m16.852 12.228-.383-.923"/><path d="m16.852 17.772-.383.924"/><path d="m19.148 12.228.383-.923"/><path d="m19.53 18.696-.382-.924"/><path d="m20.772 13.852.924-.383"/><path d="m20.772 16.148.924.383"/><circle cx="18" cy="15" r="3"/><circle cx="9" cy="7" r="4"/></svg>
                                                </a>
                                                <div class="flex flex-col grow">
                                                    <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                    {{ $loop->iteration }}. {{ $item['nama_siswa'] }}
                                                    </span>
                                                    <span class="text-xs font-normal text-gray-500 dark:text-neutral-500">
                                                    {{ $item['username'] }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>


                                        @forelse ($item['nilai_harian'] as $nilai)                    
                                        <td scope="col" class="bg-amber-500/5 group-hover:bg-amber-500/10">
                                            <div class="py-2 flex justify-center items-center px-3 gap-x-1.5">
                                                @if ($nilai['id_nilai'])
                                                <a href="#{{ $nilai['id_nilai'] }}" class="p-1 inline-flex items-center gap-x-1.5 text-sm sm:text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil-icon lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                                                </a>
                                                <div>
                                                    <p class="text-sm text-start flex items-center gap-x-1 text-nowrap font-normal {{ $nilai['nilai'] < $nilai['kkm'] ? 'text-red-600 dark:text-red-500' : 'text-gray-600 dark:text-neutral-400' }}">
                                                        {{ $nilai['nilai'] }}
                                                    </p>
                                                </div>
                                                @else
                                                <a href="#createNilai" class="p-1 inline-flex items-center gap-x-1.5 text-sm sm:text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                        @empty
                                        <td class="bg-amber-500/5 size-px px-3 py-3 group-hover:bg-amber-500/10">
                                            <span class="flex justify-center items-center gap-x-1.5 text-sm text-gray-600 dark:text-neutral-400">
                                            Tidak ada komponen
                                            </span>
                                        </td>
                                        @endforelse
                                        <td scope="col" class="bg-amber-500/10 group-hover:bg-amber-500/20">
                                            <div class="py-2 flex justify-center items-center px-3 gap-x-1.5">
                                                <div>
                                                    <p class="text-sm text-start flex items-center gap-x-1 text-nowrap font-semibold text-gray-600 dark:text-neutral-400">
                                                        {{ $item['rata_nilai_harian'] ?? '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>


                                        @forelse ($item['nilai_assesmen'] as $nilai)                    
                                        <td scope="col" class="bg-blue-500/5 group-hover:bg-blue-500/10">
                                            <div class="py-2 flex justify-center items-center px-3 gap-x-1.5">
                                                @if ($nilai['id_nilai'])
                                                <a href="#{{ $nilai['id_nilai'] }}" class="p-1 inline-flex items-center gap-x-1.5 text-sm sm:text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil-icon lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                                                </a>
                                                <div>
                                                    <p class="text-sm text-start flex items-center gap-x-1 text-nowrap font-normal {{ $nilai['nilai'] < $nilai['kkm'] ? 'text-red-600 dark:text-red-500' : 'text-gray-600 dark:text-neutral-400' }}">
                                                        {{ $nilai['nilai'] }}
                                                    </p>
                                                </div>
                                                @else
                                                <a href="#createNilai" class="p-1 inline-flex items-center gap-x-1.5 text-sm sm:text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                        @empty
                                        <td class="bg-blue-500/5 size-px px-3 py-3 group-hover:bg-blue-500/10">
                                            <span class="flex justify-center items-center gap-x-1.5 text-sm text-gray-600 dark:text-neutral-400">
                                            Tidak ada komponen
                                            </span>
                                        </td>
                                        @endforelse
                                        <td scope="col" class="bg-blue-500/10 group-hover:bg-blue-500/20">
                                            <div class="py-2 flex justify-center items-center px-3 gap-x-1.5">
                                                <div>
                                                    <p class="text-sm text-start flex items-center gap-x-1 text-nowrap font-semibold text-gray-600 dark:text-neutral-400">
                                                        {{ $item['rata_nilai_assesmen'] ?? '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>


                                        <td scope="col" class="bg-purple-500/10 group-hover:bg-purple-500/20">
                                            <div class="py-2 flex justify-center items-center px-3 gap-x-1.5">
                                                @if ($item['simpanan_nilai'])
                                                <a href="#{{ $item['simpanan_nilai']['id_simpanan_nilai']}}" class="p-1 inline-flex items-center gap-x-1.5 text-sm sm:text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil-icon lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                                                </a>
                                                <div>
                                                    <p class="text-sm text-start flex items-center gap-x-1 text-nowrap font-semibold text-gray-800 dark:text-neutral-200">
                                                       {{ $item['simpanan_nilai']['nilai'] ?? 0 }}
                                                    </p>
                                                </div>
                                                @else
                                                <a href="#createSimpanan" class="p-1 inline-flex items-center gap-x-1.5 text-sm sm:text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                                </a>
                                                @endif
                                            </div>
                                        </td>

                                        
                                        <td scope="col" class="bg-green-500/10 group-hover:bg-blue-500/20">
                                            <div class="py-2 flex justify-center items-center px-3 gap-x-1.5">
                                                <div>
                                                    <p class="text-sm text-start flex items-center gap-x-1 text-nowrap font-semibold  {{ $item['nilai_akhir'] ?? 0 < $data['pengaturan_nilai_akhir']['kkm'] ? 'text-red-600 dark:text-red-500' : 'text-gray-800 dark:text-neutral-200' }}">
                                                        {{ $item['nilai_akhir'] ?? '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        @php
                                            $data_colum = 7;
                                            $data_colum += count($data['komponen_nilai_harian'] ?? []) + count($data['komponen_nilai_assesmen'] ?? []);
                                        @endphp
                                        <td colspan="{{ $data_colum }}">
                                            <!-- Empty State -->
                                            <div class="p-5 min-h-150 flex flex-col justify-center items-center text-center">
                                            <svg class="w-48 mx-auto mb-4" width="178" height="90" viewBox="0 0 178 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="27" y="50.5" width="124" height="39" rx="7.5" fill="currentColor" class="fill-white dark:fill-neutral-800" />
                                                <rect x="27" y="50.5" width="124" height="39" rx="7.5" stroke="currentColor" class="stroke-gray-50 dark:stroke-neutral-700/10" />
                                                <rect x="34.5" y="58" width="24" height="24" rx="4" fill="currentColor" class="fill-gray-50 dark:fill-neutral-700/30" />
                                                <rect x="66.5" y="61" width="60" height="6" rx="3" fill="currentColor" class="fill-gray-50 dark:fill-neutral-700/30" />
                                                <rect x="66.5" y="73" width="77" height="6" rx="3" fill="currentColor" class="fill-gray-50 dark:fill-neutral-700/30" />
                                                <rect x="19.5" y="28.5" width="139" height="39" rx="7.5" fill="currentColor" class="fill-white dark:fill-neutral-800" />
                                                <rect x="19.5" y="28.5" width="139" height="39" rx="7.5" stroke="currentColor" class="stroke-gray-100 dark:stroke-neutral-700/30" />
                                                <rect x="27" y="36" width="24" height="24" rx="4" fill="currentColor" class="fill-gray-100 dark:fill-neutral-700/70" />
                                                <rect x="59" y="39" width="60" height="6" rx="3" fill="currentColor" class="fill-gray-100 dark:fill-neutral-700/70" />
                                                <rect x="59" y="51" width="92" height="6" rx="3" fill="currentColor" class="fill-gray-100 dark:fill-neutral-700/70" />
                                                <g filter="url(#filter3)">
                                                <rect x="12" y="6" width="154" height="40" rx="8" fill="currentColor" class="fill-white dark:fill-neutral-800" shape-rendering="crispEdges" />
                                                <rect x="12.5" y="6.5" width="153" height="39" rx="7.5" stroke="currentColor" class="stroke-gray-100 dark:stroke-neutral-700/60" shape-rendering="crispEdges" />
                                                <rect x="20" y="14" width="24" height="24" rx="4" fill="currentColor" class="fill-gray-200 dark:fill-neutral-700 " />
                                                <rect x="52" y="17" width="60" height="6" rx="3" fill="currentColor" class="fill-gray-200 dark:fill-neutral-700" />
                                                <rect x="52" y="29" width="106" height="6" rx="3" fill="currentColor" class="fill-gray-200 dark:fill-neutral-700" />
                                                </g>
                                                <defs>
                                                <filter id="filter3" x="0" y="0" width="178" height="64" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                                    <feOffset dy="6" />
                                                    <feGaussianBlur stdDeviation="6" />
                                                    <feComposite in2="hardAlpha" operator="out" />
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.03 0" />
                                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1187_14810" />
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1187_14810" result="shape" />
                                                </filter>
                                                </defs>
                                            </svg>

                                            <div class="max-w-sm mx-auto">
                                                <p class="mt-2 font-medium text-gray-800 dark:text-neutral-200">
                                                Belum ada data siswa
                                                </p>
                                                <p class="mb-5 text-sm text-gray-500 dark:text-neutral-500">
                                                Tambahkan siswa baru untuk mulai mengelola.
                                                </p>
                                            </div>
                                            </div>
                                            <!-- End Empty State -->
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- End Table -->
                        </div>
                    </div>
                    <!-- End Table Section -->
                    <!-- Footer -->
                    <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-neutral-300">
                                Pengajar: <span class="font-semibold text-gray-800 dark:text-neutral-200">{{ $data['guru']['nama_guru'] }}</span>
                            </p>
                        </div>
                    </div>
                    <!-- End Footer -->
                </div>
                <!-- End Tab Content -->
            </div>
            <!-- End Datatable -->
        </div>
        <!-- End Table Card -->
    </div>
</x-app>