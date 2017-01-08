<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Spatie\Analytics\AnalyticsFacade;
use Spatie\Analytics\Period;
use App\Http\Requests;

class ChartController extends Controller
{
    public function analytics(){
        $startDate = Carbon::now()->subYear();
        $endDate = Carbon::now();

        $analyticsData = AnalyticsFacade::performQuery(Period::create($startDate, $endDate),
            "ga:sessions,ga:pageviews",
            [])->getRows();

       return view('analytic-charts.analytics', compact('analyticsData'));
    }

    public function analyticsChart(){

        $startDate = Carbon::now()->subYear();
        $endDate = Carbon::now();

        $analyticsData = AnalyticsFacade::fetchMostVisitedPages(Period::create($startDate, $endDate), 10);

        return view('analytic-charts.analyticsChart', compact('analyticsData'));
    }
    public function browsers(){
        $startDate = Carbon::now()->subYear();
        $endDate = Carbon::now();
        $analyticsData = AnalyticsFacade::fetchTopBrowsers(Period::create($startDate, $endDate), 6);
        return view('analytic-charts.browsers', compact('analyticsData'));
    }

    public function pageViews(){

        $startDate = Carbon::now()->subYear();
        $endDate = Carbon::now();

        $analyticsData = AnalyticsFacade::performQuery(Period::create($startDate, $endDate),
            "ga:pageviews,ga:uniquePageviews", ['dimensions'=>'ga:pagePath', 'sort' => '-ga:pageviews', 'max-results' => 10])->getRows();

        return view('analytic-charts.pageViews', compact('analyticsData'));
    }
    public function sessionByCountry(){
        $startDate = Carbon::now()->subYear();
        $endDate = Carbon::now();

        $analyticsData = AnalyticsFacade::performQuery(Period::create($startDate, $endDate),
            "ga:sessions", ['dimensions'=>'ga:country', 'sort' => '-ga:sessions'])->getRows();
        return view('analytic-charts.sbcountry', compact('analyticsData'));

    }

    public function operatingSystems(){
        $startDate = Carbon::now()->subYear();
        $endDate = Carbon::now();

        $analyticsData = AnalyticsFacade::performQuery(Period::create($startDate, $endDate),
            "ga:sessions", ['dimensions'=>'ga:operatingSystem'])->getRows();
        return view('analytic-charts.operatingSystems', compact('analyticsData'));

    }

    public function mobileTraffics(){
        $startDate = Carbon::now()->subYear();
        $endDate = Carbon::now();

        $analyticsData = AnalyticsFacade::performQuery(Period::create($startDate, $endDate),
            "ga:sessions, ga:pageviews, ga:sessionDuration",
            ['dimensions' => 'ga:mobileDeviceBranding, ga:source', 'segment' => 'gaid::-14'])->getRows();
        return view('analytic-charts.mobileTraffic', compact('analyticsData'));

    }
}
