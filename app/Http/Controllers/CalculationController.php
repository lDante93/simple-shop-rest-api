<?php

namespace App\Http\Controllers;

use App\Calculation;
use App\WorkersSalaries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CalculationController extends Controller
{
    public function cashbox(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cashbox_a' => 'required|integer',
            'income.takings' => 'required|integer',
            'income.reservations' => 'integer',
            'income.others' => 'integer',

            'costs.shopping' => 'integer',
            'costs.salaries.*' => 'integer',
            'costs.others' => 'integer',
        ]);
            $salaries_sum = 0;
            foreach ($request['costs']['salaries'] as $key => $value)
            {
                $worker[$key] = $value;
                $salaries_sum += $value;
            }


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $data = $request->all();

        $cashbox_a = $data['cashbox_a'];
        $income = $data['income'];
        $costs = $data['costs'];

        isset($income['reservations']) ?: $income['reservations'] = 0;
        isset($income['others']) ?: $income['others'] = 0;

        isset($costs['shopping']) ?: $costs['shopping'] = 0;

        isset($costs['others']) ?: $costs['others'] = 0;

        $income_sum = ($income['takings'] + $income['reservations'] + $income['others']);
        $costs_sum = ($costs['shopping'] + $salaries_sum + $costs['others']);

        $cashbox = ($cashbox_a + $income_sum) - $costs_sum;

        $calculation = new Calculation;

        $calculation->user_id = Auth::user()->id;
        $calculation->cashbox_a = $cashbox_a;

        $calculation->takings = $income['takings'];
        $calculation->reservations = $income['reservations'];
        $calculation->income_others = $income['others'];
        $calculation->income_sum = $income_sum;

        $calculation->shopping = $costs['shopping'];
        $calculation->salaries = $salaries_sum;
        $calculation->costs_others = $costs['others'];
        $calculation->costs_sum = $costs_sum;

        $calculation->cashbox = $cashbox;

        $calculation->day_of_the_week = date('l');

        $calculation->save();

        foreach ($worker as $key => $value)
        {
            $salary = new WorkersSalaries;
            $salary->user_id = Auth::user()->id;
            $salary->calculation_id = $calculation->id;
            $salary->worker_id = $key;
            $salary->salary = $value;

            $salary->save();
        }

        return response()->json(['response' => 'succes', 'message' => ['PLN_gr' => $cashbox, 'PLN' => number_format($cashbox / 100, 2)]], 200);
    }

    public function showCashbox(Request $request)
    {
        $calculation = Calculation::all();
        // Get calculations added by the current user only:
        // $calculation = Calculation::where('user_id', Auth::user->id)->get();
        return response()->json($calculation, 200);
    }
}
