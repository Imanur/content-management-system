<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Runningtext;

class RunningTextController extends Controller
{
    public function index()
    {
        $data = Runningtext::get();
        return view('admin.runningtext.index', compact('data'));
    }

    public function create()
    {
        $category = Runningtext::get();
        return view('admin.runningtext.create', compact('category'));
    }

    public function insert(Request $request)
    {
        $request->validate(Runningtext::$rules);
        $requests = $request->all();
        $requests['image'] = "";
        if ($request->hasFile('image')) {
            $files = Str::random("20") . "-" . $request->image->getClientOriginalName();
            $request->file('image')->move("file/runningtext/", $files);
            $requests['image'] = "file/runningtext/" . $files;
        }

        $cat = Runningtext::create($requests);
        if($cat){
            return redirect('admin/runningtext')->with('status', 'Berhasil menambah data !');
        }

        return redirect('admin/runningtext')->with('status', 'Gagal menambah data !');
    }

    public function edit($id)
    {
        $data   = Runningtext::find($id);
        $runningtext   = Runningtext::get();
        return view('admin.runningtext.edit', compact('data', 'runningtext'));
    }

    public function update(Request $request, $id)
    {
        $d = Runningtext::find($id);
        if ($d == null) {
            return redirect('admin/runningtext')->with('status', 'Data tidak ditemukan !');
        }

        $req = $request->all();

        if ($request->hasFile('image')) {
            if ($d->image !== null) {
                File::delete("$d->image");
            }
            $runningtext = Str::random("20") . "-" . $request->image->getClientOriginalName();
            $request->file('image')->move("file/runningtext/", $runningtext);
            $req['image'] = "file/runningtext/" . $runningtext;
        }

        $data = Runningtext::find($id)->update($req);
        if ($data) {
            return redirect('admin/runningtext')->with('status', 'runningtext berhasil diedit !');
        }
        return redirect('admin/runningtext')->with('status', 'Gagal edit runningtext !');

    }

    public function delete($id)
    {
        $data = Runningtext::find($id);
        if ($data == null) {
            return redirect('admin/runningtext')->with('status', 'Data tidak ditemukan !');
        }
        if ($data->image !== null || $data->image !== "") {
            File::delete("$data->image");
        }
        $delete = $data->delete();
        if ($delete) {
            return redirect('admin/runningtext')->with('status', 'Berhasil hapus runningtext !');
        }
        return redirect('admin/runningtext')->with('status', 'Gagal hapus runningtext !');
    }
}
