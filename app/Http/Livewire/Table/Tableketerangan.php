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
    public $jenisket;
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
        'jenisket' => 'required',
        'ket' => 'required',
    ];
    protected $messages = [
        'jenisket.required' => 'Isi jenisket',
        'ket.required' => 'Isi ket',
    ];

    public function store()
    {
        $data = [
            'ket' => $this->ket,
            'jenisket' => $this->jenisket,
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
        $this->jenisket = $cari->jenisket;
        $this->ket = $cari->ket;
        $this->simpan = 'Update';
        $this->button = create_button('update', "Gunabayar");
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
        $this->jenisket = '';
        $this->ket = '';
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
