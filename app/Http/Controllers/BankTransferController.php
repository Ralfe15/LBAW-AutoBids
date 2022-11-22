<?php

namespace App\Http\Controllers;

use App\Models\BankTransfer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankTransferController extends Controller
{

    public function show($id)
    {
        $banktransfer = BankTransfer::find($id);

        return view('pages.banktransfer', ['banktransfer' => $banktransfer]);
    }

    public function list()
    {
        if (!Auth::check()) return redirect('/login');
        $this->authorize('list', Card::class);
        $banktransfers = Auth::user()->banktransfer()->orderBy('id')->get();
        return view('pages.my_banktransfers', ['banktransfers' => $banktransfers]);
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
            'type' => Rule::in(['Deposit','Withdraw'])
        ]);
    }

    /**
     * Create a new auction instance after validation
     *
     */

    public function create(Request $request)
    {
        $this->validator($request->all())->validate();
        if (!Auth::check()) {
            redirect('/home');
        }
        $id_member = Auth::user()->id;


        $banktransfer = new BankTransfer();
        $banktransfer->type = $request->input('type');
        $banktransfer->value = $request->input('value') * 100;
        $banktransfer->id_member = $id_member;

        $banktransfer->save();

        //change redirect to auction details
        return redirect('/home');
    }

    public function approve($id)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            $banktransfer = BankTransfer::find($id);
            $banktransfer->approved = true;
            $banktransfer->save();
            return redirect('/admin');
        }
    }
}
