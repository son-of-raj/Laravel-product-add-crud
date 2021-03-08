<?php
/**
 * Created by PhpStorm.
 * User: lets
 * Date: 16/11/2018
 * Time: 10:33
 */

namespace App\Repositories;

use App\Base\Repository;
use App\Models\Product;
use App\Traits\UploadableTrait;


class ProductsRepository extends Repository
{
    use UploadableTrait;

    protected function getClass()
    {
        return Product::class;
    }

    public function create($productData)
    {
        $price = $productData['price'];
        $price = str_replace('.', '', $price);
        $price = str_replace(',', '.', $price);
        $productData['price'] = $price;

        $this->model->create($productData);

    }

    public function update($id, $productData)
    {
        $product = $this->find($id);
        $price = $productData['price'];
        $config = $productData['config'];
        $price = str_replace('.', '', $price);
        $price = str_replace(',', '.', $price);
        $productData['price'] = $price;
        $product->update($productData);
    }

    public function delete($id)
    {
        $product = $this->find($id);
        $this->deleteUploadedFilesFor($product);
        $product->delete();
    }


}
