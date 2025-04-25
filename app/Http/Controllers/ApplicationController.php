<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationStoreRequest;
use App\Http\Requests\ApplicationUpdateRequest;
use App\Http\Resources\ApplicationCollection;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApplicationController extends Controller
{
    public function index(Request $request): ApplicationCollection
    {
        $applications = Application::all();

        return new ApplicationCollection($applications);
    }

    public function store(ApplicationStoreRequest $request): ApplicationResource
    {
        $application = Application::create($request->validated());

        return new ApplicationResource($application);
    }

    public function show(Request $request, Application $application): ApplicationResource
    {
        return new ApplicationResource($application);
    }

    public function update(ApplicationUpdateRequest $request, Application $application): ApplicationResource
    {
        $application->update($request->validated());

        return new ApplicationResource($application);
    }

    public function destroy(Request $request, Application $application): Response
    {
        $application->delete();

        return response()->noContent();
    }
}
