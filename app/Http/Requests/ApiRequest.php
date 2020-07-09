<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    /** @var MessageBag|null $bag */
    private $bag;

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
     * @inheritDoc
     */
    protected function failedValidation(Validator $validator)
    {
        $this->bag = $validator->errors();
    }

    /**
     * Есть ли ошибки
     *
     * @return bool
     */
    public function hasErrors(): bool
    {
        return null === $this->bag;
    }

    /**
     * Список ошибок
     *
     * @return string[]
     */
    public function errors(): array
    {
        if (null === $this->bag) {
            return [];
        }

        $errors = [];
        $keys   = $this->bag->keys();
        foreach ($keys as $key) {
            $errors[$key] = $this->bag->get($key);
        }

        return $errors;
    }
}
