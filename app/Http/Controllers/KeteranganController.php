<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\KeteranganModel;

class KeteranganController extends Controller
{
    
    public function index(): View {
       
        $listKeterangan = KeteranganModel::all();

        return view('content.keterangan', compact('listKeterangan'));
    }
    
    public function TambahData(Request $request)
    {

        /*$datas = $request->validate([
            'Keterangan' => 'required|max:250',
            'KodeKeterangan' => 'required|string|max:10',
        ]);*/

        $this->validate($request, [
            'Keterangan' => 'required|max:250',
            'KodeKeterangan' => 'required|string|max:10', 
        ]);

        try {
            
            $datas = $request->all();
            $save = new KeteranganModel;
            $save->keterangan = $datas['Keterangan'];
            $save->kode_keterangan = $datas['KodeKeterangan'];
            $save->save();

            return redirect()->route('content.keterangan')->with('success', 'Keterangan berhasil ditambah');
        } catch (\Throwable $th) {
            return redirect()->route('content.keterangan')->with('success', $th->getMessage());
        }

        /*KeteranganModel::create([
            'keterangan' => $datas['Keterangan'],
            'kode_keterangan' => $datas['KodeKeterangan'],
        ]);*/
        
    }

    public function HapusData(Request $id)
    {
        //get post by ID
        $idKeterangan = $id->input('id');
        $hapusData = KeteranganModel::findOrFail($idKeterangan);

        //delete post
        $hapusData->delete();

        //redirect to index
        return redirect()->route('content.keterangan')->with('success', 'Data Berhasil Dihapus!');
    }

    public function EditData(Request $request, $id) {

        $keterangan = KeteranganModel::findOrFail($id);

        $this->validate($request, [
            'Keterangan' => 'required|max:250',
            'KodeKeterangan' => 'required|string|max:10',
        ]);

        $keterangan->update([
            'keterangan'        => $request->Keterangan,
            'kode_keterangan'   => $request->KodeKeterangan
        ]);
        
        return redirect()->route('content.keterangan')->with('success', 'Keterangan berhasil diubah');

    } 

}
