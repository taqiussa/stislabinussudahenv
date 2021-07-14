<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Set Kenaikan Kelas') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Tata Usaha</a></div>
            <div class="breadcrumb-item"><a href="{{ route('naikkelas') }}">Set Kenaikan Kelas</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:naikkelas />
    </div>
</x-app-layout>
