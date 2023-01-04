<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Pertanyaan;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    public function index()
    {
        $data["pertanyaan"] = Pertanyaan::orderBy("created_at", "DESC")->get();

        return view("admin.master.pertanyaan.v_index", $data);
    }

    public function store(Request $request)
    {
        Pertanyaan::create($request->all());

        return back();
    }

    public function update(Request $request, $id)
    {
        Pertanyaan::where("id", $id)->update([
            "teks_pertanyaan" => $request->teks_pertanyaan,
            "bobot" => $request->bobot
        ]);

        return back();
    }

    public function destroy($id)
    {
        Pertanyaan::where("id", $id)->delete();

        return back();
    }
}
