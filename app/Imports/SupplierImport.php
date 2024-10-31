<?php

namespace App\Imports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;

class SupplierImport implements ToModel
{
    public function model(array $row)
    {
        return new Supplier([
            'name'    => $row[0], // Cột đầu tiên trong Excel
            'phone'   => $row[1], // Cột thứ hai
            'email'   => $row[2], // Cột thứ ba
            'address' => $row[3], // Cột thứ tư
        ]);
    }
}
