<input type="hidden" id="cam_id" value="{{$campaign->id}}">
<input type="hidden" name="str" value="">
<input type="hidden" name="tel" value="">
<input type="hidden" name="no" value="">
<input type="hidden" name="pay_date" value="">
<input type="hidden" name="time" value="">
<input type="hidden" name="point" value="">
<input type="hidden" name="val" value="">
<input type="hidden" name="base_oil" value="">
<input type="hidden" name="products" value="">
<input type="hidden" name="shopNg" value="">
<input type="hidden" name="com" value="">
<input type="hidden" name="isDouble" value="">
<input type="hidden" name="isMulti" value="">
<input type="hidden" id="ocr_lists" name="ocr_lists" value="{{ $ocr_value }}">
@foreach($level1_lists as $level1_list)
    <input type="hidden" id="{{ $level1_list->tel }}" name="level1_lists" value="{{ $level1_list->products }}">
@endforeach