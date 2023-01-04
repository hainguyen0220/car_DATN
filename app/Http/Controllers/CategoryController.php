<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\UpdateMessageTrait;

class CategoryController extends Controller
{
    use UpdateMessageTrait;
    const DEFAULT_PAGINATE = 15;
    public function listCategory(Request $request)
    {
        $searchParams = $request->category;

        $categorys = Category::withFilter($searchParams)
            ->paginate(self::DEFAULT_PAGINATE);

        return view('admin.category.table_category')->with(
            [
                'categorys' => $categorys,
            ]
        );
    }

    public function showCreateCategory()
    {
        return view('admin.category.create_category');
    }

    public function createCategory(Request $request)
    {

        $request->validate(
            [
                'category_name' => 'required|min:4|max:255|unique:category',
            ],
        );

        $category_name = $request->category_name;
        try {

            $category = new Category();
            $category->category_name = $category_name;
            $category->save();

            $this->updateSuccessMessage($request, __('message.create-successful'));

            return back();
        } catch (Throwable $e) {

            log::channel('admin_log')->info($e->getMessage());

            $this->updateFailMessage($request, __('message.create-fail'));

            return back();
        }
    }

    public function showUpdateCategory($id)
    {
        $category = Category::find($id);
        session()->put('id_category_update', $id);
        return view('admin.category.update_category')
            ->with(compact('category'));
    }

    public function updateCategory(Request $request)
    {
        $id = session()->get('id_category_update');
        if (!$id) {

            $this->updateFailMessage($request, __('message.update-fail'));

            return back();
        }

        $request->validate(
            [
                'category_name' => 'required|min:4|max:255|unique:category,category_name,' . $id,
            ],
        );

        $category_name = $request->category;
        try {
            Category::where('id', $id)->update([
                'category_name' => $category_name,
            ]);

            $this->updateSuccessMessage($request, __('message.update-successful'));
            return back();
        } catch (Throwable $e) {

            log::channel('admin_log')->info($e->getMessage());

            $this->updateFailMessage($request, __('message.update-fail'));

            return back();
        }
    }


    public function deleteCategory(Request $request, $id)
    {
        if (!$id) {

            $this->updateFailMessage($request, __('message.delete-fail'));

            return back();
        }

        try {
            Category::find($id)->delete();
            $this->updateSuccessMessage($request, __('message.delete-successful'));
            return back();
        } catch (Throwable $e) {

            log::channel('admin_log')->info($e->getMessage());

            $this->updateFailMessage($request, __('message.delete-fail'));

            return back();
        }
    }

    public function getCategoryDetail(Request $request)
    {
        $category = Category::with('category_detail')->get();
        return $category; 
    }

   

}
