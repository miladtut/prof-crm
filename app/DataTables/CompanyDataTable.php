<?php

namespace App\DataTables;

use App\Models\Company;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CompanyDataTable extends DataTable
{
    protected $filter = null;

    public function __construct($filter=null)
    {
        $this->filter = $filter;
    }

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
                    'edit_link'=>route('admin.companies.edit',$row->id),
                    'delete_link'=>route('admin.companies.delete',$row->id),
                    'show_link'=>route('admin.companies.show',$row->id)
                ];
                return view('pages.actions.common_action',['data'=>$data])->render();
            })
            ->addColumn('type', function ($row){
                return view('pages.actions.type',['data'=>$row])->render();
            })
            ->addColumn('phone', function ($row){
                return $row->phone_key.$row->phone;
            })
            ->addColumn('No.of_inquiries', function ($row){
                if ($row->inquiries()->count() > 0){
                    return '<a href="'.route('admin.inquiries',['company'=>$row->id]).'">'.$row->inquiries()->count().'</a>';
                }else{
                    return 'No Inquires';
                }
            })->addColumn('logo',function ($row){
                if (!empty($row->logo_img)){
                    return '<img src="'.asset('uploads/'.$row->logo_img).'" width="30"/>';
                }else{
                    return '<img src="'.asset('media/users/blank.png').'" width="30"/>';
                }
            })
            ->filterColumn('type',function ($q,$word){
                $q->where('account_type','like','%'.$word.'%');
            })
            ->rawColumns(['action','type','logo','No.of_inquiries']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Company $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Company $model)
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
                    ->setTableId('company-table')->responsive()
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
            Column::make('company_name')->title('Company'),
            Column::make('email'),
            Column::computed('phone'),
            Column::computed('No.of_inquiries'),
            Column::make('created_at'),
            Column::make('type'),
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
        return 'Company_' . date('YmdHis');
    }
}
