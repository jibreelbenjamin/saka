 @php
    $page = 'siswa';
    $page_variable = 'siswa';
    $page_title = 'siswa';
    $action_param = $data->id_siswa;
@endphp
<x-app :page='$page'>
    <div class="p-2 sm:p-5 sm:py-0 md:pt-5 space-y-5">
        <!-- Card Form -->
        <div class="flex flex-col pt-3 gap-y-5 max-w-xl mx-auto">
            <!-- Header -->
            <div class="flex gap-x-3">
                <div class="grow">
                    <h1 class="font-semibold text-xl text-gray-800 dark:text-neutral-200">
                        Pengaturan {{ $page_title }}
                    </h1>

                    <p class="text-sm text-gray-500 dark:text-neutral-500">
                        Halaman akses pengaturan {{ $page_title }}
                    </p>
                </div>
            </div>
            <!-- End Header -->

            <!-- Card -->
            <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <form action="{{ route($page.'.update.action', $action_param) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="py-2 sm:py-4 px-2">
                        <div class="p-4 space-y-5">
                            <!-- Grid -->
                            <!-- Kelas -->
                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                                        Kelas
                                    </label>
                                </div>
                                <!-- End Col -->

                                <div class="sm:col-span-9">
                                    <select data-hs-select='{
                                        "hasSearch": true,
                                        "searchPlaceholder": "Search...",
                                        "searchClasses": "block w-full sm:text-sm bg-transparent border-gray-200 dark:border-neutral-700 rounded-lg text-gray-800 dark:text-neutral-200 placeholder:text-gray-500 dark:placeholder:text-neutral-400 focus:border-blue-700 dark:focus:border-blue-600 focus:ring-blue-700 dark:focus:ring-blue-600 before:absolute before:inset-0 before:z-1 py-1.5 sm:py-2 px-3",
                                        "searchWrapperClasses": "bg-white dark:bg-neutral-900 p-2 -mx-1 sticky top-0",
                                        "placeholder": "Pilih Kelas...",
                                        "scrollToSelected": true,
                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200\" data-title></span></button>",
                                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 text-gray-800 dark:text-white rounded-lg text-start text-sm hover:bg-gray-50 dark:hover:bg-neutral-700 focus:outline-hidden focus:bg-gray-50 dark:focus:bg-neutral-700",
                                        "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white dark:bg-neutral-900 border border-transparent rounded-lg shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-none [&::-webkit-scrollbar-track]:bg-gray-100 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500",
                                        "optionClasses": "hs-selected:bg-gray-100 dark:hs-selected:bg-neutral-800 py-2 px-4 w-full text-sm text-gray-800 dark:text-neutral-200 cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-800 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:focus:bg-neutral-800",
                                        "optionTemplate": "<div class=\"flex items-center\"><div><div class=\"hs-selected:font-semibold text-sm text-gray-800 dark:text-neutral-200\" data-title></div><div class=\"text-xs text-gray-500 dark:text-neutral-400\" data-description></div></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-4 text-blue-600 dark:text-blue-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>",
                                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-400\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                    }' name="id_kelas" class="hidden">
                                    <option value="" disabled {{ old('id_kelas') || $data->id_kelas ? '' : 'selected' }}>Pilih Kelas</option>
                                    @foreach ($kelas as $item)
                                    <option value="{{ $item->id_kelas }}" {{ (old('id_kelas') ?? $data->id_kelas) == $item->id_kelas ? 'selected' : '' }} data-hs-select-option='{
                                        "title": "{{ addslashes($item->nama_kelas) }}",
                                        "description": "{{ addslashes($item->kode_kelas) }}"
                                        }'>
                                        {{ $item->nama_kelas }}
                                    </option>
                                    @endforeach
                                    </select>
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Grid -->

                            <!-- Username -->
                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                                        Username
                                    </label>
                                </div>
                                <!-- End Col -->

                                <div class="sm:col-span-9">
                                    <input type="text" name="username" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600"
                                    placeholder="Masukkan username" value="{{ $data->username }}" autocomplete="off" required>
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Grid -->

                            <!-- Nama -->
                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                                        Nama
                                    </label>
                                </div>
                                <!-- End Col -->

                                <div class="sm:col-span-9">
                                    <input type="text" name="nama" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600"
                                    placeholder="Masukkan nama lengkap" value="{{ $data->nama }}" autocomplete="off" required>
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Grid -->

                            <!-- Kontak -->
                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                                        Kontak
                                    </label>
                                </div>
                                <!-- End Col -->

                                <div class="sm:col-span-9">
                                    <input type="text" name="kontak" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600"
                                    placeholder="Masukkan nomor kontak" value="{{ $data->kontak }}" autocomplete="off">
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Grid -->

                            <!-- Alamat -->
                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                                        Alamat
                                    </label>
                                </div>
                                <!-- End Col -->

                                <div class="sm:col-span-9">
                                    <textarea name="alamat" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Masukkan alamat lengkap" rows="3" autocomplete="off">{{ $data->alamat }}</textarea>
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Grid -->


                            <!-- Footer -->
                    <div class="p-0 pt-0 flex justify-end gap-x-2">
                        <div class="w-full flex justify-end items-center gap-x-2">
                            <a href="{{ route($page) }}" class="py-2 px-3 inline-flex justify-center items-center text-start text-xs bg-white border border-gray-200 text-gray-800 text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                Kembali
                            </a>

                            <button type="submit" class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-start text-xs bg-blue-600 border border-blue-600 text-white text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:ring-1 focus:ring-blue-300 dark:focus:ring-blue-500">
                                Perbarui
                            </button>
                        </div>
                    </div>
                    <!-- End Footer -->
                        </div>
                    </div>
                    
                </form>
            </div>
            <!-- End Card -->

             <!-- Card -->
            <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <form action="{{ route($page.'.update.action', $action_param) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="py-2 sm:py-4 px-2">
                        <div class="p-4 space-y-5">
                            <!-- Grid -->
                            <!-- Password -->
                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                                        Password baru
                                    </label>
                                </div>
                                <!-- End Col -->

                               <div class="sm:col-span-9 relative">
                    <input id="hs-toggle-password" type="password" name="password" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600"
                    placeholder="Masukan password baru" autocomplete="off">
                    <button type="button" data-hs-toggle-password='{
                        "target": "#hs-toggle-password"
                      }' class="absolute inset-y-0 end-0 flex items-center z-20 px-4 cursor-pointer text-gray-400 rounded-e-md focus:outline-hidden focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500">
                      <svg class="shrink-0 size-3.5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                        <path class="hs-password-active:hidden" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                        <path class="hs-password-active:hidden" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                        <line class="hs-password-active:hidden" x1="2" x2="22" y1="2" y2="22"></line>
                        <path class="hidden hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                        <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3"></circle>
                      </svg>
                    </button>
                  </div>

                                <!-- End Col -->
                            </div>
                            <!-- End Grid -->

                             <!-- Confrim Password -->
                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                                        Konfirmasi
                                    </label>
                                </div>
                                <!-- End Col -->

                                <div class="sm:col-span-9 relative">
                    <input id="hs-toggle-password-confirm" type="password" name="password_confirmation" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600"
                    placeholder="Masukan konfirmasi password baru" autocomplete="off">
                    <button type="button" data-hs-toggle-password='{
                        "target": "#hs-toggle-password-confirm"
                      }' class="absolute inset-y-0 end-0 flex items-center z-20 px-4 cursor-pointer text-gray-400 rounded-e-md focus:outline-hidden focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500">
                      <svg class="shrink-0 size-3.5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                        <path class="hs-password-active:hidden" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                        <path class="hs-password-active:hidden" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                        <line class="hs-password-active:hidden" x1="2" x2="22" y1="2" y2="22"></line>
                        <path class="hidden hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                        <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3"></circle>
                      </svg>
                    </button>
                  </div>

                                <!-- End Col -->
                            </div>
                            <!-- End Grid -->


                        </div>
                    </div>
                    

                    <!-- Footer -->
                    <div class="p-6 pt-0 flex justify-end gap-x-2">
                        <div class="w-full flex justify-end items-center gap-x-2">
                            <button type="submit" class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-start text-xs bg-blue-600 border border-blue-600 text-white text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:ring-1 focus:ring-blue-300 dark:focus:ring-blue-500">
                                Perbarui Password
                            </button>
                        </div>
                    </div>
                    <!-- End Footer -->
                </form>
            </div>
            <!-- End Card -->

            <!-- Card -->
            <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="p-6 w-full flex justify-between">
                    <div class="w-full text-sm">
                        <p class="font-semibold text-gray-800 dark:text-neutral-200">Hapus data</p>
                        <p class="text-xs text-gray-500 dark:text-neutral-500">Menghapus permanen data {{ $page_title }}</p>
                    </div>
                    <div>
                        <button class="py-2 px-3 inline-flex justify-center items-center text-start text-xs bg-white border border-gray-200 text-red-700 text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-red-600 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-scale-confirm-modal" data-hs-overlay="#hs-scale-confirm-modal">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Card -->

        </div>
        <!-- End Card Form -->
    </div>
</x-app>

<!-- Confirm Modal -->
<div id="hs-scale-confirm-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-confirm-modal-label">
    <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
        <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="p-7">
                <div class="flex justify-between items-center  ">
                    <h3 id="hs-scale-confirm-modal-label" class="font-bold text-gray-800 dark:text-white">
                    Hapus {{ $page_title }}?
                    </h3>
                </div>
                <div class="pb-3 overflow-y-auto">
                    <p class="mt-1 text-gray-800 dark:text-neutral-400">
                    Yakin ingin menghapus data {{ $page_title }} ini secara permanen? Mungkin akan memengaruhi data lainnya. Aksi ini tidak dapat dikembalikan.
                    </p>
                </div>
                <div class="flex justify-end items-center gap-x-2  ">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-scale-confirm-modal">
                    Kembali
                    </button>
                    <form method="post" action="{{ route($page.'.delete.action', $action_param) }}">
                        @csrf
                        @method('DELETE')
                        <button class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                        Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Confirm Modal -->
