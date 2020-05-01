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
        <div class="col-sm-1  p-1"></div>

        <div class="col-sm-10  p-1">
  

        <table class="table table-striped table-bordered">
<thead>
<tr><th colspan="2">Cookies policy<a href="https://www.sharenlock.com/static/terms"></a></th>
</tr></thead>
<tbody>
<tr>
<td>Privacy Statement:&nbsp; How we use Cookies</td>
</tr>
<tr>
<td>Cookies are very small text files that are stored on your computer when you visit some websites.&nbsp; <br> We use cookies to help identify your computer so we can tailor your user experience, track you when you are logged in and remember you.</td>
</tr>
<tr>
<td>The following is strictly necessary in the operation of our website.</td>
</tr>
<tr>
<td><p>This Website Will:</p>
<ul>
<li> Remember that you are logged in and that your session is secure.&nbsp; You need to be logged in, in order to upoad, comment or do other operations in out website like adding friends or messaging other people.</li>
</ul>
<p>The following are not Strictly Necessary, but are required to provide you with the best user experience and also to tell us which pages you find most interesting (anonymously).</p></td>
</tr>
<tr>
<td>Functional Cookies</td>
</tr>
<tr>
<td><p>This Website Will:</p>
<ul>
<li> Track the pages you visits via Google Analytics, Alexa.com and possibly more visitor tracking platforms</li>
</ul></td>
</tr>
<tr>
<td>Targeting Cookies</td>
</tr>
<tr>
<td><p>This Website Will:</p>
<ul>
<li> Allow you to share pages with social networks such as Facebook (If available)</li>
<li> Allow you to share pages via other sharing plugins (If available)</li>
</ul></td>
</tr>
<tr>
<td>This website will not</td>
</tr>
<tr>
<td> Share any personal information with third parties.</td>
</tr>
</tbody>
</table>


</div>
        </div>

        <div class="col-sm-1  p-1"></div>
    </div>
</div>


@endsection
@section('scripts')
@parent

@endsection

