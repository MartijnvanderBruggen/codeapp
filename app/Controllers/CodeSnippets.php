<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\CodeSnippet as CodeSnippetModel;
use CodeIgniter\API\ResponseTrait;

class CodeSnippets extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\CodeSnippet';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function create()
    {
       
        $CodeSnippetModel = new CodeSnippetModel();
        $data = [
            'title' => $this->request->getVar('title'),
            'content'  => $this->request->getVar('content'),
        ];
        $CodeSnippetModel->insert($data);
        //return $this->response->setStatusCode(200);
        return $this->response->setStatusCode(200)->setJSON( ['message' => 'testing'] );
        //return $this->respondCreated();
    }
}