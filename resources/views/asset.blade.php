@extends('layouts.admin')
@section('content')
<div class="content">

    <!-- Header and error message row -->
    <div class="row">
        <div class="col-sm-3  p-1"></div>

        <div class="col-sm-6 ">
            <div class="card">
                <div class="card-header">
                    Asset Access/Download Page
                </div>

                    @if(session('status'))
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        </div>
                    @endif

            </div>
        </div>

        <div class="col-sm-3  p-1"></div>
            
    </div>


    <!-- Download row -->
    <div class="row mt-3">
        <div class="col-sm-3  p-1"></div>

        <div class="col-sm-6  p-1">
            <div class="card card-outline card-dark">
                <div class="card-header">
                    <h3 class="card-title">{{$file->name}}</h3>
                    <div class="card-tools">
                    <span class="badge badge-primary">{{ucfirst($file->privacy)}}</span> 
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body p-3">

                <i class="fa-fw nav-icon fas fa-file-alt" style="font-size: 8rem; width:100%;"></i>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    @can('paid_access')
                        @if($file->file && $authorised)
                            <a href="{{ $file->file->getTemporaryUrl(Carbon::now()->addMinutes(30)) }}" target="_blank">
                                {{ trans('global.download_file') }}
                            </a> - <span class="text-warning">{{$file->file->human_readable_size}}</span>
                        @elseif($file->privacy=='paid' && !$authorised)
                        You need to pay ${{$file->price}} to access this asset
                        @elseif($file->privacy=='private' && !$authorised)
                        It may be that you are not in the allowed Groups. Contact Admin.
                        @else
                        Please contact Admin... There seems to be a problem with this file
                        @endif
                    @else
                        @if(request()->user() && $file->user_id==request()->user()->id)
                            <a href="{{ $file->file->getTemporaryUrl(Carbon::now()->addMinutes(30)) }}" target="_blank">
                                {{ trans('global.download_file') }}
                            </a> - <span class="text-warning">{{$file->file->human_readable_size}}</span>
                
                        @else
                        <a href="{{route('paid.upgrade')}}"> You need a Paid membership </a> to download files that are not yours
                        @endif
                    @endif
                </div>
                <!-- /.card-footer -->            

            </div>
        </div>

        <div class="col-sm-3  p-1"></div>
    </div>
</div>


@endsection
@section('scripts')
@parent

@endsection

