<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Http\Requests\StoreBiodataRequest;
use App\Http\Requests\UpdateBiodataRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', [
            'title' => 'Home'
        ]);
    }

    public function getAllData(Request $request)
    {
        if ($request->filterNama) {
            $data = Biodata::where('nama', 'like', '%' . $request->filterNama . '%')->get();
        } else {
            $data = Biodata::all();
        }
        // @dd($data);
        if (count($data) > 0) {
            return response()->json([
                'message' => 'Data berhasil ditemukan',
                'data' => $data
            ]);
        } else {
            return response()->json(['message' => 'Data Kosong']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Lakukan validasi jika diperlukan
        // Simpan data ke dalam database
        $biodata = new Biodata;
        $biodata->nim = $request->modalNim;
        $biodata->nama = $request->modalNama;
        $biodata->email = $request->modalEmail;
        $biodata->jurusan = $request->modalJurusan;
        // Tambahkan field lainnya sesuai kebutuhan
        $biodata->save();

        // Kirim respons
        return response()->json(['message' => 'Data inserted successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBiodataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBiodataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function show(Biodata $biodata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function edit(Biodata $biodata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBiodataRequest  $request
     * @param  \App\Models\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdateBiodataRequest $request, Biodata $biodata)
    // {
    //     //
    // }
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirimkan

        $validatedData = $request->validate([
            'nimMhs' => 'required',
            'namaMhs' => 'required',
            'emailMhs' => 'required',
            // 'emailMhs' => 'required|email',
            'jurusanMhs' => 'required',
        ]);

        // Temukan data berdasarkan ID
        $biodata = Biodata::find($id);


        // Periksa apakah data ditemukan
        if (!$biodata) {
            // Jika tidak ditemukan, kirimkan respons dengan status 404
            return response()->json(['message' => 'Data not found'], 404);
        }

        // Update data
        $biodata->update([
            'nim' => $request->nimMhs,
            'nama' => $request->namaMhs,
            'email' => $request->emailMhs,
            'jurusan' => $request->jurusanMhs
        ]);
        // Kirim respons dengan status 200
        return response()->json(['message' => 'Data updated successfully'], 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Biodata $biodata)
    // {
    //     //
    // }

    public function destroy($id)
    {
        Biodata::where('id', $id)->delete();
        // return redirect('/')->with('status', 'Data mahasiswa berhasil dihapus');
        return response()->json(['message' => 'Data deleted successfully'], 200);
    }

    public function pageNavMulti($curHal, $maxHal, $jmlTampil, $fungsi)
    {
        $linkHal = '';
        $angka = '';
        $halTengah = round($jmlTampil / 2);
        if ($maxHal > 1) {
            if ($curHal > 1) {
                $previous = $curHal - 1;
                $linkHal = $linkHal . "<ul class='pagination'><li class='page-item'><a class='page-link' onclick='" . $fungsi . "(1)'> First</a></li>";
                $linkHal = $linkHal . "<li class='page-item'><a class='page-link' onclick='" . $fungsi . "($previous)'>Prev</a></li>";
            } elseif (empty($curHal) || $curHal == 1) {
                $linkHal = $linkHal . "<ul class='pagination'><li class='page-item'><a class='page-link'>First</a></li><li class='page-item'><a class='page-link'>Prev</a></li> ";
            }

            for ($i = $curHal - ($halTengah - 1); $i < $curHal; $i++) {
                if ($i < 1)
                    continue;
                $angka .= "<li class='page-item'><a class='page-link' onclick='" . $fungsi . "($i)'>$i</a></li>";
            }
            $angka .= "<li class='page-item active'><span class='page-link'><b >$curHal</b> <span class='sr-only'>(current)</span></span></li>";
            for ($i = $curHal + 1; $i < ($curHal + $halTengah); $i++) {
                if ($i > $maxHal)
                    break;
                $angka .= "<li class='page-item'><a class='page-link' onclick='" . $fungsi . "($i)'>$i</a></li> ";
            }
            $linkHal = $linkHal . $angka;
            if ($curHal < $maxHal) {
                $next = $curHal + 1;
                $linkHal = $linkHal . "<li class='page-item'><a class='page-link'onclick='" . $fungsi . "($next)'>Next </a></li><li class='page-item'>
				<a class='page-link' onclick='" . $fungsi . "($maxHal)'>Last</a></li> </ul>";
            } else {
                $linkHal = $linkHal . " <li class='page-item'><a class='page-link'>Next</a></li><li class='page-item'><a class='page-link'>Last</a></li></ul>";
            }
        }
        return $linkHal;
    }
}
