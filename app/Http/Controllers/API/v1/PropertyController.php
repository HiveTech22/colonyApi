<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PropertyResource;
use App\Http\Resources\v1\PropertyCollection;

class PropertyController extends Controller
{

    public function index(Request $request)
    {
        $pageSize = $request->page ?? 5;
        return new PropertyCollection(Property::query()->where('isAvailable', true)->inRandomOrder()->paginate($pageSize));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title'           => ['required', 'max:30', 'unique:properties,title'],
            'price'           => ['required'],
            'description'     => ['required', 'min:5']
        ]);

        $property = Property::create([
            'title'             =>$request->input('title'),
            'slug'              =>Str::slug($request->input('title')),
            'price'             =>$request->input('price'),
            'longitude'         =>$request->input('longitude'),
            'latitude'          =>$request->input('latitude'),
            'image'             =>$request->input('image'),
            'description'       =>$request->input('description'),
            'author_id'         => auth()->id() ?? 1
        ]);
        
        return (new PropertyResource($property))
        ->response()
        ->setStatusCode(201);
    }

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
}