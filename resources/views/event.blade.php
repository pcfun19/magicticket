@extends('layouts.admin')
@section('content')
<div class="content">


<section class="container">
<h1>Tickets</h1>
  <div class="row">
    
    @foreach ($event->eventTickets as $ticket)
    <article class="card col-12 col-md-6">
      <section class="date">
        <time datetime="23th feb">
          <span>{{Carbon::parse($event->event_date)->format('d')}}</span>
          <span>{{Carbon::parse($event->event_date)->format('M')}}</span>
          <p class="mt-2">
          <img width="100%" src="{{$ticket->ticket_image->thumbnail}}">
          </p>
        </time>
      </section>
      <section class="card-cont">
        <!-- <small>{{$ticket->name}}</small> -->
        <h3>{{$ticket->name}}</h3>
        <div class="even-info">
          <i class="fas fa-map-marker-alt"></i>
          <span class="ml-2">
           {{$event->address}} 
          </span>
        </div>
        <div class="even-date">
         <i class="fa fa-calendar"></i>
         <span class="ml-2">{{Carbon::parse($event->event_date)->format('d-F H:i')}} </span>
        </div>

        <div class="even-info">
          <i class="far fa-money-bill-alt"></i>
          <span class="ml-2">
           {{$ticket->price}} {{$ticket->currency}}
          </span>
        </div>
        <a class="btn btn-primary" href="{{route('ticket.get',$ticket->uuid)}}">BOOK</a>
      </section>
    </article>
    @endforeach
    
    
  </div>
</div>


</div>


@endsection
@section('styles')
@parent
<style>
@import url('https://fonts.googleapis.com/css?family=Oswald');
*
{
  margin: 0;
  padding: 0;
  border: 0;
  box-sizing: border-box
}

body
{
  background-color: #f4f6f9;
}

.container
{
  width: 90%;
  margin: 20px auto
}

h1
{
  text-transform: uppercase;
  font-weight: 900;
  border-left: 10px solid #b2d03e;
  padding-left: 10px;
  margin-bottom: 30px
}

.row{overflow: hidden}

.card
{
  display: table-row;
  width: 49%;
  background-color: #fff;
  color: #989898;
  margin-bottom: 10px;
  font-family: 'Oswald', sans-serif;
  text-transform: uppercase;
  border-radius: 4px;
  position: relative
}

.card + .card{margin-left: 2%}

.date
{
  display: table-cell;
  width: 25%;
  position: relative;
  text-align: center;
  border-right: 2px dashed #f4f6f9
}

.date:before,
.date:after
{
  content: "";
  display: block;
  width: 30px;
  height: 30px;
  background-color: #f4f6f9;
  position: absolute;
  top: -15px ;
  right: -15px;
  z-index: 1;
  border-radius: 50%
}

.date:after
{
  top: auto;
  bottom: -15px
}

.date time
{
  display: block;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%)
}

.date time span{display: block}



.card-cont
{
  display: table-cell;
  width: 75%;
  font-size: 85%;
  padding: 10px 10px 30px 50px
}



.card-cont > div
{
  display: table-row
}

.card-cont .even-date i,
.card-cont .even-info i,
.card-cont .even-date time,
.card-cont .even-info p
{
  display: table-cell
}

.card-cont .even-date i,
.card-cont .even-info i
{
  padding: 5% 5% 0 0
}

.card-cont a
{
  position: absolute;
  right: 10px;
  bottom: 10px
}


</style>
@endsection

