<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use App\Models\SuratModel;
use App\Models\KeteranganModel;

class SuratController extends Controller
{
    public function index()
    {
        $listSurat = SuratModel::join("table_keterangan","table_surat.id_keterangan","=","table_keterangan.id_keterangan")->get();
        $listKeterangan = KeteranganModel::all();
        $bulan = Carbon::parse(now())->translatedFormat('m');
        $tahun = Carbon::parse(now())->translatedFormat('Y');
        return view('content.surat', compact('listSurat','listKeterangan','tahun','bulan'));
    }

    public function TambahData(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp',
            'jenis_surat' =>'required|string|max:225',
            'id_keterangan'=> 'required',
            'perihal' => 'required',
            'kode_surat' => 'required',
        ]);

        try {

            $datas = $request->all();
            $surat = new SuratModel;

            if($request->hasFile('file')) {
                $uploadPath = public_path('uploads');
    
                if(!File::isDirectory($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true, true);
                }
    
                $file = $request->file('file');
                $explode = explode('.', $file->getClientOriginalName());
                $originalName = $explode[0];
                $extension = $file->getClientOriginalExtension();
                $rename = 'file_' . date('YmdHis') . '.' . $extension;
                $filesize = $file->getSize();
    
                if($file->move($uploadPath, $rename)) {
                    
                    $surat->name_file = $originalName;
                    $surat->file = $rename;
                    $surat->extension = $extension;
                    $surat->size = $filesize;
                    $surat->jenis_surat = $datas['jenis_surat'];
                    $surat->id_keterangan = $datas['id_keterangan'];
                    $surat->perihal = $datas['perihal'];
                    $surat->kode_surat = $datas['kode_surat'];
                    $surat->save();
    
                    return redirect()->route('content.surat')->with('success', 'Surat berhasil ditambah');
                }
    
                return redirect()->route('content.surat')->with('error', 'Surat gagal ditambah');
            }

        } catch (\Throwable $th) {
            
            return redirect()->route('content.surat')->with('error','Data tidak boleh ada yang kosong', $th->getMessage());

        }

    }

    public function UbahData(Request $req, $id)
    {
        $this->validate($req, [
            'jenis_surat' =>'required|string|max:225',
            'id_keterangan'=> 'required',
            'kode_surat'=> 'required',
            'perihal'=> 'required',
        ]);
        try {
        

            $surat = SuratModel::where('id_surat', $id)->first();

            if (!empty($surat)) {
                
                $datas = $req->all();

                //$surat->file = $datas['file'];
                $surat->jenis_surat = $datas['jenis_surat'];
                $surat->id_keterangan = $datas['id_keterangan'];
                $surat->kode_surat = $datas['kode_surat'];
                $surat->perihal = $datas['perihal'];

               if (!empty($req->file('file'))) {
                    $file = $req->file('file');
                    $this->validate($req, [
                        'file' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp',
                    ]);
                    $explode = explode('.', $file->getClientOriginalName());
                    $originalName = $explode[0];
                    $extension = $file->getClientOriginalExtension();
                    $rename = 'file_' . date('YmdHis') . '.' . $extension;
                    $filesize = $file->getSize();

                    $tujuan_upload = 'uploads';
                    $old_image = $tujuan_upload . '/' . $surat->file;
                    
                    //hapus file lama
                    if (File::exists($old_image)) {
                        //File::delete($image_path);
                        unlink($old_image);
                    }
                    //simpan file terbaru
                    $file->move($tujuan_upload, $rename); //akan kesimpan di folder public
                    $surat->file = $rename; //upfdate nama image d db
                }
               
                $surat->save(); //proses simpan perubahan
                return redirect()->route('content.surat')->with('success', 'Surat berhasil diubah');

            } else {
                return redirect()->route('content.surat')->with('error', 'Surat gagal diubah');
            }
        } catch (\Throwable $th) {

            return redirect()->route('content.surat')->with('error', 'Surat gagal diubah ', $th->getMessage());
        }
    }

    public function HapusData(Request $id)
    {
        //get post by ID
        $idSurat = $id->input('id');
        $hapusData = SuratModel::findOrFail($idSurat);

        $tujuan_upload = 'uploads';
        $old_image = $tujuan_upload . '/' . $hapusData->file;
        
        //hapus file lama
        if (File::exists($old_image)) {
            //File::delete($image_path);
            unlink($old_image);
        }
        //delete post
        $hapusData->delete();

        //redirect to index
        return redirect()->route('content.surat')->with('success', 'Data Berhasil Dihapus!');
    }

}
