{{-- Table Data --}}
<div>
    {{-- <div class="bg-gray-200">
        <div class="flex flex-col items-center justify-center h-screen">
            <div class="flex flex-col">
                <label class="inline-flex items-center mt-3">
                    <input wire:model='labela' type="checkbox" class="w-5 h-5 text-gray-600 form-checkbox" value="Berhasil"><span class="ml-2 text-gray-700">label</span>
                </label>
                <button wire:click="cek()" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Cek</button>
            </div>
        </div>
    </div> --}}
    <x-data-table-spp :data="$data" :model="$cetakpdfs">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    #
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nis')" role="button" href="#">
                    NIS
                    @include('components.sort-icon', ['field' => 'nis'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nama')" role="button" href="#">
                    Nama
                    @include('components.sort-icon', ['field' => 'nama'])
                </a></th>
                <th>Kelas</th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($cetakpdfs as $key => $siswa)
                <tr x-data="window.__controller.dataTableController({{ $siswa->id }})">
                    <td>{{ $cetakpdfs->firstItem() + $key }}</td>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->tingkat }} - {{ $siswa->jurusan }}</td>
                    {{-- <td><button wire:click="cetak({{ $siswa->id }})" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Download</button></td> --}}
                    <td><a role="button" target="_blank" href="{{ route('savepdf',$siswa->id) }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Download</a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table-spp>
</div>