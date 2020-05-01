@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-3"></div>

        <div class="col-sm-6">
            <div class="card">

                <div class="card-body p-0">
                    @if(session('status'))
                        <div class="alert alert-success m-3" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="col-sm-12 p-3">
                    
                        <h6 class="text-center">Default Payment Method</h6>
                        <p class="text-justify text-muted">
                        Every time you want to buy a ticket we will use this card to easily reserve it for you. The card is securely stored by our financial provider. </p>  
                       
                    </div>

            <div class="cell payment_select payment_des col-12 p-3 text-center" id="payment_des_id">


            <button class="btn btn-primary processing-payment-loader hide" type="button">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Processing, please wait...
            </button>

            <div class="payment-options">

                <form id="payment-form" class="mb-3" action="#card">
                    <fieldset>
                    <div class="container">
                        <div id="payment_des-card"></div>
                        <button type="submit" data-tid="elements_payment_designs.form.pay_button">Save card</button>
                    </div>
                    <small>*you can change this at any time</small>

                    </fieldset>
                    <div class="error" role="alert">
                    <span class="message"></span>
                    </div>
                </form>
            </div>



            </div>
      
      
                </div>
            </div>
        </div>

        <div class="col-sm-3"></div>
    </div>
</div>





@endsection
@section('scripts')

@parent

<script src="{{asset('js/qrcode-0.17.0.min.js')}}"></script>

<script>
var stripe = Stripe('{{env('STRIPE_PUBLIC')}}');

    var elements = stripe.elements({
    fonts: [
        {
        cssSrc: "https://rsms.me/inter/inter-ui.css"
        }
    ],
    // Stripe's payment_designs are localized to specific languages, but if
    // you wish to have Elements automatically detect your user's locale,
    // use `locale: 'auto'` instead.
    locale: 'auto'
    });

    /**
     * Card Element
     */
    var card = elements.create("card", {
        style: {
        base: {
            color: "#32325D",
            fontWeight: 500,
            fontFamily: "Inter UI, Open Sans, Segoe UI, sans-serif",
            fontSize: "16px",
            fontSmoothing: "antialiased",

            "::placeholder": {
            color: "#CFD7DF"
            }
        },
        invalid: {
            color: "#E25950"
        }
        }
    });

    card.mount("#payment_des-card");

    card.addEventListener('change', function(event) {        
        if (event.error) {
            $('.error > .message').html(event.error.message);
        } else {
            $('.error > .message').html('');
        }
    });

    var form = document.getElementById('payment-form');

    form.addEventListener('submit', function(ev) {
        ev.preventDefault();

        $('.processing-payment-loader').removeClass('hide');
        $('.payment-options').addClass('hide');

        stripe.confirmCardPayment('{{ $client_secret ?? '' }}', {
            payment_method: {
            card: card
            }
        }).then(function(result) {
            if (result.error) {
                // Show error to your customer (e.g., insufficient funds)
                $('.error > .message').html(result.error.message);
                $('.processing-payment-loader').addClass('hide');
                $('.payment-options').removeClass('hide');
            } else {
            // The payment has been processed!
            if (result.paymentIntent.status === 'succeeded') {
                // result.paymentIntent.status
                window.location = '{{route('payment.method.save')}}?type=intent&pi='+result.paymentIntent.id;
            }
            }
        });
    });
</script>

@endsection


@section('styles')

@parent



<script src="https://js.stripe.com/v3/"></script>

<style>
.payment_select.payment_des {
  background-color: #f6f9fc;
}

.payment_select.payment_des * {
  font-family: Inter UI, Open Sans, Segoe UI, sans-serif;
  font-size: 16px;
  font-weight: 500;
}

.payment_select.payment_des form {
  max-width: 496px !important;
  padding: 0 15px;
}

.payment_select.payment_des form > * + * {
  margin-top: 20px;
}

.payment_select.payment_des .container {
  background-color: #fff;
  box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
  border-radius: 4px;
  padding: 3px;
}

.payment_select.payment_des fieldset {
  border-style: none;
  padding: 5px;
  margin-left: -5px;
  margin-right: -5px;
  background: rgba(18, 91, 152, 0.05);
  border-radius: 8px;
}

.payment_select.payment_des fieldset legend {
  float: left;
  width: 100%;
  text-align: center;
  font-size: 13px;
  color: #8898aa;
  padding: 3px 10px 7px;
}

.payment_select.payment_des .card-only {
  display: block;
}
.payment_select.payment_des .payment-request-available {
  display: none;
}

.payment_select.payment_des fieldset legend + * {
  clear: both;
}

.payment_select.payment_des input, .payment_select.payment_des button {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  outline: none;
  border-style: none;
  color: #fff;
}

.payment_select.payment_des input:-webkit-autofill {
  transition: background-color 100000000s;
  -webkit-animation: 1ms void-animation-out;
}

.payment_select.payment_des #payment_des-card {
  padding: 10px;
  margin-bottom: 2px;
}

.payment_select.payment_des input {
  -webkit-animation: 1ms void-animation-out;
}

.payment_select.payment_des input::-webkit-input-placeholder {
  color: #9bacc8;
}

.payment_select.payment_des input::-moz-placeholder {
  color: #9bacc8;
}

.payment_select.payment_des input:-ms-input-placeholder {
  color: #9bacc8;
}

.payment_select.payment_des button {
  display: block;
  width: 100%;
  height: 37px;
  background-color: #007bff;
  border-radius: 2px;
  color: #fff;
  cursor: pointer;
}

.payment_select.payment_des button:active {
  background-color: #b76ac4;
}

.payment_select.payment_des .error svg .base {
  fill: #e25950;
}

.payment_select.payment_des .error svg .glyph {
  fill: #f6f9fc;
}

.payment_select.payment_des .error .message {
  color: #e25950;
}

.payment_select.payment_des .success .icon .border {
  stroke: #ffc7ee;
}

.payment_select.payment_des .success .icon .checkmark {
  stroke: #007bff;
}

.payment_select.payment_des .success .title {
  color: #32325d;
}

.payment_select.payment_des .success .message {
  color: #8898aa;
}

.payment_select.payment_des .success .reset path {
  fill: #007bff;
}
</style>

@endsection