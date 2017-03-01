<div class="row">
    <div class="col-xs-12 col-md-8">
        <div class="row">
            @foreach($championship->teams as $team)
                @component('components.panel')
                @slot('title')
                {{  $team->name }}
                @endslot
                @slot('content')
                <ul class="sortable">
                    <li class="ui-state-default">Item 1</li>
                </ul>
                @endslot

                @endcomponent

            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-md-4 panel panel-body">
        <div class="row">
            <ul>
                @foreach($championship->competitors as $competitor)
                    <li  class="draggable ui-state-highlight">{{ $competitor->user->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

