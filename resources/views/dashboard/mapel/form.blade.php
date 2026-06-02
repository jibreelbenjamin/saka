@php
        $page = 'mapel';
        $page_variable = 'mapel';
        $page_title = 'mata pelajaran';
        $action = 'create';
@endphp

<x-app :page='$page'>
        <div class="p-2 sm:p-5 sm:py-0 md:pt-5 space-y-5">
            <div class="flex flex-col gap-y-5 max-w-xl mx-auto">
                <div class="flex gap-x-3">
                    <div class="grow">
                        <h1 class="font-semibold text-xl text-gray-800 dark:text-neutral-200">Tambah {{ $page_title }}</h1>
                        <p class="text-sm text-gray-500 dark:text-neutral-500">Membuat {{ $page }} baru ke dalam sistem</p>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                    <form action="{{ route($page.'.create.action') }}" method="post">
                        @csrf
                        <div class="py-2 sm:py-4 px-2">
                            <div class="p-4 space-y-5">
                                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                    <div class="sm:col-span-3">
                                        <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">Kode Mapel</label>
                                    </div>
                                    <div class="sm:col-span-9">
                                        <input type="text" name="kode_mapel" value="{{ old('kode_mapel') }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300" placeholder="Masukkan kode mapel" autocomplete="off">
                                        @error('kode_mapel') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                    <div class="sm:col-span-3">
                                        <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">Nama Mapel</label>
                                    </div>
                                    <div class="sm:col-span-9">
                                        <input type="text" name="nama_mapel" value="{{ old('nama_mapel') }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300" placeholder="Masukkan nama mapel" autocomplete="off">
                                        @error('nama_mapel') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 pt-0 flex justify-end gap-x-2">
                            <div class="w-full flex justify-end items-center gap-x-2">
                                <a href="{{ route($page) }}" class="py-2 px-3 inline-flex justify-center items-center text-start text-xs bg-white border border-gray-200 text-gray-800 text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">Kembali</a>

                                <button type="submit" class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-start text-xs bg-blue-600 border border-blue-600 text-white text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-blue-700">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-app>
