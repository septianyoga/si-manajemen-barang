<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockOpnameRequest extends FormRequest
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
            //
            'barang_id'   => ['required'],
            'jumlah'   => ['required'],
            'status'   => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'barang_id.required' => 'Barang Wajib Diisi',
            'jumlah.required' => 'Jumlah Wajib Diisi',
            'status.required' => 'Status Wajib Diisi',
        ];
    }
}
