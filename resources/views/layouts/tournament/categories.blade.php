{!! Form::model($tournament, ['method'=>"PATCH", 'id'=>'form', "action" => ["TournamentController@update", $tournament->slug]]) !!}
<!-- Categorias Panel -->
<div class="panel panel-flat">
    <div class="panel-body">
        <div class="container-fluid">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="coutent-group">{{trans('core.select_tournament_categories')}}</p>
                    {!!  Form::select('category[]', $categories,$tournament->getCategoryIdArray(), ['class' => 'form-control listbox-filter-disabled', "multiple"]) !!} <!-- Default 1st Dan-->
                    </div>
                </div>
                <div class="row text-uppercase">
                    <div class="col-md-6">
                                    <span class="text-danger" v-cloak>
                                        @{{ error }}
                                    </span>
                    </div>
                    <div class="col-md-6 add_category">
                        <a href="#" data-toggle="modal" data-target="#create_category"
                           class="text-semibold text-black" v-on:click="resetModalValues()">
                        + {{ trans('core.add_custom_category') }}</a>
                    </div>
                </div>
                <div align="right">
                    <button type="submit" class="btn btn-success">
                        <i></i>{{trans("core.save")}}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /simple panel -->
</div>
<input type="hidden" id="activeTab" name="activeTab" value="categories" />
{!! Form::close()!!}