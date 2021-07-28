<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Gunabayar;
use App\Models\Keterangan;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class WalikelasController extends Controller
{
    public function Pembayaranperkelas()
    {
        return view('pages.binus.pembayaranperkelas-data', [
            'pembayaranperkelas' => Pembayaran::class
        ]);
    }
    public function Pembayaransppperkelas()
    {
        return view('pages.binus.pembayaransppperkelas-data', [
            'pembayaransppperkelas' => Pembayaran::class
        ]);
    }
    public function cetakpdf()
    {
        return view('pages.binus.cetakpdf-data', [
            'cetakpdf' => Siswa::class
        ]);
    }
    public function savepdf($id)
    {
        $bulan = gmdate('m');
        $bulansurat = '';
        switch ($bulan) {
            case '1':
                $bulansurat = 'I';
                $arrayguna = [1,7,8,9,10,11,12];
                break;
            case '2':
                $bulansurat = 'II';
                $arrayguna = [1,2,7,8,9,10,11,12];
                break;
            case '3':
                $bulansurat = 'III';
                $arrayguna = [1,2,3,7,8,9,10,11,12];
                break;
            case '4':
                $bulansurat = 'IV';
                $arrayguna = [1,2,3,4,7,8,9,10,11,12];
                break;
            case '5':
                $bulansurat = 'V';
                $arrayguna = [1,2,3,4,5,7,8,9,10,11,12];
                break;
            case '6':
                $bulansurat = 'VI';
                $arrayguna = [1,2,3,4,5,6,7,8,9,10,11,12];
                break;
            case '7':
                $bulansurat = 'VII';
                $arrayguna = [7];
                break;
            case '8':
                $bulansurat = 'VIII';
                $arrayguna = [7,8];
                break;
            case '9':
                $bulansurat = 'IX';
                $arrayguna = [7,8,9];
                break;
            case '10':
                $bulansurat = 'X';
                $arrayguna = [7,8,9,10];
                break;
            case '11':
                $bulansurat = 'XI';
                $arrayguna = [7,8,9,10,11];
                break;
            case '12':
                $bulansurat = 'XII';
                $arrayguna = [7,8,9,10,11,12];
                break;
        }
        $cari = Siswa::findOrFail($id);
        $carik = Keterangan::findOrFail($cari->keterangan_id);
        $ckelas = Kelas::findOrFail($cari->idkelas);
        $kelas = $ckelas->tingkat . '-' . $ckelas->jurusan;
        $tahunsurat = gmdate('Y');
        $data = [
            'nosurat' => '001/SMK.BN/SPO',
            'bulansurat' => $bulansurat,
            'tahunsurat' => $tahunsurat,
            'nama' => $cari->nama,
            'kelas' => $kelas,
            'idkelas' => $cari->idkelas,
            'tingkatkelas' => $ckelas->tingkat,
            'jurusankelas' => $ckelas->jurusan,
            'nis' => $cari->nis,
            'spp' => $carik->spp,
            'uanggedung' => $carik->uanggedung,
            'alatpraktek' => $carik->alatpraktek,
            'seragam' => $carik->seragam,
            'gunabayarspp' => Gunabayar::whereIn('id',$arrayguna)->orderBy('urut', 'asc')->get(),
            'gunabayarsppall' => Gunabayar::where('ket','1')->orderBy('urut', 'asc')->get(),
            'gunabayarug' => Gunabayar::where('ket', '2')->get(),
        ];

        $html = view('pages.cetakpdf.pdf', $data);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('Tagihan '. $cari->nama . '.pdf', Destination::DOWNLOAD);
        // return view('pages.cetakpdf.pdf', $data);
    }
}
