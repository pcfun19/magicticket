<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Subscription;
use Config;
use Carbon;
use App\Ticket;
use App\Event;
use App\SavedCustomer;

class PaymentMethodController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        \Stripe\Stripe::setApiKey(env('STRIPE_PRIVATE'));
    }


    public function index()
    {
        abort_if(Gate::denies('payment_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client_secret = '';

        $active_sub = false;
        if (request()->user() && count(SavedCustomer::all())>0) {$active_sub = true;}

        if(Gate::allows('non_paid_access')){
            
            $subscription = SavedCustomer::all();
            if ($subscription->count()==1){
                $subscription = $subscription->first();
                $customer = $subscription->subscription; 
            } else {
                $newCustomer = \Stripe\Customer::create();
                $newSubscription = [
                    'cteated_by_id'   => request()->user()->id,
                    'provider'      => 'stripe',
                    'code'          => $newCustomer->id,
                    'method_type'   => 'card',
                ];
                SavedCustomer::create($newSubscription);
                $customer = $newCustomer->id;
            }

            $intent = \Stripe\SetupIntent::create([
            'customer'     => $customer,
            'usage'        => 'off_session'
            ]);    
            $client_secret = $intent->client_secret;

        }


        return view('admin.paymentMethods.index',['client_secret'=>$client_secret,'active_sub'=>$active_sub]);
    }
}
