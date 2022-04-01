@php
    $depth_clumbs[$loop->depth] = $element->id;
    switch(count($depth_clumbs)) {
        case 1: // 会社
            $self_input_class = "company-$depth_clumbs[1] company";
            $self_input_data = "data-company=$depth_clumbs[1]";
            $ul_class = "sub_ul sub_send";
            $counter_raw_html = "";
            break;
        case 2: // 支社
            $self_input_class = "company-$depth_clumbs[1] sub_company sub-$depth_clumbs[2]";
            $self_input_data = "data-company=$depth_clumbs[1] data-sub=$depth_clumbs[2]";
            $ul_class = "area_ul area_send";
            $counter_raw_html = "";
            break;
        case 3: // エリア
            $self_input_class = "company-$depth_clumbs[1] sub-$depth_clumbs[2] area area-$depth_clumbs[3]";
            $self_input_data = "data-sub=$depth_clumbs[2] data-area=$depth_clumbs[3]";
            $ul_class = "area_ul area_send";
            $counter_raw_html = "（<span class='count-select-$depth_clumbs[3]'></span>/<span class='count-total-$depth_clumbs[3]'></span>）";
            break;
    }
@endphp
<li>
    <label class="new-control new-checkbox checkbox-primary">
        <input type="checkbox"
            class="new-control-input {{ $self_input_class }}"
            {{ $self_input_data }}
            name="element_ids[]"
            value="{{ $element->id }}"
        >
        <span class="new-control-indicator"></span>{{ $element->name }}{!! $counter_raw_html !!}
    </label>
    <ul class="{{ $ul_class }}">
        @if ($loop->depth < 3)
            @foreach ($element->children as $child)
                @include('admin.user.charge_sub', ["element" => $child, "depth_clumbs" => $depth_clumbs])
            @endforeach
        @endif
    </ul>
</li>