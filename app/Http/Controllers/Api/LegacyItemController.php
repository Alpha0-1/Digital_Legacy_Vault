<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LegacyItem;
use App\Http\Requests\LegacyItem\CreateLegacyItemRequest;
use App\Http\Resources\LegacyItemResource;
use Illuminate\Http\Request;

class LegacyItemController extends Controller
{
    public function store(CreateLegacyItemRequest $request)
    {
        try {
            $legacyItem = LegacyItem::create($request->validated());
            
            // Attach beneficiaries if provided
            if ($request->has('beneficiaries')) {
                $legacyItem->beneficiaries()->attach($request->input('beneficiaries'));
            }
            
            return new LegacyItemResource($legacyItem->load('beneficiaries'));
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create legacy item',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(CreateLegacyItemRequest $request, LegacyItem $legacyItem)
    {
        try {
            $legacyItem->update($request->validated());
            
            // Update beneficiaries if provided
            if ($request->has('beneficiaries')) {
                $legacyItem->beneficiaries()->sync($request->input('beneficiaries'));
            }
            
            return new LegacyItemResource($legacyItem->load('beneficiaries'));
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update legacy item',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
