<?php

namespace App\Http\Controllers\Checklist;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChecklistItemReqeuest;
use App\Http\Requests\ChecklistRequest;
use App\Http\Resources\ChecklistItemResource;
use App\Http\Resources\ChecklistResource;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChecklistItemController extends Controller
{
    public function index(Checklist $checklist, Request $request): JsonResponse
    {
        $checklistItems = Checklist::query()
            ->where('user_id', $request->user()->id)
            ->with('checklistItems')
            ->get();

        return response()->json([
            'message' => 'successfully retrieved checklist items',
            'data' => ChecklistResource::collection($checklistItems)
        ], 200);
    }

    public function show(Checklist $checklist, ChecklistItem $checklistItem): JsonResponse
    {
        return response()->json([
            'message' => 'successfully retrieved checklist item',
            'data' => new ChecklistItemResource($checklistItem),
        ], 200);
    }

    public function store(Checklist $checklist, ChecklistItemReqeuest $checklistItemReqeuest): JsonResponse
    {
        $requestBody = $checklistItemReqeuest->validated();
        $checklistItem = $checklist->checklistItems()->create($requestBody);

        return response()->json([
            'message' => 'successfully created checklist item',
            'data' => $checklistItem
        ], 201);
    }

    public function renameItem(Checklist $checklist, ChecklistItem $checklistItem, ChecklistItemReqeuest $checklistItemReqeuest): JsonResponse
    {
        $requestBody = $checklistItemReqeuest->validated();
        $checklistItem->update($requestBody);

        return response()->json([
            'message' => 'successfully updated checklist items'
        ], 200);
    }

    public function update(Checklist $checklist, ChecklistItem $checklistItem): JsonResponse
    {
        $checklistItem->update([
            'is_completed' => !$checklistItem->is_completed
        ]);

        return response()->json([
            'message' => 'successfully updated checklist item status'
        ], 200);
    }

    public function destroy(Checklist $checklist, ChecklistItem $checklistItem): JsonResponse
    {
        $checklistItem->delete();

        return response()->json([
            'message' => 'successfully deleted checklist item'
        ], 200);
    }
}
