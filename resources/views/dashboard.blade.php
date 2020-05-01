@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.account.title') }}
    </div>

    <div class="card-body">
        <p>
            <div class="row">

            <div class="col-sm-4 p-1">
                <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="far fa-id-badge"></i></span>
                <div class="info-box-content" style="overflow:hidden;">
                    <span class="info-box-text">Affiliates</span>
                    <span class="info-box-number" style="max-height:30px; overflow: hidden;">{{request()->user()->userAffiliates()->count()}}</span>
                </div>
                </div>
            </div>

            <div class="col-sm-4 p-1">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="far fa-save"></i></span>
                <div class="info-box-content" style="overflow:hidden;">
                    <span class="info-box-text">Space used</span>
                    <?php 
                    $size = round(request()->user()->userFiles->sum('size')/config('custom.divideInGB'),2);
                    $sizeReadable = $size>1024?($size/1024).'GB':$size.'MB';
                    ?>
                    <span class="info-box-number">{{$sizeReadable}}</span>
                </div>
                </div>
            </div>
            
            <div class="col-sm-4 p-1">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-file"></i></span>
                <div class="info-box-content" style="overflow:hidden;">
                    <span class="info-box-text">Uploads</span>
                    <span class="info-box-number">{{request()->user()->userFiles->count()}}</span>
                </div>
                </div>
            </div>

            </div>


            <div class="card card-outline card-dark">


                <div class="card-header">
                    <h3 class="card-title">Membership</h3>
                    <div class="card-tools">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    @can('paid_access')
                    <span class="badge badge-primary">Paid Member</span> 
                    @else 
                    <span class="badge badge-light">Free Member</span> 
                    @endcan
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                @include('admin.accounts.comparison')
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    @can('paid_access')
                    Thank you for being a valuable customer - <a href="{{route('paid.upgrade')}}"> Cancel membership </a> 
                    @else
                    <a href="{{route('paid.upgrade')}}"> Upgrade to a Paid membership </a> to enjoy the many benefits
                    @endif
                </div>
                <!-- /.card-footer -->            

            </div>

            <div class="row">

            <div class="col-sm-6 p-1">
                    <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-money-check-alt"></i></span>
                    <div class="info-box-content" style="overflow:hidden;">
                        <span class="info-box-text">Earnings {{Carbon::now()->format('F')}}</span>
                        <span class="info-box-number" style="max-height:30px; overflow: hidden;">{{config('custom.currencySymbol')}}{{request()->user()->userEarnings()->sum('price')*config('custom.affiliateCommision')}}</span>
                    </div>
                    </div>
                </div>

                <div class="col-sm-6 p-1">
                    <div class="info-box">
                    <span class="info-box-icon bg-dark"><i class="fw fas fa-exchange-alt"></i></span>
                    <div class="info-box-content" style="overflow:hidden;">
                        <span class="info-box-text">Refunds {{Carbon::now()->format('F')}}</span>
                        <span class="info-box-number" style="max-height:30px; overflow: hidden;">{{config('custom.currencySymbol')}}{{request()->user()->userRefunds()->sum('price')*config('custom.affiliateCommision')}}</span>
                    </div>
                    </div>
                </div>

                

            </div>

        </p>
    </div>
</div>



@endsection