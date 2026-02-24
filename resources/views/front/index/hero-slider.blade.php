<div id="index-slider" class="owl-carousel">
    @foreach($sliders as $slider)
        <section style="background: url('{{ $slider->image }}'); background-size: cover;" class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <h1>{{$slider->heading}}</h1>
                        <a href="{{$slider->btnLink}}" class="hero-link">{{$slider->btnText}}</a>
                    </div>
                </div>
            </div>
        </section>
    @endforeach

</div>
