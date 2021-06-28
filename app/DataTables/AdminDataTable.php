<?php

namespace App\DataTables;

use App\Models\Admin;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    protected $filter = null;

    public function __construct($filter=null)
    {
        $this->filter = $filter;
    }

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($row){
                $data = ['edit_link'=>route('admin.admins.edit',$row->id),'delete_link'=>route('admin.admins.delete',$row->id)];
                return view('pages.actions.common_action',['data'=>$data])->render();
            })
            ->addColumn('created', function ($row){
                $data = Carbon::createFromFormat('Y-m-d H:i:s',$row->created_at)->format('Y-m-d');
                return $data;
            })
            ->rawColumns(['action','type']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admin $model)
    {
        $query = $model->newQuery();
        if ($this->filter != null){
            if (!empty($this->filter['account_type'])){
                $query = $query->where('account_type',$this->filter['account_type']);
            }
            if (!empty($this->filter['register_type'])){
                $query = $query->where('register_type',$this->filter['register_type']);
            }
            if (!empty($this->filter['blocked'])){
                $query = $query->where('blocked',1);
            }
            if (!empty($this->filter['created_from'])){
                $query = $query->where('created_at','>=',$this->filter['created_from']);
            }
            if (!empty($this->filter['created_to'])){
                $query = $query->where('created_at','<=',$this->filter['created_to']);
            }

        }
        return $query->orderByDesc('id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('admin-table')->responsive()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
            ->buttons(
                Button::make('pdf'),
                Button::make('copy'),
                Button::make('excel'),
                Button::make('csv'),
                Button::make('print')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('admin_name')->title('Name'),
            Column::make('email'),
            Column::computed('created'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin_' . date('YmdHis');
    }
}
