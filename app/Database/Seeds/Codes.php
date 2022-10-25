<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;
use Faker\Generator;

class Codes extends Seeder
{
    
    public function run()
    {
        $faker = Factory::create();
        $data = [
            'title' => $faker->sentence(),
            'content'    => $faker->paragraph(),
        ];

        // Simple Queries
        $this->db->query('INSERT INTO codes (title, content) VALUES(:title:, :content:)', $data);

        // Using Query Builder
        //$this->db->table('codes')->insert($data);
    }
}
