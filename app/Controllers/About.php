<?php

namespace App\Controllers;

use CodeIgniter\Controller;
#use App\Models\MenuModel;

class About extends Controller
{

    #public $menuModel;
    public function __construct()
    {
        helper('form');
        #$this->menuModel = new MenuModel();
    }

    public function index()
    {
        $data['page_title'] = 'About Us';

        return view('pages/about_view', $data);
    }
}
