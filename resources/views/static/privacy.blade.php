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
<tr><th colspan="2">Privacy Policy - in accordane to our <a href="https://www.sharenlock.com/static/terms">Terms of Use</a> &amp; <a href="https://www.sharenlock.com/static/cookies">Cookies Policy</a></th>
</tr></thead>
<tbody>
<tr>
<td>Purpose</td>
</tr>
<tr>
<td>This document sets out Share'NLock's commitment to your privacy and to the protection of personal data (the "Data") collected and processed in connection with your use of the Website, under the terms and conditions set out in the General Terms of Use.</td>
</tr>
<tr>
<td>Data collected</td>
</tr>
<tr>
<td><p>We collect and subsequently process (i) the Data that you voluntarily provide on the&nbsp;registration form&nbsp;on the Website including a valid email address, your password and any other field you fill in during the registration process&nbsp;and (ii) (only in some cases) your IP address&nbsp;(the address of your computer) by an automatic collecting process (this implies, that we also extract the country and location approximatively as a result of the IP capabilities). We also collect your name, surname, age and sex when you submit them to your profile and update it. When you use social login (login through a social network like facebook) we automatically collect your email and full name after your permission throughout the authorization process.</p>
<p>Please note that whether or not you are a registered user, the Website may implement or allow third-party companies to implement automatic tracking processes (cookie or web beacon), which you may block by changing your browser settings. The Data (e.g., click stream information, browser type, time and date, subject of advertisements clicked or scrolled over) collected through these automatic tracking processes are anonymous and are used in order to improve the Website's quality (as for examples the improvement of your search results and of the advertising selection provided to you).</p></td>
</tr>
<tr>
<td>Purpose of processing</td>
</tr>
<tr>
<td><p>Data indicated on the Website as mandatory is required in order to use the Website's features (video uploads, comments, etc). Data automatically collected by the Website allows us to compile statistics on web page visits. Your Data is collected and maintained in our servers or secure cloud services of trusted providers such as, but not necessarily limited to, Amazon AWS and Google Cloud. This collection and maintenance is done according to the current laws.</p></td>
</tr>
<tr>
<td>Data recipients</td>
</tr>
<tr>
<td><p>With exception for your non-personally identifiable information as stated in section 2, your Data is not transmitted to third parties. However, Share'NLock&nbsp;may release Data if the law requires it to do so or in the good-faith belief that such action is necessary to comply with state and applicable laws or respond to a court order, subpoena, or search warrant or to protect Share'NLock's&nbsp;rights and interests. </p> </td>
</tr>
<tr>
<td>Data security</td>
</tr>
<tr>
<td><p>Share'NLock&nbsp;takes all appropriate steps to limit the risk that it may be lost, damaged or misused.</p></td>
</tr>
<tr>
<td>Data retention</td>
</tr>
<tr>
<td><p>Data is stored on the premises of the Website host and is kept only as long as necessary for the purposes set out above. After that point, data is kept only for statistical purposes and shall not be used for any other reason.</p></td>
</tr>
<tr>
<td>EU GDPR</td>
</tr>
<tr>
<td><p>In compliance with the EU GDPR you have the right to ask us to remove any data we hold of you (email, name, surname etc) and completely remove your account as well as you can ask for the data of you that we have saved in our system. Please refer to our <a href="https://www.sharenlock.com/static/terms">ToS</a> and the general Privacy Policy rules here above.</p></td>
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

