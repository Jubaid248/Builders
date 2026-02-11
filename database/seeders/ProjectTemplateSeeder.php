<?php

namespace Database\Seeders;

use App\Models\ProjectTemplate;
use Illuminate\Database\Seeder;

class ProjectTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'title' => 'E-Commerce Web Application',
                'slug' => 'ecommerce-web-app',
                'description' => 'Full-featured online store with cart, checkout, and admin panel.',
                'project_type' => 'web',
                'tech_stack' => ['Laravel', 'Vue.js', 'MySQL'],
                'complexity' => 'high',
                'is_active' => true,
            ],
            [
                'title' => 'Student Management System',
                'slug' => 'student-management-system',
                'description' => 'CRUD system for managing students, courses, and enrollments.',
                'project_type' => 'web',
                'tech_stack' => ['Laravel', 'Blade', 'MySQL'],
                'complexity' => 'medium',
                'is_active' => true,
            ],
            [
                'title' => 'Image Classification with ML',
                'slug' => 'image-classification-ml',
                'description' => 'Train and deploy a simple image classifier using Python and TensorFlow.',
                'project_type' => 'ml',
                'tech_stack' => ['Python', 'TensorFlow', 'OpenCV'],
                'complexity' => 'high',
                'is_active' => true,
            ],
            [
                'title' => 'Smart Home IoT Dashboard',
                'slug' => 'smart-home-iot',
                'description' => 'Dashboard to control and monitor IoT devices (lights, sensors).',
                'project_type' => 'iot',
                'tech_stack' => ['Node.js', 'MQTT', 'Raspberry Pi'],
                'complexity' => 'medium',
                'is_active' => true,
            ],
        ];

        foreach ($templates as $t) {
            ProjectTemplate::updateOrCreate(
                ['slug' => $t['slug']],
                $t
            );
        }
    }
}
