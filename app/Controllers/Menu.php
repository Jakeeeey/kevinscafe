<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MenuModel;

class Menu extends Controller
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
        $category_info = $this->menuModel->getAllCategories();
        $data['categories'] = $category_info;
        
        if (session()->has('logged_user')) {
            $carts = $this->menuModel->getAllPending(session()->get('logged_user_id'));
            if($carts){
                session()->set('cart_count', count($carts));
            }else{
                session()->set('cart_count', '');
            }
            if (session()->has('no_profile')) {
                return redirect()->to(base_url() . '/profile1');
            }
        }

        foreach ($category_info as $index => $category) {
            $data['category_menu' . $index] = ($this->menuModel->getCategoryAllMenu($category['category_id']));
        }

        $data['best_sellers'] = $this->menuModel->getBestSellers();
        if ($this->request->getMethod() == 'post') {
            if (session()->has('logged_user')) {
                $menu_id = $this->request->getVar('menu_id');
                $quantity = (int)$this->request->getVar('quantity');
                $sub_price = $this->request->getVar('sub_price');
                $user_id = session()->get('logged_user_id');

                $cart_menu = [
                    'user_id' => $user_id,
                    'menu_id' => $menu_id,
                    'quantity' => $quantity,
                    'sub_price' => $sub_price,
                ];
                if ($this->menuModel->addCart($cart_menu)) {
                    session()->setTempdata('success', "Added to cart", 4);
                    return redirect()->to(current_url());
                } else {
                    session()->setTempdata('error', "Sorry unable to add to cart, try again", 4);
                    return redirect()->to(current_url());
                }
            } else {
                return redirect()->to(base_url() . '/login');
            }
        }

        return view('pages/menu_view', $data);
    }
}
