<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


class Codes extends ResourceController
{
    protected $modelName = 'App\Models\Codes';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function create() {
        $code = new Codes();
        $codes->title = $request['title'];
        $codes->content = $request['content'];
        $codes->save();

    }

    public function show($id=null) {

    }

    public function update($id=null) {

    }

    public function delete($id=null){

    }
}
