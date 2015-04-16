<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpensesCategories\ExpensesCategories;
use App\Models\Expenses\Expenses;
use App\Models\Savings\Savings;
use App\Models\AddToSavings\AddToSavings;
use App\Models\User;
use Auth;

class SavingsController extends Controller {

    public function index() {
        $savings = Savings::whereRaw('user_id = ?', [Auth::user()->id])->get();
        if ($savings->count() < 1) {
            return redirect('/savings/create')->withErrors('Parece que no tienes ningún ahorro, crea uno.', 'savingsError');
        }
        return view('savings.index')->with('savings', $savings);
    }

    public function create() {
        return view('savings.create');
    }

    public function store(Request $request) {
        $rules = [
            'amount' => 'required|numeric',
            'description' => 'required',
            'title' => 'required',
        ];
        $this->validate($request, $rules);
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $request['user_id'] = $userid;
        Savings::create($request->all());
        $user->balance = $user->balance - $request['amount'];
        $user->save();
        return redirect('savings');
    }

    public function show($id) {
        return redirect('/savings/' . $id . '/edit');
    }

    public function edit($id) {
        $saving = Savings::find($id);
        $data = ['saving' => $saving];
        return view('savings.edit')->with($data);
    }

    public function update($id, Request $request) {
        $rules = [
            'amount' => 'required|numeric',
            'description' => 'required',
            'title' => 'required',
        ];
        $this->validate($request, $rules);
        $request['user_id'] = Auth::user()->id;
        $saving = Savings::find($id);
        $saving['amount'] = $request['amount'];
        $saving['title'] = $request['title'];
        $saving['description'] = $request['description'];
        $saving->save();
        return redirect('savings');
    }

    public function destroy($id) {
        $saving = Savings::find($id);
        if ($saving->count() >= 1) {
            $user = User::find(Auth::user()->id);
            $user->balance = $user->balance + $saving->amount;
            $saving->delete();
            $user->save();
        }
        return redirect('savings');
    }

    public function addFounds($id) {
        $saving = Savings::find($id);
        return view('savings.addfounds')->with('saving', $saving);
    }

    public function updateAmount($id, Request $request) {
        $rules = [
            'amount' => 'required'
        ];
        $this->validate($request, $rules);
        $request['date'] = date('Ymd');
        $request['user_id'] = Auth::user()->id;
        $request['savings_id'] = $id;
        $saving = Savings::find($id);
        AddToSavings::create($request->all());
        $saving->amount = $saving->amount + $request['amount'];
        $saving->addedfounds = true;
        $user = User::find(Auth::user()->id);
        $user->balance = $user->balance - $request['amount'];
        $user->save();
        $saving->save();
        return redirect('/savings');
    }

    public function useFounds($id) {
        $savingsError = 'Para usar los fondos de ahorros, debes agregar un gasto, para que sepas en que los usaste.';
        $categories = ExpensesCategories::whereRaw('user_id = ?', [Auth::user()->id])->get();
        $data = ['savings_id' => $id, 'savingsError' => $savingsError, 'categories' => $categories];
        return view('savings.usefounds')->with($data);
    }

    public function usedFounds($id, Request $request) {
        $rules = [
            'amount' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'expensesCategory_id' => 'required'
        ];
        $this->validate($request, $rules);
        $request['date'] = str_replace('-', '', $request['date']);
        $request['user_id'] = Auth::user()->id;
        Expenses::create($request->all());
        $saving = Savings::find($id);
        if ($saving->count() >= 1) {
            $user = User::find(Auth::user()->id);
            if ($request['amount'] < $saving->amount) {
                $saving->amount = $saving->amount - $request['amount'];
                $saving->save();
            } else {
                $saving->delete();
                if ($request['amount'] > $saving->amount) {
                    $user->balance = $user->balance - ($request[amount] - $saving->amount);
                    $user->save();
                }
            }
        }
        return redirect('savings');
    }

}
