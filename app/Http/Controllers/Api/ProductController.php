<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Product $product)
    {
        $params = $request->all();
        $query = $product->filter($params);
        
        try {
            $limit = (int) $request->input('limit', 50);
        } catch (\Exception $e) {
            $limit = 50;
        }

        if (!is_int($limit) || $limit <= 0) {
            $limit = 50;
        }
        
        if (empty($params['sort'])) { 
            $query->orderBy('id', 'desc');
        }

        $response = $query->paginate($limit);
        
        return response()->success($response, trans('messages.success_message'), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->file('image_path')->isValid()) {
            throw new HttpResponseException(response()->error('Image file is not valid', Response::HTTP_UNPROCESSABLE_ENTITY));
        }

        $data = $request->all();

        $data['slug'] = $data['title'];
        $file = $request->file('image_path');
        $name = time() . '_' . $file->getClientOriginalName();
        $filePath = 'images/' . $name;
        $fileContent = file_get_contents($file);

        $result = Storage::disk('public')->put($filePath, $fileContent);
        
        $data['image_path'] = $filePath;

        $response = Product::create($data);

        return response()->success($response, trans('messages.success_message'), Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        $response = $product;
        
        return response()->success($response, trans('messages.success_message'), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        
        return response()->success($product, trans('messages.success_message'), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
