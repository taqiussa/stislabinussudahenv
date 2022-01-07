<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class PemasukanExport implements FromQuery
{
    use Exportable;

    public function __construct($tanggalmulai, $tanggalakhir, $exmodel)
    {
        $this->tanggalmulai = $tanggalmulai;
        $this->tanggalakhir = $tanggalakhir;
        $this->exmodel = $exmodel;
    }

    public function query()
    {
        if($this->exmodel == 'Pengeluaran'){
            return Pengeluaran::whereBetween('tanggalsimpan', [$this->tanggalmulai, $this->tanggalakhir])
                ->select(
                    'pengeluaran.tanggalsimpan',
                    'pengeluaran.keterangan',
                    'pengeluaran.tanggalnota',
                    'pengeluaran.jumlahbayar'
                );
        }
        elseif($this->exmodel == 'SPP'){
            return Pembayaran::join('siswa', 'siswa.id', '=', 'pembayaran.idsiswa')
            ->join('kelas', 'kelas.id', '=', 'pembayaran.idkelas')
            ->join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
            ->whereBetween('pembayaran.tanggalbayar', [$this->tanggalmulai, $this->tanggalakhir])
            ->where('gunabayar.ket', '1')
            ->select(
                'pembayaran.tanggalbayar',
                'siswa.nama as nama',
                'kelas.tingkat as tingkat',
                'kelas.jurusan as jurusan',
                'gunabayar.gunabayar as gunabayar',
                'pembayaran.tahun as tahun',
                'pembayaran.jumlahbayar as jumlahbayar',
            );
        }
        elseif($this->exmodel == 'UG'){
            return Pembayaran::join('siswa', 'siswa.id', '=', 'pembayaran.idsiswa')
            ->join('kelas', 'kelas.id', '=', 'pembayaran.idkelas')
            ->join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
            ->whereBetween('pembayaran.tanggalbayar', [$this->tanggalmulai, $this->tanggalakhir])
            ->where('gunabayar.gunabayar', 'Uang Gedung')
            ->select(
                'pembayaran.tanggalbayar',
                'siswa.nama as nama',
                'kelas.tingkat as tingkat',
                'kelas.jurusan as jurusan',
                'gunabayar.gunabayar as gunabayar',
                'pembayaran.tahun as tahun',
                'pembayaran.jumlahbayar as jumlahbayar',
            );
        }
        elseif($this->exmodel == 'AP'){
            return Pembayaran::join('siswa', 'siswa.id', '=', 'pembayaran.idsiswa')
            ->join('kelas', 'kelas.id', '=', 'pembayaran.idkelas')
            ->join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
            ->whereBetween('pembayaran.tanggalbayar', [$this->tanggalmulai, $this->tanggalakhir])
            ->where('gunabayar.gunabayar', 'Alat Praktek')
            ->select(
                'pembayaran.tanggalbayar',
                'siswa.nama as nama',
                'kelas.tingkat as tingkat',
                'kelas.jurusan as jurusan',
                'gunabayar.gunabayar as gunabayar',
                'pembayaran.tahun as tahun',
                'pembayaran.jumlahbayar as jumlahbayar',
            );
        }
        elseif($this->exmodel == 'SR'){
            return Pembayaran::join('siswa', 'siswa.id', '=', 'pembayaran.idsiswa')
            ->join('kelas', 'kelas.id', '=', 'pembayaran.idkelas')
            ->join('gunabayar', 'gunabayar.id', '=', 'pembayaran.idgunabayar')
            ->whereBetween('pembayaran.tanggalbayar', [$this->tanggalmulai, $this->tanggalakhir])
            ->where('gunabayar.gunabayar', 'Seragam')
            ->select(
                'pembayaran.tanggalbayar',
                'siswa.nama as nama',
                'kelas.tingkat as tingkat',
                'kelas.jurusan as jurusan',
                'gunabayar.gunabayar as gunabayar',
                'pembayaran.tahun as tahun',
                'pembayaran.jumlahbayar as jumlahbayar',
            );
        }
    }
}