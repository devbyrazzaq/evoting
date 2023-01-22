<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;


class CandidateController extends Controller
{
    public function index()
    {
        return view('candidate.index', [
            'candidates' => SpladeTable::for(Candidate::class)
                ->column('name', canBeHidden: false, sortable:true)
                ->withGlobalSearch(columns:['name', 'email'])
                ->column('candidate_id')
                ->column('email')
                ->paginate(5),
        ]);
    }
}
