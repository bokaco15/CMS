<tbody id="sortable">
@foreach($categories as $category)
<tr id="{{$category->id}}">
    <td class="handle" style="cursor: pointer; display: none">☰</td>
    <td>{{ $category->id }}</td>
    <td>{{ $category->slug }}</td>
    <td><a href="{{route('front.category.index', ['category'=>$category->id, 'slug' => $category->slug])}}">{{ $category->name }}</a></td>
    <td class="text-center">
        {{ $category->created_at ? $category->created_at->format('d.m.Y H:i') : '-' }}
    </td>
    <td class="text-center">
        <button class="btn btn-sm {{$category->show_on_index ? 'btn-danger' : 'btn-primary'}}" id="{{$category->show_on_index ? 'banCategoryBtn' : 'unbanCategoryBtn'}}" data-toggle="modal" data-target="{{$category->show_on_index ? '#banCategoryModal' : '#unbanCategoryModal'}}" data-id="{{$category->id}}" data-newStatus="{{$category->show_on_index ? 0 : 1}}">
            {{$category->show_on_index ? 'Ban' : 'Unban'}}
        </button>
        <button type="button" class="btn btn-sm btn-warning mr-2" id="btnEditCategory" data-toggle="modal" data-target="#editCategoryModal" data-id="{{$category->id}}" data-name="{{$category->name}}" data-slug="{{$category->slug}}">
            Edit
        </button>
        <button class="btn btn-sm btn-danger" id="btnDeleteCategory" data-toggle="modal" data-target="#deleteCategoryModal" data-id="{{$category->id}}" data-name="{{$category->name}}" data-slug="{{$category->slug}}">
            Delete
        </button>

    </td>
</tr>
@endforeach
</tbody>


{{--editInputName--}}
{{--editInputSlug--}}
