<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MenuListModel;


class Menulist extends Controller
{

    public $menulistModel;
    public function __construct()
    {
        helper('form');
        $this->menulistModel = new MenuListModel();
    }

    public function index()
    {
        $data['validation'] = null;
        $data['page_title'] = 'Menu List';
        if (!session()->has('logged_admin')) {
            return redirect()->to(base_url() . '/login');
        }
        $data['menu_list'] = $this->menulistModel->getAllMenu();
        $data['category_list'] = $this->menulistModel->getAllCategory();

        if (isset($_POST['add_menu'])) {
            $file = $this->request->getFile("add_menu_image");
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'public\uploads', $newName);
            $added_menu = [
                "category_id" => $this->request->getVar("add_category"),
                "menu_name" => $this->request->getVar("add_menu_name"),
                "menu_image" => $newName,
                "size" => $this->request->getVar("add_size"),
                "price" => $this->request->getVar("add_price"),
                //"best_seller" => $this->request->getVar("add_best_seller"),
            ];
            if ($this->menulistModel->addMenu($added_menu)) {
                session()->setTempdata('success', 'Menu added successfully', 3);
                return redirect()->to(current_url());
            }
        }

        if (isset($_POST['category_filter'])) {
            $category_id = $this->request->getVar("category_filter");
            if ($category_id == 'all') {
                $data['menu_list'] = $this->menulistModel->getAllMenu();
            } else {
                $data['menu_list'] = $this->menulistModel->getCategoryAllMenu($category_id);
            }
        }

        if (isset($_POST['edit_menu'])) {
            $menu_id = $this->request->getVar("menu_id_hidden");
            $edit_menu_image = $this->request->getFile("edit_menu_image");
            $edit_menu_category = $this->request->getVar("edit_menu_category");
            $edit_menu_name = $this->request->getVar("edit_menu_name");
            $edit_menu_size = $this->request->getVar("edit_menu_size");
            $edit_menu_price = $this->request->getVar("edit_menu_price");
            $edit_best_seller = $this->request->getVar("edit_best_seller");
            if (!is_uploaded_file($edit_menu_image)) {
                $current_menu_image_path = $this->request->getVar('current_menu_image_path');
                $edited_menu = [
                    "category_id" => $edit_menu_category,
                    "menu_name" => $edit_menu_name,
                    "menu_image" => $current_menu_image_path,
                    "size" => $edit_menu_size,
                    "price" => $edit_menu_price,
                    "best_seller" => $edit_best_seller,
                ];
                if ($this->menulistModel->editMenu($menu_id, $edited_menu)) {
                    session()->setTempdata('success', 'Menu changed successfully', 3);
                    return redirect()->to(current_url());
                }
            } else {
                $newName = $edit_menu_image->getRandomName();
                $edit_menu_image->move(FCPATH . 'public\uploads', $newName);
                $edited_menu = [
                    "category_id" => $edit_menu_category,
                    "menu_name" => $edit_menu_name,
                    "menu_image" => $newName,
                    "size" => $edit_menu_size,
                    "price" => $edit_menu_price,
                    "best_seller" => $edit_best_seller,
                ];
                if ($this->menulistModel->editMenu($menu_id, $edited_menu)) {
                    session()->setTempdata('success', 'Menu changed successfully', 3);
                    return redirect()->to(current_url());
                }
            }
        }
        return view('pages/menu_list_view', $data);
    }

    public function getmenudetails()
    {
        $menu_id = $_GET['menu_id'];
        $menu_details = $this->menulistModel->getMenuDetails($menu_id);
        return $this->response->setJSON($menu_details);
    }

    public function delete_menu()
    {
        $menu_id = $_GET['menu_id'];
        if ($this->menulistModel->deleteMenu($menu_id)) {
            return redirect()->to(current_url());
        }
    }
}
