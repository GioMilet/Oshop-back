<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;

class ProductController extends CoreController {

    /**
     *
     * @return void
     */
    public function list()
    {
        $products = Product::findAll();
        $this->show('product/list', ["products" => $products]);
    }

   
    public function add()
    { 
       
        if (!empty($_POST)){
            
            $name = strip_tags(filter_input(INPUT_POST, 'name'));
            $description = strip_tags(filter_input(INPUT_POST, 'description'));
            $picture = strip_tags(filter_input(INPUT_POST, 'picture'));
            $status = strip_tags(filter_input(INPUT_POST, 'status'));
            $price = strip_tags(filter_input(INPUT_POST, 'price'));

            $categoryId = strip_tags(filter_input(INPUT_POST, 'category_id'));
            $brandId = strip_tags(filter_input(INPUT_POST, 'brand_id'));
            $typeId = strip_tags(filter_input(INPUT_POST, 'type_id'));

            $product = new Product();
            $product->setName($name);
            $product->setDescription($description);
            $product->setPicture($picture);
            $product->setStatus($status);
            $product->setPrice($price);

            $product->setCategoryId($categoryId);
            $product->setTypeId($typeId);
            $product->setBrandId($brandId);

            if ($product->insert()){
               
                $_SESSION['alert'] = "Votre produit a bien été ajouté !";
                header("Location: list");
                die();
            }
        }

        $allCategories = Category::findAll();

        $allBrands = Brand::findAll();

        $allTypes = Type::findAll();

        $this->show('product/add', [
            "allCategories" => $allCategories,
            "allBrands" => $allBrands,
            "allTypes" => $allTypes
        ]);
    }



    public function update($productId)
    { 
        $product = Product::find($productId);

        if (!empty($_POST)){
           
            $name = strip_tags(filter_input(INPUT_POST, 'name'));
            $description = strip_tags(filter_input(INPUT_POST, 'description'));
            $picture = strip_tags(filter_input(INPUT_POST, 'picture'));
            $status = strip_tags(filter_input(INPUT_POST, 'status'));
            $price = strip_tags(filter_input(INPUT_POST, 'price'));

            $categoryId = strip_tags(filter_input(INPUT_POST, 'category_id'));
            $brandId = strip_tags(filter_input(INPUT_POST, 'brand_id'));
            $typeId = strip_tags(filter_input(INPUT_POST, 'type_id'));


            $product->setName($name);
            $product->setDescription($description);
            $product->setPicture($picture);
            $product->setStatus($status);
            $product->setPrice($price);

            $product->setCategoryId($categoryId);
            $product->setTypeId($typeId);
            $product->setBrandId($brandId);

            if ($product->update()){
               
                $_SESSION['alert'] = "Votre produit a bien été modifié !";
             
                $this->redirectToRoute("product-list");
            }
        }

        $allCategories = Category::findAll();
        $allBrands = Brand::findAll();
        $allTypes = Type::findAll();

        $this->show('product/update', [
            "product" => $product,
            "allCategories" => $allCategories,
            "allBrands" => $allBrands,
            "allTypes" => $allTypes
        ]);
    }
    
}