<?php

namespace App\Http\Controllers;

use App\Jobs\SendCreatedProductNotification;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::Available()->orderBy('status')->get();
        return view('product.index', [
            'products' => $products,
            'status' => $products->first()->status
        ]);
    }

    public function store(Request $request, Product $product): JsonResponse
    {
        $validator = Validator::make($request->all(), $product->rules(), [
            'name.required' => 'Поле (название) обязательно для заполнения.',
            'name.min' => 'Поле (название) должно содержать не менее 10 символов.',
            'article.required' => 'Поле (артикул) обязательно для заполнения.',
            'article.unique' => 'Поле (артикул) должно быть оригинальным.',
            'article.regex' => 'Только латинские символы и цифры',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = new Product();
        $product->article = $request->input('article');
        $product->name = $request->input('name');
        $product->status = $request->input('status');
        $product->data = $request->input('data') ?? '';
        if ($product->save()) {
           SendCreatedProductNotification::dispatch($product);
        }
        return response()->json($product, 200);
    }

    public function show(int $id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json('', 204);
        }

        return response()->json($product);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        if (!IsAdmin::isAdmin() && $request->input('article') != $product->article) {
            return response()->json([
                'article' => 'Менять артикул разрешено, только администратору'
            ], 403);
        }
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:10'],
            'article' => [
                Rule::excludeIf(!IsAdmin::isAdmin()),
                'required',
                'unique:products,article',
                'regex:/(^[A-Za-z0-9]+$)/i'
            ]
        ], [
            'name.required' => 'Поле (название) обязательно для заполнения.',
            'name.min' => 'Поле (название) должно содержать не менее 10 символов.',
            'article.required' => 'Поле (артикул) обязательно для заполнения.',
            'article.unique' => 'Поле (артикул) должно быть оригинальным.',
            'article.regex' => 'Только латинские символы и цифры',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $product->update([
                'article' => $request->input('article'),
                'name' => $request->input('name'),
                'status' => $request->input('status'),
                'data' => $request->input('data'),
            ]);
        }

        return response()->json($product);
    }

    public function destroy(int $id): JsonResponse
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return response()->json($product);
    }
}
