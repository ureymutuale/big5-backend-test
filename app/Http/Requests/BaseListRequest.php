<?php


namespace App\Http\Requests;

/**
 * @property int per_page
 * @property string order_by
 * @property string order
 * @property string search
 * @property mixed account
 */
class BaseListRequest extends BaseFormRequest
{

    /**
     * Do Any Cleanup of request here
     *
     * @return void
     */
    public function prepareForValidation()
    {
        if (!intval($this->input('page'))) {
            $this->merge([
                'page' => 1
            ]);
        }
        if (!intval($this->input('per_page'))) {
            $this->merge([
                'per_page' => 20
            ]);
        }
        if (!$this->input('order_by')) {
            $this->merge([
                'order_by' => 'created_at'
            ]);
        }
        if (!$this->input('order')) {
            $this->merge([
                'order' => 'DESC'
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }
}

