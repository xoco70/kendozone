<div class="col-md-4" id="team-panel" :panel-id="team.id">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">{{ $title }}<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="close" @click="deleteTeam(team.id)"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body" >
            {{ $content }}
        </div>
    </div>
</div>