@extends('layouts.app')

@push('fonts')
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;600&display=swap" rel="stylesheet">
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="{{ asset('/js/carousel.js') }}"></script>
@endpush

@section('content')
<div>
    <div class="swiper nagoyameshi-swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="{{ asset('/images/washoku.jpg') }}"></div>
            <div class="swiper-slide"><img src="{{ asset('/images/don.jpg') }}"></div>
            <div class="swiper-slide"><img src="{{ asset('/images/ramen.jpg') }}"></div>

            <div class="d-flex align-items-center nagoyameshi-overlay-background">
                <div class="container nagoyameshi-container nagoyameshi-overlay-text">
                    <h1 class="text-white nagoyameshi-catchphrase-heading">名古屋ならではの味を、<br>見つけよう</h1>
                    <p class="text-white nagoyameshi-catchphrase-paragraph">NAGOYAMESHIは、<br>名古屋市のB級グルメ専門のレビューサイトです。</p>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session('flash_message'))
<div class="container nagoyameshi-container my-3">
    <div class="alert alert-info" role="alert">
        <p class="mb-0">{{ session('flash_message') }}</p>
    </div>
</div>
@endif

<div class="bg-light mb-4 py-4">
    <div class="container nagoyameshi-container">
        <h2 class="mb-3">キーワードから探す</h2>
        <form method="GET" action="{{ route('restaurants.index') }}" class="nagoyameshi-user-search-box">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="店舗名・エリア・カテゴリ" name="keyword">
                <button type="submit" class="btn text-white shadow-sm nagoyameshi-btn">検索</button>
            </div>
        </form>
    </div>
</div>

<div class="container nagoyameshi-container">
    <h2 class="mb-3">評価が高いお店</h2>
    <div class="row row-cols-xl-5 row-cols-md-3 row-cols-2 g-3 mb-5">
        @foreach ($highly_rated_restaurants as $highly_rated_restaurant)
        <div class="col">
            <a href="{{ route('restaurants.show', $highly_rated_restaurant) }}" class="link-dark nagoyameshi-card-link">
                <div class="card h-100">
                    @if ($highly_rated_restaurant->image !== '')
                    <img src="{{ asset('storage/restaurants/' . $highly_rated_restaurant->image) }}" class="card-img-top nagoyameshi-vertical-card-image">
                    @else
                    <img src="{{ asset('/images/no_image.jpg') }}" class="card-img-top nagoyameshi-vertical-card-image" alt="画像なし">
                    @endif
                    <div class="card-body">
                        <h3 class="card-title">{{ $highly_rated_restaurant->name }}</h3>
                        <div class="text-muted small mb-1">
                            @if ($highly_rated_restaurant->categories()->exists())
                            @foreach ($highly_rated_restaurant->categories as $index => $category)
                            <div class="d-inline-block">
                                @if ($index === 0)
                                {{ $category->name }}
                                @else
                                {{ ' ' . $category->name }}
                                @endif
                            </div>
                            @endforeach
                            @else
                            <span>カテゴリ未設定</span>
                            @endif
                        </div>
                        <p class="card-text">
                            <span class="nagoyameshi-star-rating me-1" data-rate="{{ round($highly_rated_restaurant->reviews->avg('score') * 2) / 2 }}"></span>
                            {{ number_format(round($highly_rated_restaurant->reviews_avg_score, 2), 2) }}（{{ $highly_rated_restaurant->reviews_count }}件）
                        </p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <h2 class="mb-3">予約数の多い人気店</h2>
    <div class="row row-cols-xl-5 row-cols-md-3 row-cols-2 g-3 mb-5">
        @foreach ($popular_restaurants as $index => $popular_restaurant)
        <div class="col">
            <a href="{{ route('restaurants.show', $popular_restaurant) }}" class="link-dark nagoyameshi-card-link">
                <div class="card h-100">
                    @if ($popular_restaurant->image !== '')
                    <img src="{{ asset('storage/restaurants/' . $popular_restaurant->image) }}" class="card-img-top nagoyameshi-vertical-card-image">
                    @else
                    <img
                        src="{{ asset('/images/no_image.jpg') }}" class="card-img-top nagoyameshi-vertical-card-image">
                    @endif
                    <div class="card-body">
                        <p class="fw-bold mb-2">
                            @if($index == 0)🥇 第1位
                             @elseif($index == 1)🥈 第2位
                             @elseif($index == 2)🥉 第3位
                             @else 第{{ $index + 1 }}位
                            @endif
                        </p>
                        <h3 class="card-title">
                            {{ $popular_restaurant->name }}
                        </h3>
                        <p class="card-text text-muted">
                            予約数：{{ $popular_restaurant->reservations_count }}件
                        </p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <h2 class="mb-3">カテゴリから探す</h2>
    <div class="row row-cols-xl-6 row-cols-md-3 row-cols-2 g-3 mb-3">
        @foreach ($featured_categories as $featured_category)
        <div class="col">
            <a href="{{ url("/restaurants/?category_id={$featured_category['category']->id}") }}" class="nagoyameshi-card-link">
              <div class="card text-white">
                <img src="{{ asset('/images/' . $featured_category['image']) }}" class="card-img nagoyameshi-vertical-card-image" alt="{{ $featured_category['category']->name }}">
                <div class="card-img-overlay d-flex justify-content-center align-items-center nagoyameshi-overlay-background">
                    <h3 class="card-title nagoyameshi-category-name">
                        {{ $featured_category['category']->name }}
                        （{{ $featured_category['category']->restaurants_count }}件）
                    </h3>
                </div>
              </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class="mb-5">
        @foreach ($categories as $category)
        @if ($category->name === '和食' || $category->name === 'うどん' || $category->name === '丼物' || $category->name === 'ラーメン' || $category->name === 'おでん' || $category->name === '揚げ物')
        @continue
        @else
        <a href="{{ url("/restaurants/?category_id={$category->id}") }}" 
             class="btn btn-outline-secondary btn-sm me-1 mb-2">{{ $category->name }}
             （{{ $category->restaurants_count }}件）</a>
        @endif
        @endforeach
    </div>

    <h2 class="mb-3">新規掲載店</h2>
    <div class="row row-cols-xl-5 row-cols-md-3 row-cols-2 g-3 mb-5">
        @foreach ($new_restaurants as $new_restaurant)
        <div class="col">
            <a href="{{ route('restaurants.show', $new_restaurant) }}" class="link-dark nagoyameshi-card-link">
                <div class="card h-100">
                    @if ($new_restaurant->image !== '')
                    <img src="{{ asset('storage/restaurants/' . $new_restaurant->image) }}" class="card-img-top nagoyameshi-vertical-card-image">
                    @else
                    <img src="{{ asset('/images/no_image.jpg') }}" class="card-img-top nagoyameshi-vertical-card-image" alt="画像なし">
                    @endif
                    <div class="card-body">
                        <h3 class="card-title">{{ $new_restaurant->name }}</h3>
                        <div class="text-muted small mb-1">
                            @if ($new_restaurant->categories()->exists())
                            @foreach ($new_restaurant->categories as $index => $category)
                            <div class="d-inline-block">
                                @if ($index === 0)
                                {{ $category->name }}
                                @else
                                {{ ' ' . $category->name }}
                                @endif
                            </div>
                            @endforeach
                            @else
                            <span>カテゴリ未設定</span>
                            @endif
                        </div>
                        <p class="card-text">{{ mb_substr($new_restaurant->description, 0, 19) }}@if (mb_strlen($new_restaurant->description) > 19)...@endif</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection