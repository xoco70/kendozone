@forelse($championship->fightersGroups as $group)
    @include('layouts.scoresheets.sheet', ['group' => $group])
@empty
    {{ trans('core.still_no_scoresheet') }}
@endforelse