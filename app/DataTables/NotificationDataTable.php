<?php

namespace App\DataTables;

use App\Models\Notification;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NotificationDataTable extends DataTable
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
            ->addColumn('title', function ($row){
                return '<a href="'.$row->notification_url.'">'.$row->title.'</a>';
            })
            ->addColumn('readed', function ($row){
                if ($row->readed == 'no'){
                    return 'unread';
                }else{
                    return 'read';
                }
            })
            ->addColumn('created_at', function ($row){
                return Carbon::createFromFormat('Y-m-d H:i:s',$row->created_at)->format('Y-m-d H:i:s');
            })
            ->rawColumns(['title'])
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Notification $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Notification $model)
    {
        $q = $model->newQuery();
        if (auth('admin')->check()){
            $q->where('for_admin','yes');
        }elseif (auth()->check()){
            $q->where('company_id',auth()->user()->id);
        }
        return $q->orderByDesc('id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('notification-table')
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
            Column::computed('title')->title('text'),
            Column::make('readed')->title('status'),
            Column::computed('created_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Notification_' . date('YmdHis');
    }
}
