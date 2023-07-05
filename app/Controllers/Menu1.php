<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MenuModel;

class Menu1 extends Controller
{

    public $menuModel;
    public function __construct()
    {
        helper('form');
        $this->menuModel = new MenuModel();
    }

    public function index()
    {
        $data['page_title'] = 'Menu';
        #'<pre>';
        #echo count($data['MilkteaWithFreeBlackPearl'] = $this->menuModel->getAllProducts('Milktea With Free Black Pearl'));die;
        $data['MilkteaWithFreeBlackPearl'] = $this->menuModel->getAllProducts('Milktea With Free Black Pearl');
        $data['YougurtSmoothies'] = $this->menuModel->getAllProducts('Yougurt Smoothies');
        $data['FruitTea'] = $this->menuModel->getAllProducts('Fruit Tea');
        $data['YakultSeries'] = $this->menuModel->getAllProducts('Yakult Series');
        $data['RockSaltCheese'] = $this->menuModel->getAllProducts('Rock Salt & Cheese');
        $data['ItalianSoda'] = $this->menuModel->getAllProducts('Italian Soda');
        $data['ClassicFrapeIceBlended'] = $this->menuModel->getAllProducts('Classic Frape Ice Blended');
        $data['OrganicFrappeIcedBlended'] = $this->menuModel->getAllProducts('Organic Frappe (Iced Blended)');
        $data['OrganicHotDrink'] = $this->menuModel->getAllProducts('Organic Hot Drink');
        $data['Appetizers'] = $this->menuModel->getAllProducts('Appetizers');
        $data['ClassicTapsilog'] = $this->menuModel->getAllProducts('Classic Tapsilog');
        $data['Snacks'] = $this->menuModel->getAllProducts('Snacks');
        $data['ChickenWings'] = $this->menuModel->getAllProducts('Chicken Wings');
        if ($this->request->getMethod() == 'post') {
            if (session()->has('logged_user')) {
                $product_id = $this->request->getVar('product_id');
                $quantity = (int)$this->request->getVar('quantity');
                $price = $this->menuModel->getProductPrice($product_id);
                if (session()->has('logged_user')) {
                    $uid = session()->get('logged_user');
                    $user_id = $this->menuModel->getUserUid($uid);

                    $product_data = [
                        'user_id' => $user_id['id'],
                        'p_id' => $product_id,
                        'quantity' => $quantity,
                        'sub_price' => $price,
                    ];
                    if ($this->menuModel->addCart($product_data)) {
                        session()->setTempdata('success', "Added to cart", 4);
                        return redirect()->to(current_url());
                    } else {
                        session()->setTempdata('error', "Sorry unable to add to cart, try again", 4);
                        return redirect()->to(current_url());
                    }
                } else {
                    return redirect()->to(base_url() . '/login');
                }
            } else {
                return redirect()->to(base_url() . '/login');
            }
        }

        return view('pages/menu_view', $data);
    }
}
