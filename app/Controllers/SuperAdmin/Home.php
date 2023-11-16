<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;

class Home extends BaseController
{

    protected $helpers = ['master'];
    public function index()
    {
        $data = ['title'=> 'Home',
    ];
        return view('SuperAdmin/Home', $data);
    }
    function Logout()
    {
    session()->remove('super_sess');
    return redirect()->to(base_url('auth/admin'));
        
    }
}
