<?php

namespace App\Services;

use App\Models\Department;

class DepartmentService
{
    public function list($perPage = 10)
    {
        return Department::latest()->paginate($perPage);
    }

    public function store(array $data)
    {
        return Department::create($data);
    }

    public function update(Department $department, array $data)
    {
        $department->update($data);
        return $department;
    }

    public function delete(Department $department)
    {
        return $department->delete();
    }
}
