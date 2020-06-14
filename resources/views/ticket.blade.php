@extends('layouts.admin')
@section('content')
<div class="content">

<div class="content">
    <div class="row">
        <div class="col-6 col-sm-5"><img width="100%" src="{{$ticket->ticket_sample->url}}"></div>

       

        <div class="col-sm-7">
            <div class="card">
                <div class="card-header ">
                    Reserve your ticket
                </div>

                <div class="card-body p-3">
                    @if(session('status'))
                        <div class="alert alert-success m-3" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    


                    <form>
                    <div class="form-group">
                        <label for="includes">When?</label>
                        <input hidden class="form-control" id="includes" name="includes" value="{{Carbon::parse($ticket->event->event_date)->format('d-F H:i')}} ">
                        <p>{{Carbon::parse($ticket->event->event_date)->format('d-F H:i')}}</p>
                    </div>
                    <div class="form-group">
                        <label for="includes">Location</label>
                        <input hidden class="form-control" id="includes" name="includes" value="{{$ticket->event->address}}">
                        <p>{{$ticket->event->address}}</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="includes">Location</label>
                        <input hidden class="form-control" id="includes" name="includes" value="{{$ticket->event->address}}">
                        <p>{{$ticket->event->organiser_details}}</p>
                    </div>

                    @if ($ticket->includes!='')
                    <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseIncludes" aria-expanded="false" aria-controls="collapseIncludes">
                            What it Includes
                    </button>
                    @endif

                    @if ($ticket->instructions!='')
                    <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseInstructions" aria-expanded="false" aria-controls="collapseInstructions">
                            Read Guideline
                    </button>
                    @endif
                    
                    @if ($ticket->includes!='')
                    <div class="form-group">
                        <div class="collapse mt-3" id="collapseIncludes">
                            <p>{{$ticket->includes}}</p>
                        </div>
                    </div>
                    @endif

                    @if ($ticket->instructions!='')
                    <div class="form-group">
                        <div class="collapse mt-3" id="collapseInstructions">
                        <p>{{$ticket->instructions}}</p>
                        </div>
                    </div>
                    @endif

                    <div class="form-group" action="{{route('ticket.buy',$ticket->uuid)}}">
                        <label for="quantity">How many tickets do you want to buy?</label>
                        <input class="form-control" id="quantity" aria-describedby="quantity"  type="number" value="1" min="1" max="20" step="1" name="quantity"/>
                        <small id="quantity" class="form-text text-muted">You can buy no more than 20 tickets</small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary col-12">BUY</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
                  
</div>


@endsection
@section('scripts')
@parent

<script src="{{asset('js/bootstrap-input-spinner.js')}}"></script>
<script>
    $("input[type='number']").inputSpinner();
</script>

@endsection

