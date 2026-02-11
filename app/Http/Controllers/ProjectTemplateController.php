<?php

namespace App\Http\Controllers;

use App\Models\ProjectTemplate;
use Inertia\Inertia;

class ProjectTemplateController extends Controller
{
    public function index()
    {
        $templates = ProjectTemplate::where('is_active', true)
            ->orderBy('title')
            ->get();

        return Inertia::render('Templates/Index', [
            'templates' => $templates,
        ]);
    }
}
