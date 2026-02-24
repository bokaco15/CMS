<tbody id="sortable">
@foreach($sliders as $slider)
    <tr id="{{$slider->id}}">
        <td class="handle" style="cursor: pointer; display: none">☰</td>
        <td>{{ $slider->id }}</td>
        <td>{{ $slider->heading }}</td>
        <td>{{ $slider->btnText }}</td>
        <td>{{ $slider->btnLink }}</td>
        <td><img src="{{ $slider->image }}" width="100px"></td>

        <td class="text-center">
            {{ $slider->created_at ? $slider->created_at->format('d.m.Y H:i') : '-' }}
        </td>
        <td class="text-center">
            <button class="btn btn-sm {{$slider->show_on_index ? 'btn-danger' : 'btn-primary'}}" id="{{$slider->show_on_index ? 'banSliderBtn' : 'unbanSliderBtn'}}" data-toggle="modal" data-target="{{$slider->show_on_index ? '#banSliderModal' : '#unbanSliderModal'}}" data-id="{{$slider->id}}" data-newStatus="{{$slider->show_on_index ? 0 : 1}}">
                {{$slider->show_on_index ? 'Ban' : 'Unban'}}
            </button>
            <button class="btn btn-sm btn-danger" id="btnDeleteSlider" data-toggle="modal" data-target="#deleteSliderModal" data-id="{{$slider->id}}" data-heading="{{$slider->heading}}">
                Delete
            </button>

        </td>
    </tr>
@endforeach
</tbody>
