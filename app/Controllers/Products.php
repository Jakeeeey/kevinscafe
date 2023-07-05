<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductsModel;


class Products extends Controller
{

    public $productsModel;
    public function __construct()
    {
        helper('form');
        $this->productsModel = new ProductsModel();
    }

    public function index()
    {
        $data['validation'] = null;
        $data['page_title'] = 'Products';
        if (!session()->has('logged_admin')) {
            return redirect()->to(base_url() . '/login');
        } else {
            $data['products'] = $this->productsModel->get_products();
        }

        if (isset($_POST['product_edit'])) {
            session()->set('prod_id', $this->request->getVar('prod_id'));
            return redirect()->to(base_url() . '/editproduct');
        }

        if (isset($_POST['product_delete'])) {
            $prod_id = $this->request->getVar('prod_id');
            if ($this->productsModel->deleteProduct($prod_id)) {
                session()->setTempdata("success", "Product deleted successfully", 3);
                return redirect()->to(current_url());
            } else {
                session()->setTempdata("error", "Sorry, unable to delete product", 3);
                return redirect()->to(current_url());
            }
        }

        if (isset($_POST['product_delete'])) {
            $prod_id = $this->request->getVar('prod_id');
            if ($this->productsModel->deleteProduct($prod_id)) {
                session()->setTempdata("success", "Product deleted successfully", 3);
                return redirect()->to(current_url());
            } else {
                session()->setTempdata("error", "Sorry, unable to delete product", 3);
                return redirect()->to(current_url());
            }
        }
        return view('pages/products_view', $data);
    }


    public function add(){
        $data['validation'] = null;
        $data['page_title'] = 'Add Product';
        if (!session()->has('logged_admin')) {
            return redirect()->to(base_url() . '/login');
        } else {
            if ($this->request->getMethod() == 'post') {
                $rules = [
                    'prod_img' => 'uploaded[prod_img]|max_size[prod_img,5024]|ext_in[prod_img,png,jpg,gif]',
                    'category' => 'required',
                    'p_name' => 'required',
                    'size' => 'required',
                    'price' => 'required',
                ];
                if ($this->validate($rules)) {
                    $file = $this->request->getFile("prod_img");
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        if ($file->move(FCPATH . 'public\uploads', $newName)) {
                            $product = [
                                "p_img" => $newName,
                                "category" => $this->request->getVar("category"),
                                "p_name" => $this->request->getVar("p_name"),
                                "size" => $this->request->getVar("size"),
                                "price" => $this->request->getVar("price"),
                            ];
                            if ($this->productsModel->addProduct($product)) {
                                session()->setTempdata('success', 'Product added successfully', 3);
                                return redirect()->to(base_url().'/products');
                            } else {
                                session()->setTempdata('error', 'Sorry, unable to add product', 3);
                                return redirect()->to(current_url());
                            }
                        }
                    }
                } else {
                    $data['validation'] = $this->validator;
                }
            }
        }

        return view('pages/add_product_view', $data);
    }
}
