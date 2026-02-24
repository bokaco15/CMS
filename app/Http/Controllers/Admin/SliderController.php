<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Sliders\AddSlidersRequest;
use App\Http\Requests\Admin\Sliders\ChangeSliderStatusRequest;
use App\Http\Requests\Admin\Sliders\DeleteSliderRequest;
use App\Models\Slider;
use App\Repositories\Admin\SliderRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SliderController extends Controller
{

    public function __construct(protected SliderRepository $sliderRepository){}
    public function index(): View
    {
        $sliders = Slider::orderBy('priority', 'asc')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function resort(Request $request)
    {
        return $this->sliderRepository->resort($request);
    }

    public function add(AddSlidersRequest $request)
    {
        return $this->sliderRepository->addSlider($request);
    }

    public function delete(DeleteSliderRequest $request)
    {
        return $this->sliderRepository->deleteSlider($request);
    }

    public function changeStatus(ChangeSliderStatusRequest $request)
    {
        return $this->sliderRepository->changeSliderStatus($request);
    }

}
