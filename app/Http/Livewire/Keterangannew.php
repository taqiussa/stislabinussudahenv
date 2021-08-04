<?php

namespace App\Http\Livewire;

use App\Models\Gunabayar;
use App\Models\Kelas;
use Livewire\Component;
use App\Models\Pembayaran;
use App\Models\Siswa;

class Keterangannew extends Component
{
    public $idsiswa;
    public $namasiswa;
    public $nis;
    public $idkelas;
    public $idgunabayar;
    public $tahun;
    public $tanggalbayar;
    public $wajibbayar;
    public $wajibbayarf;
    public $jumlahbayar;
    public $jumlahbayarf;
    public $action;
    public $button;

    protected $rules = [
        'idsiswa' => 'required',
    ];
    protected $messages = [
        'idsiswa.required' => 'Pilih Siswa',
    ];

    public function store()
    {
        $data = [
            
        ];

        $this->validate();
        Pembayaran::Create($data);
        $this->resetErrorBag();
        $this->clearVar();
        $this->emit('saved');
    }
    public function kembali()
    {
        return redirect()->to('keterangan');
    }
    public function clearVar()
    {
        $this->button = create_button($this->action, "Keterangan Baru");
    }
    public function tambah(){

    }
    public function mount()
    {
        $this->button = create_button($this->action, "Keterangan Baru");
        // this button untuk menampilkan emit atau message toast 

    }
    public function render()
    {
        $data = [
            'kelas' => Kelas::orderBy('tingkat')->orderBy('jurusan')->get(),
            'tahuns' => Siswa::select('tahun')->distinct()->orderBy('tahun')->get(),
            'siswas' => Siswa::where('idkelas', $this->idkelas)
                ->where('tahun', $this->tahun)
                ->orderBy('nama')
                ->get(),
            'gunabayars' => Gunabayar::where('jenisket', 'SPP')->orderBy('urut')->get(),
        ];
        //end of idsiswa
        return view('livewire.keterangannew', $data);
    }
}
