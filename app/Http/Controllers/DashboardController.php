<?php

namespace App\Http\Controllers;

use App\Models\Capital;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\ServiceSale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get initial capital
        $capital = Capital::sum('initial_capital');

        // Total purchases cost
        $totalPurchases = Purchase::sum('total_cost');

        // Total sales revenue
        $totalSales = Sale::sum('total_revenue');

        // Total service sales revenue
        $totalServiceSales = ServiceSale::sum('total_revenue');

        // Total services revenue
        $totalServicesRevenue = \App\Models\Service::sum('price');

        // Gross profit = total revenue - total purchases
        $grossProfit = ($totalSales + $totalServiceSales) - $totalPurchases;

        // Net profit = gross profit - initial capital (assuming capital is invested)
        $netProfit = $grossProfit - $capital;

        return view('dashboard', compact('capital', 'totalPurchases', 'totalSales', 'totalServiceSales', 'totalServicesRevenue', 'grossProfit', 'netProfit'));
    }
}
