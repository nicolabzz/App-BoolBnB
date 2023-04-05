<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Apartment;
use App\Sponsorship;
use Braintree\Gateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{

    public function index()
    {
        $sponsorships = Sponsorship::all();
        $apartments = Apartment::all();

        return view('admin.sponsorships.index', [
            'sponsorships'  => $sponsorships,
            'apartments'    => $apartments
        ]);
    }

    // public function show(Sponsorship $sponsorship)
    // {
    //     return view('admin.sponsorships.show', compact('sponsorship'));
    // }

    public function payment(Request $request) {
        $user = Auth::user();
        $apartments = Apartment::all();
        $value = $request->value;
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => '7jxbczhxqzdxss5x',
            'publicKey' => '53c4z9cm28vj59nn',
            'privateKey' => '8425f998431f73bd871fd50a194670f4'
        ]);
        $token = $gateway->ClientToken()->generate();
        return view('admin.sponsorships.show', [
            'token' =>  $token,
            'value' =>  $value,
            'user'  =>  $user,
            'apartments'  =>  $apartments,
        ]);
    }

    public function checkout(Request $request) {
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => '7jxbczhxqzdxss5x',
            'publicKey' => '53c4z9cm28vj59nn',
            'privateKey' => '8425f998431f73bd871fd50a194670f4'
        ]);
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        if ($result->success) {
            $transaction = $result->transaction;
            $user = User::find(Auth::user()->id);
            return back()->with('success_message', 'Transazione eseguita con successo. ID transazione: ' .$transaction->id);
        } else {
            $errorString = '';
            foreach ($result->errors->deepAll() as  $error) {
                $errorString .= 'Error: ' . $error->code . ': ' . $error->message . '\n';
            }
            return back()->withErrors('C\'è stato un errore: ' .$result->message );
        }
    }
}
