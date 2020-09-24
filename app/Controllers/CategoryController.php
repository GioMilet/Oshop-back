<?php

namespace App\Controllers;

use App\Models\Category;

class CategoryController extends CoreController {

    public function list()
    {
        $categories = Category::findAll();

        $this->show('category/list', ["categories" => $categories]);
    }

    public function add()
    { 

        if (!empty($_POST)){
        
            $name = strip_tags(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
            $subtitle = strip_tags(filter_input(INPUT_POST, 'subtitle'));
            $picture = strip_tags(filter_input(INPUT_POST, 'picture'));

            $category = new Category();
            $category->setName($name);
            $category->setSubtitle($subtitle);
            $category->setPicture($picture);

            $category->insert();
        }

        $this->show('category/add');
    }

    public function update($categoryId)
    {
        $category = Category::find($categoryId);

        if (!empty($_POST)){
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $subtitle = strip_tags(filter_input(INPUT_POST, 'subtitle'));
            $picture = strip_tags(filter_input(INPUT_POST, 'picture'));

            $category->setName($name);
            $category->setSubtitle($subtitle);
            $category->setPicture($picture);

            if ($category->update()){
                $_SESSION['alert'] = 'Catégorie modifiée ! Bravo !';

                $this->redirectToRoute("category-list");
            }
        }

        $this->show('category/update', ["category" => $category]);
    }
}