<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Alert;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier=\App\Models\Supplier::All();
        return view('admin.supplier.supplier',['supplier'=>$supplier]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.input');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tambah_supplier=new \App\Models\Supplier;
        $tambah_supplier->kd_supp = $request->addkdsupp;
        $tambah_supplier->nm_supp = $request->addnmsupp;
        $tambah_supplier->alamat = $request->addalamat;
        $tambah_supplier->telepon = $request->addtelepon;
        $tambah_supplier->save();
        Alert::success('Pesan ','Data berhasil disimpan');
        return redirect('/supplier');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier_edit=\App\Models\Supplier::findOrFail($id);
        return view('admin.supplier.editSupplier',['supplier'=>$supplier_edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supplier=\App\Models\Supplier::findOrFail($id);
        $supplier->kd_supp=$request->get('addkdsupp');
        $supplier->nm_supp=$request->get('addnmsupp');
        $supplier->alamat=$request->get('addalamat');
        $supplier->telepon=$request->get('addtelepon');
        $supplier->save();
        return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier=\App\Models\Supplier::findOrFail($id);
        $supplier->delete();
        Alert::success('Pesan ','Data berhasil dihapus');
        return redirect()->route('supplier.index');
    }
}
