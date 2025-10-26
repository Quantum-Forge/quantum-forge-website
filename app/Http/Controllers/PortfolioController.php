<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the portfolios.
     */
    public function index(Request $request)
    {
        $perPage = 6;
        $portfolios = Portfolio::query()
            ->active()
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        return view('portfolio', [
            'portfolios' => $portfolios,
        ]);
    }

    /**
     * Display the specified portfolio.
     */
    public function show(Portfolio $portfolio)
    {
        // Ensure the portfolio is active
        if (!$portfolio->is_active) {
            abort(404);
        }

        return view('details.portfolio', [
            'portfolio' => $portfolio,
        ]);
    }
}