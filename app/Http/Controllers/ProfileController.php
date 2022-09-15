<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $data = User::get();
        return view('admin.profile.index', compact('data'));
    }

    public function create()
    {
        return view('admin.profile.create');
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('admin.profile.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $d = User::find($id);
        if ($d == null) {
            return redirect('admin/profile')->with('status', 'Data tidak ditemukan');
        }
        $req = $request->all();
        if ($request->hasFile('image')) {
            if ($d->image !== null) {
                File::delete("$d->image");
            }
            $profile = Str::random("20") . "-" . $request->image->getClientOriginalName();
            $request->file('image')->move("file/profile/", $profile);
            $req['image'] = "file/profile/" . $profile;
        }
        $data = User::find($id)->update($req);
        if ($data) {
            return redirect('admin/profile/index')->with('status', 'Admin berhasil di update');
        }
        return redirect('admin/profile/index')->with('status', 'Gagal edit admin');
    }

    public function delete($id)
    {
        $data = User::find($id);
        if ($data == null) {
            return redirect('admin/profile/index')->with('status', 'Admin tidak ditemukan');
        }
        if ($data->image !== null || $data->image !== "") {
            File::delete("$data->image");
        }
        $delete = $data->delete();
        if ($delete) {
            return redirect('admin/profile/index')->with('status', 'Berhasil hapus admin');
        }
        return redirect('admin/profile/index')->with('status', 'Gagal hapus admin');
    }
}
