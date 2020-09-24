<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;


class MainController extends CoreController {

    public function home()
    {
       
        $homeCategories = Category::findAllHomepage();

        $homeProducts = Product::findAllHomepage();

        $this->show('main/home', ["categories" => $homeCategories, "products" => $homeProducts]);
    }


}

