<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = $this->db = \config\Database::connect();
        $query = $db->query('select * from test');
        $res = $query->getResult();


        return view('welcome_message', ['data' => $res]);
    }
}
