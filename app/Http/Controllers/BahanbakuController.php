<?php

namespace App\Http\Controllers;

use App\Model\bahan_baku;
use Illuminate\Http\Request;

class BahanbakuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = bahan_baku::all();
        return view('bahan_baku.show', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bahan_baku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $items = new bahan_baku;
        $items->nama_bahan = $request->nama_bahan;
        $items->stock = $request->stock;
        $items->satuan = $request->satuan;
        $items->save();
        return redirect(route('bahan_baku.index'))->withSuccessMessage(__('global.data_saved_successfully!'));
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
        $data = bahan_baku::find($id);
        return view('bahan_baku.edit', compact('data'));
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
        $items = bahan_baku::find($id);
        $items->nama_bahan = $request->nama_bahan;
        $items->stock = $request->stock;
        $items->satuan = $request->satuan;
        $items->save();
        return redirect(route('bahan_baku.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        bahan_baku::where('id', $id)->delete();
        return redirect()->back();
    }
}
