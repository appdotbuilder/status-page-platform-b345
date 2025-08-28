<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIncidentRequest extends FormRequest
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
            'status' => 'required|in:investigating,identified,monitoring,resolved',
            'impact' => 'required|in:none,minor,major,critical',
            'started_at' => 'required|date',
            'resolved_at' => 'nullable|date|after:started_at',
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
            'title.required' => 'Incident title is required.',
            'title.max' => 'Incident title cannot exceed 255 characters.',
            'description.required' => 'Incident description is required.',
            'status.required' => 'Incident status is required.',
            'status.in' => 'Invalid incident status.',
            'impact.required' => 'Incident impact level is required.',
            'impact.in' => 'Invalid impact level.',
            'started_at.required' => 'Start time is required.',
            'started_at.date' => 'Start time must be a valid date.',
            'resolved_at.after' => 'Resolved time must be after start time.',
            'component_ids.*.exists' => 'One or more selected components do not exist.',
        ];
    }
}