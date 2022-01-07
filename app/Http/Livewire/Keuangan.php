<?php

namespace App\Http\Livewire;

use App\Exports\PemasukanExport;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Siswa;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Keuangan extends Component
{
    public $tanggalmulai;
    public $tanggalakhir;
    public $pilihlaporan;
    public $pilihbulan;
    public $saldospp;
    public $saldomasuk;
    public $saldomasuknon;
    public $saldoug;
    public $saldoap;
    public $saldosr;
    public $pengeluaran;
    public $totalpemasukan;
    public $sisasaldo;
    public $bulan;
    public $tahun;
    public $pengeluarans;
    public $pemasukans;
    public $isPemasukan = 0;
    public $isPengeluaran = 0;
    public $laporanpemasukan;
    public $laporanpengeluaran;
    public $namafile;
    public $exmodel;
    public $exgunabayar;
    public function mount()
    {
        $this->tanggalmulai = gmdate('Y-m-d');
        $this->tanggalakhir = gmdate('Y-m-d');
    }
    public function render()
    {
        $this->saldomasuk = Pembayaran::join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
            ->where('gunabayar.ket', 1)
            ->whereMonth('pembayaran.tanggalbayar', date('m'))
            ->whereYear('pembayaran.tanggalbayar', date('Y'))
            ->sum('jumlahbayar');
        $this->saldomasuknon = Pembayaran::join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
            ->where('gunabayar.ket', 2)
            ->whereMonth('pembayaran.tanggalbayar', date('m'))
            ->whereYear('pembayaran.tanggalbayar', date('Y'))
            ->sum('jumlahbayar');
        $this->saldoug = Pembayaran::join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
            ->where('gunabayar.gunabayar', 'Uang Gedung')
            ->whereMonth('pembayaran.tanggalbayar', date('m'))
            ->whereYear('pembayaran.tanggalbayar', date('Y'))
            ->sum('jumlahbayar');
        $this->saldoap = Pembayaran::join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
            ->where('gunabayar.gunabayar', 'Alat Praktek')
            ->whereMonth('pembayaran.tanggalbayar', date('m'))
            ->whereYear('pembayaran.tanggalbayar', date('Y'))
            ->sum('jumlahbayar');
        $this->saldosr = Pembayaran::join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
            ->where('gunabayar.gunabayar', 'Seragam')
            ->whereMonth('pembayaran.tanggalbayar', date('m'))
            ->whereYear('pembayaran.tanggalbayar', date('Y'))
            ->sum('jumlahbayar');
        $this->totalpemasukan = intval($this->saldomasuk) + intval($this->saldomasuknon);
        $this->pengeluaran = Pengeluaran::whereMonth('tanggalsimpan', date('m'))
            ->whereYear('tanggalsimpan', date('Y'))
            ->sum('jumlahbayar');
        $this->sisasaldo = intval($this->totalpemasukan) - intval($this->pengeluaran);
        if ($this->pilihlaporan == 'Pengeluaran') {
            $this->pengeluarans = Pengeluaran::whereBetween('tanggalsimpan', [$this->tanggalmulai, $this->tanggalakhir])
                ->select(
                    'pengeluaran.id as id',
                    'pengeluaran.keterangan as keterangan',
                    'pengeluaran.tanggalsimpan as tanggals',
                    'pengeluaran.tanggalnota as tanggaln',
                    'pengeluaran.jumlahbayar as jumlahbayar'
                )
                ->get();
            $this->laporanpengeluaran = Pengeluaran::whereBetween('tanggalsimpan', [$this->tanggalmulai, $this->tanggalakhir])
                ->sum('jumlahbayar');
            $this->isPemasukan = false;
            $this->isPengeluaran = true;
        } elseif ($this->pilihlaporan == 'SPP') {
            $this->pemasukans = Pembayaran::join('siswa', 'siswa.id', '=', 'pembayaran.idsiswa')
                ->join('kelas', 'kelas.id', '=', 'pembayaran.idkelas')
                ->join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
                ->whereBetween('pembayaran.tanggalbayar', [$this->tanggalmulai, $this->tanggalakhir])
                ->where('gunabayar.ket', '1')
                ->select(
                    'pembayaran.id as id',
                    'pembayaran.tanggalbayar as tanggal',
                    'pembayaran.jumlahbayar as jumlahbayar',
                    'pembayaran.tahun as tahun',
                    'siswa.nama as nama',
                    'kelas.tingkat as tingkat',
                    'kelas.jurusan as jurusan',
                    'gunabayar.gunabayar as gunabayar',
                )
                ->get();
            $this->laporanpemasukan = Pembayaran::join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
                ->whereBetween('pembayaran.tanggalbayar', [$this->tanggalmulai, $this->tanggalakhir])
                ->where('gunabayar.ket', '1')
                ->sum('pembayaran.jumlahbayar');
            $this->isPengeluaran = false;
            $this->isPemasukan = true;
        } elseif ($this->pilihlaporan == 'UG') {
            $this->pemasukans = Pembayaran::join('siswa', 'siswa.id', '=', 'pembayaran.idsiswa')
                ->join('kelas', 'kelas.id', '=', 'pembayaran.idkelas')
                ->join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
                ->whereBetween('pembayaran.tanggalbayar', [$this->tanggalmulai, $this->tanggalakhir])
                ->where('gunabayar.gunabayar', 'Uang Gedung')
                ->select(
                    'pembayaran.id as id',
                    'pembayaran.tanggalbayar as tanggal',
                    'pembayaran.jumlahbayar as jumlahbayar',
                    'pembayaran.tahun as tahun',
                    'siswa.nama as nama',
                    'kelas.tingkat as tingkat',
                    'kelas.jurusan as jurusan',
                    'gunabayar.gunabayar as gunabayar',
                )
                ->get();
            $this->laporanpemasukan = Pembayaran::join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
                ->whereBetween('pembayaran.tanggalbayar', [$this->tanggalmulai, $this->tanggalakhir])
                ->where('gunabayar.gunabayar', 'Uang Gedung')
                ->sum('pembayaran.jumlahbayar');
            $this->isPengeluaran = false;
            $this->isPemasukan = true;
        } elseif ($this->pilihlaporan == 'AP') {
            $this->pemasukans = Pembayaran::join('siswa', 'siswa.id', '=', 'pembayaran.idsiswa')
                ->join('kelas', 'kelas.id', '=', 'pembayaran.idkelas')
                ->join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
                ->whereBetween('pembayaran.tanggalbayar', [$this->tanggalmulai, $this->tanggalakhir])
                ->where('gunabayar.gunabayar', 'Alat Praktek')
                ->select(
                    'pembayaran.id as id',
                    'pembayaran.tanggalbayar as tanggal',
                    'pembayaran.jumlahbayar as jumlahbayar',
                    'pembayaran.tahun as tahun',
                    'siswa.nama as nama',
                    'kelas.tingkat as tingkat',
                    'kelas.jurusan as jurusan',
                    'gunabayar.gunabayar as gunabayar',
                )
                ->get();
            $this->laporanpemasukan = Pembayaran::join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
                ->whereBetween('pembayaran.tanggalbayar', [$this->tanggalmulai, $this->tanggalakhir])
                ->where('gunabayar.gunabayar', 'Alat Praktek')
                ->sum('pembayaran.jumlahbayar');
            $this->isPengeluaran = false;
            $this->isPemasukan = true;
        } elseif ($this->pilihlaporan == 'SR') {
            $this->pemasukans = Pembayaran::join('siswa', 'siswa.id', '=', 'pembayaran.idsiswa')
                ->join('kelas', 'kelas.id', '=', 'pembayaran.idkelas')
                ->join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
                ->whereBetween('pembayaran.tanggalbayar', [$this->tanggalmulai, $this->tanggalakhir])
                ->where('gunabayar.gunabayar', 'Seragam')
                ->select(
                    'pembayaran.id as id',
                    'pembayaran.tanggalbayar as tanggal',
                    'pembayaran.jumlahbayar as jumlahbayar',
                    'pembayaran.tahun as tahun',
                    'siswa.nama as nama',
                    'kelas.tingkat as tingkat',
                    'kelas.jurusan as jurusan',
                    'gunabayar.gunabayar as gunabayar',
                )
                ->get();
            $this->laporanpemasukan = Pembayaran::join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
                ->whereBetween('pembayaran.tanggalbayar', [$this->tanggalmulai, $this->tanggalakhir])
                ->where('gunabayar.gunabayar', 'Seragam')
                ->sum('pembayaran.jumlahbayar');
            $this->isPengeluaran = false;
            $this->isPemasukan = true;
        } else {
            $this->isPemasukan = false;
            $this->isPengeluaran = false;
        }
        if (!empty($this->pilihbulan) && !empty($this->tahun)) {
            $this->saldospp = Pembayaran::where('idgunabayar', $this->pilihbulan)
                ->where('tahun', $this->tahun)->sum('jumlahbayar');
            $this->bulan = date('F', strtotime(date('Y') . '-' . $this->pilihbulan . '-01'));
        }
        $data = [
            'now' => date('Y'),
            'nowm' => date('F'),
            'tahuns' => Siswa::select('tahun')->distinct()->orderBy('tahun')->get(),
            'pengeluaranss' => $this->pengeluarans,
            'pemasukanss' => $this->pemasukans,
            'lappemasukan' => $this->laporanpemasukan,
            'lappengeluaran' => $this->laporanpengeluaran,
        ];
        return view('livewire.keuangan', $data);
    }

    public function export_excel(){
        if($this->pilihlaporan == 'Pengeluaran'){
            $this->exmodel = 'Pengeluaran';
            $this->namafile = 'Pengeluaran.xlsx';
        }
        elseif($this->pilihlaporan == 'SPP'){
            $this->exmodel = 'SPP';
            $this->namafile = 'Pemasukan_SPP.xlsx';
        }
        elseif($this->pilihlaporan == 'UG'){
            $this->exmodel = 'UG';
            $this->namafile = 'Pemasukan_UG.xlsx';
        }
        elseif($this->pilihlaporan == 'AP'){
            $this->exmodel = 'AP';
            $this->namafile = 'Pemasukan_AP.xlsx';
        }
        elseif($this->pilihlaporan == 'SR'){
            $this->exmodel = 'SR';
            $this->namafile = 'Pemasukan_Seragam.xlsx';
        }
        return Excel::download(new PemasukanExport($this->tanggalmulai, $this->tanggalakhir, $this->exmodel), $this->namafile);
    }
}
