<?php

namespace MiPaPo\Core\Components\Common\Contracts;

use Illuminate\Http\Request;

interface RepositoryInterface
{
    public function all(Request $request);

    public function getById(Request $request, string $id);

    public function update(Request $request, string $id);

    public function delete(Request $request, string $id);

    public function deleteSoft(Request $request, string $id);
}
