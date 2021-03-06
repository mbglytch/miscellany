@can('member', $model)
<p class="text-right">
    <a href="{{ route('organisations.organisation_members.create', ['organisation' => $model->id]) }}" class="btn btn-primary">
        {{ trans('organisations.members.actions.add') }}
    </a>
</p>
@endcan

<table id="characters" class="table table-hover">
    <tbody><tr>
        <th class="avatar"><br></th>
        <th>{{ trans('characters.fields.name') }}</th>
        @if ($campaign->enabled('locations'))
        <th>{{ trans('characters.fields.location') }}</th>
        @endif
        <th>{{ trans('organisations.members.fields.role') }}</th>
        <th>{{ trans('characters.fields.age') }}</th>
        <th>{{ trans('characters.fields.race') }}</th>
        <th>{{ trans('characters.fields.sex') }}</th>
        <th><br /></th>
    </tr>
    <?php $r = $model->members()->acl(auth()->user())->has('character')->with('character', 'character.location')->paginate();?>
    @foreach ($r->sortBy('character.name') as $relation)
        <tr>
            <td>
                <img class="direct-chat-img" src="{{ $relation->character->getImageUrl(true) }}" alt="{{ $relation->character->name }} picture">
            </td>
            <td>
                <a href="{{ route('characters.show', $relation->character->id) }}">{{ $relation->character->name }}</a>
            </td>
            @if ($campaign->enabled('locations'))
            <td>
                @if ($relation->character->location)
                    <a href="{{ route('locations.show', $relation->character->location_id) }}">{{ $relation->character->location->name }}</a>
                @endif
            </td>
            @endif
            <td>{{ $relation->role }}</td>
            <td>{{ $relation->character->age }}</td>
            <td>{{ $relation->character->race }}</td>
            <td>{{ $relation->character->sex }}</td>
            <td class="text-right">
                @can('member', $model)
                    <a href="{{ route('organisations.organisation_members.edit', ['organisation' => $model, 'organisationMember' => $relation]) }}" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil"></i> {{ trans('crud.edit') }}
                    </a>
                    {!! Form::open(['method' => 'DELETE','route' => ['organisations.organisation_members.destroy', $model->id, $relation->id], 'style'=>'display:inline']) !!}
                    <button class="btn btn-xs btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i> {{ trans('crud.remove') }}
                    </button>
                    {!! Form::close() !!}
                @endcan
            </td>
        </tr>
    @endforeach
    </tbody></table>

{{ $r->appends('tab', 'member')->links() }}
