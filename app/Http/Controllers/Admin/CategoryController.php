<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Categories');
    }


    public function index()
    {
        $categories = Category::with('services')->latest()->get();
        return view('dashboard.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('dashboard.categories.create');
    }


    public function store(CategoryRequest $request)
    {
        $validator = $request->validated();
        Category::create($validator);
        return redirect(route('admin.categories.index'))->with('success', 'تم الاضافة بنجاح');
    }


    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }


    public function update(CategoryRequest $request, Category $category)
    {
        $validator = $request->validated();
        if ($request->image) {
            if ($category->image) {
                deleteImage('uploads', $category->image);
            }
        }

        $category->update($validator);
        return redirect(route('admin.categories.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return 'Done';
    }
}
