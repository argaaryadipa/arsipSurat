<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\KeteranganModel;
use App\Models\InstansiModel;

class InstansiController extends Controller
{
    public function index(): View {
       
        $listInstansi = InstansiModel::all();

        return view('content.instansi', compact('listInstansi'));
    }

    public function EditData(Request $request, $id) {

        $instansi = InstansiModel::findOrFail($id);

        $this->validate($request, [
            'namaInstansi' => 'required|max:250',
            'alamatInstansi' => 'required|string|max:500',
        ]);

        $instansi->update([
            'nama_instansi'        => $request->namaInstansi,
            'alamat_instansi'   => $request->alamatInstansi
        ]);
        
        return redirect()->route('content.instansi')->with('success', 'Instansi berhasil diubah');

    }
    
    public function EditDataGambar(Request $request, $id) {

        $this->validate($request, [
            'file' => 'required|mimes:jpg,jpeg,png|max:2045',
        ]);

        try {

            $datas = $request->all();
            $instansi = InstansiModel::where('id_instansi', $id)->first();

            if (!empty($request->file('file'))) {
                $file = $request->file('file');
                $this->validate($request, [
                    'file' => 'required|mimes:jpg,jpeg,png|max:5045',
                ]);
                $explode = explode('.', $file->getClientOriginalName());
                $originalName = $explode[0];
                $extension = $file->getClientOriginalExtension();
                $rename = 'file_' . date('YmdHis') . '.' . $extension;
                $filesize = $file->getSize();

                $tujuan_upload = 'uploads';
                $old_image = $tujuan_upload . '/' . $instansi->file;
                
                //hapus file lama
                if (File::exists($old_image)) {
                    //File::delete($image_path);
                    unlink($old_image);
                }
                //simpan file terbaru
                $file->move($tujuan_upload, $rename); //akan kesimpan di folder public
                $instansi->file = $rename; //upfdate nama image d db
            }
            $instansi->save();
            /*$instansi->update([
                'nama_instansi'    => $request->namaInstansi,
                'alamat_instansi'   => $request->alamatInstansi
            ]);*/
            
            return redirect()->route('content.instansi')->with('success', 'Instansi berhasil diubah');

        } catch (\Throwable $th) {
            
            return redirect()->route('content.instansi')->with('error', $th->getMessage());

        }
        

    } 

}
