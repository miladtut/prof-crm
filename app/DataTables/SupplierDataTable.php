<?php

namespace App\DataTables;

use App\Models\Supplier;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SupplierDataTable extends DataTable
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
                $data = [
                    'edit_link'=>route('admin.suppliers.edit',$row->id),
                    'delete_link'=>route('admin.suppliers.delete',$row->id),
                    'show_link'=>route('admin.suppliers.show',$row->id)
                ];
                return view('pages.actions.common_action',['data'=>$data])->render();
            })
            ->addColumn('phone', function ($row){
                return $row->phone_key.$row->phone;
            })
            ->addColumn('logo',function ($row){
                if (!empty($row->logo_img)){
                    return '<img src="'.asset('uploads/'.$row->logo_img).'" width="30"/>';
                }else{
                    return '<img src="'.asset('media/users/blank.png').'" width="30"/>';
                }
            })
            ->addColumn('creation_date',function ($row){
                return Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('Y-m-d');
            })
            ->addColumn('no_of_logistics_inquiries',function ($row){
                return '<a href="'.route('admin.inquiries',['supplier'=>$row->id]).'">'.$row->inquiries()->where('type','logistic')->count().'</a>';
            })
            ->rawColumns(['action','type','logo','no_of_logistics_inquiries']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Supplier $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Supplier $model)
    {
        $query = $model->newQuery();
        if ($this->filter != null){
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
                    ->setTableId('supplier-table')->responsive()
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
            Column::computed('logo')
                ->exportable(false)
                ->printable(false),
            Column::make('supplier_name')->title('Supplier'),
            Column::make('email'),
            Column::computed('phone'),
            Column::computed('no_of_logistics_inquiries'),
            Column::computed('creation_date'),
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
        return 'Supplier_' . date('YmdHis');
    }
}
