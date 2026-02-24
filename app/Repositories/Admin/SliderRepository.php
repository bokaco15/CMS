<?php

namespace App\Repositories\Admin;

use App\Http\Requests\Admin\Sliders\ChangeSliderStatusRequest;
use App\Models\Slider;
use App\Traits\PostPhotoTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Js;

class SliderRepository
{

    use PostPhotoTrait;


    public function resort($request) : JsonResponse
    {
        $sortArr = explode(',',$request->resort);
        if ($sortArr) {
            foreach ($sortArr as $sortPosition => $id) {
                $category = Slider::find($id);
                $category->priority = $sortPosition + 1;
                $category->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'You have been resorted sliders successfully!',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "You should change the order!"
        ]);
    }

    public function addSlider($request) : JsonResponse
    {
        $data = $request->validated();

        $slider = Slider::create([
            'heading' => $data['heading'],
            'btnText' => $data['btnText'] ?? null,
            'btnLink' => $data['btnLink'] ?? null,
            'show_on_index' => (int)$data['show_on_index'],
            'priority' => (Slider::max('priority') ?? 0) + 1,
            'image' => ''
        ]);

        $imagePath = $this->slideImage($slider->id. '.webp', $data['image']);
        $slider->image = $imagePath;
        $slider->save();

        $sliders = Slider::orderBy('priority')->orderByDesc('id')->get();
        $html = view('admin.slider.table', compact('sliders'))->render();

        return response()->json([
            'success' => true,
            'message' => 'Slider added successfully',
            'html' => $html,
        ]);
    }

    public function deleteSlider($request) : JsonResponse
    {
        $data = $request->validated();

        $slider = Slider::findOrFail($data['id']);
        $slider->delete();

        $sliders = Slider::orderBy('priority')->orderByDesc('id')->get();
        $html = view('admin.slider.table', compact('sliders'))->render();

        return response()->json([
            'success' => true,
            'message' => 'Slider deleted successfully',
            'html' => $html,
        ]);
    }

    public function changeSliderStatus($request) : JsonResponse
    {
        $data = $request->validated();

        $message = $data['show_on_index'] == 1 ? 'Slider activated' : 'Slider deactivated';

        $slider = Slider::findOrFail($data['id']);
        $slider->show_on_index = $data['show_on_index'];
        $slider->save();

        $sliders = Slider::orderBy('priority')->orderByDesc('id')->get();
        $html = view('admin.slider.table', compact('sliders'))->render();

        return response()->json([
            'success' => true,
            'message' => $message,
            'html' => $html,
        ]);
    }
}
