<tr>
    <td nowrap="">
        <img src="{{ asset('/images/flags/'.substr($code,0,2).'.png') }}" width="25"
             style="padding: 0; margin-top: 0; margin-bottom: 0; margin-right: 3px;">
        <small>
            <label>{{ $language }}</label>
        </small>
    </td>
    <td width="100%">
        <div style="overflow: hidden;">
            <div style="float: left; margin-right: 10px;">
                {{ $percent }}%
            </div>
            <div class="progress hidden-md"
                 style="margin-bottom: 8px; margin-top: 6px; height: 6px;">
                <div class="progress-bar progress-bar-primary" role="progressbar"
                     aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"
                     style="width: {{ $percent }}%">
                </div>
            </div>
        </div>
    </td>
</tr>