<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Biodata;

class BiodataController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $biodata = Biodata::orderBy('id', 'DESC')->paginate(5);
        return view('biodata.list', compact('biodata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('biodata.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required'
        ]);
        Biodata::create($request->all());

        return redirect('biodata')->with('status', $this->message_status('success', 'Data berhasil ditambah!'));
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
        $biodata = Biodata::findOrFail($id);
        if($biodata) {
            return view('biodata.edit', compact('biodata'));
        } else {
            return redirect('biodata')->with('status', $this->message_status('danger', 'Data tidak ditemukan!'));
        }
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
        $biodata = Biodata::findOrFail($id);
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required'
        ]);
        if($biodata) {
            $biodata->update($request->all());
            return redirect('biodata')->with('status', $this->message_status('success', 'Data berhasil diubah!'));
        } else {
            return redirect('biodata')->with('status', $this->message_status('danger', 'Data yang diubah tidak ditemukan!'));
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
        $biodata = Biodata::findOrFail($id);
        if($biodata) {
            $biodata->delete();
            return redirect('biodata')->with('status', $this->message_status('success', 'Data berhasil dihapus!'));
        } else {
            return redirect('biodata')->with('status', $this->message_status('danger', 'Data gagal dihapus!'));
        }
    }

    public function search(Request $request) 
    {
        $search = $request->cari;
        if($search) {
            $biodata = Biodata::orderBy('id', 'DESC')->where('nama', 'like', "%" . $search . "%")->paginate(5);
            return view('biodata.list', compact('biodata'));
        } else {
            return redirect('biodata');
        }
    }

    private function message_status($type, $message) {
        $html = '<div class="alert alert-' . $type . '">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </button>' . $message . '
                </div>';
        return $html;
    }
}
