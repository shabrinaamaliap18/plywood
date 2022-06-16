<?php

namespace App\DataTables;

use App\AuditTrail;
use App\Models\forms\Form;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

use Yajra\Datatables\Facades\Datatables;



class AuditTrailDataTable extends DataTables
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */


    /**
     * Get query source of dataTable.
     *
     * @param \App\AuditTrail $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Form $model , Request $request )
    {
        $start_date = $this->$request->get('start_date');
        $end_date   = $this->$request->get('end_date');
        $name       = $this->$request->get('name');


        $query = $model->newQuery();
        if ( !empty($start_date)  &&   !empty($end_date))
        {
            $start_date  = Carbon::parse($start_date);

            $end_date = Carbon::parse($end_date);

            $query = $query->whereBetween('created_at',[$start_date,$end_date]);
        }

        if(!empty($name))
        {
            $query = $query->where('name',$name);
        }

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    
    /**
     * Get columns.
     *
     * @return array
     */
    

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AuditTrail_' . date('YmdHis');
    }
}