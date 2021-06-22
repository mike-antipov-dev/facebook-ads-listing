@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <h3>Список Ваших кампаний</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="/update_id">
                        @csrf

                        <div class="form-group row no-gutters">
                            <div class="col-10">
                                <input id="fbid" type="number" class="form-control @error('name') is-invalid @enderror" name="fbid" placeholder="Ваш ID: {{ $fbid }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-2 text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Обновить') }}
                                </button>
                            </div>
                        </div>
                      </form>
                    
                    @if ($campaigns)
                      {{ $campaigns->links() }}
                    @endif

                    @foreach ($campaigns as $campaign)
                    <div class="container">
                        <div class="row mb-3">
                        <div class="card" style="width: 100%;">
                          <div class="card-body">
                            <p class="font-weight-light">account_id: {{ $campaign->account_id }}</p>
                            <p class="font-weight-light">campaign_id: {{ $campaign->id }}</p>
                            <p class="font-weight-light">action_values: {{ $campaign->action_values }}</p>
                            <p class="font-weight-light">buying_type: {{ $campaign->buying_type }}</p>
                            <p class="font-weight-light">clicks: {{ $campaign->clicks }}</p>
                            <p class="font-weight-light">conversion_values: {{ $campaign->conversion_values }}</p>
                            <h5 class="card-title">{{ $campaign->name }}</h5>
                            <a href="home/{{ $campaign->id }}/adsets" class="btn btn-primary">Перейти к группам кампании</a>
                          </div>
                        </div>
                        </div>
                      </div>
                    @endforeach

                    @if ($campaigns)
                      {{ $campaigns->links() }}
                    @endif

                    <a href="/redirect" class="btn btn-outline-secondary btn-lg">Обновить список кампаний</a>
                  </div>
                </div>
              </div>
    </div>
</div>
@endsection
