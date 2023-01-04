<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UpdateMessageTrait;
use App\Models\Author;
use App\Models\Car;
use App\Models\CarDetail;
use App\Models\Category;
use App\Models\CategoryDetail;
use App\Models\Gara;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CarController extends Controller
{
    use UpdateMessageTrait;

    const PAGINATE = 16;
    const PAGINATE_AUTHOR = 30;
    public function getCarDetail(Request $request, $id)
    {
        $car =  Car::with('car_detail')->find($id);

        if (!$car) {

            $this->updateFailMessage($request, __('message.car-not-found'));
            return back();
        }

        $stock = Car::isStock($car->car_detail->status);
        $categoryDetail = CategoryDetail::with('category')->find($car->car_detail->category_detail_id);
        $author = Author::find($car->car_detail->author_id);
        $gara = Gara::find($car->car_detail->gara_id);

        $carAlikes = Car::with('car_detail')->whereHas('car_detail', function (Builder $query) use ($car) {
            $query->where('car_detail.id', '<>', $car->car_detail->id)
                ->where('car_detail.category_detail_id', $car->car_detail->category_detail_id);
        })->orderByDesc('created_at')->limit(4)
            ->get();


        return view('user.car_detail.car_detail')
            ->with(compact('car', 'stock', 'gara', 'author', 'categoryDetail', 'carAlikes'));
    }

    public function searchCar(Request $request)
    {
        $search = $request->search;

        $category = $request->category;

        $categoryDetail = $request->category_detail;

        $publishDate = $request->publish_date;

        $author = $request->author;

        $carSearch = Car::with('car_detail.category_detail')->withFilterCarName($search);

        if ($search === '%') {
            $carSearch = Car::with('car_detail.category_detail')->where('car_name', $search);
        }

        if ($categoryDetail) {
            $carSearch = Car::whereHas('car_detail.category_detail', function (Builder $query) use ($categoryDetail) {
                $query->where('category_detail_name', 'like', $categoryDetail);
            }, '>=', 1);
            if ($publishDate) {
                $carSearch = $carSearch->whereHas('car_detail', function (Builder $query)  use ($publishDate) {
                    $query->where('publish_date', $publishDate);
                }, '>=', 1);
            }
        }

        if ($category) {
            $carSearch = Gara::whereHas('car_detail.category_detail.category', function (Builder $query)  use ($category) {
                $query->where('category_name', 'like', $category);
            }, '>=', 1);
        }

        if($author){
            $carSearch = $carSearch->whereHas('car_detail.author', function (Builder $query)  use ($author) {
                $query->where('full_name', $author);
            }, '>=', 1);
        }


        $count = $carSearch->count();
        $carPaginate = $carSearch->paginate(self::PAGINATE);

        $categorys = Category::with('category_detail.car_detail')
            ->limit(self::PAGINATE)->get();

        $authors = Author::limit(self::PAGINATE_AUTHOR)->get();

        $publishDateMap = [];

        foreach ($categorys as $category) {
            foreach ($category->category_detail as $category_detail) {
                foreach ($category_detail->car_detail as $car) {
                    if (array_key_exists("$category_detail->category_detail_name", $publishDateMap)) {
                        $publishDateMap["$category_detail->category_detail_name"][] = $car->publish_date;
                    } else {
                        $publishDateMap["$category_detail->category_detail_name"] = [$car->publish_date];
                    }
                }
            }
        }
        $publishDateMapUnique = [];
        foreach ($publishDateMap as $key => $publishDateMap) {
            foreach (array_unique($publishDateMap) as $publishDate) {
                if (array_key_exists("$key", $publishDateMapUnique)) {
                    $publishDateMapUnique["$key"][] = $publishDate;
                } else {
                    $publishDateMapUnique["$key"] = [$publishDate];
                }
            }
        }
        return view('user.search',)->with(compact('authors','carPaginate', 'categorys', 'count', 'publishDateMapUnique'));
    }
}
