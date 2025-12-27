<?php

namespace App\Analysis;

use App\Models\Item;
use App\Models\Order;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SalesAnalysisService
{
    public function getSalesReport(string $period = 'today', ?string $startDate = null, ?string $endDate = null): array
    {
        $dateRange = match($period) {
            'custom' => [
                'start' => $startDate ? Carbon::instance(Verta::parse($startDate)->datetime()) : Carbon::today()->subDays(3),
                'end' => $endDate ? Carbon::instance(Verta::parse($endDate)->datetime()) : Carbon::today(),
            ],
            'today' => $this->getTodayRange(),
            'yesterday' => $this->getYesterdayRange(),
            'week' => $this->getThisWeekRange(),
            'month' => $this->getThisMonthRange(),
            default => $this->getTodayRange(),
        };

        return [
            'date_range' => [
                'start' => [
                    'gregorian' => Carbon::parse($dateRange['start'])->format('Y-m-d'),
                    'persian' => Verta::instance($dateRange['start'])->format('Y/n/j'),
                ],
                'end' => [
                    'gregorian' => Carbon::parse($dateRange['end'])->format('Y-m-d'),
                    'persian' => Verta::instance($dateRange['end'])->format('Y/n/j'),
                ],
            ],
            'total_sales' => $this->getTotalSales($dateRange['start'], $dateRange['end']),
            'top_products' => $this->getTopProducts($dateRange['start'], $dateRange['end']),
        ];
    }


    protected function getTotalSales(Carbon|string $startDate, Carbon|string $endDate): float
    {
        $startDate = $startDate instanceof Carbon ? $startDate : Carbon::parse($startDate);
        $endDate = $endDate instanceof Carbon ? $endDate : Carbon::parse($endDate);

        return Order::query()
            ->where('status', 'completed')
            ->whereBetween('created_at', [
                $startDate->startOfDay(),
                $endDate->endOfDay()
            ])
            ->sum('total_with_coupon');
    }

    protected function getTopProducts(Carbon|string $startDate, Carbon|string $endDate): Collection
    {
        $startDate = $startDate instanceof Carbon ? $startDate : Carbon::parse($startDate);
        $endDate = $endDate instanceof Carbon ? $endDate : Carbon::parse($endDate);

        return Item::query()
            ->select(
                'product_id',
                DB::raw('SUM(qty) as total_quantity'),
                DB::raw('SUM(price * qty) as total_revenue')
            )
            ->whereHas('order', function ($query) {
                $query->where('status', 'completed');
            })
            ->whereBetween('created_at', [
                $startDate->startOfDay(),
                $endDate->endOfDay()
            ])
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_revenue')
            ->limit(5)
            ->get();
    }

    private function getTodayRange(): array
    {
        return [
            'start' => Carbon::today(),
            'end' => Carbon::today(),
        ];
    }

    private function getYesterdayRange(): array
    {
        return [
            'start' => Carbon::yesterday(),
            'end' => Carbon::yesterday(),
        ];
    }

    private function getThisWeekRange(): array
    {
        return [
            'start' => Carbon::now()->startOfWeek(),
            'end' => Carbon::now()->endOfWeek(),
        ];
    }

    private function getThisMonthRange(): array
    {
        return [
            'start' => Carbon::now()->startOfMonth(),
            'end' => Carbon::now()->endOfMonth(),
        ];
    }
}
