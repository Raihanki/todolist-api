<?php

namespace App\Http\Controllers\Checklist;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChecklistRequest;
use App\Http\Resources\ChecklistResource;
use App\Models\Checklist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $checklists = $request->user()->checklists()->get();
        return response()->json([
            'message' => 'successfully retrieved checklists',
            'data' => ChecklistResource::collection($checklists)
        ], 200);
    }

    public function store(ChecklistRequest $checklistRequest): JsonResponse
    {
        $requestBody = $checklistRequest->validated();
        $checklist = $checklistRequest->user()->checklists()->create($requestBody);

        return response()->json([
            'message' => 'successfully created checklist',
            'data' => new ChecklistResource($checklist)
        ], 201);
    }

    public function destroy(Checklist $checklist) : JsonResponse
    {
        $checklist->delete();

        return response()->json([
            'message' => 'successfully deleted checklist'
        ], 200);
    }
}
