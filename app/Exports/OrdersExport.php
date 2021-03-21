<?php

namespace App\Exports;

use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\OrderDetail;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrdersExport implements Responsable, FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'Orders.xlsx';

    /**
    * Optional Writer Type
    */
    private $writerType = Excel::XLSX;

    /**
    * Optional headers
    */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function headings(): array
    {
        return [
            'Order No.',
            'Product',
            'Date'
        ];
    }

    public function map($order_details): array
    {
        return [
            $order_details->orderDetailsOrder ? $order_details->orderDetailsOrder->order_number : '',
            $order_details->orderDetailProduct ? $order_details->orderDetailProduct->name : '',
            $order_details->created_at->format('d-M-Y')
        ];
    }

    public function collection()
    {
        return $order_details = OrderDetail::with('orderDetailsOrder')->with('orderDetailProduct.productSupplierProducts.supplierproductSupplier')->get();
    }
}
