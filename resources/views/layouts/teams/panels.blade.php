<div class="row">


    <div class="col-xs-12 col-md-8">

        <div class="row" >
            <div  :tournament="tournament" v-for="team in tournament.find((elem) => elem.championship == {{ $championship->id }}).teams"
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
                         v-for="(competitor, index) in copyOne"
                         :team-id="team.id"
                         :championship-id= {{ $championship->id }}
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


