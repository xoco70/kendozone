<div class="form-group">
    {!!  Form::label('tournamentId', trans('crud.tournaments')) !!}
    {!!  Form::select('tournamentId', $tournaments,null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
{!!  Form::label('categoryId', trans('crud.categories')) !!}
{!!  Form::select('categoryId', $categories,null, ['class' => 'form-control']) !!} <!-- 484 is Mexico Code -->
</div>
<div class="form-group">
    {!!  Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
</div>