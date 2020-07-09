<?php

namespace App\Http\Requests;

use App\Models\dto\ParticipantDto;

class ParticipantRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => ['required', 'max:255'],
            'lastName'  => ['required', 'max:255'],
            'email'     => ['required', 'max:255', 'email', 'unique:participant,email,' . $this->route('participant')],
            'eventId'   => ['required', 'exists:event,id', 'integer'],
        ];
    }

    /**
     * Данные участника
     *
     * @return ParticipantDto
     */
    public function getParticipantDto(): ParticipantDto
    {
        $dto            = new ParticipantDto;
        $dto->firstName = $this->request->get('firstName');
        $dto->lastName  = $this->request->get('lastName');
        $dto->email     = $this->request->get('email');
        $dto->eventId   = $this->request->get('eventId');

        return $dto;
    }
}
