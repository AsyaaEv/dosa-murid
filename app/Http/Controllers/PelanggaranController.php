<?php

namespace App\Http\Controllers;

use App\Models\Aksi;
use App\Models\ListPelanggaran;
use App\Models\Pelanggaran;
use App\Models\Siswa;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use PhpParser\Node\Expr\Print_;

class PelanggaranController extends Controller
{

    public function resultSiswa( Request $request){
        $nis = $request->nis;
        $siswa = Siswa::where('nis', $nis)->with('kelas')->first();
        $aksi = Aksi::where('nis_siswa', $nis);
        $point = $this->jumlahPoint($siswa->nis);
        return view('user.result', compact('nis', 'siswa', 'point', 'aksi'));
    }

    public function pelanggaran($aksi){
        $kode_aksi = $aksi;
        $aksi = Aksi::where('kode_aksi', $aksi)->with('siswa.kelas.jurusan', 'guruBK', 'listPelanggaran.pelanggaran')->first();
        $siswa = $aksi->siswa ?? null;
        $pelanggaranAll = Pelanggaran::all();
        $point = $this->jumlahPoint($siswa->nis);
        return view('pelanggaran', compact('siswa', 'aksi', 'kode_aksi', 'pelanggaranAll', 'point'));
    }
    public function print(Request $request){
        $request->validate([
            'kode_aksi' => 'required',
        ]);

        $kode_aksi = $request->kode_aksi;
        $aksi = Aksi::where('kode_aksi', $kode_aksi)->with('siswa.kelas.jurusan', 'guruBK', 'listPelanggaran.pelanggaran')->first();
        $siswa = $aksi->siswa ?? null;
        $point = $this->jumlahPoint($siswa->nis);

        if($siswa == null){
            return redirect()->back(); 
        }

        $connector = new WindowsPrintConnector('EPSON TM-T82 Receipt');
        $printer = new Printer($connector);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $logo = public_path('img\logo.png');
        $logo = EscposImage::load($logo);
        $printer->graphics($logo);
        $printer->feed();
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_EMPHASIZED);
        $printer->text("Dosa Murid\n");
        $printer->selectPrintMode(Printer::MODE_EMPHASIZED);
        $printer->text("Sistem Pencatatan Pelanggaran Siswa\n");
        $printer->text("SMKN 1 BANGSRI\n");

        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->selectPrintMode();
        $printer->text("Nama        :" . $siswa->nama . "\n");
        $printer->text("NISN        :" . $siswa->nisn . "\n");
        $printer->text("NIS         :" . $siswa->nis . "\n");
        $printer->text("Kelas       :" . $siswa->kelas->nama_kelas . "\n");
        $printer->text("Jurusan     :" . $siswa->kelas->jurusan->nama_jurusan . "\n");
        $printer->text("Alamat      :" . $siswa->alamat . "\n");
        $printer->text("Tanggal     :" . $aksi->tanggal . "\n");
        $printer->text("Waktu       :" . $aksi->waktu . "\n");
        $printer->text("Guru BK     :" . $aksi->guruBK->nama . "\n");
        $printer->text("Point       :" . $point . "\n");

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("***************************\n");
        $printer->selectPrintMode(Printer::MODE_EMPHASIZED);
        $printer->text("List Pelanggaran\n");
        $printer->selectPrintMode();
        $printer->text("***************************\n");
        $printer->feed();
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        foreach($aksi->listPelanggaran as $list){
            $printer->text("    # " . $list->pelanggaran->nama_pelanggaran . "\n");
            $printer->text("    " . $list->keterangan . "\n");
            $printer->feed();
        }
        $printer->setJustification(Printer::JUSTIFY_CENTER);

        $printer->text("***************************\n");
        $printer->feed();
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Sebaik-baiknya manusia adalah yang tidak mengulangi dosanya kembali, dan mengajak temannya kepada kebaikan\n");
        $printer->feed();
    
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->qrCode($kode_aksi, Printer::QR_ECLEVEL_L, 10);
        $printer->text("Kode Aksi ;" .$kode_aksi . "\n");
        $printer->feed();

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_EMPHASIZED);
        $printer->text("@PT BOGENG MEDIA PRIMA");
        $printer->feed(2);
        $printer->cut();
        $printer->close();

        return redirect()->back();

    }
    public function storeAksi(Request $request){
        $request->validate([
            'nis' => 'required',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'kode_bk' => 'required',
        ]);

        $kode_aksi = 'AKS' . fake()->unique()->numerify('###');

        $siswa = Siswa::where('nis', $request->nis)->first();
        $siswa->aksi()->create([
            'kode_aksi' => $kode_aksi,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'kode_bk' => $request->kode_bk,
        ]);
        return redirect()->route('pelanggaran', $kode_aksi);
    }

    public function removeAksi($aksi, Request $request){
        $request->validate([
            'id_list' => 'required',
        ]);

        $list = ListPelanggaran::find($request->id_list);
        if($list->kode_aksi == $aksi){
            $list->delete();
        }
        return redirect()->back();
    }

    public function addAksi($kode_aksi, Request $request){
        $request->validate([
            'kode_pelanggaran' => 'required',
            'keterangan' => 'required',
        ]);

        $list = ListPelanggaran::create([
            'kode_aksi' => $kode_aksi,
            'kode_pelanggaran' => $request->kode_pelanggaran,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back();
    }

    public function jumlahPoint(Int $nis) : Int{
        $siswa = Siswa::where('nis', $nis)->with('aksi.listPelanggaran.pelanggaran')->first();
        $total = 0;

        if($siswa == null){
            return $total;
        }
        foreach($siswa->aksi as $aksi){
            foreach($aksi->listPelanggaran as $list){
                $total += $list->pelanggaran->point;
            }
        }

        return $total ;
    }
}
