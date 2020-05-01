@extends('layouts.admin')
@section('content')
<div class="content">

    <!-- Header and error message row -->
    <div class="row">
        @if(session('status'))
            <div class="card-body">
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            </div>
        @endif
    </div>


    <!-- Download row -->
    <div class="row mt-3">
        <div class="col-sm-2  p-1"></div>

        <div class="col-sm-8  p-1">
  

        <table class="table table-striped table-bordered">
<thead>
<tr><th>About us</th>
</tr></thead>
<tbody>
<tr>
<td class="text-justify">
We are excited to be offering this service to you. We have been working on this platform for over a year and finally in 2019 we made it possible to go public and offer you the most efficient service for online file transfers. Why us and not Dropbox you may ask. Well, the choice is yours but what we know is that we take your privacy and data really seriously. We are a small yet growing company that respects their clients and secures their digital assets in a way probably bigger companies don't. We are glad to have you here and THANK YOU for using our service.
</td>
</tr>

<tr>
<td>
Share'NLock.com is a property of <br>
SPAREBYTES LLC. <br>
30 N Gould St Ste 6325 <br>
Sheridan, WY 82801 USA. <br>
</td>
</tr>

<tr>
<td class="text-justify">
To get in touch please send us an email at info@sharenlock.com for any queries or visit www.sparebytes.company and use the contact form of our company.
</td>
</tr>
</tbody>
</table>

</div>
        </div>

        <div class="col-sm-2  p-1"></div>
    </div>
</div>


@endsection
@section('scripts')
@parent

@endsection

