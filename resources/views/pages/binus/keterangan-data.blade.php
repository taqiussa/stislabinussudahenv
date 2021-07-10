<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Keterangan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Tata Usaha</a></div>
            <div class="breadcrumb-item"><a href="{{ route('keterangan') }}">Data Keterangan</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.tableketerangan name="keterangan" :model="$keterangan" />
    </div>
</x-app-layout>
