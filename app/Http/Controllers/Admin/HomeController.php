<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Reservation;
// Reviewモデルを読み込む
use App\Models\Review;

class HomeController extends Controller
{
    public function index() {
        $total_users = User::count();
        $total_premium_users = DB::table('subscriptions')->where('stripe_status', 'active')->count();
        $total_free_users = $total_users - $total_premium_users;
        $total_restaurants = Restaurant::count();
        $total_reservations = Reservation::count();
        // レビュー件数を取得する
        $total_reviews = Review::count();
        // 平均評価を取得する（小数点第一位まで表示、値が存在しない場合はnullではなく0）
        $average_score = round(Review::avg('score') ?? 0, 1);

        $sales_for_this_month = 300 * $total_premium_users;

        return view(
            'admin.home', 
            compact(
                'total_users', 
                'total_premium_users', 
                'total_free_users', 
                'total_restaurants', 
                'total_reservations', 
                // レビュー件数を取得する
                'total_reviews',
                // 平均評価を取得する（小数点第一位まで）
                'average_score',
                'sales_for_this_month'
            )
        );
    }
}