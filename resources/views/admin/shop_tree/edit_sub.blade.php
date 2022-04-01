@error($dot.'name')
    <p>{{ $message }}</p>
@enderror
<span class="caret"><input type="text" name="{{ $name.'[name]' }}" value="{{ $element['name'] ?? '' }}">
@if ($loop->depth == 1)
    <a href="#" class="cmd_add_area">エリア追加</a><a class="shisha_delete delete_btn">- 削除</a>
@elseif ($loop->depth == 2)
    <a href="#" class="cmd_add_shop">店舗追加</a><a class="area_delete delete_btn">- 削除</a>
@elseif ($loop->depth == 3)
    @if ($element["id"])
        <a href="{{ route('admin.shop.edit', $element['id']) }}" target="_blank">編集</a>
    @endif
    <a class="shop_delete delete_btn">- 削除</a>
@endif
</span>
<input type="hidden" name="{{ $name.'[id]' }}" value="{{ $element['id'] ?? '' }}">

@error($dot.'children')
    <p>{{ $message }}</p>
@enderror
<ul>
    @isset($element["children"])
        @foreach ($element["children"] as $child)
            @php
                $depth_crumbs[$loop->depth] = $loop->index;
                switch(count($depth_crumbs)) {
                    case 2:
                        $li_data = "data-office=$depth_crumbs[1] data-area=$depth_crumbs[2]";
                        break;
                    case 3:
                        $li_data = "class=shop_elem";
                        break;
                }
            @endphp
            <li {{ $li_data }}>
                @include('admin.shop_tree.edit_sub', ["element" => $child, "name" => "${name}[children][$loop->index]", "dot" => "${dot}children.$loop->index.", "depth_crumbs" => $depth_crumbs])
            </li>
        @endforeach
    @endisset
</ul>