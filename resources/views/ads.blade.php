@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <h3>Список Ваших объявлений</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Список кампаний</a></li>
                        <li class="breadcrumb-item"><a href="/home/{{ $campaign_id }}/adsets">Список групп</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Список объявлений</li>
                      </ol>
                    </nav>

                    @if ($ads)
                      {{ $ads->links() }}
                    @endif

                    @foreach ($ads as $ad)
                    <div class="container">
                        <div class="row my-3">
                        <div class="card" style="width: 100%;">
                          <div class="card-body">
                            <p class="font-weight-light">account_id: {{ $ad->account_id }}</p>
                            <p class="font-weight-light">campaign_id: {{ $ad->campaign_id }}</p>
                            <p class="font-weight-light">adset_id: {{ $ad->adset_id }}</p>
                            <p class="font-weight-light">ad_id: {{ $ad->id }}</p>
                            <p class="font-weight-light">action_values: {{ $ad->action_values }}</p>
                            <p class="font-weight-light">clicks: {{ $ad->clicks }}</p>
                            <p class="font-weight-light">conversion_values: {{ $ad->conversion_values }}</p>
                            <h5 class="card-title">{{ $ad->name }}</h5>
                          </div>
                        </div>
                        </div>
                      </div>
                    @endforeach

                    @if ($ads)
                      {{ $ads->links() }}
                    @endif

                  </div>
                </div>
              </div>
    </div>
</div>
@endsection
