<?php

namespace App\DataTables;

use App\Models\Material;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MaterialDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action',function ($row){
                $data = [
                    'edit_link'=>route('admin.materials.edit',$row->id),
                    'delete_link'=>route('admin.materials.delete',$row->id)
                ];
                return view('pages.actions.common_action',['data'=>$data])->render();
            })->addColumn('suppliers',function ($row){
                $string='';
                foreach ($row->suppliers as $supplier)
                    $string.=$supplier->supplier_name.',';
                return $string;
            })
            ->rawColumns(['action','suppliers']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Material $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Material $model)
    {
        return $model->newQuery()->orderByDesc('id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('material-table')->responsive()
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
            Column::make('name'),
            Column::computed('suppliers'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'Material_' . date('YmdHis');
    }
}
