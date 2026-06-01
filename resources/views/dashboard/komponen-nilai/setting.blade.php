@php
    $page = 'komponen-nilai';
    $page_variable = 'komponen_nilai';
    $page_title = 'komponen nilai';
    $action_param = $data->{$typeConfig['primary']};
@endphp
<x-app :page='$page'>
    <div class="p-2 sm:p-5 sm:py-0 md:pt-5 space-y-5">
        <div class="flex flex-col pt-3 gap-y-5 max-w-xl mx-auto">
            <div class="flex gap-x-3">
                <div class="grow">
                    <h1 class="font-semibold text-xl text-gray-800 dark:text-neutral-200">
                        Pengaturan {{ $typeLabel }}
                    </h1>

                    <p class="text-sm text-gray-500 dark:text-neutral-500">
                        Halaman akses pengaturan {{ $typeLabel }}.
                    </p>
                </div>
            </div>

            <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <form action="{{ route($page.'.update.action', [$type, $action_param]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="py-2 sm:py-4 px-2">
                        <div class="p-4 space-y-5">
                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">Tipe</label>
                                </div>
                                <div class="sm:col-span-9">
                                    <input type="text" disabled value="{{ $typeLabel }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm bg-gray-100 dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-300" />
                                </div>
                            </div>

                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">Kode Komponen</label>
                                </div>
                                <div class="sm:col-span-9">
                                    <input type="text" name="kode_komponen" value="{{ old('kode_komponen', $data->{$typeConfig['code']}) }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300" placeholder="Kode komponen" autocomplete="off">
                                    @error('kode_komponen')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">Nama Komponen</label>
                                </div>
                                <div class="sm:col-span-9">
                                    <input type="text" name="nama_komponen" value="{{ old('nama_komponen', $data->nama_komponen) }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300" placeholder="Nama komponen" autocomplete="off">
                                    @error('nama_komponen')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">Mata Pelajaran</label>
                                </div>
                                <div class="sm:col-span-9">
                                    <select data-hs-select='{"hasSearch": true, "searchPlaceholder": "Search...", "searchClasses": "block w-full sm:text-sm bg-transparent border-gray-200 dark:border-neutral-700 rounded-lg text-gray-800 dark:text-neutral-200 placeholder:text-gray-500 dark:placeholder:text-neutral-400 focus:border-blue-700 dark:focus:border-blue-600 focus:ring-blue-700 dark:focus:ring-blue-600 before:absolute before:inset-0 before:z-1 py-1.5 sm:py-2 px-3", "searchWrapperClasses": "bg-white dark:bg-neutral-900 p-2 -mx-1 sticky top-0", "placeholder": "Pilih mata pelajaran...", "scrollToSelected": true, "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200\" data-title></span></button>", "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 ps-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 text-gray-800 dark:text-white rounded-lg text-start text-sm hover:bg-gray-50 dark:hover:bg-neutral-700 focus:outline-hidden focus:bg-gray-50 dark:focus:bg-neutral-700", "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white dark:bg-neutral-900 border border-transparent rounded-lg shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-none [&::-webkit-scrollbar-track]:bg-gray-100 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500", "optionClasses": "hs-selected:bg-gray-100 dark:hs-selected:bg-neutral-800 py-2 px-4 w-full text-sm text-gray-800 dark:text-neutral-200 cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-800 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:focus:bg-neutral-800", "optionTemplate": "<div class=\"flex items-center\"><div><div class=\"hs-selected:font-semibold text-sm text-gray-800 dark:text-neutral-200\" data-title></div></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-4 text-blue-600 dark:text-blue-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>", "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-400\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"}' name="id_mapel" class="hidden">
                                        <option value="">Pilih mata pelajaran</option>
                                        @foreach ($mapels as $mapel)
                                            <option value="{{ $mapel->id_mapel }}" {{ old('id_mapel', $data->id_mapel) == $mapel->id_mapel ? 'selected' : '' }}>{{ $mapel->nama_mapel }} ({{ $mapel->kode_mapel }})</option>
                                        @endforeach
                                    </select>
                                    @error('id_mapel')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">Guru</label>
                                </div>
                                <div class="sm:col-span-9">
                                    <select data-hs-select='{"hasSearch": true, "searchPlaceholder": "Search...", "searchClasses": "block w-full sm:text-sm bg-transparent border-gray-200 dark:border-neutral-700 rounded-lg text-gray-800 dark:text-neutral-200 placeholder:text-gray-500 dark:placeholder:text-neutral-400 focus:border-blue-700 dark:focus:border-blue-600 focus:ring-blue-700 dark:focus:ring-blue-600 before:absolute before:inset-0 before:z-1 py-1.5 sm:py-2 px-3", "searchWrapperClasses": "bg-white dark:bg-neutral-900 p-2 -mx-1 sticky top-0", "placeholder": "Pilih guru...", "scrollToSelected": true, "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200\" data-title></span></button>", "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 ps-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 text-gray-800 dark:text-white rounded-lg text-start text-sm hover:bg-gray-50 dark:hover:bg-neutral-700 focus:outline-hidden focus:bg-gray-50 dark:focus:bg-neutral-700", "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white dark:bg-neutral-900 border border-transparent rounded-lg shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-none [&::-webkit-scrollbar-track]:bg-gray-100 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500", "optionClasses": "hs-selected:bg-gray-100 dark:hs-selected:bg-neutral-800 py-2 px-4 w-full text-sm text-gray-800 dark:text-neutral-200 cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-800 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:focus:bg-neutral-800", "optionTemplate": "<div class=\"flex items-center\"><div><div class=\"hs-selected:font-semibold text-sm text-gray-800 dark:text-neutral-200\" data-title></div></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-4 text-blue-600 dark:text-blue-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>", "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-400\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"}' name="id_guru" class="hidden">
                                        <option value="">Pilih guru</option>
                                        @foreach ($gurus as $guru)
                                            <option value="{{ $guru->id_guru }}" {{ old('id_guru', $data->id_guru) == $guru->id_guru ? 'selected' : '' }}>{{ $guru->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_guru')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">Tahun Ajaran</label>
                                </div>
                                <div class="sm:col-span-9">
                                    <select data-hs-select='{"hasSearch": true, "searchPlaceholder": "Search...", "searchClasses": "block w-full sm:text-sm bg-transparent border-gray-200 dark:border-neutral-700 rounded-lg text-gray-800 dark:text-neutral-200 placeholder:text-gray-500 dark:placeholder:text-neutral-400 focus:border-blue-700 dark:focus:border-blue-600 focus:ring-blue-700 dark:focus:ring-blue-600 before:absolute before:inset-0 before:z-1 py-1.5 sm:py-2 px-3", "searchWrapperClasses": "bg-white dark:bg-neutral-900 p-2 -mx-1 sticky top-0", "placeholder": "Pilih tahun ajaran...", "scrollToSelected": true, "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200\" data-title></span></button>", "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 ps-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 text-gray-800 dark:text-white rounded-lg text-start text-sm hover:bg-gray-50 dark:hover:bg-neutral-700 focus:outline-hidden focus:bg-gray-50 dark:focus:bg-neutral-700", "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white dark:bg-neutral-900 border border-transparent rounded-lg shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-none [&::-webkit-scrollbar-track]:bg-gray-100 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500", "optionClasses": "hs-selected:bg-gray-100 dark:hs-selected:bg-neutral-800 py-2 px-4 w-full text-sm text-gray-800 dark:text-neutral-200 cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-800 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:focus:bg-neutral-800", "optionTemplate": "<div class=\"flex items-center\"><div><div class=\"hs-selected:font-semibold text-sm text-gray-800 dark:text-neutral-200\" data-title></div></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-4 text-blue-600 dark:text-blue-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>", "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-400\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"}' name="id_tahun_ajaran" class="hidden">
                                        <option value="">Pilih tahun ajaran</option>
                                        @foreach ($tahunAjarans as $tahun)
                                            <option value="{{ $tahun->id_tahun_ajaran }}" {{ old('id_tahun_ajaran', $data->id_tahun_ajaran) == $tahun->id_tahun_ajaran ? 'selected' : '' }}>{{ $tahun->tahun_mulai }}/{{ $tahun->tahun_akhir }} - Smt {{ $tahun->semester }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_tahun_ajaran')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">KKM</label>
                                </div>
                                <div class="sm:col-span-9">
                                    <input type="number" min="0" max="100" name="kkm" value="{{ old('kkm', $data->kkm) }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300" placeholder="Masukkan KKM" autocomplete="off">
                                    @error('kkm')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                                <div class="sm:col-span-3">
                                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">Status Aktif</label>
                                </div>
                                <div class="sm:col-span-9">
                                    <select data-hs-select='{"hasSearch": false, "placeholder": "Pilih status...", "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 ps-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 text-gray-800 dark:text-white rounded-lg text-start text-sm hover:bg-gray-50 dark:hover:bg-neutral-700 focus:outline-hidden focus:bg-gray-50 dark:focus:bg-neutral-700", "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white dark:bg-neutral-900 border border-transparent rounded-lg shadow-xl overflow-hidden overflow-y-auto", "optionClasses": "hs-selected:bg-gray-100 dark:hs-selected:bg-neutral-800 py-2 px-4 w-full text-sm text-gray-800 dark:text-neutral-200 cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-800 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:focus:bg-neutral-800", "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-400\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"}' name="is_active" class="hidden">
                                        <option value="1" {{ old('is_active', $data->is_active ? '1' : '0') === '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('is_active', $data->is_active ? '1' : '0') === '0' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('is_active')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 pt-0 flex justify-end gap-x-2">
                        <div class="w-full flex justify-end items-center gap-x-2">
                            <a href="{{ route($page, ['type' => $type]) }}" class="py-2 px-3 inline-flex justify-center items-center text-start text-xs bg-white border border-gray-200 text-gray-800 text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700">
                                Kembali
                            </a>
                            <button type="submit" class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-start text-xs bg-blue-600 border border-blue-600 text-white text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-blue-700 focus:outline-hidden focus:ring-1 focus:ring-blue-300 dark:focus:ring-blue-500">
                                Perbarui
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="p-6 w-full flex justify-between">
                    <div class="w-full text-sm">
                        <p class="font-semibold text-gray-800 dark:text-neutral-200">Hapus data</p>
                        <p class="text-xs text-gray-500 dark:text-neutral-500">Menghapus permanen data komponen nilai {{ $typeLabel }}.</p>
                    </div>
                    <div>
                        <button class="py-2 px-3 inline-flex justify-center items-center text-start text-xs bg-white border border-gray-200 text-red-700 text-sm font-medium rounded-lg shadow-2xs hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-red-600 dark:hover:bg-neutral-700" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-scale-confirm-modal" data-hs-overlay="#hs-scale-confirm-modal">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>

<div id="hs-scale-confirm-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-confirm-modal-label">
    <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
        <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-7">
                <div class="flex justify-between items-center">
                    <h3 id="hs-scale-confirm-modal-label" class="font-bold text-gray-800 dark:text-white">Hapus {{ $typeLabel }}?</h3>
                </div>
                <div class="pb-3 overflow-y-auto">
                    <p class="mt-1 text-gray-800 dark:text-neutral-400">Yakin ingin menghapus komponen nilai {{ $typeLabel }} ini secara permanen? Aksi ini tidak dapat dikembalikan.</p>
                </div>
                <div class="flex justify-end items-center gap-x-2">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#hs-scale-confirm-modal">Kembali</button>
                    <form method="post" action="{{ route($page.'.delete.action', [$type, $action_param]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
