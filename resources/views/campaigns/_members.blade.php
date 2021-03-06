
<table id="campaigns" class="table table-hover">
    <tbody><tr>
        <th>{{ trans('campaigns.members.fields.name') }}</th>
        <th>{{ trans('campaigns.members.fields.joined') }}</th>
        <th>&nbsp;</th>
    </tr>
    @foreach ($r = $campaign->members()->with('user')->paginate() as $relation)
        <tr>
            <td>{{ $relation->user->name }}</td>
            <td>{{ $relation->created_at }}</td>

            <td class="text-right">
                @if (Auth::user()->can('delete', $relation))
                {!! Form::open(['method' => 'DELETE','route' => ['campaign_user.destroy', $relation->id],'style'=>'display:inline']) !!}
                    <button class="btn btn-xs btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i> {{ trans('crud.remove') }}
                    </button>
                {!! Form::close() !!}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody></table>

{{ $r->appends('tab', 'member')->links() }}

@if (Auth::user()->can('invite', $campaign))
    <hr />
    <h3>{{ trans('campaigns.members.invite.title') }}</h3>
    <p>
        {{ trans('campaigns.members.invite.description') }}
    </p>
    <p class="text-right">
        <a href="{{ route('campaigns.campaign_invites.create', ['campaign' => $campaign->id]) }}" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i>
            {{ trans('campaigns.invites.actions.add') }}
        </a>
    </p>

    <table id="invites" class="table table-hover">
        <tbody><tr>
            <th>{{ trans('campaigns.invites.fields.email') }}</th>
            <th>{{ trans('campaigns.invites.fields.created') }}</th>
            <th>&nbsp;</th>
        </tr>
        @foreach ($r = $campaign->unusedInvites()->paginate() as $relation)
            <tr>
                <td>{{ $relation->email }}</td>
                <td>{{ $relation->elapsed('created_at') }}</td>

                <td class="text-right">
                    {!! Form::open(['method' => 'DELETE','route' => ['campaigns.campaign_invites.destroy', $campaign->id, $relation->id],'style'=>'display:inline']) !!}
                    <button class="btn btn-xs btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i> {{ trans('crud.remove') }}
                    </button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody></table>

    {{ $r->appends('tab', 'member')->links() }}
@endif
