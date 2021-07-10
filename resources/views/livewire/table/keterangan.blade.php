<div>
    <x-data-table :data="$data" :model="$keterangans">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('ket')" role="button" href="#">
                    ket
                    @include('components.sort-icon', ['field' => 'ket'])
                </a></th>
                <th><a wire:click.prevent="sortBy('jenisket')" role="button" href="#">
                    jenisket
                    @include('components.sort-icon', ['field' => 'jenisket'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($keterangans as $keterangan)
                <tr x-data="window.__controller.dataTableController({{ $keterangan->id }})">
                    <td>{{ $keterangan->id }}</td>
                    <td>{{ $keterangan->ket }}</td>
                    <td>{{ $keterangan->jenisket }}</td>
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
