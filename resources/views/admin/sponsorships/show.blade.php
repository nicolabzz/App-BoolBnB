@extends('layouts.app')

@section('content')
<div class="container p-5 sponsor-payment">
        {{-- @if($value == 'Pacchetto Silver')
            title-silver
        @elseif($value == 'Pacchetto Gold')
            title-gold
        @elseif($value == 'Pacchetto Platinum')
            title-platinum
        @endif"> --}}
        <h1 class="text-center">Payment</h1>

        @if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}<br>
                <br><span>Turn back to your <a href="{{ route('admin.apartments.index', ['apartments' => $apartments])}}">apartments</a>.</span>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all as $error)
                        <li>{{ $error->message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" id="payment-form" action="{{ url('/admin/checkout') }}">
            @csrf
            <section>
                <label for="amount">
                    <span class="input-label">You are buying {{ strtoupper($value) }}.</span>
                    <div class="input-wrapper amount-wrapper">
                        <input id="amount" name="amount" type="hidden" min="1" placeholder="Amount" value="@if ($value=='Bronze Sponsorship' ) 2.99 @elseif ($value=='Silver Sponsorship')5.99 @elseif($value=='Gold Sponsorship')9.99 @endif" readonly>
                    </div>
                </label>

                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
            </section>
            <div class="text-center mt-3">
                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button class="btn btn-success text-center" type="submit"><span>Payment</span></button>
            </div>
        </form>

    </div>
    <script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>
        <script>
            var form = document.querySelector('#payment-form');
            var client_token = "{{ $token }}";

            braintree.dropin.create({
                authorization: client_token,
                selector: '#bt-dropin',
                paypal: {
                    flow: 'vault'
                }
            }, function(createErr, instance) {
                if (createErr) {
                    console.log('Create Error', createErr);
                    return;
                }
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    instance.requestPaymentMethod(function(err, payload) {
                        if (err) {
                            console.log('Request Payment Method Error', err);
                            return;
                        }

                        // Add the nonce to the form and submit
                        document.querySelector('#nonce').value = payload.nonce;
                        form.submit();
                    });
                });
            });
        </script>
@endsection
