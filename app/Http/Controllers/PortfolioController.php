<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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

    public function apiIndex(Request $request): JsonResponse
    {
        $user = $request->attributes->get('apiUser');

        if (! $user) {
            return response()->json([
                'error' => 'Unauthorized.'
            ], 401);
        }

        $ids = $user->selected_portfolio_ids ?? [];

        if (! is_array($ids) || empty($ids)) {
            return response()->json([
                'data' => [],
            ]);
        }

        $portfolios = Portfolio::query()
            ->active()
            ->whereIn('id', $ids)
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->get([
                'id', 'title', 'date', 'clients', 'kota', 'description_proyek', 'link', 'slug', 'images1', 'images2', 'images3', 'images4', 'category_id',
            ]);

        return response()->json([
            'data' => $portfolios,
        ]);
    }
}
