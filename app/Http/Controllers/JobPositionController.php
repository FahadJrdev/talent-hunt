<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobPositionStoreRequest;
use App\Http\Requests\JobPositionUpdateRequest;
use App\Http\Resources\JobPositionCollection;
use App\Http\Resources\JobPositionResource;
use App\Models\JobPosition;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobPositionController extends Controller
{
    public function index(Request $request): JobPositionCollection
    {
        $jobPositions = JobPosition::all();

        return new JobPositionCollection($jobPositions);
    }

    public function store(JobPositionStoreRequest $request): JobPositionResource
    {
        $jobPosition = JobPosition::create($request->validated());

        return new JobPositionResource($jobPosition);
    }

    public function show(Request $request, JobPosition $jobPosition): JobPositionResource
    {
        return new JobPositionResource($jobPosition);
    }

    public function update(JobPositionUpdateRequest $request, JobPosition $jobPosition): JobPositionResource
    {
        $jobPosition->update($request->validated());

        return new JobPositionResource($jobPosition);
    }

    public function destroy(Request $request, JobPosition $jobPosition): Response
    {
        $jobPosition->delete();

        return response()->noContent();
    }
}
