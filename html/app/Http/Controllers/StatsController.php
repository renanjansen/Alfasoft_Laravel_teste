<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\CountryService;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function contactsByCountry()
    {
        $stats = Contact::select('country_code', DB::raw('COUNT(*) as total'))
            ->groupBy('country_code')
            ->orderBy('total', 'DESC')
            ->get();

        $statsWithCountryInfo = $stats->map(function ($stat) {
            $countryName = $this->countryService->getCountryNameByCode($stat->country_code);

            return [
                'country_code' => $stat->country_code,
                'country_name' => $countryName,
                'total' => $stat->total,
                'display' => $countryName . ' (+' . $stat->country_code . ')'
            ];
        });

        return view('stats.contacts-by-country', [
            'stats' => $statsWithCountryInfo,
            'totalContacts' => $stats->sum('total'),
            'uniqueCountries' => $stats->count()
        ]);
    }

    public function contactsByCountryWithAllCountries()
    {
        $allCountries = $this->countryService->getCountriesForDropdown();

        $stats = Contact::select('country_code', DB::raw('COUNT(*) as total'))
            ->groupBy('country_code')
            ->get()
            ->keyBy('country_code');

        $combinedStats = $allCountries->map(function ($country) use ($stats) {
            $countryStat = $stats->get($country['code']);

            return [
                'country_code' => $country['code'],
                'country_name' => $country['name'],
                'total' => $countryStat ? $countryStat->total : 0,
                'display' => $country['display'],
                'has_contacts' => (bool) $countryStat
            ];
        })->filter(function ($stat) {
            return $stat['total'] > 0;
        })->sortByDesc('total');

        return view('stats.contacts-by-country', [
            'stats' => $combinedStats,
            'totalContacts' => $combinedStats->sum('total'),
            'uniqueCountries' => $combinedStats->count()
        ]);
    }
}
