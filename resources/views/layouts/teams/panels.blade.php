<div class="row">
    <div class="col-xs-12 col-md-8">
        <div class="row">
            @foreach($championship->teams as $team)
                @component('components.panel')
                @slot('title')
                {{  $team->name }}
                @endslot
                @slot('content')
                <div class="container-dragula" v-dragula="copyOne" bag="third-bag" >
                    <div v-for="text in copyOne" track-by="$index" v-cloak>@{{text}}</div>
                </div>
                @endslot

                @endcomponent

            @endforeach
        </div>
    </div>

    <div class="col-xs-12 col-md-4 panel panel-body">
        <h2 align="center">{{ trans_choice('core.competitor',2) }}</h2>
        <div class="row">

            <div class="wrapper-dragula">
                <div class="container-dragula" v-dragula="copyTwo" bag="third-bag">
                    <div v-for="text in copyTwo" track-by="$index" v-cloak>@{{text}}</div>
                </div>
            </div>
        </div>
    </div>
</div>

