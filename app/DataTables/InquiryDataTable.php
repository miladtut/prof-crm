<?php

namespace App\DataTables;

use App\Models\Inquiry;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InquiryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     *
     *
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
            ->addColumn('id',function ($row){
                $id = mb_substr($row->company_name, 0, 3, "UTF-8").'-'.($row->id**2);
                return $id;
            })
            ->addColumn('action', function ($row){
                $data = ['show_link'=>route('admin.inquiry.show',$row->id)];
                return view('pages.actions.view_action',['data'=>$data])->render();
            })
            ->addColumn('status_name', function ($row){
                return view('pages.actions.status',['data'=>$row])->render();
            })->addColumn('creation_date',function ($row){
                return Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('Y-m-d');
            })->addColumn('Qty',function ($row){
                if ($row->qty){
                    return $row->qty . ' ' . $row->qty_unit;
                }elseif ($row->s_po){
                    return $row->s_po->qty.' '.$row->s_po->qty_unit;
                }else{
                    return '----';
                }

            })
            ->addColumn('material_name',function ($row){
                if ($row->material){
                    return '<a href="'.route('admin.materials.edit',$row->material->id).'">'.$row->material_name.'</a>';
                }elseif($row->s_po){
                    return '<a href="'.route('admin.materials.edit',$row->s_po->material->id).'">'.$row->s_po->material_name.'</a>';
                }else{
                    return '---';
                }
            })
            ->addColumn('company_name',function ($row){
                return '<a href="'.route('admin.companies.show',$row->company->id).'">'.$row->company_name.'</a>';
            })
            ->addColumn('price', function ($row){
                if ($row->pilot){
                    return number_format($row->pilot->price,2) ;
                }else{
                    if ($row->s_po){
                        return number_format($row->s_po->material_price_per_unit,2) ;
                    }
                    return 'not sent';
                }

            })
            ->filterColumn('material_name',function ($query,$keyword){
                $query->whereHas('material',function ($q2) use($keyword){
                    $q2->where('name','like','%'.$keyword.'%');
                });
            })
            ->filterColumn('company_name',function ($query,$keyword){
                $query->whereHas('company',function ($q2) use($keyword){
                    $q2->where('company_name','like','%'.$keyword.'%');
                });
            })
            ->filterColumn('status_name',function ($query,$keyword){
                $query->where('status_name','like','%'.$keyword.'%');
            })
            ->rawColumns(['status_name','action','price','material_name','company_name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\InquiryDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Inquiry $model)
    {
        $query = $model->newQuery();
        if ($this->filter != null){
            if (!empty($this->filter['type'])){
                $query = $query->where('type',$this->filter['type']);
            }
            if (!empty($this->filter['company'])){
                $query = $query->where('company_id',$this->filter['company']);
            }
            if (!empty($this->filter['supplier'])){
                $query = $query->where('supplier_id',$this->filter['supplier'])->where('type','logistic');
            }
            if (!empty($this->filter['status_name'])){
                if ($this->filter['status_name']=='ongoing'){
                    $query->whereNotIn('status_name',['closed','declined']);
                }elseif ($this->filter['status_name']=='po_sent'){
                    $query->whereHas('files',function ($q){
                        $q->where('type','po');
                    });
                }elseif ($this->filter['status_name']=='closed'){
                    $query->where('status_name','like','%closed%');
                }
                else{
                    $query = $query->where('status_name',$this->filter['status_name']);
                }
            }
            if (!empty($this->filter['material'])){
                $query = $query->where('material_id',$this->filter['material']);
            }
            if (!empty($this->filter['from'])){
                $query = $query->where('created_at','>=',$this->filter['from']);
            }
            if (!empty($this->filter['to'])){
                $query = $query->where('created_at','<=',$this->filter['to']);
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
                    ->setTableId('inquirydatatable-table')->responsive()
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
            Column::computed('id')->searchable(false),
            Column::make('material_name')->title('Material'),
            Column::make('company_name')->title('Customer'),
            Column::computed('Qty'),
            Column::computed('price'),
            Column::make('creation_date')->title('Creation Date'),
            Column::make('status_name')->title('Status'),
            Column::computed('action')->title('Action')
                ->exportable(false)
                ->printable(false)
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
        return 'Inquiry_' . date('YmdHis');
    }
}
