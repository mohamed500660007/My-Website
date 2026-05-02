<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ProjectController extends Controller
{
    protected ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index(): View|JsonResponse
    {
        $projects = $this->projectService->getAllProjects(request()->all());
        $stats = $this->projectService->getProjectStats();
        $technologies = $this->projectService->getTechnologies();

        if (request()->ajax()) {
            $view = view('admin.projects.partials.project_list', compact('projects'))->render();
            $statsView = view('admin.projects.partials.stats', compact('stats'))->render();
            return response()->json([
                'html' => $view,
                'stats_html' => $statsView,
                'stats' => $stats
            ]);
        }
        
        return view('admin.projects.index', compact('projects', 'stats', 'technologies'));
    }

    public function create(): View
    {
        $fields = $this->getDynamicFields();
        return view('admin.projects.create', compact('fields'));
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $validated['is_featured'] = $request->has('is_featured');
            $project = $this->projectService->createProject($validated);

            return response()->json([
                'success' => true,
                'message' => 'تم إنشاء المشروع بنجاح!',
                'project' => $project
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء إنشاء المشروع: ' . $e->getMessage()
            ], 422);
        }
    }

    public function show(int $id): View|string
    {
        $project = $this->projectService->getProjectWithRelations($id);
        
        if (!$project) {
            abort(404);
        }

        if (request()->ajax() && request()->has('preview')) {
            return view('admin.projects.partials.preview', compact('project'))->render();
        }

        return view('admin.projects.show', compact('project'));
    }

    public function edit(int $id): View
    {
        $project = $this->projectService->getProjectWithRelations($id);
        
        if (!$project) {
            abort(404);
        }

        $fields = $this->getDynamicFields();
        return view('admin.projects.edit', compact('project', 'fields'));
    }

    public function update(UpdateProjectRequest $request, int $id): JsonResponse
    {
        try {
            $validated = $request->validated();
            $validated['is_featured'] = $request->has('is_featured');
            $success = $this->projectService->updateProject($id, $validated);

            if ($success) {
                $project = $this->projectService->getProjectWithRelations($id);
                return response()->json([
                    'success' => true,
                    'message' => 'تم تحديث المشروع بنجاح!',
                    'project' => $project
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'المشروع غير موجود'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث المشروع: ' . $e->getMessage()
            ], 422);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $success = $this->projectService->deleteProject($id);

            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم حذف المشروع بنجاح!'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'المشروع غير موجود'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف المشروع: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleFeatured(int $id): JsonResponse
    {
        try {
            $success = $this->projectService->toggleFeatured($id);

            if ($success) {
                $project = $this->projectService->getProjectWithRelations($id);
                return response()->json([
                    'success' => true,
                    'message' => $project->is_featured ? 'تم تمييز المشروع بنجاح!' : 'تم إلغاء تمييز المشروع!',
                    'is_featured' => $project->is_featured
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'المشروع غير موجود'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث حالة التمييز: ' . $e->getMessage()
            ], 500);
        }
    }

    public function publish(int $id): JsonResponse
    {
        try {
            $success = $this->projectService->publishProject($id);

            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم نشر المشروع بنجاح!'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'المشروع غير موجود'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء نشر المشروع: ' . $e->getMessage()
            ], 500);
        }
    }

    public function unpublish(int $id): JsonResponse
    {
        try {
            $success = $this->projectService->unpublishProject($id);

            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم تحويل المشروع إلى مسودة بنجاح!'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'المشروع غير موجود'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحويل المشروع إلى مسودة: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(int $id): JsonResponse
    {
        try {
            $status = request('status');
            $project = $this->projectService->getProjectWithRelations($id);
            if (!$project) {
                return response()->json(['success' => false, 'message' => 'المشروع غير موجود'], 404);
            }

            if ($status === 'published') {
                $this->projectService->publishProject($id);
            } else {
                $this->projectService->unpublishProject($id);
            }

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الحالة بنجاح!',
                'status' => $status
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    private function getDynamicFields(): array
    {
        $columns = \Schema::getColumnListing('projects');
        $exclude = ['id', 'created_at', 'updated_at', 'slug']; // Slug is often auto-generated
        
        $fields = [];
        foreach ($columns as $column) {
            if (in_array($column, $exclude)) continue;
            
            $type = \Schema::getColumnType('projects', $column);
            
            $label = match($column) {
                'title' => 'عنوان المشروع',
                'short_description' => 'وصف قصير',
                'full_description' => 'الوصف الكامل',
                'cover_image' => 'صورة الغلاف',
                'demo_url' => 'رابط الديمو',
                'github_url' => 'رابط جيت هاب',
                'is_featured' => 'مشروع مميز',
                'status' => 'الحالة',
                default => ucfirst(str_replace('_', ' ', $column))
            };

            $fieldType = match($type) {
                'text', 'mediumtext', 'longtext' => 'textarea',
                'boolean', 'tinyint' => 'checkbox',
                'enum' => 'select',
                default => 'text'
            };

            // Custom overrides
            if ($column === 'status') $fieldType = 'select';
            if ($column === 'cover_image') $fieldType = 'file';
            if (str_contains($column, 'url')) $fieldType = 'url';
            if ($column === 'full_description') $fieldType = 'editor';

            $fields[$column] = [
                'name' => $column,
                'label' => $label,
                'type' => $fieldType,
                'required' => !in_array($column, ['github_url', 'is_featured']),
                'options' => $column === 'status' ? ['draft' => 'مسودة', 'published' => 'منشور'] : []
            ];
        }
        
        return $fields;
    }
}
