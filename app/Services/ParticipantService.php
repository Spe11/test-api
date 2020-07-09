<?php

namespace App\Services;

use App\Models\db\Participant;
use App\Models\dto\ParticipantDto;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

/**
 * Сервис управления участниками
 */
class ParticipantService
{
    /**
     * Создать
     *
     * @param ParticipantDto $dto
     *
     * @return Participant
     */
    public function create(ParticipantDto $dto): Participant
    {
        $participant             = new Participant;
        $participant->first_name = $dto->firstName;
        $participant->last_name  = $dto->lastName;
        $participant->email      = $dto->email;
        $participant->event_id   = $dto->eventId;

        if (false === $participant->save()) {
            throw new InternalErrorException('Error during saving data');
        }

        return $participant;
    }

    /**
     * Редактировать
     *
     * @param Participant    $participant
     * @param ParticipantDto $dto
     *
     * @return void
     */
    public function update(Participant $participant, ParticipantDto $dto)
    {
        $participant->first_name = $dto->firstName;
        $participant->last_name  = $dto->lastName;
        $participant->email      = $dto->email;
        $participant->event_id   = $dto->eventId;

        if (false === $participant->save()) {
            throw new InternalErrorException('Error during saving data');
        }
    }

    /**
     * Поиск участников с пагинацией
     *
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function search(Request $request): LengthAwarePaginator
    {
        $page    = $request->get('page');
        $eventId = $request->get('eventId');

        if (false === is_numeric($page) || $page < 1) {
            $page = 1;
        }

        $result = Participant::query();
        if ($eventId !== null) {
            $result->where('event_id', $eventId);
        }

        return $result->paginate(null, '*', 'page', $page);
    }
}
