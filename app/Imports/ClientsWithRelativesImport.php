<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ClientsWithRelativesImport implements WithMultipleSheets
{

    protected $supervisor_id;

    // Add a constructor to accept the request
    public function __construct(int $supervisor_id)
    {
        $this->supervisor_id = $supervisor_id;
    }
    public function sheets(): array
    {
        return [
            'Clients' => new ClientsImport(supervisor_id: $this->supervisor_id),
            'Relatives' => new RelativesImport(),
        ];
    }

}
