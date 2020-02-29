<?php

namespace App\Components\Common\Contracts;

use Illuminate\Http\Request;

interface RepositoryInterface
{
    public function all(Request $request);

    public function getById(Request $request, $id);

    public function update(Request $request, $id);

    public function delete(Request $request, $id);

    public function deleteSoft(Request $request, $id);
}
