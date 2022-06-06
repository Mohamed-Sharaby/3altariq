<?php

namespace App\DataTables;

use App\Models\Provider;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProviderDataTable extends DataTable
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
            ->addColumn('image', 'dashboard.providers.image')
            ->addColumn('action', 'dashboard.providers.action')->rawColumns(['action', 'image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Provider $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = Provider::query();
        $model
            ->when(\request()->has('is_reviewed')and $this->request->get('is_reviewed')!='', function ($q) {
            $q->where('is_reviewed', \request('is_reviewed'));
        })
            ->when(\request()->has('country_code')and $this->request->get('country_code')!='', function ($q) {
            $q->where('country_code', \request('country_code'));
        })
            ->with('service','service.category')->withAvg('orders','rate')->withCount('orders')->whereHas('service');
        return $model;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('provider-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->responsive()
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
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

            Column::make('id')->title('#'),
            Column::make('name')->title('الاسم'),
            Column::make('expire_at')->title('تاريخ الانتهاء'),
            Column::make('service.category.ar_name')->title('التصنيف'),
            Column::make('service.ar_name')->title('الخدمة المقدمة'),
            Column::computed('orders_avg_rate')->title('التقييم')->searchable(false),
            Column::computed('orders_count')->title('عدد الطلبات')->searchable(false),
            Column::computed('image')->title('الصورة')
                ->exportable(false)
                ->printable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')->title('العمليات'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Provider_' . date('YmdHis');
    }
}
