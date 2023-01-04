<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UpdateMessageTrait;
use App\Http\Controllers\UploadImageControllerTrait;
use App\Models\Slider;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Throwable;

class SliderController extends Controller
{
    use UpdateMessageTrait;
    use UploadImageControllerTrait;
    public function showSlider()
    {
        $sliders = Slider::limit(10)->get();
        return view('admin.slider.table_slider')->with('sliders', $sliders);
    }

    public function createSlider(Request $request)
    {
        $request->validate(
            [
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:4096',
            ],
        );

        if ($request->hasFile('image')) {
            $image = $request->image;
            $image = $this->upload($image, 'slider', 'slider');
        }

        try {

            $slider = new Slider();
            $slider->image = $image;
            $slider->link = $request->link;
            $slider->save();

            $this->updateSuccessMessage($request, __('message.create-successful'));

            return back();
        } catch (Throwable $e) {

            log::channel('admin_log')->info($e->getMessage());

            $this->updateFailMessage($request, __('message.create-fail'));

            return back();
        }
    }

    public function deleteSlider(Request $request,$id){
        try {

            $slider = Slider::find($id);
            $this->deleteImage($slider->image,'slider');
            $slider->delete();

            $this->updateSuccessMessage($request, __('message.delete-successful'));

            return back();
        } catch (Throwable $e) {

            log::channel('admin_log')->info($e->getMessage());

            $this->updateFailMessage($request, __('message.delete-fail'));

            return back();
        }

    }
}
