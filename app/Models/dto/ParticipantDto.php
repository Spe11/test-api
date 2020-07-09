<?php

namespace App\Models\dto;

/**
 * Участник
 */
class ParticipantDto
{
    /** @var string $firstName Имя */
    public $firstName;

    /** @var string $lastName Фамилия */
    public $lastName;

    /** @var string $email Email */
    public $email;

    /** @var string $name Ид мероприятия */
    public $eventId;
}
