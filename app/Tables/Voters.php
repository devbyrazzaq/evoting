<?php

namespace App\Tables;

use App\Models\Voter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Excel;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Voters extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Voter::latest();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            // ->withGlobalSearch(columns: ['id'])
            // ->column('id', sortable: true);
                ->column('name', canBeHidden: false, sortable:true)
                ->withGlobalSearch(columns:['name', 'email'])
                ->column('voter_id')
                ->column('email')
                ->column('status', exportAs:false)
                ->column(label: 'Actions', exportAs:false)
                ->selectFilter(key:'status', label:'Status', options: [
                    true => 'has been vote',
                    false => 'note yet vote',
                ])
                ->export(
                    label:'Export Voter Data',
                    filename: 'voter-data-at-' . Carbon::now()->format('d-m-Y') . '.xlsx',
                    type: Excel::XLSX
                )
                ->paginate(5);


            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
