<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index() {}

    public function services()
    {
        return ServiceResource::collection(Service::query()
            ->with(['centers', 'financialPlansTypes'])
            ->latest()->paginate());
    }

    public function service(Service $service)
    {
        $service->load('centers');
        return new ServiceResource($service);
    }
}
