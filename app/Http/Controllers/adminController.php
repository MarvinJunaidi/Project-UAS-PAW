<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    public function adminDashboard()
    {
        $user = Auth::user();
        if ($user->role == 'user') {
            return redirect('/');
        }
        $data = Pesanan::get();
        $total = count($data);
        return view('web-admin.dashboard', compact('total'));
    }
    public function pesananAdmin()
    {
        $user = Auth::user();
        if ($user->role == 'user') {
            return redirect('/');
        }
        $data = Pesanan::get();
        return view('web-admin.pesanan', compact('data'));
    }
    public function profileAdmin()
    {
        $user = Auth::user();
        if ($user->role == 'user') {
            return redirect('/');
        }
        return view('web-admin.profile', compact('user'));
    }
    public function terima($id)
    {
        $data =  Pesanan::where('id', $id)->first();
        $data->status = 'Pesanan diterima';
        $data->estimasi = Carbon::parse($data->tanggal_pesan)->addDays(5);
        $data->save();

        return redirect()->back()->with('success', 'Pesanan berhasil di terima');
    }
    public function tolak($id)
    {
        $data =  Pesanan::where('id', $id)->first();
        $data->status = 'Pesanan ditolak';
        $data->save();

        return redirect()->back()->with('success', 'Pesanan berhasil di tolak');
    }
    public function updateProfile(Request $r)
    {
        $user = Auth::user();
        $data = User::where('username', $user->username)->first();
        if (!empty($r->username)) {
            $data->username = $r->username;
            $data->save();
        }
        if (!empty($r->password)) {
            $data->password = Hash::make($r->password);
            $data->save();
        }
        return redirect()->back()->with('success', 'Berhasil di update');
    }

    public function produkAdmin()
    {
        $data = Produk::get();
        return view('web-admin.produkAdmin', compact('data'));
    }

    public function produkAdminAdd(Request $r)
    {
        // Validasi input
        $validated = $r->validate([
            'foto_produk' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'motif' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'harga' => 'required|numeric',
        ]);

        // Mengambil file gambar yang diupload
        if ($r->hasFile('foto_produk')) {
            // Mengambil file
            $file = $r->file('foto_produk');

            // Menyimpan file dengan nama asli langsung di public
            $fileName = $file->getClientOriginalName();

            // Pindahkan file ke folder public
            $file->move(public_path(), $fileName);

            // Menyimpan data ke database
            Produk::create([
                'foto_produk' => $fileName, // Menyimpan nama file tanpa folder
                'motif' => $r->motif,
                'title' => $r->title,
                'sub_title' => $r->sub_title,
                'harga' => $r->harga,
            ]);

            return redirect()->back()->with('success', 'Berhasil di tambahkan');
        }
    }
    public function produkAdminDelete($id){
Produk::where('id',$id)->delete();
            return redirect()->back()->with('success', 'Berhasil hapus data');

    }
public function produkAdminUpdate(Request $request,$id){
      // Ambil data produk berdasarkan ID
    $produk = Produk::findOrFail($id);

    // Validasi data yang diterima
    $request->validate([
        'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi foto produk
        'motif' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'sub_title' => 'required|string|max:255',
        'harga' => 'required|numeric|min:0',
    ]);

    // Cek apakah ada file foto baru yang diupload
    if ($request->hasFile('foto_produk')) {
        // Hapus foto lama dari server jika ada
        $oldFile = public_path($produk->foto_produk);
        if (file_exists($oldFile)) {
            unlink($oldFile); // Menghapus foto lama
        }

        // Ambil nama file asli dari foto yang diupload
        $fileName = $request->file('foto_produk')->getClientOriginalName(); // Gunakan nama file asli

        // Tentukan path folder tujuan di dalam public
        $destinationPath = public_path();

        // Pindahkan file ke folder public dengan nama file yang sama
        $request->file('foto_produk')->move($destinationPath, $fileName);

        // Set foto_produk dengan path baru
        $produk->foto_produk = $fileName; // Simpan hanya nama file, path relatif
    }

    // Update data produk lainnya
    $produk->motif = $request->input('motif');
    $produk->title = $request->input('title');
    $produk->sub_title = $request->input('sub_title');
    $produk->harga = $request->input('harga');

    // Simpan perubahan produk
    $produk->save();
            return redirect()->back()->with('success', 'Berhasil edit data');


}
}
