<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;

class VoterController extends Controller
{
    public function index()
    {
        return view('voter.index', [
            'voters' => SpladeTable::for(Voter::class)
                ->column('name', canBeHidden: false, sortable:true)
                ->withGlobalSearch(columns:['name', 'email'])
                ->column('voter_id')
                ->column('email')
                ->column('status')
                ->column(label: 'Actions')
                ->selectFilter(key:'status', label:'Status', options: [
                    true => 'has been vote',
                    false => 'note yet vote',
                ])
                ->paginate(5),
        ]);
    }

    public function create()
    {
        return view('voter.create');
    }

    public function import()
    {
        return view('voter.import');
    }
}
