<?php

namespace App\Http\Controllers;

use App\Models\Paypal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PaypalController extends Controller
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
        return Validator::make($data, [
            'value' => 'required|integer',
            'email' => 'required|email',
            'type' => Rule::in(['Deposit','Withdraw'])
        ]);
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


        $paypal = new Paypal();
        $paypal->type = $request->input('type');
        $paypal->email = $request->input('email');
        $paypal->value = $request->input('value') * 100;
        $paypal->id_member = $id_member;
        $paypal->approved = true;
        $paypal->save();

        //change redirect to auction details
        return redirect('/home');
    }

    public function approve($id)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $paypal = Paypal::find($id);
            $paypal->approved = true;
            $paypal->active = true;
            $paypal->start_date = now();
            $paypal->save();
            return redirect('/admin');
        }
    }

    public function showPaypalForm()
    {
        if (!Auth::check()) {
            return redirect('/home');
        }
        $current_credits = Auth::user()->credits;
        return view('pages.paypalCreate', ['paypal' => null, 'current_credits' => $current_credits]);
    }
}
