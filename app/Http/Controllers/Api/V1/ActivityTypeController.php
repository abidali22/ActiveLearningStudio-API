<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreActivityType;
use App\Http\Requests\V1\UpdateActivityType;
use App\Http\Resources\V1\ActivityTypeItemResource;
use App\Http\Resources\V1\ActivityTypeResource;
use App\Models\ActivityType;
use App\Models\Organization;
use App\Repositories\ActivityType\ActivityTypeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

/**
 * @group 9. Activity Type
 *
 * APIs for activity type management
 */
class ActivityTypeController extends Controller
{
    private $activityTypeRepository;

    /**
     * ActivityTypeController constructor.
     *
     * @param ActivityTypeRepositoryInterface $activityTypeRepository
     */
    public function __construct(ActivityTypeRepositoryInterface $activityTypeRepository)
    {
        $this->activityTypeRepository = $activityTypeRepository;
        // $this->authorizeResource(ActivityType::class, 'activityType');
    }

    /**
     * Get Activity Types
     *
     * Get a list of the activity types.
     * 
     * @urlParam suborganization required The Id of a suborganization Example: 1
     *
     * @responseFile responses/activity-type/activity-types.json
     *
     * @param Request $request
     * @param Organization $suborganization
     *
     * @return Response
     */
    public function index(Request $request, Organization $suborganization)
    {
        return  ActivityTypeResource::collection($this->activityTypeRepository->getAll($suborganization, $request->all()));
    }

    /**
     * Upload Thumbnail
     *
     * Upload thumbnail image for a activity type
     *
     * @bodyParam thumb image required Thumbnail image
     *
     * @response {
     *   "thumbUrl": "/storage/activity-types/1fqwe2f65ewf465qwe46weef5w5eqwq.png"
     * }
     *
     * @response 400 {
     *   "errors": [
     *     "Invalid image."
     *   ]
     * }
     *
     * @param Request $request
     * @return Response
     */
    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image',
        ]);

        if ($validator->fails()) {
            return response([
                'errors' => ['Invalid image.']
            ], 400);
        }

        $path = $request->file('image')->store('/public/activity-types');

        return response([
            'image' => Storage::url($path),
        ], 200);
    }

    /**
     * Create Activity Type
     *
     * Create a new activity type.
     *
     * @urlParam suborganization required The Id of a suborganization Example: 1
     * @bodyParam title string required The title of a activity type Example: Audio
     * @bodyParam order integer The order number of a activity type Example: 0
     * @bodyParam image string The image url of a activity type Example: /storage/uploads/4kZL5uuExvNPngVsaIdC7JscWmstOTsYO8sBbekx.png
     * @bodyParam organization_id integer The Id of an organization Example: 1
     *
     * @responseFile responses/activity-type/activity-type.json
     *
     * @response 500 {
     *   "errors": [
     *     "Could not create activity type. Please try again later."
     *   ]
     * }
     *
     * @param StoreActivityType $request
     * @param Organization $suborganization
     *
     * @return Response
     */
    public function store(StoreActivityType $request, Organization $suborganization)
    {
        $data = $request->validated();
        $activityType = $this->activityTypeRepository->create($data);

        if ($activityType) {
            return response([
                'activityType' => new ActivityTypeResource($activityType),
            ], 201);
        }

        return response([
            'errors' => ['Could not create activity type. Please try again later.'],
        ], 500);
    }

    /**
     * Get Activity Type
     *
     * Get the specified activity type.
     *
     * @urlParam suborganization required The Id of a suborganization Example: 1
     * @urlParam activityType required The Id of a activity type Example: 1
     *
     * @responseFile responses/activity-type/activity-type.json
     *
     * @param Organization $suborganization
     * @param ActivityType $activityType
     *
     * @return Response
     */
    public function show(Organization $suborganization, ActivityType $activityType)
    {
        return response([
            'activityType' => new ActivityTypeResource($activityType),
        ], 200);
    }

    /**
     * Get Activity Type Items
     *
     * Get a list of activity items of the specified activity type.
     *
     * @urlParam activityType integer required The Id of a activity type Example: 1
     *
     * @responseFile responses/activity-type/activity-items.json
     *
     * @param ActivityType $activityType
     * 
     * @return Response
     */
    public function items(ActivityType $activityType)
    {
        return response([
            'activityItems' => ActivityTypeItemResource::collection($activityType->activityItems),
        ], 200);
    }

    /**
     * Update Activity Type
     *
     * Update the specified activity type.
     *
     * @urlParam suborganization required The Id of a suborganization Example: 1
     * @urlParam activityType required The Id of a activity type Example: 1
     * @bodyParam title string required The title of a activity type Example: Audio
     * @bodyParam order integer The order number of a activity type Example: 0
     * @bodyParam image string The image url of a activity type Example: /storage/uploads/4kZL5uuExvNPngVsaIdC7JscWmstOTsYO8sBbekx.png
     * @bodyParam organization_id integer The Id of an organization Example: 1
     *
     * @responseFile responses/activity-type/activity-type.json
     *
     * @response 500 {
     *   "errors": [
     *     "Failed to update activity type."
     *   ]
     * }
     *
     * @param UpdateActivityType $request
     * @param Organization $suborganization
     * @param ActivityType $activityType
     *
     * @return Response
     */
    public function update(UpdateActivityType $request, Organization $suborganization, ActivityType $activityType)
    {
        $data = $request->validated();
        $is_updated = $this->activityTypeRepository->update($activityType->id, $data);

        if ($is_updated) {
            return response([
                'activityType' => new ActivityTypeResource($this->activityTypeRepository->find($activityType->id)),
            ], 200);
        }

        return response([
            'errors' => ['Failed to update activity type.'],
        ], 500);
    }

    /**
     * Remove Activity Type
     *
     * Remove the specified activity type.
     *
     * @urlParam suborganization required The Id of a suborganization Example: 1
     * @urlParam activityType required The Id of a activity type Example: 1
     *
     * @response {
     *   "message": "Activity type has been deleted successfully."
     * }
     *
     * @response 500 {
     *   "message": [
     *     "Failed to delete activity type."
     *   ]
     * }
     *
     * @param Organization $suborganization
     * @param ActivityType $activityType
     *
     * @return Response
     */
    public function destroy(Organization $suborganization, ActivityType $activityType)
    {
        if ($suborganization->id !== $activityType->organization_id) {
            return response([
                'message' => 'Invalid activituy type or organization',
            ], 400);
        }

        $is_deleted = $this->activityTypeRepository->delete($activityType->id);

        if ($is_deleted) {
            return response([
                'message' => 'Activity type has been deleted successfully.',
            ], 200);
        }

        return response([
            'errors' => ['Failed to delete activity type.'],
        ], 500);
    }
}
