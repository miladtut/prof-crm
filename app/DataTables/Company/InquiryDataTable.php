<?php

namespace App\DataTables\Company;

use App\Models\Inquiry;
use Carbon\Carbon;
use http\Env\Request;
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
                $data = ['show_link'=>route('company-inquiry-show',$row->id)];
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
            ->addColumn('material_name',function ($row){
                if ($row->material){
                    return $row->material_name;
                 }elseif($row->s_po){
                    return $row->s_po->material_name;
                }else{
                    return '---';
                }
            })
            ->filterColumn('material_name',function ($query,$keyword){
                $query->whereHas('material',function ($q2) use($keyword){
                    $q2->where('name','like','%'.$keyword.'%');
                });
            })
            ->filterColumn('status_name',function ($query,$keyword){
                $query->where('status_name','like','%'.$keyword.'%');
            })
            ->rawColumns(['status_name','action','price']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Company/InquiryDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Inquiry $model)
    {
        $query = $model->newQuery()->where('company_id',auth()->user()->id);
        if ($this->filter != null){
            if (!empty($this->filter['type'])){
                $query = $query->where('type',$this->filter['type']);
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
                }else{
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
        return 'Company/Inquiry_' . date('YmdHis');
    }
}
