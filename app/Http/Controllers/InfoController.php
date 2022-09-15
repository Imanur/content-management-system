<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Info;

class InfoController extends Controller
{
    public function index()
    {
        $data = Info::get();
        return view('admin.info.index', compact('data'));
    }

    public function create()
    {
        $category = Info::get();
        return view('admin.info.create', compact('category'));
    }

    public function insert(Request $request)
    {
        $request->validate(Info::$rules);
        $requests = $request->all();
        $requests['image'] = "";
        if ($request->hasFile('image')) {
            $files = Str::random("20") . "-" . $request->image->getClientOriginalName();
            $request->file('image')->move("file/info/", $files);
            $requests['image'] = "file/info/" . $files;
        }

        $cat = Info::create($requests);
        if($cat){
            return redirect('admin/info')->with('status', 'Berhasil menambah data !');
        }

        return redirect('admin/info')->with('status', 'Gagal menambah data !');
    }

    public function edit($id)
    {
        $data       = Info::find($id);
        $info   = Info::get();
        return view('admin.info.edit', compact('data', 'info'));
    }

    public function update(Request $request, $id)
    {
        $d = Info::find($id);
        if ($d == null) {
            return redirect('admin/info')->with('status', 'Data tidak ditemukan !');
        }

        $req = $request->all();

        if ($request->hasFile('image')) {
            if ($d->image !== null) {
                File::delete("$d->image");
            }
            $info = Str::random("20") . "-" . $request->image->getClientOriginalName();
            $request->file('image')->move("file/info/", $info);
            $req['image'] = "file/info/" . $info;
        }

        $data = Info::find($id)->update($req);
        if ($data) {
            return redirect('admin/info')->with('status', 'info berhasil diedit !');
        }
        return redirect('admin/info')->with('status', 'Gagal edit info !');

    }

    public function delete($id)
    {
        $data = Info::find($id);
        if ($data == null) {
            return redirect('admin/info')->with('status', 'Data tidak ditemukan !');
        }
        if ($data->image !== null || $data->image !== "") {
            File::delete("$data->image");
        }
        $delete = $data->delete();
        if ($delete) {
            return redirect('admin/info')->with('status', 'Berhasil hapus info !');
        }
        return redirect('admin/info')->with('status', 'Gagal hapus info !');
    }
}
