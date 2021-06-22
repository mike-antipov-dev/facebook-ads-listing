@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <h3>Список Ваших групп</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="/home">Список кампаний</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Список групп</li>
                      </ol>
                    </nav>

                    @if ($adsets)
                      {{ $adsets->links() }}
                    @endif

                    @foreach ($adsets as $adset)
                    <div class="container">
                        <div class="row my-3">
                        <div class="card" style="width: 100%;">
                          <div class="card-body">
                            <p class="font-weight-light">account_id: {{ $adset->account_id }}</p>
                            <p class="font-weight-light">campaign_id: {{ $adset->campaign_id }}</p>
                            <p class="font-weight-light">adset_id: {{ $adset->id }}</p>
                            <p class="font-weight-light">action_values: {{ $adset->action_values }}</p>
                            <p class="font-weight-light">clicks: {{ $adset->clicks }}</p>
                            <p class="font-weight-light">conversion_values: {{ $adset->conversion_values }}</p>
                            <h5 class="card-title">{{ $adset->name }}</h5>
                            <a href="{{ $url }}/{{ $adset->id }}/ads" class="btn btn-primary">Перейти к списку объявлений</a>
                          </div>
                        </div>
                        </div>
                      </div>
                    @endforeach

                    @if ($adsets)
                      {{ $adsets->links() }}
                    @endif

                  </div>
                </div>
              </div>
    </div>
</div>
@endsection
