<?php

namespace App\Components\Common\Repositories;

use App\Components\Common\Contracts\RepositoryInterface;
use App\Components\Common\Http\Resources\ErrorResource;
use App\Components\Common\MiPaPo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class GenericRepository implements RepositoryInterface
{
    /**
     * @var string
     */
    private $resource;

    /**
     * @var string
     */
    private $model;

    /**
     * @var array
     */
    private $validationRules;

    /**
     * @var array
     */
    private $validationMessages;

    /**
     * @var array
     */
    private $validationCustomAttributes;

    /**
     * GenericRepository constructor.
     *
     * @param string $resource
     * @param string $model
     */
    public function __construct(string $resource, string $model)
    {
        $this->resource = $resource;
        $this->model = $model;
        $this->validationRules = [];
        $this->validationMessages = [];
        $this->validationCustomAttributes = [];
    }

    /**
     * Set the validation rules.
     *
     * @param array $validationRules
     *
     * @return $this
     */
    public function setValidationRules(array $validationRules): self
    {
        $this->validationRules = $validationRules;

        return $this;
    }

    /**
     * Set custom validation messages.
     *
     * @param array $validationMessages
     *
     * @return $this
     */
    public function setValidationMessages(array $validationMessages): self
    {
        $this->validationMessages = $validationMessages;

        return $this;
    }

    /**
     * Set custom validation attributes.
     *
     * @param array $validationCustomAttributes
     *
     * @return $this
     */
    public function setValidationCustomAttributes(array $validationCustomAttributes): self
    {
        $this->validationCustomAttributes = $validationCustomAttributes;

        return $this;
    }

    /**
     * Get all entries for one resource.
     *
     * @param Request $request
     *
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $paginate = $request->get('paginate');

        if ($paginate && is_numeric($paginate)) {
            return $this->getCollection(
                $this->model::paginate($paginate)
                    ->setPath($request->fullUrl()),
                $request
            );
        }

        return $this->getCollection(
            $this->model::paginate(
                $this->model::all()->count()
            ),
            $request
        );
    }

    /**
     * Validate data.
     *
     * @param array $data
     * #
     * @return bool|JsonResponse
     */
    public function validate(array $data)
    {
        $validator = Validator::make(
            $data, $this->validationRules, $this->validationMessages, $this->validationCustomAttributes
        );

        if ($validator->fails()) {
            $errorResource = new ErrorResource();

            foreach ($validator->errors()->keys() as $key => $field) {
                $errorResource->addError(
                    null,
                    null,
                    422,
                    null,
                    'Validation Error',
                    $validator->errors()->get($field)[0],
                    '/data/attributes/'.$field,
                    null,
                    null
                );
            }

            return $errorResource
                ->setStatusCode(422)
                ->getErrorCollection();
        }

        return true;
    }

    /**
     * Store new entry for $this->model with the given data.
     *
     * @param Request $request
     * @param array $data
     *
     * @return JsonResource
     */
    public function store(Request $request, array $data)
    {
        $newModel = new $this->model();

        foreach ($data as $field => $value) {
            $newModel->$field = $value;
        }

        $newModel->save();

        return $this->getResource(
            $newModel, $request
        );
    }

    /**
     * Get the specified resource.
     *
     * @param Request $request
     * @param $id
     *
     * @return JsonResource
     */
    public function getById(Request $request, $id): JsonResource
    {
        return $this->getResource(
            $this->model::findOrFail($id), $request
        );
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param $model
     *
     * @return bool|JsonResponse|JsonResource
     */
    public function update(Request $request, $model)
    {
        foreach ($request->all() as $field => $value) {
            if (!array_key_exists($field, $model->getAttributes())) {
                continue;
            }

            if ($model->$field === $value) {
                continue;
            }

            if (key_exists($field, $this->validationRules)) {
                $tmp = $this->validationRules;

                $this->validationRules = [
                    $field => $this->validationRules[$field]
                ];

                $valid = $this->validate(
                    [$field => $value]
                );

                $this->validationRules = $tmp;
                unset($tmp);

                if ($valid !== true) {
                    return $valid;
                }
            }
        }

        $model->update($request->all());

        return $this->getResource(
            $model, $request
        );
    }

    /**
     * Delete the specified resource.
     *
     * @param Request $request
     * @param $id
     *
     * @return JsonResource
     */
    public function delete(Request $request, $id): JsonResource
    {
        // TODO: Add delete method + validation
    }

    /**
     * Soft-delete the specified resource.
     *
     * @param Request $request
     * @param $id
     *
     * @return JsonResource
     */
    public function deleteSoft(Request $request, $id): JsonResource
    {
        // TODO: Add soft delete method + validation
    }

    /**
     * Get the specified resource.
     *
     * @param $model
     * @param Request|null $request
     *
     * @return JsonResource
     */
    private function getResource($model, Request $request = null): JsonResource
    {
        return (new $this->resource(
            $model, $request
        ))->additional($this->getAdditional($request));
    }

    /**
     * Get the specified resource collection.
     *
     * @param $model
     * @param Request|null $request
     *
     * @return AnonymousResourceCollection
     */
    private function getCollection($model, Request $request = null): AnonymousResourceCollection
    {
        return $this->resource::collection(
            $model
        )->additional($this->getAdditional($request));
    }

    /**
     * Get additional resource data.
     *
     * @param Request|null $request
     *
     * @return array
     */
    private function getAdditional(Request $request = null): array
    {
        return [
            'links' => [
                'self' => $request ? $request->fullUrl() : null,
                'parameter' => $request ? $request->query() : [],
            ],
            'meta' => [],
            'jsonapi' => [
                'version' => MiPaPo::API_VERSION
            ],
        ];
    }
}
