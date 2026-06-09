@extends('layouts.app')

@section('content')
    <div class="col container">
        <div class="row justify-content-center">
            <div class="col-xxl-9 col-xl-10 col-lg-11">
                <div class="nagoyameshi-admin-grid mb-5">
                    <div>
                        <!-- 総会員数・無料会員数・有料会員数をひとまとめにし、アコーディオン表示にする -->
                        <div
                            class="card nagoyameshi-admin-card"
                            data-bs-toggle="collapse"
                            data-bs-target="#memberDetail"
                            style="cursor:pointer;"
                        >
                            <div class="card-body text-center">
                                <h5 class="card-title">総会員数 ▼</h5>
                                <p class="card-text">
                                    <span class="card-text">{{ number_format($total_users) }}名</span>
                                </p>
                                <div class="collapse mt-3" id="memberDetail">
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">無料会員数</span>
                                        <span class="fw-bold text-success">{{ number_format($total_free_users) }}名</span>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <span class="text-muted">有料会員数</span>
                                        <span class="fw-bold text-primary">{{ number_format($total_premium_users) }}名</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card nagoyameshi-admin-card">
                            <div class="card-body text-center">
                                <h5 class="card-title">店舗数</h5>
                                <p class="card-text">{{ $total_restaurants }}件</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card nagoyameshi-admin-card">
                            <div class="card-body text-center">
                                <h5 class="card-title">総予約数</h5>
                                <p class="card-text">{{ $total_reservations }}件</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card nagoyameshi-admin-card">
                             <div class="card-body text-center">
                                <h5 class="card-title">レビュー件数</h5>
                                <p class="card-text">{{ $total_reviews }}件</p>
                             </div>
                        </div>
                    </div>
                    <div>
                        <div class="card nagoyameshi-admin-card">
                            <div class="card-body text-center">
                                <h5 class="card-title">平均評価</h5>
                                <p class="card-text">★{{ $average_score }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card nagoyameshi-admin-card">
                            <div class="card-body text-center">
                                <h5 class="card-title">月間売上</h5>
                                <p class="card-text">{{ number_format($sales_for_this_month) }}円</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
