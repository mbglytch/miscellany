<div class="col-md-4 dashboard-box">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('dashboard.recent.title', ['name' => $title]) }}</h3>

            @if ($createAcl)
            <div class="box-tools pull-right">
                <a href="{{ route($route . '.create') }}" class="btn btn-primary btn-xs" title="{{ trans('dashboard.recent.add', ['name' => $title]) }}"><i class="fa fa-plus"></i></a>
            </div>
            @endif
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <ul class="products-list product-list-in-box">
                @foreach ($models as $model)
                    <li class="item entity">
                        <div class="product-img">
                            <a style="background-image: url('{{ $model->getImageUrl(true) }}');" title="{{ $model->name }}" class="entity-image" href="{{ route($route . '.show', $model->id) }}"></a>
                        </div>
                        <div class="product-info">
                            <a href="{{ route($route . '.show', $model->id) }}" class="product-title">{{ $model->name }}</a>
                            @if ($model->family)
                                <a href="{{ route('families.show', $model->family_id) }}">{{ $model->family->name }}</a>
                            @endif
                            <span class="pull-right product-description">{{ $model->elapsed() }}</span>
                            <p class="text-justify entity-short">
                                {{ $model->shortHistory() }}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
            @if (count($models) == 0)
                <p><i>{{ trans('dashboard.recent.no_entries') }}</i></p>
            @endif
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">
            <a href="{{ route($route . '.index') }}" class="uppercase">{{ trans('dashboard.recent.view', ['name' => $title]) }}</a>
        </div>
        <!-- /.box-footer -->
    </div>
</div>