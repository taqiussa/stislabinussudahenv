<?php

namespace App\Http\Livewire;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Siswasementara;
use Livewire\Component;

class Naikkelas extends Component
{
    public $idkelas;
    public $tahun;
    public $tahunbaru;
    public $kelasbaru;
    public $tingkat;
    public $jurusan;
    public $action;
    public $button;

    public function mount()
    {
        $this->button = create_button($this->action, "Naik Kelas");
        // this button untuk menampilkan emit atau message toast 
        // $this->emit('saved');
        // $this->emit("deleteResult", [
        //     "status" => true,
        //     "message" => "Data " . $this->name . " berhasil dihapus!"
        // ]);

    }
    public function store(){
        $carik = Kelas::where('tingkat',$this->tingkat)->where('jurusan',$this->jurusan)->first();
        $cari = Siswa::where('idkelas',$this->idkelas)->where('tahun',$this->tahun)->get();
        foreach($cari as $c){
            $data = [
                'nis' => $c->nis,
                'nama' => $c->nama,
                'tahun' => $this->tahunbaru,
                'ortu' => $c->ortu,
                'ket' => $c->ket,
                'idkelas' => $carik->id,
                'id' => $c->id,
            ];
            Siswasementara::create($data);
        }
        $siswabaru = Siswasementara::get();

        foreach($siswabaru as $s){
            $data = [
                'nis' => $s->nis,
                'nama' => $s->nama,
                'idkelas' => $s->idkelas,
                'tahun' => $s->tahun,
                'ortu' => $s->ortu,
                'ket' => $s->ket,
            ];
            Siswa::create($data);
        }
        Siswasementara::truncate();
        $this->emit('saved');
    }
    public function render()
    {
        $data = [
            'tahuns' => Siswa::select('tahun')->distinct()->orderBy('tahun')->get(),
            'kelas' => Kelas::orderBy('tingkat','asc')->orderBy('jurusan','asc')->get(), 

        ];
        if(!empty($this->idkelas)){
            $cari = Kelas::findOrFail($this->idkelas);
            if($cari->tingkat == 'X'){
                $this->tingkat = 'XI';
                $this->jurusan = $cari->jurusan;
                $this->kelasbaru = $this->tingkat. ' - ' . $cari->jurusan;
            }elseif($cari->tingkat == 'XI'){
                $this->tingkat = 'XII';
                $this->jurusan = $cari->jurusan;
                $this->kelasbaru = $this->tingkat. ' - ' . $cari->jurusan;
            }else{
                $this->kelasbaru = 'Tidak Bisa Naik';
            }
        }else{
            $this->kelasbaru = '';
        }
        return view('livewire.naikkelas',$data);
    }
}
