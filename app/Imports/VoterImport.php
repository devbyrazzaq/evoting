<?php

namespace App\Imports;

use App\Models\Voter;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Validation\ValidationException;
use Throwable;

class VoterImport implements ToModel, WithHeadingRow, WithValidation 
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'unique:voters,email'],
        ];
    }

    public function model(array $row)
    {
        return new Voter([
            'name' => $row['name'],
            'email' => $row['email'],
            'username' => strtolower(str_replace(' ', '-', $row['name'])),
            'voter_id' => Str::random(6)
        ]);
    }

    public function customValidationMessages()
{
    return [
        'email.unique' => 'Import failed, email already taken',
    ];
}

    

    

    
}
