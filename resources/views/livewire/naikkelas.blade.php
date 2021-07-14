<div class="card card-body shadow-dark">
    <div class="w-full py-2 mx-auto mb-2 md:flex max-w-7xl sm:px-6 lg:px-8">
        <div class="px-1 mb-6 md:w-1/4 md:mb-0">
            <label class="block mb-2 text-xs font-bold tracking-wide uppercase text-grey-darker" for="grid-state">
                Kelas :
                </label>
                <select wire:model='idkelas' class="w-full px-2 py-2 border rounded shadow appearance-non">
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelas as $t)
                    <option value="{{ $t->id }}">{{ $t->tingkat }} - {{ $t->jurusan }}</option>
                    @endforeach
                </select>
        </div>
        <div class="px-1 mb-6 md:w-1/4 md:mb-0">
            <label class="block mb-2 text-xs font-bold tracking-wide uppercase text-grey-darker" for="grid-state">
                tahun ajaran lama :
                </label>
                <select wire:model='tahun' class="w-full px-2 py-2 border rounded shadow appearance-non">
                    <option value="">Pilih Tahun Ajaran</option>
                    @foreach ($tahuns as $t)
                    <option value="{{ $t->tahun }}">{{ $t->tahun }}</option>
                    @endforeach
                </select>
        </div>
        <div class="px-1 mb-6 md:w-1/4 md:mb-0">
            <label class="block mb-2 text-xs font-bold tracking-wide uppercase text-grey-darker" for="grid-state">
                naike ke kelas :
                </label>
                <input type="text" wire:model='kelasbaru' class="w-full px-2 py-2 border rounded shadow appearance-non focus:outline-none" readonly>
        </div>
        <div class="px-1 mb-6 md:w-1/4 md:mb-0">
            <label class="block mb-2 text-xs font-bold tracking-wide uppercase text-grey-darker" for="grid-state">
                tahun ajaran baru:
                </label>
                <input type="text" wire:model.defer='tahunbaru' class="w-full px-2 py-2 border rounded shadow appearance-non">
        </div>
        <div class="px-1 mb-6 md:w-1/4 md:mb-0">
            <label class="block mb-2 text-xs font-bold tracking-wide uppercase text-grey-darker" for="grid-state">
                &nbsp;
                </label>
            <div class="relative flex flex-col w-1/2 mx-1 mb-2 text-center">
                <button wire:click.prevent="store()" class="flex-shrink-0 px-2 py-1 text-sm text-white bg-teal-500 border-4 border-teal-500 rounded hover:bg-teal-700 hover:border-teal-700 focus:outline" type="button">
                    Naik Kelas
                </button>
            </div>
        </div>
    </div>
    <!-- component -->
    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
</div>
