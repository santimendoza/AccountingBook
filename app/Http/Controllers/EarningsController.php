<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Earnings\Earnings;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EarningsCategories\EarningsCategories;
use App\Models\DateFunctions;
use Auth;

class EarningsController extends Controller {

    public function index() {
        $dates = DateFunctions::firstAndLastDayOfActualMonth();
        $monthstartday = $dates[0];
        $monthendday = $dates[1];
        $monthstartdaystring = DateFunctions::dateToString($dates[0]);
        $monthenddaystring = DateFunctions::dateToString($dates[1]);
        $earnings = Earnings::whereRaw('user_id = ? and date <= ? and date >= ?', [
                    Auth::user()->id, $monthenddaystring, $monthstartdaystring
                ])->orderBy('date')->get();
        if ($earnings->count() < 1) {
            return redirect('/earnings/create')->withErrors('Parace que aún no tienes ningún ingreso registrado este mes. Agrega uno.', 'earningsError');
        }
        $data = ['earnings' => $earnings, 'date1' => $monthstartday, 'date2' => $monthendday];
        return view('earnings.index')->with($data);
    }

    public function create() {
        $categories = EarningsCategories::whereRaw('user_id = ?', [Auth::user()->id])->get();
        if ($categories->count() < 1) {
            return redirect('/categories/earnings/create')->withErrors('Parece que aún no tienes categorías. Crea una en el siguiente formulario.');
        }
        return view('earnings.create')->with('categories', $categories);
    }

    public function store(Request $request) {
        $rules = [
            'amount' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'earningsCategory_id' => 'required'
        ];
        $this->validate($request, $rules);
        $request['date'] = str_replace('-', '', $request['date']);
        $request['user_id'] = Auth::user()->id;
        Earnings::create($request->all());
        $user = User::find(Auth::user()->id);
        $user->balance = $user->balance + $request['amount'];
        $user->save();
        return redirect('earnings');
    }

    public function show($id) {
        return redirect('/earnings/' . $id . '/edit');
    }

    public function edit($id) {
        $earning = Earnings::find($id);
        $date = strtotime($earning->date);
        $earning->date = date('Y-m-d', $date);
        $categories = EarningsCategories::whereRaw('user_id = ?', [Auth::user()->id])->get();
        $data = ['earning' => $earning, 'categories' => $categories];
        return view('earnings.edit')->with($data);
    }

    public function update(Request $request, $id) {
        $rules = [
            'amount' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'earningsCategory_id' => 'required'
        ];
        $this->validate($request, $rules);
        $earning = Earnings::find($id);
        $earning->amount = $request['amount'];
        $earning->description = $request['description'];
        $earning->earningsCategory_id = $request['earningsCategory_id'];
        $earning->date = str_replace('-', '', $request['date']);
        $earning->save();
        return redirect('earnings');
    }

    public function destroy($id) {
        $earning = Earnings::find($id);
        if ($earning->count() >= 1) {
            $user = User::find(Auth::user()->id);
            $user->balance = $user->balance - $earning->amount;
            $earning->delete();
            $user->save();
        }
        return redirect('earnings');
    }

}
