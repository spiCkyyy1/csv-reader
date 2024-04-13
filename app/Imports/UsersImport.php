<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
class UsersImport implements WithStartRow, WithChunkReading
{
    //skipping heading row
    public function startRow(): int
    {
        return 2;
    }
    //defining the size of chunk to read file for memory optimization
    public function chunkSize(): int
    {
        return 5;
    }
}
