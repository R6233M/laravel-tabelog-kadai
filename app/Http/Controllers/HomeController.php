<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $display_count = 5;

        $highly_rated_restaurants = Restaurant::withAvg('reviews', 'score')
            ->withCount('reviews')
            ->orderBy('reviews_avg_score', 'desc')
            ->take($display_count)
            ->get();

        $popular_restaurants = Restaurant::withCount('reservations')
            ->orderBy('reservations_count', 'desc')
            ->take($display_count)
            ->get();

        $categories = Category::withCount('restaurants')->get();

        $featured_categories = [
            [
                'category' => $categories->firstWhere('name', '和食'),
                'image' => 'washoku.jpg'
            ],
            [
                'category' => $categories->firstWhere('name', 'うどん'),
                'image' => 'udon.jpg'
            ],
            [
                'category' => $categories->firstWhere('name', '丼物'),
                'image' => 'don.jpg'
            ],
            [
                'category' => $categories->firstWhere('name', 'ラーメン'),
                'image' => 'ramen.jpg'
            ],
            [
                'category' => $categories->firstWhere('name', 'おでん'),
                'image' => 'oden.jpg'
            ],
            [
                'category' => $categories->firstWhere('name', '揚げ物'),
                'image' => 'fried.jpg'
            ],
        ];

        $new_restaurants = Restaurant::orderBy('created_at', 'desc')
            ->take($display_count)
            ->get();

        return view('home', compact(
            'highly_rated_restaurants',
            'popular_restaurants',
            'categories',
            'featured_categories',
            'new_restaurants'
        ));
    }
}
