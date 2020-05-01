<?php

namespace App\Http\Controllers\Admin;

use App\BusinessDetail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBusinessDetailRequest;
use App\Http\Requests\StoreBusinessDetailRequest;
use App\Http\Requests\UpdateBusinessDetailRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BusinessDetailsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('business_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BusinessDetail::with(['created_by'])->select(sprintf('%s.*', (new BusinessDetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'business_detail_show';
                $editGate      = 'business_detail_edit';
                $deleteGate    = 'business_detail_delete';
                $crudRoutePart = 'business-details';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('taxid', function ($row) {
                return $row->taxid ? $row->taxid : "";
            });
            $table->editColumn('passport', function ($row) {
                if (!$row->passport) {
                    return '';
                }

                $links = [];

                foreach ($row->passport as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('documents', function ($row) {
                if (!$row->documents) {
                    return '';
                }

                $links = [];

                foreach ($row->documents as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('activities_details', function ($row) {
                return $row->activities_details ? $row->activities_details : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'passport', 'documents']);

            return $table->make(true);
        }

        return view('admin.businessDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('business_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessDetails.create');
    }

    public function store(StoreBusinessDetailRequest $request)
    {
        $businessDetail = BusinessDetail::create($request->all());

        foreach ($request->input('passport', []) as $file) {
            $businessDetail->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('passport');
        }

        foreach ($request->input('documents', []) as $file) {
            $businessDetail->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('documents');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $businessDetail->id]);
        }

        return redirect()->route('admin.business-details.index');

    }

    public function edit(BusinessDetail $businessDetail)
    {
        abort_if(Gate::denies('business_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessDetail->load('created_by');

        return view('admin.businessDetails.edit', compact('businessDetail'));
    }

    public function update(UpdateBusinessDetailRequest $request, BusinessDetail $businessDetail)
    {
        $businessDetail->update($request->all());

        if (count($businessDetail->passport) > 0) {
            foreach ($businessDetail->passport as $media) {
                if (!in_array($media->file_name, $request->input('passport', []))) {
                    $media->delete();
                }

            }

        }

        $media = $businessDetail->passport->pluck('file_name')->toArray();

        foreach ($request->input('passport', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $businessDetail->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('passport');
            }

        }

        if (count($businessDetail->documents) > 0) {
            foreach ($businessDetail->documents as $media) {
                if (!in_array($media->file_name, $request->input('documents', []))) {
                    $media->delete();
                }

            }

        }

        $media = $businessDetail->documents->pluck('file_name')->toArray();

        foreach ($request->input('documents', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $businessDetail->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('documents');
            }

        }

        return redirect()->route('admin.business-details.index');

    }

    public function show(BusinessDetail $businessDetail)
    {
        abort_if(Gate::denies('business_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessDetail->load('created_by');

        return view('admin.businessDetails.show', compact('businessDetail'));
    }

    public function destroy(BusinessDetail $businessDetail)
    {
        abort_if(Gate::denies('business_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessDetail->delete();

        return back();

    }

    public function massDestroy(MassDestroyBusinessDetailRequest $request)
    {
        BusinessDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('business_detail_create') && Gate::denies('business_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BusinessDetail();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
