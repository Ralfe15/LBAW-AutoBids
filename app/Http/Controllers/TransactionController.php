<?php

namespace App\Http\Controllers;

use App\Models\BankTransfer;
use App\Models\Paypal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{

    public function show($id)
    {
        $paypal = Paypal::find($id);

        return view('pages.paypal', ['paypal' => $paypal]);
    }

    public function list()
    {
        if (!Auth::check()) return redirect('/login');
        $this->authorize('list', Card::class);
        $paypal = Auth::user()->paypal()->orderBy('id')->get();
        return view('pages.my_paypal', ['paypal' => $paypal]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $rules = array(
            'type' => Rule::in(['Deposit','Withdraw']),
            'transaction' => Rule::in(['Paypal','BankTransfer'])
        );
        if ($data['type'] == 'Deposit'){
            $rules+=['value'=> 'required|integer'];
        }
        elseif ($data['type'] == 'Withdraw') {
            $current_credits = Auth::user()->credits/100;

            $rules+=['value'=> "required|integer|lte:$current_credits"];
            info($current_credits);
        }


        if($data['transaction']  == 'Paypal'){
            $rules+=['email'=> 'required|email'];
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new paypal instance after validation
     *
     */

    public function create(Request $request)
    {
        $this->validator($request->all())->validate();
        if (!Auth::check()) {
            redirect('/home');
        }
        $id_member = Auth::user()->id;

        $transaction = null;

        if($request->input('transaction') == 'Paypal') {
            $transaction = new Paypal();
            $transaction->email = $request->input('email');
        }
        elseif($request->input('transaction') == 'BankTransfer'){
            $transaction = new BankTransfer();
        }

        $transaction->type = $request->input('type');
        $transaction->value = $request->input('value') * 100;
        $transaction->id_member = $id_member;

        $transaction->save();

        if($transaction->transaction == 'Paypal') {
            if($transaction->type == 'Deposit') {
                Auth::user()->increment('credits', $transaction->value);
            }
            elseif($transaction->type == 'Withdraw') {
                Auth::user()->decrement('credits', $transaction->value);
            }
        }


        //change redirect to auction details
        return redirect('/home');
    }

    public function approve($id)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $transaction = BankTransfer::find($id);
            $transaction->approved = true;
            $transaction->save();

            if($transaction->type == 'Deposit') {
                Auth::user()->increment('credits', $transaction->value);
            }
            elseif($transaction->type == 'Withdraw') {
                Auth::user()->decrement('credits', $transaction->value);
            }

            return redirect('/admin');
        }
    }

    public function showTransactionForm()
    {
        if (!Auth::check()) {
            return redirect('/home');
        }
        $current_credits = Auth::user()->credits;
        return view('pages.transactionCreate', ['transaction' => null, 'current_credits' => $current_credits]);
    }
}
