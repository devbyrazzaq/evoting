<?php

namespace App\Http\Controllers;

use App\Exports\VoterExport;
use App\Http\Requests\VoterCreateRequest;
use App\Http\Requests\VoterUpdateRequest;
use App\Imports\VoterImport;
use App\Models\Voter;
use App\Tables\Voters;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use ProtoneMedia\Splade\Facades\Toast;

class VoterController extends Controller
{
    public function index()
    {
        return view('voter.index', [
            // 'voters' => SpladeTable::for(Voter::latest())
            //     ->column('name', canBeHidden: false, sortable:true)
            //     ->withGlobalSearch(columns:['name', 'email'])
            //     ->column('voter_id')
            //     ->column('email')
            //     ->column('status')
            //     ->column(label: 'Actions')
            //     ->selectFilter(key:'status', label:'Status', options: [
            //         true => 'has been vote',
            //         false => 'note yet vote',
            //     ])
            //     ->paginate(5),

            'voters' => Voters::class,
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
    
    public function importStore(Request $request)
    {
        $file = $request->file('file');

        $import = new VoterImport;
        // dd($import->errors());
        
        try {
            $import->import($file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();
            //  dd($failures[0]->attribute());
             
             foreach ($failures as $failure) {
                $error[] = [
                    'row' => $failure->row(),
                    'attribute' => $failure->attribute(),
                    'errors' => $failure->errors()
                ];
                //  $failure->attribute(); // either heading key (if using heading row concern) or column index
                //  $failure->errors(); // Actual error messages from Laravel validator
                //  $failure->values(); // The values of the row that has failed.
             }
             Toast::danger($e->getMessage() . ' position at column ' . $failures[0]->attribute() . ' row ' . $failures[0]->row())->autoDismiss(5);


             return back();
        }
        
        
        Toast::title('New Voter Imported')
            ->autoDismiss(5);

        return redirect()->route('voter.index');
    }

    public function export_format(Request $request)
    {        
        // if(Storage::disk('public')->exists("formatImport/$request->file"))
        // {
        //     $path = Storage::disk('public')->path("formatImport/$request->file");
        //     $content = file_get_contents($path);
        //     return response($content)->withHeaders([
        //         'Content-Type' => mime_content_type($path)
        //     ]);
        // }

        // return redirect('/404');
        if(file_exists(public_path("assets/$request->file")))
        {
            return response()->download(public_path("assets/$request->file"));
        } else {
            Toast::warning('Sorry, the file you are referring to does not exist')
                ->autoDismiss(5);

            return back();
        }
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
        Toast::title('Voter ' . $voter->name .' data has been updated')
            ->autoDismiss(5);

        return redirect()->route('voter.index');
    }

    public function destroy(Voter $voter)
    {
        $voter->delete();
        Toast::success('Voter ' . $voter->name . ' Data Deleted Succesfully')
            ->autoDismiss(5);

        return back();
    }
}
