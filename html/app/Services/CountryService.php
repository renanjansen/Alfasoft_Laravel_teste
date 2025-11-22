<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CountryService
{
    public function getCountries()
    {
        return Cache::remember('countries', 3600, function () {
            try {
                // Tentar a v3 da API primeiro
                $response = Http::timeout(30)->get('https://restcountries.com/v3.1/all?fields=name,idd,cca2');

                if ($response->successful()) {
                    $data = $response->json();
                    Log::info('API v3.1 successful. Countries count: ' . count($data));
                    return $data;
                }

                // Se a v3 falhar, tentar a v2
                Log::warning('API v3.1 failed, trying v2...');
                $response = Http::timeout(30)->get('https://restcountries.com/v2/all?fields=name,callingCodes,alpha2Code');

                if ($response->successful()) {
                    $data = $response->json();
                    Log::info('API v2 successful. Countries count: ' . count($data));
                    return $data;
                }

                Log::error('Both API versions failed. Status: ' . $response->status());
                return [];

            } catch (\Exception $e) {
                Log::error('Error fetching countries: ' . $e->getMessage());
                return [];
            }
        });
    }

    public function getCountriesForDropdown()
    {
        $countries = $this->getCountries();

        // Se a API falhar, usar fallback
        if (empty($countries)) {
            Log::warning('Using fallback countries');
            return $this->getFallbackCountries();
        }

        $dropdown = [];
        $processedCodes = [];

        foreach ($countries as $country) {
            $name = $country['name']['common'] ?? ($country['name'] ?? 'Unknown');

            // Extrair código de chamada
            $callingCode = $this->extractCallingCode($country);

            if (!empty($callingCode) && !empty($name) && !in_array($callingCode, $processedCodes)) {
                $dropdown[] = [
                    'code' => $callingCode,
                    'name' => $name,
                    'display' => $name . ' (' . $callingCode . ')'
                ];
                $processedCodes[] = $callingCode;
            }
        }

        // Ordenar por nome
        usort($dropdown, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        return collect($dropdown);
    }

    private function extractCallingCode($country)
    {
        // API v3 - novo formato
        if (isset($country['idd'])) {
            $root = $country['idd']['root'] ?? '';
            $suffixes = $country['idd']['suffixes'] ?? [];
            if (!empty($root) && !empty($suffixes)) {
                $suffix = $suffixes[0] ?? '';
                return preg_replace('/[^0-9]/', '', $root . $suffix);
            }
        }

        // API v2 - formato antigo
        if (isset($country['callingCodes']) && !empty($country['callingCodes'])) {
            return preg_replace('/[^0-9]/', '', $country['callingCodes'][0]);
        }

        return null;
    }

    private function getFallbackCountries()
    {
        return collect([
            ['code' => '351', 'name' => 'Portugal', 'display' => 'Portugal (351)'],
            ['code' => '55', 'name' => 'Brazil', 'display' => 'Brazil (55)'],
            ['code' => '1', 'name' => 'United States', 'display' => 'United States (1)'],
            ['code' => '44', 'name' => 'United Kingdom', 'display' => 'United Kingdom (44)'],
            ['code' => '33', 'name' => 'France', 'display' => 'France (33)'],
            ['code' => '49', 'name' => 'Germany', 'display' => 'Germany (49)'],
            ['code' => '34', 'name' => 'Spain', 'display' => 'Spain (34)'],
            ['code' => '39', 'name' => 'Italy', 'display' => 'Italy (39)'],
            ['code' => '31', 'name' => 'Netherlands', 'display' => 'Netherlands (31)'],
            ['code' => '41', 'name' => 'Switzerland', 'display' => 'Switzerland (41)'],
        ]);
    }

    public function getCountryNameByCode($code)
    {
        $countries = $this->getCountriesForDropdown();
        $country = $countries->firstWhere('code', $code);
        return $country ? $country['name'] : 'Unknown';
    }
}
