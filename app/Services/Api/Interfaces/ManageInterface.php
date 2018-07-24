<?php

namespace App\Services\Api\Interfaces;

use App\Http\Requests\GetDataRequest;

interface ManageInterface{
    public function getAll(GetDataRequest $request);
    public function getOne($id);
    public function getProfile($option);
    public function save($inputs);
    public function update($inputs,$id);
    public function destroy($id);
}