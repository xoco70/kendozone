<div class="panel panel-body">
    <fieldset title="{{ trans('core.numbers') }}">
        <legend class="text-semibold">{{ trans('core.numbers') }}</legend>
    </fieldset>
    <div class="row">
        <div class="col-lg-6 col-md-6">

            <div class="square bg-nav">{{ $tournamentsCreated->count() }}
                <div class="text-size-large text-uppercase">{{ trans('core.created') }}</div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="square bg-secondary">{{ $tournamentsParticipated->count()  }}
                <div class="text-size-large text-uppercase">{{ trans('core.participations') }}</div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="square bg-primary">{{ $tournamentsParticipated->where('dateFin','<', new \DateTime('today'))->count() }}
                <div class="text-size-large text-uppercase">{{ trans('core.past') }}</div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="square bg-success">{{ $tournamentsParticipated->where('dateFin','>=', new \DateTime('today'))->count() }}
                <div class="text-size-large text-uppercase">{{ trans('core.next') }}</div>
            </div>
        </div>

    </div>

</div>