<div class="col-lg-8 col-lg-offset-2">
    <div class="panel panel-flat category-settings">
        <div class="panel-body">
            <div class="container-fluid">
                <fieldset title="{{trans_choice('categories.categorySettings',2)}}">
                    <a name="categories">
                        <legend class="text-semibold">{{trans_choice('categories.categorySettings',2)}}</legend>
                    </a>
                </fieldset>


                <div class="row">
                    <div class="col-md-12">

                        <div class="panel-group" id="accordion-styled">


                            @foreach($tournament->championships as $key => $championship)
                                <?php
                                $setting = $tournament->championships->get($key)->settings;
                                ?>

                                <div class="panel ">
                                    <a data-toggle="collapse" data-parent="#accordion-styled"
                                       href="#accordion-styled-group{!! $key !!}">

                                        <div class="panel-heading">
                                            <h6 class="panel-title">
                                                {{trans($championship->category->buildName())}}
                                            </h6>
                                        </div>
                                    </a>
                                    <div id="accordion-styled-group{!! $key !!}"
                                         class="panel-collapse collapse {!! $key==0 ? "in" : "" !!} ">
                                        <div class="panel-body">
                                            @if ($setting !=null)
                                                @include('categories.categorySettingsShow')
                                            @else
                                                {{ trans('categories.category_not_configured') }}
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>


                </div>
            </div>


        </div>
        <!-- /simple panel -->
    </div>
</div>