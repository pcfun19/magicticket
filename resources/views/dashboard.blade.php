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
                    <span class="info-box-number" style="max-height:30px; overflow: hidden;">
                    </span>
                </div>
                </div>
            </div>

            <div class="col-sm-4 p-1">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="far fa-save"></i></span>
                <div class="info-box-content" style="overflow:hidden;">
                    <span class="info-box-text">Space used</span>

                    <span class="info-box-number"></span>
                </div>
                </div>
            </div>
            
            <div class="col-sm-4 p-1">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-file"></i></span>
                <div class="info-box-content" style="overflow:hidden;">
                    <span class="info-box-text">Uploads</span>
                    <span class="info-box-number"></span>
                </div>
                </div>
            </div>

            </div>


            <div class="card card-outline card-dark">

        

            </div>

            <div class="row">

            <div class="col-sm-6 p-1">
                    <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-money-check-alt"></i></span>
                    <div class="info-box-content" style="overflow:hidden;">
                        <span class="info-box-text">Earnings {{Carbon::now()->format('F')}}</span>
                        <span class="info-box-number" style="max-height:30px; overflow: hidden;">
                        </span>
                    </div>
                    </div>
                </div>

                <div class="col-sm-6 p-1">
                    <div class="info-box">
                    <span class="info-box-icon bg-dark"><i class="fw fas fa-exchange-alt"></i></span>
                    <div class="info-box-content" style="overflow:hidden;">
                        <span class="info-box-text">Refunds {{Carbon::now()->format('F')}}</span>
                        <span class="info-box-number" style="max-height:30px; overflow: hidden;">
                        </span>
                    </div>
                    </div>
                </div>

                

            </div>

        </p>
    </div>
</div>



@endsection