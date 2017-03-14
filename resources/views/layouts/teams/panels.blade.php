
<div class="row">


    <div class="col-xs-12 col-md-8">

        <div class="row">
            <div v-for="team in teams" v-cloak>
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
                         v-for="(competitor, index) in copyOne"
                         :team-id="team.id"
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
    <input type="hidden" id="activeTab" name="activeTab" value="general"/>


    <div class="col-xs-12 col-md-4 panel panel-body">
        <h2 align="center">{{ trans_choice('core.competitor',2) }}</h2>
        <div class="row">

            <div class="wrapper-dragula">
                <div class="container-dragula" v-dragula="competitorsArea" bag="third-bag">
                    <div  v-cloak
                          v-for="(competitor, index) in competitorsArea"
                          :id="competitor.id"
                          :index="index"
                          :key="competitor.id"
                        >@{{competitor.name}}</div>
                </div>
            </div>
        </div>
    </div>
</div>


