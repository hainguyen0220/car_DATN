<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CarExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UpdateMessageTrait;
use App\Http\Controllers\UploadImageControllerTrait;
use App\Imports\CarImport;
use App\Models\Author;
use App\Models\Car;
use App\Models\CategoryDetail;
use App\Models\Gara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class CarController extends Controller
{
    use UpdateMessageTrait;
    use UploadImageControllerTrait;
    const DEFAULT_PAGINATE = 15;

    public function listCar(Request $request)
    {
        $searchParams = $request->car_name;
        $cars = Car::withFilterCarName($searchParams)
            ->orderByDesc('created_at')
            ->paginate(self::DEFAULT_PAGINATE);


        return view('admin.car.table_car')->with(
            [
                'cars' => $cars,
            ]
        );
    }

    public function showCreateCar()
    {
        $category_details = CategoryDetail::all();
        $garas = Gara::all();
        $authors = Author::all();

        return view('admin.car.create_car')
            ->with(compact('category_details', 'garas', 'authors'));
    }

    public function createCar(Request $request)
    {
        $request->validate(
            [
                'car_name' => 'required|min:4|max:255',
                'number' => 'required',
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:4096',
                'gara' => 'required',
                'author' => 'required',
                'category_detail' => 'required',
                'status' => 'required',
            ],
        );

        if ($request->hasFile('image')) {
            $image = $request->image;
            $image = $this->upload($image, 'car', 'product');
        }

        $dataInsert = $request->only(
            'car_name',
            'number',
            'gara',
            'author',
            'category_detail',
            'publish_date',
            'status',
            'describle'
        );

        $image = $image ?? '';

        try {

            Car::createCar($dataInsert, $image);
            $this->updateSuccessMessage($request, __('message.create-successful'));

            return back();
        } catch (Throwable $e) {

            log::channel('admin_log')->info($e->getMessage());

            $this->updateFailMessage($request, __('message.create-fail'));

            return back();
        }
    }

    public function showUpdateCar($id)
    {
        $category_details = CategoryDetail::all();
        $garas = Gara::all();
        $authors = Author::all();

        $car = Car::with('car_detail')->find($id);

        return view('admin.car.update_car')
            ->with(compact('category_details', 'garas', 'authors', 'car'));
    }

    public function updateCar(Request $request, $id)
    {
        if (!$id) {

            $this->updateFailMessage($request, __('message.update-fail'));

            return back();
        }
        $car = Car::find($id);

        $request->validate(
            [
                'car_name' => 'required|min:4|max:255',
                'number' => 'required',
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:4096',
                'gara' => 'required',
                'author' => 'required',
                'category_detail' => 'required',
                'status' => 'required',
            ],
        );

        $dataInsert = $request->only(
            'car_name',
            'number',
            'gara',
            'author',
            'category_detail',
            'publish_date',
            'status',
            'describle'
        );

        if ($request->hasFile('image')) {
            $image = $request->image;
            $image = $this->upload($image, 'car', 'product');
            $this->deleteImage($car->image, 'product');
        }

        $image  = $image ?? $car->image;

        try {

            Car::updateCar($id, $dataInsert, $image);

            $this->updateSuccessMessage($request, __('message.update-successful'));
            return back();
        } catch (Throwable $e) {

            log::channel('admin_log')->info($e->getMessage());

            $this->updateFailMessage($request, __('message.update-fail'));

            return back();
        }
    }

    public function deleteCar(Request $request, $id)
    {
        $idAdmin = session('admin')->id ?? null;
        if (!$idAdmin) {
            return redirect()->route('login');
        }
        if (!$id) {

            $this->updateFailMessage($request, __('message.delete-fail'));

            return back();
        }

        try {
            Car::find($id)->delete();
            $this->updateSuccessMessage($request, __('message.delete-successful'));
            return back();
        } catch (Throwable $e) {

            log::channel('sql_log')->error($e->getMessage());

            $this->updateFailMessage($request, __('message.delete-fail'));

            return back();
        }
    }

    public function showInfoCar($id)
    {
        $car = Car::with('car_detail')->find($id);
        $category_detail = CategoryDetail::find($car->car_detail->category_detail_id);
        $gara = Gara::find($car->car_detail->gara_id);
        $author = Author::find($car->car_detail->author_id);

        return view('admin.car.info_car')
            ->with(compact('category_detail', 'gara', 'author', 'car'));
    }

    public function importCar(Request $request)
    {
        $request->validate(
            [
                'file-excel' => 'required|max:50000|mimes:xlsx,xls,csv',
            ],
        );
        try {
            Excel::import(new CarImport, $request->file('file-excel'));
            $this->updateSuccessMessage($request, __('message.import-successful'));
            return back();
        } catch (Throwable $e) {
            log::channel('admin_log')->error($e->getMessage());
            $this->updateFailMessage($request, __('message.import-fail'));
            return back();
        }
    }
}
