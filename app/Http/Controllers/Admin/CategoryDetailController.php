<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UpdateMessageTrait;
use App\Models\Category;
use App\Models\CategoryDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class CategoryDetailController extends Controller
{
    use UpdateMessageTrait;
    const DEFAULT_PAGINATE = 15;

    public function listCategoryDetail(Request $request)
    {


        $categoryOptions = Category::all();
        $searchParams = [
            'category_detail' => $request->input('category_detail'),
            'category_id' => $request->input('category_id'),
        ];

        $categoryDetails = CategoryDetail::with('category')->withFilter($searchParams)
            ->paginate(self::DEFAULT_PAGINATE);

        return view('admin.category_detail.table_category_detail')->with(
            [
                'categoryOptions' => $categoryOptions,
                'categoryDetails' => $categoryDetails
            ]
        );
    }

    public function showCreateCategoryDetail()
    {
        $categoryOptions = Category::all();
        return view('admin.category_detail.create_category_detail')
            ->with(compact('categoryOptions'));
    }

    public function createCategoryDetail(Request $request)
    {

        $request->validate(
            [
                'category_detail_name' => 'required|min:4|max:255|unique:category_detail',
                'category_id' => 'required',
            ],
        );

        $data = $request->only('category_detail_name', 'category_id');
        try {

            $categoryDetail = new CategoryDetail();
            $categoryDetail->category_id = $data['category_id'];
            $categoryDetail->category_detail_name = $data['category_detail_name'];
            $categoryDetail->save();

            $this->updateSuccessMessage($request, __('message.create-successful'));

            return back();
        } catch (Throwable $e) {

            log::channel('admin_log')->info($e->getMessage());

            $this->updateFailMessage($request, __('message.create-fail'));

            return back();
        }
    }

    public function showUpdateCategoryDetail($id)
    {

        $categoryOptions = Category::all();

        $categoryDetail = CategoryDetail::find($id);
        
        session()->put('id_category_detail_up',$id);

        return view('admin.category_detail.update_category_detail')
            ->with(compact('categoryOptions','categoryDetail'));
    }

    public function updateCategoryDetail(Request $request)
    {
        $id = session()->get('id_category_detail_up');
        if (!$id) {

            $this->updateFailMessage($request, __('message.update-fail'));

            return back();
        }

        $request->validate(
            [
                'category_detail_name' => 'required|min:4|max:255|unique:category_detail,category_detail_name,'.$id,
                'category_id' => 'required',
            ],
        );

        $data = $request->only('category_detail_name', 'category_id');
    
        try {
            CategoryDetail::where('id', $id)->update([
                'category_id' => $data['category_id'],
                'category_detail_name' => $data['category_detail_name'],
            ]);

            $this->updateSuccessMessage($request, __('message.update-successful'));

            return back();

        } catch (Throwable $e) {

            log::channel('admin_log')->info($e->getMessage());

            $this->updateFailMessage($request, __('message.update-fail'));

            return back();
        }


    }
}
