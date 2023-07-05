<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    use App\Models\CategoryModel;

    class Category extends Controller{

        public $categoryModel;
        public function __construct(){
            helper('form');
            $this->categoryModel = new CategoryModel();
        }

        public function index(){
            $data['page_title'] = 'Category';

            if(!session()->has('logged_admin')){
                return redirect()->to(base_url().'/login');
            }
            $data['categories'] = $this->categoryModel->getAllCategory();
            
            if(isset($_POST['add_category'])){
                $category = $this->request->getVar('category');
                if($this->categoryModel->addCategory($category)){
                    return redirect()->to(current_url());
                }
            }

            if(isset($_POST['save_category'])){
                $category = $this->request->getVar('edit_category');
                $category_id = $this->request->getVar('edit_category_id');
                if($this->categoryModel->saveCategory($category, $category_id)){
                    return redirect()->to(current_url());
                }
            }

            return view('pages/category_view', $data);
        }

        public function getcategory(){
            $category_id = $_GET['id'];
            $category = $this->categoryModel->getCategory($category_id);
            return $this->response->setJSON($category);
        }

        public function deletecategory(){
            $category_id = $_GET['id'];
            if($this->categoryModel->deleteCategory($category_id)){
                return redirect()->to(base_url().'/category');
            }
        }

    }
