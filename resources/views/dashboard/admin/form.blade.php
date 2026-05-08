@php
    $page = 'admin';
    $page_variable = 'admin';
    $page_title = 'Admin';
    $is_edit = isset($data);
@endphp
<x-app :page='$page'>
    <div class="p-2 sm:p-5 sm:py-0 md:pt-5 space-y-5">
      <!-- Card Form -->
      <div class="flex flex-col gap-y-5 max-w-xl mx-auto">
        <!-- Header -->
        <div class="flex gap-x-3">
          <div class="grow">
            <h1 class="font-semibold text-xl text-gray-800 dark:text-neutral-200">
                {{ $is_edit ? 'Edit' : 'Tambah' }} {{ $page_title }}
            </h1>

            <p class="text-sm text-gray-500 dark:text-neutral-500">
               {{ $is_edit ? 'Ubah data' : 'Membuat' }} {{ $page_variable }} {{ $is_edit ? 'di dalam sistem' : 'baru ke dalam sistem' }}
            </p>
          </div>
        </div>
        <!-- End Header -->

        <!-- Card -->
        <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <form action="{{ $is_edit ? route($page.'.update', $data->id_admin) : route($page.'.store') }}" method="POST">
            @csrf
            @if ($is_edit)
                @method('PUT')
            @endif
            
            <div class="py-2 sm:py-4 px-2">
              <div class="p-4 space-y-5">
                <!-- Nama -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                        Nama <span class="text-red-500">*</span>
                    </label>
                  </div>

                  <div class="sm:col-span-9">
                    <input type="text" name="nama" value="{{ old('nama', $is_edit ? $data->nama : '') }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600 @error('nama') border-red-500 ring-red-500 @enderror" placeholder="Masukkan nama {{ $page_title }}" autocomplete="off" required>
                    @error('nama')
                      <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <!-- End Nama -->

                <!-- Username -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                        Username <span class="text-red-500">*</span>
                    </label>
                  </div>

                  <div class="sm:col-span-9">
                    <input type="text" name="username" value="{{ old('username', $is_edit ? $data->username : '') }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600 @error('username') border-red-500 ring-red-500 @enderror" placeholder="Masukkan username {{ $page_title }}" autocomplete="off" required>
                    @error('username')
                      <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <!-- End Username -->

                <!-- Password -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                        Password <span class="text-red-500">{{ $is_edit ? '' : '*' }}</span>
                    </label>
                  </div>

                  <div class="sm:col-span-9">
                    <input type="password" name="password" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600 @error('password') border-red-500 ring-red-500 @enderror" placeholder="{{ $is_edit ? 'Kosongkan jika tidak ingin mengubah' : 'Masukkan password' }}" autocomplete="off" {{ !$is_edit ? 'required' : '' }}>
                    <p class="text-xs text-gray-500 dark:text-neutral-400 mt-1">{{ $is_edit ? 'Minimal 6 karakter (opsional)' : 'Minimal 6 karakter' }}</p>
                    @error('password')
                      <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <!-- End Password -->

                <!-- Password Confirmation (Show only on create) -->
                @if (!$is_edit)
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>
                  </div>

                  <div class="sm:col-span-9">
                    <input type="password" name="password_confirmation" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Konfirmasi password" autocomplete="off" required>
                  </div>
                </div>
                <!-- End Password Confirmation -->
                @endif

              </div>
            </div>

            <!-- Footer -->
            <div class="p-6 pt-0 flex justify-end gap-x-2">
              <div class="w-full flex justify-end items-center gap-x-2">
                <a href="{{ route($page.'.index') }}" class="py-2 px-3 inline-flex justify-center items-center text-start text-xs bg-white border border-gray-200 text-gray-800 text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                  Kembali
                </a>

                <button type="submit" class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-start text-xs bg-blue-600 border border-blue-600 text-white text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:ring-1 focus:ring-blue-300 dark:focus:ring-blue-500">
                  {{ $is_edit ? 'Perbarui' : 'Tambah' }}
                </button>
              </div>
            </div>
            <!-- End Footer -->
          </form>
        </div>
        <!-- End Card -->

      </div>
      <!-- End Card Form -->
    </div>
</x-app>
