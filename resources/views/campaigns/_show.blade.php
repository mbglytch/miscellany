<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box">
            <div class="box-body box-profile">
                @if ($campaign->image)
                <a href="/storage/{{ $campaign->image }}" title="{{ $campaign->name }}" target="_blank">
                    <img class="profile-user-img img-responsive img-circle" src="/storage/{{ $campaign->image }}" alt="{{ $campaign->name }} picture">
                </a>
                @endif

                <h3 class="profile-username text-center">{{ $campaign->name }}</h3>

                @if (Auth::user()->can('update', $campaign))
                <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-primary btn-block">
                    <i class="fa fa-pencil" aria-hidden="true"></i> {{ trans('crud.update') }}
                </a>
                @endif
                @if (Auth::user()->can('leave', $campaign))
                <button data-url="{{ route('campaigns.leave', $campaign->id) }}" class="btn btn-warning btn-block click-confirm" data-toggle="modal" data-target="#click-confirm" data-message="{{ trans('campaigns.leave.confirm', ['name' => $campaign->name]) }}">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> {{ trans('campaigns.show.actions.leave') }}
                </button>
                @endif

                @if (Auth::user()->can('delete', $campaign))
                <button class="btn btn-block btn-danger delete-confirm" data-name="{{ $campaign->name }}" data-toggle="modal" data-target="#delete-confirm">
                    <i class="fa fa-trash" aria-hidden="true"></i> {{ trans('crud.remove') }}
                </button>
                {!! Form::open(['method' => 'DELETE','route' => ['campaigns.destroy', $campaign->id], 'style'=>'display:inline', 'id' => 'delete-confirm-form']) !!}
                {!! Form::close() !!}
                {!! Form::close() !!}
                @endif
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->


        @if (!empty($campaigns))
            @foreach ($campaigns as $c)
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h4>{!! $c->shortName(50) !!}</h4>

                        </div>
                        <div class="icon">
                            <i class="ion ion-map"></i>
                        </div>
                        <a href="{{ route('campaigns.index', ['campaign_id' => $c->id]) }}" class="small-box-footer">
                            <i class="fa fa-arrow-circle-right"></i> {{ trans('crud.select') }}
                        </a>
                    </div>
            @endforeach
        @endif

    <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h4>{{ trans('campaigns.index.actions.new.title') }}</h4>
            </div>
            <div class="icon">
                <i class="ion ion-plus"></i>
            </div>
            <a href="{{ route('campaigns.create') }}" class="small-box-footer">
                <i class="fa fa-plus-circle"></i> {{ trans('campaigns.index.actions.new.description') }}
            </a>
        </div>

    </div>

    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="{{ (request()->get('tab') == null ? ' active' : '') }}">
                    <a href="#info">
                        {{ trans('campaigns.show.tabs.information') }}
                    </a>
                </li>
                <li class="{{ (request()->get('tab') == 'member' ? ' active' : '') }}">
                    <a href="#member">
                        {{ trans('campaigns.show.tabs.members') }}
                    </a>
                </li>
                @can('update', $campaign)
                <li class="{{ (request()->get('tab') == 'roles' ? ' active' : '') }}">
                    <a href="#roles">
                        {{ trans('campaigns.show.tabs.roles') }}
                    </a>
                </li>
                @endcan
                @if (Auth::user()->can('setting', $campaign))
                <li class="{{ (request()->get('tab') == 'setting' ? ' active' : '') }}">
                    <a href="#setting">
                        {{ trans('campaigns.show.tabs.settings') }}
                    </a>
                </li>
                @endif
            </ul>

            <div class="tab-content">
                <div class="tab-pane {{ (request()->get('tab') == null ? ' active' : '') }}" id="info">
                    <div class="post">
                        <p>{!! $campaign->description !!}</p>
                    </div>
                </div>
                <div class="tab-pane {{ (request()->get('tab') == 'member' ? ' active' : '') }}" id="member">
                    @include('campaigns._members')
                </div>
                @can('update', $campaign)
                <div class="tab-pane {{ (request()->get('tab') == 'roles' ? ' active' : '') }}" id="roles">
                    @include('campaigns._roles')
                </div>
                @endcan
                @if (Auth::user()->can('setting', $campaign))
                <div class="tab-pane {{ (request()->get('tab') == 'setting' ? ' active' : '') }}" id="setting">
                    @include('campaigns._settings')
                </div>
                @endif
            </div>
        </div>

        <!-- actions -->
    </div>
</div>