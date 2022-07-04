<?php

namespace App\Http\Controllers;

use App\Models\Baby;
use App\Models\Vitamin;
use Illuminate\Http\Request;
use App\Models\Vitaminization;

class VitaminizationController extends Controller {
    public function index() {
        $babies = Baby::with('parents')
                        ->with('vitaminization')
                        ->orderBy('id', 'ASC')->get();
        // dd($babies);
        return view('vitaminizations.index', compact('babies'));
    }

    public function create($id_baby){
        $vit = Vitamin::all();
        $baby = Baby::where('id', $id_baby)->first();
        return view('vitaminizations.create', compact('vit', 'baby'));
    }

    public function store(Request $request, $id_baby) {
        $request->validate([
            'id_vitamin' => 'required',
            'bulan' => 'required',
            'date' => 'required',
        ]);

        $vitamins = Vitaminization::with('baby')
                        ->with('vitamin')
                        ->where('id_vitamin',  $request->id_vitamin)
                        ->where('id_baby', $id_baby)->first();
        // dd($immuns->id_vaccine .'=='. $request->id_vaccine);
        if($vitamins != null){
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('danger', $vitamins->baby->nama." Sudah di vitamin ".$vitamins->vitamin->name);
        }else{
            Vitaminization::create([
                'id_baby' => $id_baby,
                'id_vitamin' => $request->id_vitamin,
                'bulan' => $request->bulan,
                'date' => $request->date,
            ]);

            return redirect('/vitaminization'.'/'.$id_baby.'/show')->with('status', "Data '" . $request->name . "' berhasil ditambahkan");
        }
    }

    public function add($id_baby, $id){
        $vit = Vitamin::where('id', $id)->first();
        $baby = Baby::where('id', $id_baby)->first();
        return view('vitaminizations.addvitamin', compact('vit', 'baby'));
    }

    public function store_vitamin(Request $request, $id_baby) {
        $request->validate([
            'id_vitamin' => 'required',
            'bulan' => 'required',
            'date' => 'required',
        ]);

        $vitamins = Vitaminization::with('baby')
                        ->with('vitamin')
                        ->where('id_vitamin',  $request->id_vitamin)
                        ->where('id_baby', $id_baby)->first();
        // dd($immuns->id_vaccine .'=='. $request->id_vaccine);
        if($vitamins != null){
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('danger', $vitamins->baby->nama." Sudah di vitamin ".$vitamins->vitamin->name);
        }else{
            Vitaminization::create([
                'id_baby' => $id_baby,
                'id_vitamin' => $request->id_vitamin,
                'bulan' => $request->bulan,
                'date' => $request->date,
            ]);

            return redirect('/vitaminization'.'/'.$id_baby.'/show')->with('status', "Data '" . $request->name . "' berhasil ditambahkan");
        }
    }

    public function show($id_baby){
        $vit = Vitaminization::with('baby')
                        ->with('vitamin')
                        ->where('id_baby', $id_baby)->get();
        $baby = Baby::where('id', $id_baby)->first();
        return view('vitaminizations.show', compact('vit', 'baby'));
    }

    public function edit($id_baby, $id){
        $vit = Vitaminization::where('id', $id)->first();
        $baby = Baby::where('id', $id_baby)->first();
        $vitamins = Vitamin::all();
        return view('vitaminizations.edit', compact('vit', 'baby', 'vitamins'));
    }

    public function update(Request $request, $id_baby, $id){
        $request->validate([
            'id_vitamin' => 'required',
            'bulan' => 'required',
            'date' => 'required',
        ]);

        $vitamins = Vitaminization::with('baby')
                        ->with('vitamin')
                        ->where('id_vitamin',  $request->id_vitamin)
                        ->where('id_baby', $id_baby)->first();
        // dd($immuns->id_vaccine .'=='. $request->id_vaccine);
        if($vitamins != null){
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('danger', $vitamins->baby->nama." Sudah di vitamin ".$vitamins->vitamin->name);
        }else{
            Vitaminization::where('id', $id)->update([
                'id_baby' => $id_baby,
                'id_vitamin' => $request->id_vitamin,
                'bulan' => $request->bulan,
                'date' => $request->date,
            ]);

            return redirect('/vitaminization'.'/'.$id_baby.'/show')->with('status', "Data '" . $request->name . "' berhasil diubah");
        }
    }

    public function destroy($id_baby, $id){
        $vit = Vitaminization::where('id', $id)->first();
        $vit->delete();
        return redirect('/vitaminization'.'/'.$id_baby.'/show')->with('status', "Data '" . $vit->name . "' berhasil dihapus");
    }
}
