<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('status', function($query){
            if ($query->status === 'pending') {
                    return '<span class="badge badge-warning">Pending</span>';
                } elseif ($query->status === 'processing') {
                    return '<span class="badge badge-info">Processing</span>';
                } elseif ($query->status === 'shipped') {
                    return '<span class="badge badge-success">Shipped</span>';
                } elseif ($query->status === 'delivered') {
                    return '<span class="badge badge-success">Delivered</span>';
                } elseif ($query->status === 'cancelled') {
                    return '<span class="badge badge-danger">Cancelled</span>';
                } elseif ($query->status === 'on_hold') {
                    return '<span class="badge badge-warning">On Hold</span>';
                } elseif ($query->status === 'refunded') {
                    return '<span class="badge badge-secondary">Refunded</span>';
                } else {
                   
                    return '<span class="badge badge-light">Unknown</span>';
                }
                
            })
            ->addColumn('payment_status', function($query){
                if ($query->payment_status === 'success') {
                    return '<span class="badge badge-success">Payment Successful</span>';
                } elseif ($query->payment_status === 'complete') {
                    return '<span class="badge badge-success">Payment Completed</span>';
                } elseif ($query->payment_status === 'incomplete') {
                    return '<span class="badge badge-warning">Payment Incomplete</span>';
                } elseif ($query->payment_status === 'failed') {
                    return '<span class="badge badge-danger">Payment Failed</span>';
                } else {
                    return '<span class="badge badge-light">Unknown Payment Status</span>';
                }

            })
            ->addColumn('date' , function($query){
                return date('d-m-Y', strtotime($query->created_at));
            })
            ->addColumn('action', function ($query) {
                $view = "<a href='" . route('admin.order.show', $query->id) . " ' class='btn btn-primary mr-2' > <i class='fas fa-eye'></i>  </a>";
                $delete = "<a href='" . route('admin.category-group.destroy', $query->id) . "' class='btn btn-danger delete-item' > <i class='fas fa-trash'></i> </a>";

                return $view . $delete;
            })
            ->rawColumns(['action', 'status', 'payment_status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('orders-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('invoice_id'),
            Column::make('qty'),
            Column::make('grand_total'),
            Column::make('status'),
            Column::make('payment_status'),
            Column::make('date'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(160)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Orders_' . date('YmdHis');
    }
}
