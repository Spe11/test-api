<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipantRequest;
use App\Http\Resources\ParticipantResource;
use App\Jobs\NewParticipantMailNotification;
use App\Models\db\Participant;
use App\Models\json\JsonErrorResponse;
use App\Models\json\JsonFailResponse;
use App\Models\json\JsonSuccessResponse;
use App\Services\ParticipantService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;

/**
 * Контроллер участников
 */
class ParticipantController extends Controller
{
    /** @var ParticipantService $service */
    private $service;

    /**
     * @param ParticipantService $service
     */
    public function __construct(ParticipantService $service)
    {
        $this->service = $service;
    }

    /**
     * Список элементов
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = $this->service->search($request);

        return ParticipantResource::collection($data);
    }

    /**
     * Добавление
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ParticipantRequest $request)
    {
        if (false === empty($request->errors())) {
            return JsonFailResponse::validationError($request->errors());
        }

        $model = $this->service->create($request->getParticipantDto());

        NewParticipantMailNotification::dispatch($model);

        return JsonSuccessResponse::success();
    }

    /**
     * Один элемент
     *
     * @param  int  $id
     * @return Response
     */
    public function show(int $id)
    {
        /** @var Participant $model */
        $model = Participant::findOrFail($id);

        return new ParticipantResource($model);
    }

    /**
     * Редактирование
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ParticipantRequest $request, int $id)
    {
        /** @var Participant $model */
        $model = Participant::findOrFail($id);

        if (false === empty($request->errors())) {
            return JsonFailResponse::validationError($request->errors());
        }

        if (false === $this->service->update($model, $request->getParticipantDto())) {
            return JsonErrorResponse::serverError();
        }

        return JsonSuccessResponse::success();
    }

    /**
     * Удаление
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Participant $model */
        $model = Participant::findOrFail($id);

        if (false === $model->delete()) {
            return JsonErrorResponse::serverError();
        }

        return JsonSuccessResponse::success();
    }
}
