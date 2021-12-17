<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateVehiclesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();
        if($user->role == 'admin'){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vehicle_name' => 'required|string',
            'user_id' => 'sometimes|nullable|string',
            'reg_no' => 'required|string',
            'type' => 'sometimes|nullable|string',
            'description' => 'sometimes|nullable|string',
            'make' => 'sometimes|nullable|string',
            'year' => 'sometimes|nullable|string',
            'model' => 'sometimes|nullable|string',
            'condition' => 'sometimes|nullable|string',
            'status' => 'required|string'
        ];
    }
}
