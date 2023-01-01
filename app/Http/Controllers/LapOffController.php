<?php

namespace App\Http\Controllers;

use App\Model\lap_offline;
use Illuminate\Http\Request;
use Image;

class LapOffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = lap_offline::orderBy('created_at', 'desc')->get();
        return view('lap_offline.show', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lap_offline.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new lap_offline;
        $data->name = $request->name;
        $data->keterangan = $request->keterangan;
        $data->debit = $request->debit;
        $data->credit = $request->credit;

        $image = $request->file('nota');
        if (empty($image)) {

        } else {
            $input['imagename'] = time() . '.' . $image->extension();
            $target = storage_path() . '/app/public/invoice/' . $input['imagename'];
            $img = Image::make($image->path());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($target);
            $data->nota = $input['imagename'];
        }

        // dd($image);
        $data->save();
        return redirect(route('lap_off.index'));
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
        $data = lap_offline::find($id);
        return view('lap_offline.edit', compact('data'));
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
        $data = lap_offline::find($id);
        $data->name = $request->name;
        $data->keterangan = $request->keterangan;
        $data->debit = $request->debit;
        $data->credit = $request->credit;

        $image = $request->file('nota');
        if (empty($image)) {

        } else {
            $path = storage_path() . '/app/public/invoice/' . $data->nota;
            if(file_exists($path)){
                unlink($path);
            }

            $input['imagename'] = time() . '.' . $image->extension();
            $target = storage_path() . '/app/public/invoice/' . $input['imagename'];
            $img = Image::make($image->path());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($target);
            $data->nota = $input['imagename'];
        }

        // dd($image);
        $data->save();
        return redirect(route('lap_off.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = lap_offline::find($id);

        if (empty($data->nota)) {

        } else {
            $path = storage_path() . '/app/public/invoice/' . $data->nota;
            if(file_exists($path)){
                unlink($path);
            }
        }

        lap_offline::where('id', $id)->delete();
        return redirect()->back();
    }

    public function detail($id)
    {
        $data = lap_offline::where('id', $id)->first();
        return view('lap_offline.detail', compact('data'));
    }

}
