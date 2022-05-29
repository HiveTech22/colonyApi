<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Review;
use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\ReviewCreated;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\PropertyRequest;
use App\Http\Resources\v1\ReviewResource;
use App\Http\Resources\v1\PropertyResource;
use App\Http\Resources\v1\PropertyCollection;

/**
 * @group Property Management
 * APIs to manage property
*/

class PropertyController extends Controller
{

    /**
     * Display a listing of properties.
     *
     * Gets a list of properties.
     *
     * @queryParam page_size int Size per page. Defaults to 5. Example: 5
     * @queryParam page int Page to view. Example: 1
     *
     * @apiResourceCollection App\Http\Resources\v1\PropertyResource
     * @apiResourceModel App\Models\Property
     * @return ResourceCollection
     */
    public function index(Request $request)
    {
        $pageSize = $request->page_size ?? 5;
        return new PropertyCollection(Property::query()->where('isAvailable', true)->inRandomOrder()->paginate($pageSize));
    }

    /**
     * Store a newly created property in storage.
     * @bodyParam title string required Title of the property. Example: Amazing property
     * @bodyParam body string[] required Body of the property. Example: ["This property is super beautiful"]
     * @bodyParam author_id int[] required The author ids of the property. Example: [1, 2]
     * @apiResource App\Http\Resources\v1\PropertyResource
     * @apiResourceModel App\Models\Property
     * @param  PropertyRequest  $request
     * @return PropertyResource
     */
    public function store(PropertyRequest $request, PropertyRepository $repositor)
    {

        $property = $repository->create($payload);
        $property = Property::create([
            'title'             =>$request->input('title'),
            'slug'              =>Str::slug($request->input('title')),
            'price'             =>$request->input('price'),
            'longitude'         =>$request->input('longitude'),
            'latitude'          =>$request->input('latitude'),
            'image'             =>$request->input('image'),
            'description'       =>$request->input('description'),
            'author_id'         => auth()->id()
        ]);
        
        return (new PropertyResource($property));
    }

    /**
     * Display the specified Property.
     * @apiResource App\Http\Resources\v1\PropertyResource
     * @apiResourceModel App\Models\Property
     * @param  \App\Models\Property  $Property
     * @return PropertyResource
     */
    public function show(Property $property)
    {
        return (new PropertyResource($property))
        ->response()
        ->setStatusCode(200);
    }

    public function update(Request $request, Property $property)
    {
         $this->validate($request, [
            'title'           => ['sometimes ', 'max:30', Rule::unique('properties')->ignore($property->title(), 'title')],
            'price'           => ['sometimes'],
            'description'     => ['sometimes', 'min:5']
        ]);

        $property->update([
            'title'             => $request->input('title'),
            'slug'              => Str::slug($request->input('title')),
            'price'             => $request->input('price'),
            'longitude'         => $request->input('longitude'),
            'latitude'          => $request->input('latitude'),
            'image'             => $request->input('image'),
            'description'      =>  $request->input('description'),
            'author_id' => auth()->id() ?? 1
        ]);

        return (new PropertyResource($property))
        ->response()
        ->setStatusCode(200);
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return response()->json(null, 204); //no content
    }

     /**
     * Store a newly created review in storage.
     * @bodyParam message string[] required message of the review. Example: ["This review is super beautiful"]
     * @bodyParam rating int[] Example: 5
     * @bodyParam author_id int required The author id of the review. Example: 1
     * @bodyParam property_id int required The property id that the review belongs to. Example: 1
     * @apiResource App\Http\Resources\v1/ReviewResource
     * @apiResourceModel App\Models\Review
     * @param \Illuminate\Http\Request $request
     * @return ReviewResource
     */
    public function review(ReviewRequest $request, ReviewRepository $repository){
        
        $review = $repository->create($request->only([
            'message',
            'rating',
            'property_id',
        ]));

        return (new ReviewResource($review));

    }
}