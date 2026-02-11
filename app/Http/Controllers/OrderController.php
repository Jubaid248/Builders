<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDeliverable;
use App\Models\ProjectTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()
            ->orders()
            ->with(['projectTemplate', 'deliverables'])
            ->latest()
            ->paginate(10);

        return Inertia::render('Orders/Index', [
            'orders' => $orders,
        ]);
    }

    public function create(Request $request)
    {
        $templates = ProjectTemplate::where('is_active', true)->get();
        $projectTypes = ProjectTemplate::projectTypes();
        $complexityLevels = ProjectTemplate::complexityLevels();
        $templateId = $request->integer('template_id', 0);
        $selectedTemplate = $templateId ? ProjectTemplate::find($templateId) : null;

        return Inertia::render('Orders/Create', [
            'templates' => $templates,
            'projectTypes' => $projectTypes,
            'complexityLevels' => $complexityLevels,
            'selectedTemplate' => $selectedTemplate,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_template_id' => 'nullable|exists:project_templates,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_type' => 'required|in:web,ml,iot,desktop',
            'tech_stack_preference' => 'nullable|string|max:500',
            'deadline' => 'nullable|date',
            'complexity' => 'required|in:low,medium,high',
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['status'] = 'pending';

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Project order submitted successfully.');
    }

    public function show(Request $request, Order $order)
    {
        if ($order->user_id !== $request->user()->id) {
            abort(403);
        }

        $order->load([
            'projectTemplate',
            'deliverables',
            'learningMaterial',
            'vivaQuestions' => fn ($q) => $q->orderBy('sort_order'),
        ]);

        return Inertia::render('Orders/Show', [
            'order' => $order,
        ]);
    }

    public function download(Request $request, Order $order, OrderDeliverable $deliverable)
    {
        if ($order->user_id !== $request->user()->id) {
            abort(403);
        }
        if ($deliverable->order_id !== $order->id) {
            abort(404);
        }

        if ($deliverable->isLocalFile()) {
            $path = $deliverable->file_path;
            if (! Storage::disk('local')->exists($path)) {
                abort(404);
            }
            return Storage::disk('local')->download(
                $path,
                $deliverable->file_name,
                ['Content-Type' => 'application/zip']
            );
        }

        return redirect()->away($deliverable->file_path);
    }
}
