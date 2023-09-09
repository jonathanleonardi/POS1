<?php

namespace App\Exports;

use App\Models\Penjualan;
use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionReport extends DefaultValueBinder implements FromView, WithColumnFormatting, ShouldAutoSize, WithCustomValueBinder, WithStyles
{
    use Exportable;

    protected $awal;
    protected $akhir;

    public function __construct(string $awal, string $akhir)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
    }

    public function view(): View
    {
        $report = [];
        $transaksiModel = new Transaksi();
        $penjualanModel = new Penjualan();

        $transaksi = $transaksiModel->getReport($this->awal, $this->akhir);
        foreach ($transaksi as $index => $value) {
            # code...
            $reportPenjualan = [];
            $penjualan = $penjualanModel->getPenjualan('penjualan.id_transaksi', '=', $value->id_transaksi);

            foreach ($penjualan as $key => $valuePenjualan) {
                # code...
                $reportPenjualan[$key] = $valuePenjualan;
            }

            $report[$index] = [
                'transaksi' => $value,
                'item' => $reportPenjualan,
            ];
        }

        return view('report', ['report' => $report]);
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_STRING,
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_NUMERIC);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'size' => 21]],
            2    => ['font' => ['bold' => true, 'size' => 11]],
            4    => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
