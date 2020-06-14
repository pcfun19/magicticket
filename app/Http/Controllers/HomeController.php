<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Payment;
use App\User;
use App\File;
use App\Folder;
use App\Group;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFileRequest;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Topic;
use Gate;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use App\Subscription;
use Config;
use Carbon;
use App\Ticket;
use App\Event;

class HomeController extends Controller
{

    use MediaUploadingTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        \Stripe\Stripe::setApiKey(env('STRIPE_PRIVATE'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function ticket($code)
    {   

        Config::set('app.tenantOnly', False);
        $ticket = Ticket::where('uuid',$code);

        if ($ticket->count()==0){ abort(404); }
        
        
        return view('ticket',['ticket'=>$ticket->first()]);

    }    

    public function event($code)
    {   
        Config::set('app.tenantOnly', False);
        $event = Event::where('slug',$code);

        if ($event->count()==0){ abort(404); }
        
        return view('event',['event'=>$event->first()]);
    }    

    public function home()
    {
        return view('home');
    }

    public function static($id)
    {
        return view('static.'.$id);
    }
    
    public function upgrade()
    {

        $client_secret = '';

        $active_sub = false;
        if (request()->user() && SavedCustomer::all()>0) {$active_sub = true;}

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


        return view('upgrade',['client_secret'=>$client_secret,'active_sub'=>$active_sub]);
    }

    public function execUpgrade() {

        $msg = '';

        if (request()->input('type')=='intent'){
            $pi = \Stripe\SetupIntent::retrieve(request()->input('pi'));

            if ($pi->status=='succeeded' && $pi->customer){
                $sub = SavedCustomer::ActiveOrPending()->where('subscription',$pi->customer);
                if ($sub->count()==1 && $sub->update(['status'=>'chargeable','ends_at'=>Carbon::now()->addMonths(6)])){
                    
                    $sub = $sub->first();
                    $newDBPayment = [
                        'provider'          => 'stripe',
                        'price'             => ((int)$pi->amount/100),
                        'status'            => 'paid',
                        'subscription_id'   => $sub->id,
                        'user_id'           => request()->user()->id,
                        'affiliate_id'      => request()->user()->affiliate_id,
                        'created_at'        => Carbon::createFromTimestamp($pi->created),
                    ];

                    $findPayment = Payment::where('subscription_id',$sub->id)->where('created_at',Carbon::createFromTimestamp($pi->created));

                    if ($findPayment->count()==0) { Payment::create($newDBPayment); }
                    $msg = 'Thank you for  subscribing';
                } else {
                    return redirect()->route('paid.upgrade')->with('We could not find the payment corresponding in our DB. Please contact admin.');
                }
            } 
        } elseif (request()->input('type')=='source') {
            
            $source = \Stripe\Source::retrieve(request()->input('source'));  
            
            if ($source->status!='chargeable'){ return redirect()->back()->withErrors(['No valid payment. Please ensure you authorized the payment properly.']); }
            
            $charge = \Stripe\Charge::create([
                'amount' => config('custom.6monthPriceCents'),
                'currency' => config('custom.currencyName'),
                'source' => request()->input('source'),
            ]);    


            if ($charge->paid==true){
                $newDBCharge = [
                    'provider'      => 'stripe',
                    'type'          => 'subscription',
                    'subscription'  => $charge->id,
                    'status'        => 'charged',
                    'user_id'       => request()->user()->id,
                    'cancelled_at'  => Carbon::now(),
                    'ends_at'       => Carbon::now()->addMonths(6)
                ];
                
                if ($newSub = SavedCustomer::create($newDBCharge)){
                    
                    $newDBPayment = [
                        'provider'          => 'stripe',
                        'price'             => ((int)$charge->amount/100),
                        'status'            => 'paid',
                        'subscription_id'   => $newSub->id,
                        'user_id'           => request()->user()->id,
                        'affiliate_id'      => request()->user()->affiliate_id,
                        'created_at'        => Carbon::createFromTimestamp($charge->created),
                    ];

                    $findPayment = Payment::where('subscription_id',$newSub->id)->where('created_at',Carbon::createFromTimestamp($charge->created));
                    

                    if ($findPayment->count()==0) { Payment::create($newDBPayment); }
                    $msg = 'Thank you for  subscribing';

                } else {
                    return redirect()->route('paid.upgrade')->with('We could not confirm the charge. If you got charged please contact us.');
                }
            } else {
                return redirect()->route('paid.upgrade')->with('We could not confirm the charge. If you got charged please contact us.');
            }
        } else {
            return redirect()->route('paid.upgrade')->with('Sorry, this request did not seem to work. Contact admin if you think this is an error.');
        }

        // If we have ended up with no error we upgrade the user
        // 3 is the Paid User role to add to a user
        request()->user()->roles()->sync([3]);

        return redirect()->route('admin.home')->with($msg);
    }

    public function cancelUpgrade() {

        $msg = 'Subscription cancelled ';
        $sub = Subscription::Active();

        // if we have subscription active
        if ($sub->count()==1) {

            // we update cancellation field so we don't charge anymore
            if ($sub->update(['cancelled_at'=>Carbon::now(),'status'=>'cancelled'])) {

                // if sub has ended already we also downgrade the user immediately
                if (Subscription::Ending()->count()==0) {
                    // 2 is for the Non-paid User role
                    request()->user()->roles()->sync([2]);
                }

            }

        } elseif (Subscription::Ending()->count()==0) {

            // if we don't have any active subscription for some reason 
            // then we execute downgrade immediately
            // 2 is for the Non-paid User role
            request()->user()->roles()->sync([2]);
            
        }

        return redirect()->route('paid.upgrade')->with($msg);
        
    }
    
}
