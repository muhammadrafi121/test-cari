<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\City;
use App\Models\Province;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('index', [
            'script' => 'index',
        ]);
    }

    public function manage()
    {
        return view('manage', [
            'script' => 'manage',
            'articles' => Article::all(),
            'cities' => City::all(),
            'provinces' => Province::all(),
        ]);
    }

    public function getAllCity()
    {
        return City::all();
    }

    public function getAllProvince()
    {
        return Province::all();
    }

    public function getGeo(Request $request)
    {
        if ($request->filled('province')) {
            return City::select('articles.*', DB::raw('ST_AsGeoJSON(cities.wkb_geometry) as geojson'))
                ->join(DB::raw('(SELECT city, province, COUNT(*) AS article_count FROM articles GROUP BY city, province) AS articles'), 'cities.shapename', '=', 'articles.city')
                ->where('articles.province', $request->input('province'))
                ->get();
        } elseif ($request->filled('city')) {
            return City::select('articles.*', DB::raw('ST_AsGeoJSON(cities.wkb_geometry) as geojson'))
                ->join(DB::raw('(SELECT city, COUNT(*) AS article_count FROM articles GROUP BY city) AS articles'), 'cities.shapename', '=', 'articles.city')
                ->where('articles.city', $request->input('city'))
                ->get();
        }

        return City::select('articles.*', DB::raw('ST_AsGeoJSON(cities.wkb_geometry) as geojson'))
            ->join(DB::raw('(SELECT city, COUNT(*) AS article_count FROM articles GROUP BY city) AS articles'), 'cities.shapename', '=', 'articles.city')
            ->get();
    }
}
