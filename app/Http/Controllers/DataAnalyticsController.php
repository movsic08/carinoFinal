<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DataAnalyticsController extends Controller
{
    
    public function showDataAnalytics()
    {

        $clients = Client::all();
        return view('admin.data-analytics', compact('clients'));
    }
    
    public function showGenderBasedAnalytics()
    {
        // Get the monthly counts of female and male clients
        $genderCounts = Client::selectRaw('gender, COUNT(*) as count, MONTH(created_at) as month')
            ->groupBy('gender', 'month')
            ->get();

        // Separate the counts for female and male
        $femaleCounts = $genderCounts->where('gender', 'female')->pluck('count', 'month')->toArray();
        $maleCounts = $genderCounts->where('gender', 'male')->pluck('count', 'month')->toArray();

        // Fill in missing months with zero counts
        $months = range(1, 12);
        $femaleData = array_fill_keys($months, 0);
        $maleData = array_fill_keys($months, 0);

        $femaleData = array_merge($femaleData, $femaleCounts);
        $maleData = array_merge($maleData, $maleCounts);

        // Example: Return the admin.data-analytics-index view with data
        return view('admin.data-analytics-index', [
            'femaleData' => json_encode(array_values($femaleData)),
            'maleData' => json_encode(array_values($maleData)),
        ]);
    }


    public function getTotalClients()
    {
        $totalClients = Client::count();

        return response()->json(['totalClients' => $totalClients]);
    }


    public function getTopMethods()
    {
        $topMethods = Client::select('method_accepted')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('method_accepted')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->get();

        // Pass the $topMethods variable to the view
        return view('data.index', ['topMethods' => $topMethods]);
    }

    public function showTopMunicipality()
    {
        // Fetch top city/municipality data
        $cityMunicipalityData = DB::table('clients')
            ->select('city_municipality', DB::raw('COUNT(city_municipality) as count'))
            ->groupBy('city_municipality')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        // Pass data to the view with adjusted column names
        return view('data.top-municipality', compact('cityMunicipalityData'));
    }

    public function getClientData()
    {
        // Get clients with month and year extracted from created_at
        $clients = Client::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('year', 'month')
        ->get();

        // Pass the clients data to the Blade view
        return view('data.client-data', ['clients' => $clients]);
    }


}
