<?php

namespace App\DataTables;

use App\Models\Customerdoc;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomerDocumentDataTable extends DataTable
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
            ->addColumn('action', function ($row){
                $data = [
                    'edit_link'=>route('admin.cdocuments.edit',$row->id),
                    'delete_link'=>route('admin.cdocuments.delete',$row->id)
                ];
                return view('pages.actions.common_action',['data'=>$data])->render();
            })->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Customerdoc $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customerdoc $model)
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
                    ->setTableId('customerdocument-table')->responsive()
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
        return 'CustomerDocument_' . date('YmdHis');
    }
}
