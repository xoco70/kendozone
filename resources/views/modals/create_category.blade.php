<div id="create_category" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">{{ trans('core.add_custom_category') }}</h6>
            </div>

            <div class="modal-body">
                @include("categories.form")
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary" v-on:click="addCategory"
                >{{ trans('categories.add_and_close') }}</button>

            </div>
        </div>
    </div>
</div>