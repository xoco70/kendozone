<div class="modal-body" id="modal">
    <create-category
            :team="{{ json_encode( trans_choice('core.team',1))}}"
            :gender="{{ json_encode( trans('categories.gender'))}}"
            :single="{{ json_encode( trans('categories.single'))}}"

            :age="{{ json_encode( trans('categories.age'))}}"
            :no_age="{{ json_encode( trans('categories.no_age_restriction'))}}"
            :age_min="{{ json_encode( trans('categories.age_min'))}}"
            :age_max="{{ json_encode( trans('categories.age_max'))}}"
            :age_category="{{ json_encode( trans('categories.age_category'))}}"

            :grade="{{ json_encode( trans('core.grade'))}}"
            :no_grade="{{ json_encode( trans('categories.no_grade_restriction'))}}"
            :grade_min="{{ json_encode( trans('categories.grade_min'))}}"
            :grade_max="{{ json_encode( trans('categories.grade_max'))}}"

            :childs="{{ json_encode( trans('categories.children'))}}"
            :students="{{ json_encode( trans('categories.students'))}}"
            :adults="{{ json_encode( trans('categories.adults'))}}"
            :masters="{{ json_encode( trans('categories.masters'))}}"
            :custom="{{ json_encode( trans('categories.custom'))}}"

            :male="{{ json_encode( trans('categories.male'))}}"
            :female="{{ json_encode( trans('categories.female'))}}"
            :mixt="{{ json_encode( trans('categories.mixt'))}}"

            :years="{{ json_encode( trans('categories.years'))}}"
            :add_and_close="{{ json_encode( trans('categories.add_and_close'))}}"



    ></create-category>
</div>