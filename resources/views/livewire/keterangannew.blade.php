<div class="card card-body shadow-dark">
    <!-- component -->
    <form>
    <div class="flex items-center">
        <div class="w-full py-1 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col w-full mb-2 space-y-2 lg:flex-row lg:space-x-2 lg:space-y-0 lg:mb-4">
                <div class="w-full my-2 lg:w-1/2">
                    <div class="flex items-center justify-between mb-2">
                        <div class="relative flex flex-col w-1/2 mx-1 mb-2 text-center border-b border-teal-500">
                            <input type="text" class="w-full px-1 py-2 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline-none font-bold" value="Buat Keterangan Baru" readonly/>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="relative flex flex-col w-1/2 mx-1 mb-2 text-center border-b border-teal-500">
                            <input wire:model.defer='' type="text" id="weight-pounds" class="w-full px-1 py-2 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline" placeholder="Jumlah Bayar" autocomplete="off" />
                        </div>
                        <div class="relative flex flex-col w-1/3 mx-1 mb-2 text-center">
                            <button wire:click.prevent="tambah()" class="flex-shrink-0 px-2 py-1 text-sm text-white bg-teal-500 border-4 border-teal-500 rounded hover:bg-teal-700 hover:border-teal-700 focus:outline" type="button">
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>
                <div class="w-full my-2 lg:w-1/2">
                    <div class="flex items-center justify-between mb-2">
                        <div class="relative flex flex-col w-1/2 mx-1 mb-2 text-center border-b border-teal-500">
                            <input type="text" class="w-full px-1 py-1 mr-3 leading-tight text-gray-700 bg-transparent border-none font-bold appearance-none focus:outline-none" value="Detail Keterangan" readonly/>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="relative flex flex-col w-1/2 mx-1 mb-2 text-center border-b border-teal-500">
                            <select wire:model='idkelas' class="block w-full px-1 py-2 pr-8 leading-tight bg-white border-none appearance-none focus:outline">
                                <option value=""> Kelas </option>
                                @foreach ($kelas as $s)
                                <option value="{{ $s->id }}">{{ $s->tingkat }}-{{ $s->jurusan }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-1 text-gray-700 pointer-events-none">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                        <div class="relative flex flex-col w-1/2 mx-1 mb-2 text-center border-b border-teal-500">
                            <select wire:model='tahun' class="block w-full px-1 py-2 pr-8 leading-tight bg-white border-none appearance-none focus:outline">
                                <option value=""> Tahun </option>
                                @foreach ($tahuns as $s)
                                <option value="{{ $s->tahun }}">{{ $s->tahun }} </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-1 text-gray-700 pointer-events-none">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="relative flex flex-col w-1/2 mx-1 mb-2 text-center border-b border-teal-500">
                            <input wire:model='jumlahbayar' type="number" id="weight-pounds" class="w-full px-1 py-2 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline" placeholder="Jumlah Bayar" aria-label="jumlahbayar" />
                        </div>
                        <div class="relative flex flex-col w-1/2 mx-1 mb-2 text-center border-b border-teal-500">
                            <input wire:model.defer='jumlahbayarf' type="text" id="weight-pounds" class="w-full px-1 py-2 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline" placeholder="Jumlah Bayar" aria-label="jumlahbayar" readonly />
                        </div>
                    </div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="relative flex flex-col w-1/2 mx-1 mb-2 text-center">
                            <button wire:click.prevent='kembali()' class="flex-shrink-0 px-2 py-1 text-sm text-teal-500 bg-gray-200 border-4 border-transparent rounded hover:bg-gray-300" type="button">
                                Kembali
                            </button>
                        </div>
                        <div class="relative flex flex-col w-1/2 mx-1 mb-2 text-center">
                            <button wire:click.prevent="store()" class="flex-shrink-0 px-2 py-1 text-sm text-white bg-teal-500 border-4 border-teal-500 rounded hover:bg-teal-700 hover:border-teal-700 focus:outline" type="button">
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
</div>
