@php
    $page = 'admin';
    $page_variable = 'admin';
    $page_title = 'Admin';
    $action_param = $data->id_admin;
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
                <form action="{{ route($page.'.update.action', $action_param) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="py-2 sm:py-4 px-2">
                        <div class="p-4 space-y-5">
                            <!-- Nama -->
                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                                        Nama
                                    </label>
                                </div>
                                <!-- End Col -->

                                <div class="sm:col-span-9">
                                    <input type="text" name="nama" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600 @error('nama') border-red-500 ring-red-500 @enderror"
                                    placeholder="Masukkan nama {{ $page_title }}" value="{{ old('nama', $data->nama) }}" autocomplete="off" required>
                                    @error('nama')
                                      <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
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
                                    <input type="text" name="username" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600 @error('username') border-red-500 ring-red-500 @enderror"
                                    placeholder="Masukkan username {{ $page_title }}" value="{{ old('username', $data->username) }}" autocomplete="off" required>
                                    @error('username')
                                      <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Grid -->

                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="p-6 pt-0 flex justify-end gap-x-2">
                        <div class="w-full flex justify-end items-center gap-x-2">
                            <a href="{{ route($page.'.index') }}" class="py-2 px-3 inline-flex justify-center items-center text-start text-xs bg-white border border-gray-200 text-gray-800 text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                Kembali
                            </a>

                            <button type="submit" class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-start text-xs bg-blue-600 border border-blue-600 text-white text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:ring-1 focus:ring-blue-300 dark:focus:ring-blue-500">
                                Perbarui
                            </button>
                        </div>
                    </div>
                    <!-- End Footer -->
                </form>
            </div>
            <!-- End Card -->

            <!-- Card Delete -->
            <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="p-6 w-full flex justify-between">
                    <div class="w-full text-sm">
                        <p class="font-semibold text-gray-800 dark:text-neutral-200">Hapus data</p>
                        <p class="text-xs text-gray-500 dark:text-neutral-500">Menghapus permanen data {{ $page_title }}</p>
                    </div>
                    <div>
                        <button type="button" class="py-2 px-3 inline-flex justify-center items-center text-start text-xs bg-white border border-gray-200 text-red-700 text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-red-600 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-scale-confirm-modal" data-hs-overlay="#hs-scale-confirm-modal">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Card Delete -->

        </div>
        <!-- End Card Form -->
    </div>
</x-app>

<!-- Confirm Modal -->
<div id="hs-scale-confirm-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-confirm-modal-label">
    <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
        <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="p-7">
                <div class="flex justify-between items-center">
                    <h3 id="hs-scale-confirm-modal-label" class="font-bold text-gray-800 dark:text-white">
                        Hapus {{ $page_title }}?
                    </h3>
                </div>
                <div class="pb-3 overflow-y-auto">
                    <p class="mt-1 text-gray-800 dark:text-neutral-400">
                        Yakin ingin menghapus data {{ $page_title }} ini secara permanen? Mungkin akan memengaruhi data lainnya. Aksi ini tidak dapat dikembalikan.
                    </p>
                </div>
                <div class="flex justify-end items-center gap-x-2">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-scale-confirm-modal">
                        Kembali
                    </button>
                    <form method="POST" action="{{ route($page.'.delete.action', $action_param) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Confirm Modal -->
                <!-- Basic Information Form -->
                <form action="{{ route($page.'.setting.update', $data->id_admin) }}" method="POST" class="space-y-6 pb-6 border-b border-gray-200 dark:border-neutral-700">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-neutral-100">Informasi Dasar</h3>

                        <!-- Nama Field -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                Nama <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama', $data->nama) }}" placeholder="Masukkan nama {{ $page_title }}" class="py-2 px-3 block w-full bg-gray-100 border-transparent rounded-lg sm:text-sm focus:bg-white focus:ring-0 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:bg-neutral-800 dark:focus:ring-neutral-600 @error('nama') !border-red-500 !ring-red-500 @enderror" required>
                            @error('nama')
                                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End Nama Field -->

                        <!-- Username Field -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                Username <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="username" name="username" value="{{ old('username', $data->username) }}" placeholder="Masukkan username {{ $page_title }}" class="py-2 px-3 block w-full bg-gray-100 border-transparent rounded-lg sm:text-sm focus:bg-white focus:ring-0 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:bg-neutral-800 dark:focus:ring-neutral-600 @error('username') !border-red-500 !ring-red-500 @enderror" required>
                            @error('username')
                                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End Username Field -->
                    </div>

                    <!-- Form Actions -->
                    <div class="flex gap-x-3 pt-2">
                        <button type="submit" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-blue-700">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            Simpan Perubahan
                        </button>
                    </div>
                    <!-- End Form Actions -->
                </form>
                <div>
                    <!-- Accordion Button -->
                    <button type="button" class="w-full flex items-center justify-between py-4 px-4 bg-gray-50 dark:bg-neutral-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-700 transition-colors group" data-hs-collapse="#password-section" aria-controls="password-section" aria-expanded="false">
                        <div class="flex items-center gap-x-3">
                            <svg class="shrink-0 size-5 text-gray-500 group-hover:text-gray-700 dark:text-neutral-400 dark:group-hover:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 0 0-9.95 9m19.9 0a10 10 0 0 0-19.9 0"/><path d="M8.5 12a3.5 3.5 0 1 1 7 0"/><path d="M12 9v6"/></svg>
                            <span class="text-sm font-medium text-gray-800 dark:text-neutral-100">Ubah Password</span>
                        </div>
                        <svg class="shrink-0 size-5 text-gray-500 transition-transform group-[.hs-collapse-open]:rotate-180 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <!-- End Accordion Button -->

                    <!-- Accordion Content -->
                    <div id="password-section" class="hs-collapse hidden w-full overflow-hidden transition-[height] duration-300">
                        <form action="{{ route($page.'.setting.update.password', $data->id_admin) }}" method="POST" class="mt-4 p-4 bg-gray-50 dark:bg-neutral-700/50 rounded-lg space-y-4">
                            @csrf
                            @method('PUT')

                            <!-- Current Password Field -->
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Password Saat Ini <span class="text-red-500">*</span>
                                </label>
                                <input type="password" id="current_password" name="current_password" placeholder="Masukkan password saat ini" class="py-2 px-3 block w-full bg-white border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 @error('current_password') !border-red-500 !ring-red-500 @enderror" required>
                                @error('current_password')
                                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- End Current Password Field -->

                            <!-- New Password Field -->
                            <div>
                                <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Password Baru <span class="text-red-500">*</span>
                                </label>
                                <input type="password" id="new_password" name="new_password" placeholder="Masukkan password baru" class="py-2 px-3 block w-full bg-white border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 @error('new_password') !border-red-500 !ring-red-500 @enderror" required>
                                @error('new_password')
                                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-gray-500 dark:text-neutral-400 mt-1">Minimal 6 karakter</p>
                            </div>
                            <!-- End New Password Field -->

                            <!-- Confirm New Password Field -->
                            <div>
                                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Konfirmasi Password Baru <span class="text-red-500">*</span>
                                </label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="Konfirmasi password baru" class="py-2 px-3 block w-full bg-white border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" required>
                            </div>
                            <!-- End Confirm New Password Field -->

                            <!-- Form Actions -->
                            <div class="flex gap-x-3 pt-2">
                                <button type="submit" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-blue-700">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2m0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8m3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5m-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11m3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5"/></svg>
                                    Ubah Password
                                </button>
                            </div>
                            <!-- End Form Actions -->
                        </form>
                    </div>
                    <!-- End Accordion Content -->
                </div>
                <!-- End Update Password Form -->
            </div>
            <!-- End Form Content -->
        </div>
        <!-- End Setting Card -->
    </div>
</x-app>

<script>
    // Initialize HSCollapse
    if (typeof HSStaticMethods !== 'undefined') {
        HSStaticMethods.autoInit();
    }
</script>
