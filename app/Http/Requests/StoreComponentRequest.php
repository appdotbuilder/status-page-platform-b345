<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComponentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'component_group_id' => 'required|exists:component_groups,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:operational,degraded,partial_outage,major_outage',
            'sort_order' => 'integer|min:0',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'component_group_id.required' => 'Please select a component group.',
            'component_group_id.exists' => 'The selected component group does not exist.',
            'name.required' => 'Component name is required.',
            'name.max' => 'Component name cannot exceed 255 characters.',
            'status.required' => 'Component status is required.',
            'status.in' => 'Invalid component status.',
            'sort_order.min' => 'Sort order must be a positive number.',
        ];
    }
}