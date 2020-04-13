<?php

namespace MiPaPo\Core\Components\Common\Http\Controller\Api;

use MiPaPo\Core\Components\Common\Contracts\ApiControllerInterface;
use MiPaPo\Core\Controller\Controller;
use MiPaPo\Core\Components\Common\Repositories\GenericRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class MiPaPoApiController extends Controller implements ApiControllerInterface
{
    /**
     * @var GenericRepository
     */
    private $repository;

    /**
     * MiPaPoApiController constructor.
     */
    public function __construct()
    {
        $this->repository = (new GenericRepository(
            $this->setResource(), $this->setModel()
        ))->setValidationRules(
            $this->setValidationRules()
        )->setValidationMessages(
            $this->setValidationMessages()
        )->setValidationCustomAttributes(
            $this->setValidationCustomAttributes()
        );
    }

    /**
     * Set the Resource for json responses.
     *
     * @return String
     */
    abstract protected function setResource(): String;

    /**
     * Set the Model for this api endpoint.
     *
     * @return String
     */
    abstract protected function setModel(): String;

    /**
     * Set the values that should be stored after the store route is called.
     *
     * @param Request $request
     *
     * @return array
     */
    abstract protected function setStoreValues(Request $request): array;

    /**
     * Set the validation rules.
     *
     * @return array
     */
    abstract protected function setValidationRules(): array;

    /**
     * OPTIONAL: Set the custom validation messages.
     *
     * @return array
     */
    abstract protected function setValidationMessages(): array;

    /**
     * OPTIONAL: Set custom validation attributes.
     *
     * @return array
     */
    abstract protected function setValidationCustomAttributes(): array;

    /**
     * Get a listing of resources.
     *
     * @param Request $request
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return $this->repository->all($request);
    }

    /**
     * Store a newly created resource.
     *
     * @param Request $request
     *
     * @return JsonResource|JsonResponse
     */
    public function store(Request $request)
    {
        $validation = $this->repository->validate(
            $request->all()
        );

        if ($validation !== true) {
            return $validation;
        }

        return $this->repository->store(
            $request, $this->setStoreValues($request)
        );
    }

    /**
     * Return the specified resource.
     *
     * @param Request $request
     * @param string $id
     *
     * @return JsonResource
     */
    public function show(Request $request, string $id): JsonResource
    {
        return $this->repository->getById(
            $request, $id
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $id
     *
     * @return JsonResource
     */
    public function update(Request $request, string $id): JsonResource
    {
        $model = $this->repository->getById(
            $request, $id
        );

        return $this->repository->update(
            $request, $model
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param string $id
     *
     * @return JsonResponse
     */
    public function destroy(Request $request, string $id): JsonResponse
    {
        $model = $this->repository->getById(
            $request, $id
        );

        return response()->json();
    }
}
