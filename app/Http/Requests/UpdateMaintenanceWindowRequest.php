<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaintenanceWindowRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:scheduled,in_progress,completed',
            'scheduled_start' => 'required|date',
            'scheduled_end' => 'required|date|after:scheduled_start',
            'actual_start' => 'nullable|date',
            'actual_end' => 'nullable|date|after:actual_start',
            'component_ids' => 'array',
            'component_ids.*' => 'exists:components,id',
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
            'title.required' => 'Maintenance title is required.',
            'title.max' => 'Maintenance title cannot exceed 255 characters.',
            'description.required' => 'Maintenance description is required.',
            'status.required' => 'Maintenance status is required.',
            'status.in' => 'Invalid maintenance status.',
            'scheduled_start.required' => 'Scheduled start time is required.',
            'scheduled_end.required' => 'Scheduled end time is required.',
            'scheduled_end.after' => 'Scheduled end time must be after start time.',
            'actual_end.after' => 'Actual end time must be after actual start time.',
            'component_ids.*.exists' => 'One or more selected components do not exist.',
        ];
    }
}