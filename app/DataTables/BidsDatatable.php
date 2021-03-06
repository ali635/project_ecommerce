<?php

namespace App\DataTables;
use App\Model\Bid;
use Yajra\DataTables\Services\DataTable;

class BidsDatatable extends DataTable
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
            ->addColumn('checkbox', 'admin.bids.btn.checkbox')
            ->addColumn('edit', 'admin.bids.btn.edit')
            ->addColumn('delete', 'admin.bids.btn.delete')
           
            ->rawColumns([
                'edit',
                'delete',
                'checkbox',
                
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\UsersDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Bid::query()->with('user_id')->select('bids.*');
        return Bid::query()->with('auction_id')->select('bids.*');
    }
   
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('admindatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->addAction(['width'=>'80px'])
                    //->parameters($this->getBuilderParameters());
                    ->parameters([
                        'dom'           => 'Blfrtip',
                        'lengthMenu'    => [[10,25,50,100],[10,25,50,trans('admin.all_record')]],
                        'buttons'       => [
                            ['extend' =>'print','className'=>'btn btn-primary','text'=> '<i class="fa fa-print"></i> '.trans('admin.print')],
                            ['extend' =>'csv','className'=>'btn btn-info','text'=> '<i class="fa fa-file"></i> '.trans('admin.ex_csv')],
                            ['extend' =>'excel','className'=>'btn btn-success','text'=> '<i class="fa fa-file"></i> '.trans('admin.ex_excel')],
                            [
                                'text'   =>'<i class="fa fa-trash"></i>'.trans('admin.delete_all'),
                                'className'=>'btn btn-danger delBtn'
                            ],
                            ['extend' =>'reload','className'=>'btn btn-default','text'=> ''.trans('admin.reload')],
                            
                        ],
                        
                        'initComplete' =>" function () {
                            this.api().columns([1,2,3]).every(function () {
                                var column = this;
                                var input  = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty()).on('keyup',function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
                        'language'  => datatable_lang(),
                    ]);   
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name'  => 'checkbox',
                'data'  => 'checkbox',
                'title'  => '<input type="checkbox" class="check_all" onclick="check_all()" />',
                'exportable'    => false,
                'printable'     => false,
                'orderable'     => false,
                'searchable'    => false,
            ],
            [
                'name'  => 'id',
                'data'  => 'id',
                'title'  => '#',
            ],
            [
                'name'  => 'auction_id.name_ar',
                'data'  => 'auction_id.name_ar',
                'title'  => trans('admin.name_auct_ar'),
            ],
           
            [
                'name'  => 'user_id.name',
                'data'  => 'user_id.name',
                'title'  => trans('admin.user_id1'),
            ],
            [
                'name'  => 'fee',
                'data'  => 'fee',
                'title'  => trans('admin.fee'),
            ],
            [
                'name'  => 'paid',
                'data'  => 'paid',
                'title'  => trans('admin.paid'),
            ],
            

            [
				'name'  => 'created_at',
				'data'  => 'created_at',
				'title' => trans('admin.created_at'),
			], 
            [
                'name'          => 'delete',
                'data'          => 'delete',
                'title'         => trans('admin.delete'),
                'exportable'    => false,
                'printable'     => false,
                'orderable'     => false,
                'searchable'    => false,
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'bids' . date('YmdHis');
    }
}
