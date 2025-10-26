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
    public function show($id)
    {
        // Allow both numeric id and slug by attempting both
        $portfolio = is_numeric($id)
            ? Portfolio::query()->active()->findOrFail((int)$id)
            : Portfolio::query()->active()->where('slug', $id)->firstOrFail();

        return view('details.portfolio', [
            'portfolio' => $portfolio,
        ]);
    }
}