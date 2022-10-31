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
            'title' => 'required',
            'content' => 'required',            
        ];

        if (! $this->validate($rules)) {
            return $this->response->setStatusCode(400)->setJSON( [
                'errors' => $this->validator->listErrors(),
                'message' => 'validation failed'
            ] );
        }
        //extract keys and values from stdclass and store in data array
       
        foreach($this->request->getVar() as $formFieldName => $formFieldValue) {
            $data[$formFieldName] = trim($formFieldValue);
        }

        //sanitize
       

        $datafilter = array(
            'title' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => !FILTER_FLAG_STRIP_LOW),    // removes tags. formatting code is encoded
            'content' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => !FILTER_FLAG_STRIP_LOW),           
        );

        $santized_data_array = filter_var_array($data, $datafilter);
        $Codesnippet = new CodeSnippetModel();
        $Codesnippet->insert($santized_data_array);
        return $this->response->setStatusCode(200)->setJSON( ['message' => 'Stored in db'] );
    }

    public function delete($id = null) {
        $Codesnippet = new CodeSnippetModel();
        $Codesnippet->delete($id);
    }
}

