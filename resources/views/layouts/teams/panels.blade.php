<div class="row">


    <div class="col-xs-12 col-md-8">

        <div class="row">
            <div :tournament="tournament"
                 v-for="team in tournament.find((elem) => elem.championship == {{ $championship->id }}).teams"
                 v-cloak
                 :championship-id= {{ $championship->id }} >

                @component('components.panel')
                @slot('title')
                @{{team.name}}

                @endslot
                @slot('content')
                <div class="container-dragula"
                     :team-id="team.id"
                     v-dragula="copyOne"
                     bag="third-bag">
                    <div v-cloak
                         v-for="(competitor, index) in tournament.find((elem) => elem.championship == {{ $championship->id }}).teams.competitors"
                         :team-id="team.id"
                         :championship-id={{ $championship->id }}
                                 :id="competitor.id"
                         :index="index"
                         :key="competitor.id"

                    >@{{competitor.name}}</div>
                </div>
                @endslot

                @endcomponent
            </div>
        </div>
    </div>



    <div class="col-xs-12 col-md-4 panel panel-body">
        <div class="row">
            <div class="col-lg-12">

                {!! Form::open(['url'=>URL::action('TeamController@store', ['championship' => $championship->id] ), 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    <h2 align="center">{{ trans('core.addModel', ['currentModelName' => trans_choice ('core.team',1)]) }}</h2>

                    <div class="form-inline" align="center">
                        {!! Form::text('name','', ['class' => 'form-control', 'placeholder' => trans('core.team_name')]) !!}
                        <button type="submit" class="btn btn-success" id="save">{{trans("core.add")}}</button>
                        {!! Form::hidden('championship_id', $championship->id) !!}
                        <input type="hidden" id="activeTab" name="activeTab" value="{{ $championship->id }}"/>
                    </div>
                </div>


                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-4 panel panel-body">
        <h2 align="center">{{ trans_choice('core.competitor',2) }}</h2>
        <div class="row">

            <div class="wrapper-dragula">
                <div class="container-dragula" v-dragula="competitorsArea" bag="third-bag">
                    <div v-cloak
                         v-for="(competitor, index) in tournament.find((elem) => elem.championship == {{ $championship->id }}).competitors"
                         :id="competitor.id"
                         :index="index"
                         :key="competitor.id"
                    >@{{competitor.name}}</div>
                </div>
            </div>
        </div>
    </div>
</div>


