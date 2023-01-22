<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoterCreateRequest;
use App\Http\Requests\VoterUpdateRequest;
use App\Models\Voter;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\Facades\Toast;

class VoterController extends Controller
{
    public function index()
    {
        return view('voter.index', [
            'voters' => SpladeTable::for(Voter::latest())
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

    public function store(VoterCreateRequest $request)
    {   
        Voter::create($request->validated());
        Toast::title('New Voter Added')
            ->autoDismiss(5);
        
        return redirect()->route('voter.index');
    }

    public function edit(Voter $voter)
    {
        return view('voter.edit', compact('voter'));

    }

    public function update(VoterUpdateRequest $request, Voter $voter)
    {
        // dd($request->validated());

        $voter->update($request->validated());
        Toast::title('Voter ' . $voter->name .' data has been updated');

        return redirect()->route('voter.index');
    }

    public function destroy(Voter $voter)
    {
        $voter->delete();
        Toast::success('Voter ' . $voter->name . ' Data Deleted Succesfully');

        return back();
    }
}
