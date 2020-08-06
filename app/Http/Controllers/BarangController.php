<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Barang;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangs = DB::table('barangs')->paginate(5);
        return view('index',compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama_barang' => 'required|max:200',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'stok' => 'required|integer',
            'foto_barang' => 'required|image|mimes:png,jpg|max:100'
        ]);
        // $poto = $request->file('foto_barang')->store('foto');
        // $request->foto_barang = $poto;
        $poto = $request->file('foto_barang');
        $image_name = time() . '.' . $poto->getClientOriginalExtension();
        $destinationPath = public_path('img');
        $poto->move($destinationPath,$image_name);
        $poto = $image_name;
        // $poto = $poto->store('img', 'public');

        //return dd($poto);
        //Barang::create($request->all());
        $status = DB::table('barangs')->insert(
            ['nama_barang' => $request->nama_barang, 
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'foto_barang' => $poto
            ]
        );
        if ($status > 0){
            return back()->with('status','Barang berhasil ditambahkan');
        } else {
            return back()->with('fail','Barang gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        return view('detail',compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Barang $barang)
    {
        $this->validate($request,[
            'nama_barang' => 'required|max:200',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'stok' => 'required|integer'
        ]);
        if (is_null($request->foto_barang)) {
            $data = DB::table('barangs')->where('id_barang', $barang->id_barang)->first();
            $poto = $data->foto_barang;
        } else {
            $poto = $request->file('foto_barang');
            $image_name = time() . '.' . $poto->getClientOriginalExtension();
            $destinationPath = public_path('img');
            $poto->move($destinationPath,$image_name);
            $poto = $image_name;
        }
        //return dd($poto);
        $status = DB::table('barangs')
              ->where('id_barang', $barang->id_barang)
              ->update([
                  'nama_barang' => $request->nama_barang,
                  'harga_beli' => $request->harga_beli,
                  'harga_jual' => $request->harga_jual,
                  'stok' => $request->stok,
                  'foto_barang' => $poto
              ]);
        if ($status > 0){
            
            return redirect('/')->with('status','Barang berhasil diperbarui');
        } else {
            return redirect('/')->with('fail','Barang gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Barang::destroy($id);
        return redirect('/')->with('status','Barang berhasil Dihapus');
    }

    public function search(Request $request){
        $barangs = DB::table('barangs')->where('nama_barang','like','%'.$request->search.'%')->paginate(5);
        return view('index',compact('barangs'));
    }

    // public function livesearch(Request $request)
    // { 
    //     $find = DB::table('barangs')->where('nama_barang','like','%'.$request->get('searchQuest').'%')->paginate(5);
    //     return json_encode($find);
    // }

}
