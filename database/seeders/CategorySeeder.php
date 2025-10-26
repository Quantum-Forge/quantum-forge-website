<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Web Development', 'description' => 'Website and web app projects'],
            ['name' => 'Mobile App Development', 'description' => 'Android/iOS native or cross-platform apps'],
            ['name' => 'API Development', 'description' => 'Backend services and REST/GraphQL APIs'],
            ['name' => 'UI/UX Design', 'description' => 'Design systems and prototyping'],
            ['name' => 'DevOps', 'description' => 'CI/CD, infrastructure, and automation'],
            ['name' => 'QA & Testing', 'description' => 'Manual and automated testing suites'],
            ['name' => 'E-commerce', 'description' => 'Online stores and payment integrations'],
            ['name' => 'SaaS', 'description' => 'Software-as-a-Service platforms'],
            ['name' => 'IoT', 'description' => 'Internet of Things integrations'],
            ['name' => 'Data Engineering', 'description' => 'ETL pipelines and data warehousing'],
            ['name' => 'Machine Learning', 'description' => 'ML models and MLOps'],
            ['name' => 'Cloud Migration', 'description' => 'Lift-and-shift and modernization'],
            ['name' => 'Maintenance & Support', 'description' => 'Ongoing support and improvements'],
            ['name' => 'CMS Development', 'description' => 'Headless and traditional CMS builds'],
            ['name' => 'RPA & Automation', 'description' => 'Robotic process automation projects'],
        ];

        foreach ($categories as $cat) {
            $slug = Str::slug($cat['name']);

            Category::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $cat['name'],
                    'slug' => $slug,
                    'description' => $cat['description'],
                    'is_active' => true,
                ]
            );
        }
    }
}
