<div class="panel panel-flat category-settings">
    <div class="panel-body">
        <div class="container-fluid">
            <div class="panel-group" id="accordion-styled">

                @foreach($tournament->championships as $key => $championship)
                    @include('categories.categorySettings')
                @endforeach
            </div>
        </div>


        @if ($settingSize > 0 && $settingSize == $categorySize)
        @else
            <br/>
            <a href="{{ URL::action('InviteController@create',  $tournament->slug) }}" id="add_competitors"
               type="button"
               class="hide btn btn-success mr-10 pull-right p-20"> @lang('core.invite_competitors') <i
                        class="glyphicon glyphicon-chevron-right"></i> </a>
        @endif

    </div>
    <!-- /simple panel -->
</div>
