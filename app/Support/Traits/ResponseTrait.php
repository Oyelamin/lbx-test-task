<?php

namespace App\Support\Traits;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

trait ResponseTrait
{
    /**
     * The current path of resource to respond
     *
     * @var string
     */
    protected string $resourceItem;

    /**
     * The current path of collection resource to respond
     *
     * @var string
     */
    protected string $resourceCollection;

    /**
     *
     * @param $data
     * @param $status
     * @return JsonResponse
     */
    protected function respondWithCustomData(string $message = "Successful", JsonResource|array $data = [], int $status = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse([
            "status" => $status,
            "message" => $message,
            'data' => $data,
            'meta' => ['timestamp' => $this->getTimestampInMilliseconds()],
        ], $status);
    }

    protected function getTimestampInMilliseconds(): int
    {
        return intdiv((int)now()->format('Uu'), 1000);
    }

    /**
     *
     * Return collection response from the application
     */
    protected function respondWithCollection(LengthAwarePaginator|CursorPaginator $collection, int $status = Response::HTTP_OK)
    {
        return (new $this->resourceCollection($collection))->additional(
            [
                'status' => $status,
                'meta' => ['timestamp' => $this->getTimestampInMilliseconds()]
            ]
        );
    }




}
