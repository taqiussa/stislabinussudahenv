<div>
    <x-data-table :data="$data" :model="$keterangans">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    #
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('ket')" role="button" href="#">
                    Keterangan
                    @include('components.sort-icon', ['field' => 'ket'])
                </a></th>
                <th><a wire:click.prevent="sortBy('spp')" role="button" href="#">
                    SPP
                    @include('components.sort-icon', ['field' => 'spp'])
                </a></th>
                <th><a wire:click.prevent="sortBy('uanggedung')" role="button" href="#">
                    Uang Gedung
                    @include('components.sort-icon', ['field' => 'uanggedung'])
                </a></th>
                <th><a wire:click.prevent="sortBy('alatpraktek')" role="button" href="#">
                    Alat Praktek
                    @include('components.sort-icon', ['field' => 'alatpraktek'])
                </a></th>
                <th><a wire:click.prevent="sortBy('seragam')" role="button" href="#">
                    Seragam
                    @include('components.sort-icon', ['field' => 'seragam'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($keterangans as $key => $keterangan)
                <tr x-data="window.__controller.dataTableController({{ $keterangan->id }})">
                    <td>{{ $keterangans->firstItem() + $key }}</td>
                    <td>{{ $keterangan->ket }}</td>
                    <td>Rp. {{ number_format($keterangan->spp, 0, ".", ".") . ",-" }}</td>
                    <td>Rp. {{ number_format($keterangan->uanggedung, 0, ".", ".") . ",-" }}</td>
                    <td>Rp. {{ number_format($keterangan->alatpraktek, 0, ".", ".") . ",-" }}</td>
                    <td>Rp. {{ number_format($keterangan->seragam, 0, ".", ".") . ",-" }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" wire:click="edit({{ $keterangan->id }})" class="mr-3"><i class="fas fa-edit"></i></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-red-500 fa fa-16px fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
    @if ($isOpen)
    @include('livewire.modal.modal-keterangan')
    @endif  
</div>
