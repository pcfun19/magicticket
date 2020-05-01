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
<tr><th colspan="2">Share'NLock Terms of Service</th>
</tr></thead>
<tbody>
<tr>
<td>
    <p>Posted: July 12, 2019</p>
    <p>Effective: July 12, 2019</p>
</td>
</tr>
<tr>
<td>
    Thanks for using Share'NLock! Our mission is to create a more enlightened way of working by providing an intuitive, unified platform to keep your content safe and accessible while helping you and those you work with stay coordinated and in sync. These terms of service (“<strong>Terms</strong>”) cover your use and access to our services, client software and websites ("<strong>Services</strong>"). If you reside outside of the United States of America, Canada and Mexico (“<strong>North America</strong>”) your agreement is with Share'NLock International Unlimited Company. If you reside in North America your agreement is with Share'NLock, LLC. Our <a href="https://www.sharenlock.com/static/privacy" >Privacy Policy</a> explains how we collect and use your information while our <a href="https://www.sharenlock.com/static/terms#acceptable_use" >Acceptable Use Policy</a> outlines your responsibilities when using our Services. By using our Services, you’re agreeing to be bound by these Terms, our <a href="https://www.sharenlock.com/static/privacy" >Privacy Policy</a>, and <a href="https://www.sharenlock.com/static/terms#acceptable_use" >Acceptable Use Policy</a>.
</td>
</tr>
<tr>
<td>Your Stuff &amp; Your Permissions</2></td>
</tr>
<tr>
<td>
    <p>When you use our Services, you provide us with things like your files, content, messages, contacts, and so on (“<strong>Your Stuff</strong>”). Your Stuff is yours. These Terms don’t give us any rights to Your Stuff except for the limited rights that enable us to offer the Services.</p>
    <p>We need your permission to do things like hosting Your Stuff, backing it up, and sharing it when you ask us to. Our Services also provide you with features like commenting, sharing, searching, image thumbnails, document previews, optical character recognition (OCR), easy sorting and organization, and personalization to help reduce busywork. To provide these and other features, Share'NLock accesses, stores, and scans Your Stuff. You give us permission to do those things, and this permission extends to our affiliates and trusted third parties we work with.</p>
</td>
</tr>
<tr>
<td>Your Responsibilities</td>
</tr>
<tr>
<td>
    <p> Your use of our Services must comply with our <a href="https://www.sharenlock.com/static/terms#acceptable_use" >Acceptable Use Policy</a>. Content in the Services may be protected by others’ intellectual property rights. Please don’t copy, upload, download, or share content unless you have the right to do so.</p>
    <p>Share'NLock may review your conduct and content for compliance with these Terms and our <a href="https://www.sharenlock.com/static/terms#acceptable_use" >Acceptable Use Policy</a>. We aren’t responsible for the content people post and share via the Services.</p>
    <p>Help us keep Your Stuff protected. Safeguard your password to the Services, and keep your account information current. Don’t share your account credentials or give others access to your account.</p>
    <p>You may use our Services only as permitted by applicable law, including export control laws and regulations. Finally, to use our Services, you must be at least 13 (or older, depending on where you live).</p>
    
</td>
</tr>
<tr>
<td>Software</td>
</tr>
<tr>
<td>
    <p>Some of our Services allow you to download client software (“<strong>Software</strong>”) which may update automatically. So long as you comply with these Terms, we give you a limited, nonexclusive, nontransferable, revocable license to use the Software, solely to access the Services. To the extent any component of the Software may be offered under an open source license, we’ll make that license available to you and the provisions of that license may expressly override some of these Terms. Unless the following restrictions are prohibited by law, you agree not to reverse engineer or decompile the Services, attempt to do so, or assist anyone in doing so.</p>
</td>
</tr>
<tr>
<td>Beta Services</td>
</tr>
<tr>
<td>
    <p>We sometimes release products and features that we’re still testing and evaluating (“Beta Services”). Beta Services are labeled “alpha,” “beta,” “preview,” “early access,” or “evaluation” (or with words or phrases with similar meanings) and may not be as reliable as Share'NLock”s other services. Beta Services are made available so that we can collect user feedback, and by using our Beta Services, you agree that we may contact you to collect such feedback.</p>
    <p>Beta Services are confidential until official launch. If you use any Beta Services, you agree not to disclose any information about those Services to anyone else without our permission.</p>

</td>
</tr>
<tr>
<td>Our Stuff</td>
</tr>
<tr>
<td>
    <p>The Services are protected by copyright, trademark, and other US and foreign laws. These Terms don’t grant you any right, title, or interest in the Services, others’ content in the Services, Share'NLock trademarks, logos and other brand features. We welcome feedback, but note that we may use comments or suggestions without any obligation to you.</p>
</td>
</tr>
<tr>
<td>Copyright</td>
</tr>
<tr>
<td>
    <p>We respect the intellectual property of others and ask that you do too. We respond to notices of alleged copyright infringement if they comply with the law, and such notices should be reported using our contact email info@sharenlock.com. We reserve the right to delete or disable content alleged to be infringing and terminate accounts of repeat infringers. </p>
</td>
</tr>
<tr>
<td>Copyright and Personality or Likeness rights</td>
</tr>
<tr>
<td>
    <p>All works whatsoever (few examples: educational videos, songs, movies, videos!) can only be reproduced with the permission of its creator, the author: this is the base of copyright. A work belongs to its author or rights owner, and he or she alone can consent to any reuse or reproduction. Likewise, individuals have a right to control images of their own likeness, and you cannot film people and distribute the file without their consent.</p>
    <p>When you want to upload a file on DateMule, you must, in accordance with our ToS, make sure you have permission of any other authors implied in its production (director, screenwriter, musician, etc.).</p>
    <p>DateMule invites all users to participate by posting files or commenting on files posted by others. However, we do not tolerate files or comments that incite hatred, or that otherwise constitutes hateful speech towards people or communities on the basis of ethnicity, gender, age, religion, disability, sexual orientation or any other discriminative .</p>
    <p>You should respect the other members of the community: we won’t permit any threats, insults, persecution, harassment, or disclosure of personal information of other users. If we receive reports of such behavior, the users' accounts will be suspended immediately.</p>
    <p>Reported content that violates such rights will be removed.</p>

</td>
</tr>
<tr>
<td>Paid Accounts</td>
</tr>
<tr>
<td>
    <p><em>Billing.</em> You can increase your storage space and add paid features to your account (turning your account into a “Paid Account”). We’ll automatically bill you from the date you convert to a Paid Account and on each periodic renewal until cancellation. If you’re on an annual plan, we’ll send you a notice email reminding you that your plan is about to renew within a reasonable period of time prior to the renewal date. You’re responsible for all applicable taxes, and we’ll charge tax when required to do so. Some countries have mandatory local laws regarding your cancellation rights, and this paragraph doesn’t override these laws.</p>
    <p><em>No Refunds.</em> You may cancel your Share'NLock Paid Account at any time. Refunds are only issued if required by law. For example, users living in the European Union have the right to cancel their Paid Account subscriptions within 14 days of signing up for, upgrading to, or renewing a Paid Account.</p>
    <p><em>Downgrades.</em> Your Paid Account will remain in effect until it's cancelled or terminated under these Terms. If you don’t pay for your Paid Account on time, we reserve the right to suspend it or remove Paid Account features.</p>
    <p><em>Changes.</em> We may change the fees in effect but will give you advance notice of these changes via a message to the email address associated with your account.</p>
</td>
</tr>
<tr>
<td>Share'NLock Business Teams</td>
</tr>
<tr>
<td>

    <p><em>Email address.</em> If you sign up for a Share'NLock account with an email address provisioned by your organization, your organization may be able to block your use of Share'NLock until you transition to an account on a Share'NLock Business or Education team (collectively, “Share'NLock Business Team”) or you associate your Share'NLock account with a personal email address.</p>
    <p><em>Using Share'NLock Business Teams.</em> If you join a Share'NLock Business Team, you must use it in compliance with your organization’s terms and policies. Please note that Share'NLock Business Team accounts are subject to your organization's control. Your administrators may be able to access, disclose, restrict, or remove information in or from your Share'NLock Business Team account. They may also be able to restrict or terminate your access to a Share'NLock Business Team account. If you convert an existing Share'NLock account into part of a Share'NLock Business Team, your administrators may prevent you from later disassociating your account from the Share'NLock Business Team.</p>
    
    </td>
</tr>
<tr>
<td>Termination</td>
</tr>
<tr>
<td>
    <p>You’re free to stop using our Services at any time. We reserve the right to suspend or terminate your access to the Services with notice to you if:</p>
    <p class="indented">(a) you’re in breach of these Terms,</p>
    <p class="indented">(b) your use of the Services would cause a real risk of harm or loss to us or other users, or</p>
    <p class="indented">(c) you don’t have a Paid Account and haven't accessed our Services for 12 consecutive months.</p>
    <p>We’ll provide you with reasonable advance notice via the email address associated with your account to remedy the activity that prompted us to contact you and give you the opportunity to export Your Stuff from our Services. If after such notice you fail to take the steps we ask of you, we’ll terminate or suspend your access to the Services.</p>
    <p>We won’t provide notice before termination where:</p>
    <p class="indented">(a) you’re in material breach of these Terms,</p>
    <p class="indented">(b) doing so would cause us legal liability or compromise our ability to provide the Services to our other users, or</p>
    <p class="indented">(c) we're prohibited from doing so by law.</p>
    </td>
</tr>
<tr>
<td> Discontinuation of Services</td>
</tr>
<tr>
<td>

<p>We may decide to discontinue the Services in response to unforeseen circumstances beyond Share'NLock’s control or to comply with a legal requirement. If we do so, we’ll give you reasonable prior notice so that you can export Your Stuff from our systems. If we discontinue the Services in this way before the end of any fixed or minimum term you have paid us for, we’ll refund the portion of the fees you have pre-paid but haven't received Services for.</p>

</td>
</tr>
<tr>
<td>
Services “AS IS”
</td>
</tr>
<tr>
<td>
    <p>We strive to provide great Services, but there are certain things that we can't guarantee. TO THE FULLEST EXTENT PERMITTED BY LAW, SHAREN'LOCK AND ITS AFFILIATES, SUPPLIERS AND DISTRIBUTORS MAKE NO WARRANTIES, EITHER EXPRESS OR IMPLIED, ABOUT THE SERVICES. THE SERVICES ARE PROVIDED "AS IS." WE ALSO DISCLAIM ANY WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT. Some places don’t allow the disclaimers in this paragraph, so they may not apply to you.</p>
</td>
</tr>
<tr>
<td>
Limitation of Liability
</td>
</tr>
<tr>
<td>
    <p>WE DON’T EXCLUDE OR LIMIT OUR LIABILITY TO YOU WHERE IT WOULD BE ILLEGAL TO DO SO—THIS INCLUDES ANY LIABILITY FOR SHAREN'LOCK’S OR ITS AFFILIATES’ FRAUD OR FRAUDULENT MISREPRESENTATION IN PROVIDING THE SERVICES. IN COUNTRIES WHERE THE FOLLOWING TYPES OF EXCLUSIONS AREN’T ALLOWED, WE'RE RESPONSIBLE TO YOU ONLY FOR LOSSES AND DAMAGES THAT ARE A REASONABLY FORESEEABLE RESULT OF OUR FAILURE TO USE REASONABLE CARE AND SKILL OR OUR BREACH OF OUR CONTRACT WITH YOU. THIS PARAGRAPH DOESN’T AFFECT CONSUMER RIGHTS THAT CAN'T BE WAIVED OR LIMITED BY ANY CONTRACT OR AGREEMENT.</p>
    <p>IN COUNTRIES WHERE EXCLUSIONS OR LIMITATIONS OF LIABILITY ARE ALLOWED, SHAREN'LOCK, ITS AFFILIATES, SUPPLIERS OR DISTRIBUTORS WON’T BE LIABLE FOR:</p>
    <p class="indented">i. ANY INDIRECT, SPECIAL, INCIDENTAL, PUNITIVE, EXEMPLARY, OR CONSEQUENTIAL DAMAGES, OR</p>
    <p class="indented">ii. ANY LOSS OF USE, DATA, BUSINESS, OR PROFITS, REGARDLESS OF LEGAL THEORY.</p>
    <p>THESE EXCLUSIONS OR LIMITATIONS WILL APPLY REGARDLESS OF WHETHER OR NOT SHAREN'LOCK OR ANY OF ITS AFFILIATES HAS BEEN WARNED OF THE POSSIBILITY OF SUCH DAMAGES.</p>
    <p>IF YOU USE THE SERVICES FOR ANY COMMERCIAL, BUSINESS, OR RE-SALE PURPOSE, SHAREN'LOCK, ITS AFFILIATES, SUPPLIERS OR DISTRIBUTORS WILL HAVE NO LIABILITY TO YOU FOR ANY LOSS OF PROFIT, LOSS OF BUSINESS, BUSINESS INTERRUPTION, OR LOSS OF BUSINESS OPPORTUNITY. SHAREN'LOCK AND ITS AFFILIATES AREN’T RESPONSIBLE FOR THE CONDUCT, WHETHER ONLINE OR OFFLINE, OF ANY USER OF THE SERVICES.</p>
    <p>OTHER THAN FOR THE TYPES OF LIABILITY WE CANNOT LIMIT BY LAW (AS DESCRIBED IN THIS SECTION), WE LIMIT OUR LIABILITY TO YOU TO THE GREATER OF $20 USD OR 100% OF ANY AMOUNT YOU'VE PAID UNDER YOUR CURRENT SERVICE PLAN WITH SHAREN'LOCK.</p>
</td>
</tr>
<tr>
<td>
Resolving Disputes
</td>
</tr>
<tr>
<td>
<p><em>Let’s Try to Sort Things Out First.</em> We want to address your concerns without needing a formal legal case. Before filing a claim against Share'NLock, you agree to try to resolve the dispute informally by contacting dispute-notice@sharenlock.com. We’ll try to resolve the dispute informally by contacting you via email. If a dispute is not resolved within 15 days of submission, you or Share'NLock may bring a formal proceeding.</p>
    <p><em>Judicial Forum for Disputes.</em> You and Share'NLock agree that any judicial proceeding to resolve claims relating to these Terms or the Services will be brought in the federal or state courts of San Francisco County, California, subject to the mandatory arbitration provisions below. Both you and Share'NLock consent to venue and personal jurisdiction in such courts. If you reside in a country (for example, a member state of the European Union) with laws that give consumers the right to bring disputes in their local courts, this paragraph doesn’t affect those requirements.</p>
    <p><strong>IF YOU’RE A U.S. RESIDENT, YOU ALSO AGREE TO THE FOLLOWING MANDATORY ARBITRATION PROVISIONS:</strong></p>
    <p class="indented"><em>We Both Agree to Arbitrate.</em> You and Share'NLock agree to resolve any claims relating to these Terms or the Services through final and binding arbitration by a single arbitrator, except as set forth under Exceptions to Agreement to Arbitrate below. This includes disputes arising out of or relating to interpretation or application of this “Mandatory Arbitration Provisions” section, including its enforceability, revocability, or validity.</p>
    <p class="indented"><em>Arbitration Procedures.</em> The American Arbitration Association (AAA) will administer the arbitration under its Commercial Arbitration Rules and the Supplementary Procedures for Consumer Related Disputes. The arbitration will be held in the United States county where you live or work, San Francisco (CA), or any other location we agree to.</p>
    <p class="indented"><em>Arbitration Fees and Incentives.</em> The AAA rules will govern payment of all arbitration fees. Share'NLock will pay all arbitration fees for individual arbitration for claims less than $75,000. If you receive an arbitration award that is more favorable than any offer we make to resolve the claim, we will pay you $1,000 in addition to the award. Share'NLock will not seek its attorneys' fees and costs in arbitration unless the arbitrator determines that your claim is frivolous.</p>
    <p class="indented"><em>Exceptions to Agreement to Arbitrate.</em> Either you or Share'NLock may assert claims, if they qualify, in small claims court in San Francisco (CA) or any United States county where you live or work. Either party may bring a lawsuit solely for injunctive relief to stop unauthorized use or abuse of the Services, or intellectual property infringement (for example, trademark, trade secret, copyright, or patent rights) without first engaging in arbitration or the informal dispute-resolution process described above. If the agreement to arbitrate is found not to apply to you or your claim, you agree to the exclusive jurisdiction of the state and federal courts in San Francisco County, California to resolve your claim.</p>
    <p class="indented"><em><strong>NO CLASS ACTIONS</strong></em>. You may only resolve disputes with us on an individual basis, and may not bring a claim as a plaintiff or a class member in a class, consolidated, or representative action. Class arbitrations, class actions, private attorney general actions, and consolidation with other arbitrations aren’t allowed. If this specific paragraph is held unenforceable, then the entirety of this “Mandatory Arbitration Provisions” section will be deemed void.</p>
</td>
</tr>
<tr>
<td>
Controlling Law
</td>
</tr>
<tr>
<td>
    <p>These Terms will be governed by California law except for its conflicts of laws principles. However, some countries (including those in the European Union) have laws that require agreements to be governed by the local laws of the consumer's country. This paragraph doesn’t override those laws.</p>
</td>
</tr>
<tr>
<td>
Entire Agreement
</td>
</tr>
<tr>
<td>
    <p>These Terms constitute the entire agreement between you and Share'NLock with respect to the subject matter of these Terms, and supersede and replace any other prior or contemporaneous agreements, or terms and conditions applicable to the subject matter of these Terms. These Terms create no third party beneficiary rights.</p>
</td>
</tr>
<tr>
<td>
Waiver, Severability &amp; Assignment
</td>
</tr>
<tr>
<td>
    <p>Share'NLock’s failure to enforce a provision is not a waiver of its right to do so later. If a provision is found unenforceable, the remaining provisions of the Terms will remain in full effect and an enforceable term will be substituted reflecting our intent as closely as possible. You may not assign any of your rights under these Terms, and any such attempt will be void. Share'NLock may assign its rights to any of its affiliates or subsidiaries, or to any successor in interest of any business associated with the Services.</p>
</td>
</tr>
<tr>
<td>
Modifications
</td>
</tr>
<tr>
<td>
    <p>We may revise these Terms from time to time to better reflect:</p>
    <p class="indented">(a) changes to the law,</p>
    <p class="indented">(b) new regulatory requirements, or</p>
    <p class="indented">(c) improvements or enhancements made to our Services.</p>
    <p>If an update affects your use of the Services or your legal rights as a user of our Services, we’ll notify you prior to the update's effective date by sending an email to the email address associated with your account or via an in-product notification. These updated terms will be effective no less than 30 days from when we notify you.</p>
    <p>If you don’t agree to the updates we make, please cancel your account before they become effective. Where applicable, we’ll offer you a prorated refund based on the amounts you have prepaid for Services and your account cancellation date. By continuing to use or access the Services after the updates come into effect, you agree to be bound by the revised Terms.</p>    <p class="indented">(a) changes to the law,</p>
    <p class="indented">(b) new regulatory requirements, or</p>
    <p class="indented">(c) improvements or enhancements made to our Services.</p>
    <p>If an update affects your use of the Services or your legal rights as a user of our Services, we’ll notify you prior to the update's effective date by sending an email to the email address associated with your account or via an in-product notification. These updated terms will be effective no less than 30 days from when we notify you.</p>
    <p>If you don’t agree to the updates we make, please cancel your account before they become effective. Where applicable, we’ll offer you a prorated refund based on the amounts you have prepaid for Services and your account cancellation date. By continuing to use or access the Services after the updates come into effect, you agree to be bound by the revised Terms.</p>
</td>
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

