<?php
namespace App\Services\Api\Interfaces;
interface ManageInterface{
    public function getAll();
    public function getOne($id);
    public function getProfile($option);
    public function save($inputs);
    public function update($inputs,$id);
    public function destroy($id);
}