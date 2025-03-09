<?php
namespace App\Http\Requests;

use App\Models\State;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Closure;

class PlaceOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only authenticated user can place order
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'phone' => ['required', 'string', 'max:255', function ($attribute, $value, $fail) {
                $this->validateUsaPhone($attribute, $value, $fail);
            }],
            'shipping_country_id' => 'required|numeric|exists:countries,id',
            'shipping_full_name' => 'required|string|max:255',
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:255',
            'shipping_state_id' => 'required|numeric|exists:states,id',
            'zip_code' => ['required', 'string', 'max:255', function ($attribute, $value, $fail) {
                $this->validateZipCode($attribute, $value, $fail);
            }],
            'billing_address_checkbox' => 'required|boolean',
            'billing_full_name' => 'required_if:billing_address_checkbox,false|max:255',
            'billing_country_id' => 'required_if:billing_address_checkbox,false|exists:countries,id',
            'billing_address' => 'required_if:billing_address_checkbox,false|max:255',
            'delivery_charge' => 'required|numeric',
            'tax_amount' => 'required|numeric',
            'coupon_code' => 'nullable|string|max:255',
            'discount_amount' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'total' => 'required|numeric',
            'notes' => 'nullable|string|max:255',
            'shipping_method' => 'required|in:pickup,economy',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // Ensure billing_address_checkbox is cast to a boolean
        $this->merge([
            'billing_address_checkbox' => filter_var($this->billing_address_checkbox, FILTER_VALIDATE_BOOLEAN),
        ]);
    }

    protected function validateUsaPhone(string $attribute, mixed $value, Closure $fail): void
    {
        // Regular expression for the USA phone numbers with optional +1 prefix
        if (!preg_match('/^\+1\s?\(\d{3}\)\s?\d{3}[-.\s]?\d{4}$/', $value) &&
            !preg_match('/^\+1\d{10}$/', $value) &&
            !preg_match('/^\(\d{3}\)\s?\d{3}[-.\s]?\d{4}$/', $value) &&
            !preg_match('/^\d{10}$/', $value)) {
            $fail("The $attribute must be a valid USA phone number.");
        }
    }

    protected function validateZipCode(string $attribute, mixed $value, Closure $fail): void
    {
        // Find the state ID and retrieve the associated state's zip code pattern
        $stateId = $this->input('shipping_state_id');
        $state = State::find($stateId);

        if (!$state) {
            $fail("The $attribute is invalid.");
        }

        // Ensure the zip_code_pattern is a valid regex string
        $pattern = $state->zip_code_pattern;
        $pattern = '/' . $pattern . '/';
        if (empty($pattern) || @preg_match($pattern, '') === false) {
            $fail("The zip code pattern for the selected state is invalid.");
            return;
        }

        if (!preg_match($pattern, $value)) {
            $fail("The $attribute is not valid for the selected state.");
        }
    }

}
