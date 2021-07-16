<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Keterangan;

class Tableketerangan extends Component
{
    use WithPagination;

    public $model;
    public $name;
    public $idketerangan;
    public $ket;
    public $jenisket='-';
    public $spp;
    public $uanggedung;
    public $alatpraktek;
    public $seragam;
    public $simpan = 'Simpan';

    public $isOpen = 0;
    public $perPage = 10;
    public $sortField = "ket";
    public $sortAsc = false;
    public $search = '';
    public $action;
    public $button;

    protected $listeners = ["deleteItem" => "delete_item"];
    protected $rules = [
        'ket' => 'required',
        'spp' => 'required|numeric',
        'uanggedung' => 'required|numeric',
        'alatpraktek' => 'required|numeric',
        'seragam' => 'required|numeric',
    ];
    protected $messages = [
        'ket.required' => 'Isi ket',
        'spp.required' => 'Isi SPP',
        'uanggedung.required' => 'Isi Uang Gedung',
        'alatpraktek.required' => 'Isi Alat Praktek',
        'seragam.required' => 'Isi Seragam',
        'spp.numeric' => 'Harus Angka',
        'uanggedung.numeric' => 'Harus Angka',
        'alatpraktek.numeric' => 'Harus Angka',
        'seragam.numeric' => 'Harus Angka',
    ];

    public function store()
    {
        $data = [
            'ket' => $this->ket,
            'jenisket' => $this->jenisket,
            'spp' => $this->spp,
            'uanggedung' => $this->uanggedung,
            'alatpraktek' => $this->alatpraktek,
            'seragam' => $this->seragam,
            
        ];

        $this->validate();
        Keterangan::updateOrCreate(['id' => $this->idketerangan], $data);
        $this->resetErrorBag();
        $this->clearVar();
        $this->emit('saved');
        $this->hideModal();
    }

    public function edit($id)
    {
        $cari = Keterangan::findOrFail($id);
        $this->idketerangan = $id;
        $this->ket = $cari->ket;
        $this->spp = $cari->spp;
        $this->uanggedung = $cari->uanggedung;
        $this->alatpraktek = $cari->alatpraktek;
        $this->seragam = $cari->seragam;
        $this->simpan = 'Update';
        $this->button = create_button('update', "Keterangan");
        $this->showModal();
    }

    public function showModal()
    {
        $this->isOpen = true;
    }

    public function hideModal()
    {
        $this->resetErrorBag();
        $this->clearVar();
        $this->isOpen = false;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function get_pagination_data()
    {
        switch ($this->name) {
            case 'keterangan':
                $keterangans = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.keterangan',
                    "keterangans" => $keterangans,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => 'showModal()',
                            'create_new_text' => 'Buat keterangan',
                            'export' => '#',
                            'export_text' => 'Disabled'
                        ]
                    ])
                ];
                break;

            default:
                # code...
                break;
        }
    }

    public function delete_item($id)
    {
        $data = $this->model::find($id);

        if (!$data) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Gagal menghapus data " . $this->name
            ]);
            return;
        }

        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data " . $this->name . " berhasil dihapus!"
        ]);
    }

    public function clearVar()
    {
        $this->idketerangan = '';
        $this->ket = '';
        $this->spp = 0;
        $this->uanggedung = 0;
        $this->alatpraktek = 0;
        $this->seragam = 0;
        $this->simpan = 'Simpan';
        $this->button = create_button($this->action, "keterangan Baru");
    }

    public function mount()
    {
        $this->button = create_button($this->action, "keterangan Baru");
        // this button untuk menampilkan emit atau message toast 

    }

    public function render()
    {
        $data = $this->get_pagination_data();
        return view($data['view'], $data);
    }
}
