<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EditProductModel;


class EditProduct extends Controller
{

    public $editproductModel;
    public function __construct()
    {
        helper('form');
        $this->editproductModel = new EditProductModel();
    }

    public function index()
    {
        $data['validation'] = null;
        $data['page_title'] = 'Edit Product';
        $id = session()->get('prod_id');
        if (!session()->has('logged_admin')) {
            return redirect()->to(base_url() . '/login');
        } else {
            
            if ($id == null) {
                return redirect()->to(base_url() . '/products');
            } else {
                $data['p_info'] = $this->editproductModel->get_product_info($id);
                if (isset($_POST['product_image'])) {
                    $rules = [
                        'prod_img' => 'uploaded[prod_img]|max_size[prod_img,5024]|ext_in[prod_img,png,jpg,gif]',
                    ];
                    if ($this->validate($rules)) {
                        $file = $this->request->getFile('prod_img');
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $file->getRandomName();
                            if ($file->move(FCPATH . 'public/uploads', $newName)) {
                                if($this->editproductModel->updateProductImg($newName, $id)){
                                    session()->setTempdata('success-product_image', 'Image uploaded successfully', 3);
                                    return redirect()->to(current_url());
                                }
                            } else {
                                session()->setTempdata('error-product_image', $file->getErrorString() . " " . $file->getError(), 3);
                                return redirect()->to(current_url());
                            }
                        } else {
                        }
                    } else {
                        $data['validation'] = $this->validator;
                    }
                }

                if (isset($_POST['product_info'])) {
                    $product_info = [
                        'category' => $this->request->getVar('category'),
                        'p_name' => $this->request->getVar('p_name'),
                        'size' => $this->request->getVar('size'),
                        'price' => $this->request->getVar('price')
                    ];
                    #print_r($product_info);die;
                    if ($this->editproductModel->update_product($product_info, $id)) {
                        session()->setTempdata('success-p_info', 'Product information updated succesfully', 3);
                        return redirect()->to(current_url());
                    } else {
                        session()->setTempdata('error-p_info', 'Sorry, product information unable to update', 3);
                        return redirect()->to(current_url());
                    }
                }

                if(isset($_POST['product_delete'])){
                    if($this->request->getVar('test') == 'yes'){
                        if($this->editproductModel->deleteProduct($id)){
                            session()->setTempdata('success', 'Product deleted successfully', 3);
                            return redirect()->to(base_url().'/products');
                        }else{
                            session()->setTempdata('success', 'Sorry, unable to delete product, try again', 3);
                            return redirect()->to(current_url());
                        }
                    }
                }
            }

            return view('pages/edit_product_view', $data);
        }
    }
}
