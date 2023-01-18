<?php

namespace App\Repositories;

use App\Models\Define;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class DefineRepository.
 */
class DefineRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Define::class;
    }

    public function index()
    {
        return $this->model()::get(['name','value']);
    }

    public function getByName(string $name)
    {
        return $this->model()::where([
            'name' => $name
        ])->first('value')?->value;
    }
}
