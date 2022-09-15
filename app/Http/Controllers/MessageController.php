<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $data = Message::get();
        return view('admin.message.index', compact('data'));
    }

    public function create()
    {
        $data = Message::get();
        return view('admin.message.create', compact('data'));
    }

    // public function insert(Request $request)
    // {
    //     $request->validate(Message::$rules);
    //     $requests = $request->all();

    //     $message = Message::create($requests);
    //     if($message){
    //         return redirect()->back()->with('status', 'Komentar berhasil dibuat !');
    //     }

    //     return redirect()->back()->with('status', 'Gagal memberikan komentar!');
    // }
    public function insert(Request $request)
    {
        $request->validate(Message::$rules);
        $requests = $request->all();

        $mes = Message::create($requests);
        if ($mes) {
            return redirect('admin/message')->with('status', 'Berhasil menambah data!');
        }
        return redirect('admin/message')->with('status', 'Gagal menambahkan data!');
    }
    
    public function edit($id)
    {
        $data = Message::find($id);
        return view('admin.message.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $d = Message::find($id);
        if ($d == null) {
            return redirect('admin/message')->with('status', 'Data tidak ditemukan');
        }
        $req = $request->all();
        $data = Message::find($id)->update($req);
        if ($data) {
            return redirect('admin/category')->with('status', 'Category berhasil diupdate');
        }
        return redirect('admin/category')->with('status', 'Gagal edit category');
    }
    public function delete($id)
    {
        $data = Message::find($id);
        if ($data == null) {
            return redirect('admin/category')->with('status', 'Data tidak ditemukan');
        }
        $delete = $data->delete();
        if ($delete) {
            return redirect('admin/message')->with('status', 'Berhasil hapus data');
        }
        return redirect('admin/message')->with('status', 'Gagal hapus data');
    }
}
