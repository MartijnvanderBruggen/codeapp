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
        $snippets = (new CodeSnippetModel)->findAll();
        return $this->response->setStatusCode(200)->setJSON( ['data' => $snippets] );
    }

    public function create()
    {       
        $rules = [
            'title.value' => 'required',
            'content.value' => 'required',            
        ];

        if (! $this->validate($rules)) {
            return $this->response->setStatusCode(400)->setJSON( [
                'errors' => $this->validator->listErrors(),
                'message' => 'validation failed'
            ] );
        }
        //extract keys and values from stdclass and store in data array
        foreach($this->request->getVar() as $key => $value){
            //sanitize input           
            $data[$key] = $value->value;
        }
       
        $Codesnippet = new CodeSnippetModel();
        try 
        {
            $Codesnippet->insert($data);
            return $this->response->setStatusCode(200)->setJSON( ['message' => 'Stored in db'] );
        } 
        catch(Exception $e) 
        {
            return $this->response->setStatusCode(500)->setJSON( ['error' => "something went wrong while trying to save to db: {$e->getMessage()}"] );
        }
    }

    public function delete($id = null) {
        $Codesnippet = new CodeSnippetModel();
        $Codesnippet->delete($id);

    }
}