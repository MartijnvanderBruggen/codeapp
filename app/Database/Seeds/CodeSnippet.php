<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CodeSnippet extends Seeder
{
    public function run()
    {
        
        $data = [
            'title' => 'some title',
            'content'    => 'some content',
        ];

        // Simple Queries
        $this->db->query('INSERT INTO codesnippets (title, content) VALUES(:title:, :content:)', $data);

        // Using Query Builder
        $this->db->table('codesnippets')->insert($data);
        
    }
}
