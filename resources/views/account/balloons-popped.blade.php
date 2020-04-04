<div class="widget-head js-expand">
    <h2>
        @lang('Popped Balloons')

        <!-- <i class="ico-chevron-down"></i> -->
    </h2>
</div><!-- /.widget-head -->

<div class="widget-body" style ="display: block;">
    <ul class="list-balloons ballons-popped">
        @foreach ($balloons as $balloon)
            @include('account.balloon-summary', ['balloon' => $balloon])
        @endforeach
    </ul><!-- /.list-balloons -->
</div><!-- /.widget-body -->