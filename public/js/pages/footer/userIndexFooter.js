$(function () {
    var disabled = false;
    var tr = null;

    // Initialize responsive functionality
    $('.table-togglable').footable();
//    $(document).on('click', '.undo', function (e) {
//        e.preventDefault();
//        //e.stopPropagation();
//        var dataRestore      =   $(this).data('restore');
//
//        $.ajax(
//            {
//                type: 'GET',
//                url: url+ '/' + dataRestore + '/restore',
//                data: dataRestore,
//                success: function (data) {
//                    console.log(data);
//                    if (data != null && data.status == 'success') {
//                        tr.show();
//                        $.noty.closeAll()
//
//                    } else {
//                        console.log(data);
//                        noty({
//                            layout: 'topRight',
//                            type: 'error',
//                            width: 200,
//                            dismissQueue: true,
//                            timeout: 3000,
//                            text: data.msg
//                        });
//                        $('.btnDeleteTournament').prop("disabled", false);
//                        $('.btnDeleteTournament').find('i').removeClass('icon-spinner spinner position-left').addClass('glyphicon glyphicon-remove');
//
//                    }
//
//
//                },
//                error: function (data) {
//                    console.log("error");
//                    noty({
//                        layout: 'topRight',
//                        type: 'error',
//                        width: 200,
//                        dismissQueue: true,
//                        timeout: 3000,
//                        text: data.statusText
//                    });
//                }
//            }
//        )
//
//    });
//    $('.btnDeleteTournament').on('click', function (e) {
//        e.preventDefault();
//        var inputData = $('#formDeleteTourament').serialize();
//        var dataId      =   $(this).data('id');
////                console.log(inputData);
//        console.log(dataId);
//        tr = $(this).closest('tr');
//        $(this).find('i').removeClass();
//        $(this).find('i').addClass('icon-spinner spinner');
//
//        $.ajax(
//            {
//                type: 'POST',
//                url: url + '/' + dataId,
//                data: inputData,
//                success: function (data) {
//                    if (data != null && data.status == 'success') {
//                        noty({
//                            layout: 'bottomLeft',
//                            width: 200,
//                            dismissQueue: true,
//                            timeout: 10000,
//                            force: true,
//                            killer: true,
//                            closeWith: ['button'],
//                            text: "<a href='#' class='undo_link'><i class='icon  icon-cross3 noty_close' ></i></a>"+
//                            "<div class='row'><div class='col-xs-8'>" + data.msg + "</div>" +
//                                  "<div class='col-xs-3' align='right'><a class='undo' href='"+ url+ "/" + dataId + "/restore' data-restore='"+dataId+"'><span class='undo_link'>UNDO</span> </a></div>" +
//                            "</div>"
//
//
//
//                    });
//                        $('.icon-spinner').removeClass().addClass('glyphicon glyphicon-remove');
//                        tr.hide();
//                    } else {
//                        console.log(data);
//                        noty({
//                            layout: 'topRight',
//                            type: 'error',
//                            width: 200,
//                            dismissQueue: true,
//                            timeout: 3000,
//                            text: data.msg
//                        });
//                        $('.btnDeleteTournament').prop("disabled", false);
//                        $('.btnDeleteTournament').find('i').removeClass('icon-spinner spinner position-left').addClass('glyphicon glyphicon-remove');
//
//                    }
//
//
//                },
//                error: function (data) {
//                    noty({
//                        layout: 'topRight',
//                        type: 'error',
//                        width: 200,
//                        dismissQueue: true,
//                        timeout: 3000,
//                        text: data.statusText
//                    });
//                    $('.btnDeleteTournament').prop("disabled", false);
//                    $('.btnDeleteTournament').find('i').removeClass('icon-spinner spinner position-left').addClass('glyphicon glyphicon-remove');
//
//                }
//            }
//        )
//
//    });
});



//<tournaments></tournaments>
//
//<template id="tournaments-template">
//    <ul>
//    <li v-for="tournament in list.data">
//    @{{ tournament.id }}
//<a href="{!!   URL::action('TournamentController@edit',  @{ tournament.id }} ) !!}">@{{ tournament.id }}</a>
//</li>
//</ul>
//</template>

//<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.16/vue.min.js"></script>
//        Vue.component('tournaments', {
//            template: '#tournaments-template',
//            props: ['list'],
//
//            created(){
////                this.list = JSON.parse(this.list);
//                $.getJSON('api/v1/tournaments', function (data) {
//                    console.log(data);
//                    this.list = data;
//                }.bind(this))
//            }
//        });
//        new Vue({
//            el: 'body'
//        });

//$('#btnDeleteTournament').on('click', function (e) {
//    var inputData = $('#formDeleteTourament').serialize();
//    var dataId = $('#btnDeleteTournament').attr('data-id');
//    var $tr = $(this).closest('tr');
//    console.log('hola');
//
//
//    return false;
//    });