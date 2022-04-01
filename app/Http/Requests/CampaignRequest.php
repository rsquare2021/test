<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => ["required", "string"],
            "publish_datetime" => ["required", "date", "after:today"],
            "close_datetime" => ["required", "date", "after:end_datetime_to_convert_receipts_to_points"],
            "start_datetime_to_convert_receipts_to_points" => ["required", "date", "after:publish_datetime"],
            "end_datetime_to_convert_receipts_to_points" => ["required", "date", "after:start_datetime_to_convert_receipts_to_points"],
            "application_requirements" => ["required", "string"],
            "terms_of_service" => ["required", "string"],
            "privacy_policy" => ["required", "string"],
            "is_crawlable" => ["required", "boolean"],
        ];
    }

    public function withValidator($validator)
    {
        $validator->sometimes("campaign_type_id", ["required", "integer"], function() {
            return str_ends_with($this->path(), "project") and $this->isMethod("post");
        });
    }
}
