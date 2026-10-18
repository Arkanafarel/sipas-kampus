<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyReport extends Model
{
    use HasFactory;

    protected $table = 'monthly_reports';

    protected $fillable = [
        'report_number',
        'title',
        'month',
        'year',
        'total_complaints',
        'total_pending',
        'total_processing',
        'total_completed',
        'category_summary',
        'notes',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'month' => 'integer',
            'year' => 'integer',
            'total_complaints' => 'integer',
            'total_pending' => 'integer',
            'total_processing' => 'integer',
            'total_completed' => 'integer',
            'category_summary' => 'array',
        ];
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getMonthNameAttribute(): string
    {
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $months[$this->month] ?? (string) $this->month;
    }

    public function getPeriodTextAttribute(): string
    {
        return "{$this->month_name} {$this->year}";
    }
}
