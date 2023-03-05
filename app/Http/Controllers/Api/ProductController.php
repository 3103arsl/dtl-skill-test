<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    protected $product;
    protected $productRespository;

    /**
     * @param Product $product
     * @param ProductRepository $productRepository
     */
    public function __construct(Product $product, ProductRepository $productRepository)
    {
        parent::__construct();
        $this->model = $product;
        $this->productRespository = $productRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return ProductResource::collection($this->productRespository->getProductsWithSearch($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->request = $request;
        $model = $this->productRespository->save($this->getFormData());
        if (!$model) {
            return $this->httpResponse->setResponse([
                'success' => false,
                'errors' => 'Product has not been Created.'
            ], self::STATUS_BAD_REQUEST);
        }

        return $this->httpResponse->setResponse([
            'success' => true,
            'message' => 'Product Created Successfully!'
        ], self::STATUS_CREATED);
    }

    /**
     * @param string $id
     * @return \Illuminate\Http\Response|void
     */
    public function show(string $id)
    {
        $product = $this->productRespository->getProductByID($id);

        if (!$product) {
            return $this->httpResponse->setResponse([
                'success' => false,
                'errors' => 'Invalid Product.'
            ], self::STATUS_BAD_REQUEST);
        }

        return new ProductResource($this->productRespository->getProductByID($id));
    }


    public function update(ProductRequest $request, string $id)
    {
        $this->request = $request;

        $model = $this->productRespository->update($id, $this->getFormData());

        if (!$model) {
            return $this->httpResponse->setResponse([
                'success' => false,
                'errors' => 'Product has not been Updated.'
            ], self::STATUS_BAD_REQUEST);
        }

        return $this->httpResponse->setResponse([
            'success' => true,
            'message' => 'Product Updated Successfully!'
        ], self::STATUS_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->productRespository->delete($id)) {

            return $this->httpResponse->setResponse([
                'success' => false,
                'errors' => 'Product has not been Deleted.'
            ], self::STATUS_BAD_REQUEST);

        }
        return $this->httpResponse->setResponse([
            'success' => true,
            'message' => 'Product Deleted Successfully!'
        ], self::STATUS_OK);
    }

    /**
     * @return array
     */
    private function getFormData()
    {
        return [
            'name' => $this->request->input('name'),
            'price' => $this->request->input('price'),
            'type' => $this->request->input('type'),
            'status' => $this->request->input('status'),
        ];
    }
}
