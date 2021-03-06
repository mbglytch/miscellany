@inject ('datagrid', 'App\Renderers\DatagridRenderer')

{!! $datagrid->render(
    // Columns
    [
        // Avatar
        [
            'type' => 'avatar'
        ],
        // Name
        'name',
        'type',
        [
            'type' => 'location',
            'visible' => $campaign->enabled('locations'),
        ],
        [
            'label' => trans('organisations.fields.members'),
            'visible' => $campaign->enabled('characters'),
            'render' => function($model) {
                return $model->members()->count();
            }
        ],
        [
            'type' => 'is_private',
        ]
    ],
    // Data
    $models,
    // Options
    [
        'route' => 'organisations.index',
        'baseRoute' => 'organisations',
        'trans' => 'organisations.fields.',
        'campaign' => $campaign
    ]
) !!}
