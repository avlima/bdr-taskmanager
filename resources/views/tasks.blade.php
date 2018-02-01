<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env('APP_NAME')}} (Alberto)</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .close {
            top: 11px !important;
            font-size: 25px;
        }

        .edit {
            float: right !important;
        }

        .edit:hover {
            cursor: pointer;
        }

        .glyphicon.glyphicon-pencil {
            font-size: 13px !important;
            font-weight: 700 !important;
            line-height: 1 !important;
            text-shadow: 0 1px 0 #fff !important;
            top: 6px !important;
            right: 5px;
        }

        .panel-heading h4 {
            color: #0e86c1;
            font-family: sans-serif;
        }

        .panel-body p {
            color: #000;
            font-size: 15px;
            font-family: sans-serif;
        }
    </style>
</head>
<body>
<div class="full-height">
    <div class="content">
        <div class="title m-b-md">
            {{env('APP_NAME')}}
        </div>
    </div>
    <div class="container">
        <section>
            <div class="row">
                <div class="col-md-6">
                    <h2>Tarefas</h2>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                            data-target="#taskModal" data-whatever="@mdo">
                        Adicionar tarefa
                    </button>
                </div>
            </div>
            <div class="row thumbnail-sortable">
            </div>
        </section>
    </div>
</div>
<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="taskModalLabel">Nova tarefa</h4>
            </div>
            <div class="modal-body">
                <form id="taskForm">
                    <input type="hidden" id="id">
                    <input type="hidden" id="order">
                    <div class="form-group">
                        <label for="title" class="control-label">Title:</label>
                        <input type="text" class="form-control" id="title" minlength="2" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Descrição:</label>
                        <textarea class="form-control" id="description" minlength="2" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="add">Gravar</button>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.sortable.js')}}" type="text/javascript"></script>
<script>
    function clearModal() {
        $(".thumbnail-sortable").sortable("refresh");
        $('#taskModal').modal('hide');
        $('#title').val('');
        $('#description').val('');
        $('#order').val('');
        $('#id').val('');
    }

    function appendItems(item) {
        $('.thumbnail-sortable').append(
            '<div class="col-sm-6 col-md-4" id="' + item.id + '" data-order="' + item.order + '">' +
            ' <div class="panel panel-info">' +
            '  <div class="panel-heading">' +
            '   <button type="button" class="close delete">' +
            '    <span aria-hidden="true">&times;</span>' +
            '   </button>' +
            '   <a type="button" class="edit">' +
            '    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>' +
            '   </a>' +
            '   <h4 id="title_' + item.id + '">' + item.title + '</h4>' +
            '  </div>' +
            '  <div class="panel-body">' +
            '   <p id="description_' + item.id + '">' + item.description + '</p>' +
            '  </div>' +
            ' </div>' +
            '</div>'
        );
    }

    function loadItems() {
        $('.thumbnail-sortable').html('');

        $('.thumbnail-sortable').sortable({
            serialize: $.ajax({
                url: '{{ url('/task') }}',
                type: 'GET',
                async: true,
                success: function (data) {
                    $.each(data, function (index, item) {
                        appendItems(item);
                    });
                },
                complete: function () {
                    $(".thumbnail-sortable").sortable({
                        items: "div",
                        placeholderClass: 'col-sm-6 col-md-4'
                    });
                }
            }),
            connectWith: '.thumbnail-sortable'
        }).on('sortupdate', function () {

            var data = {};
            $.each($(".thumbnail-sortable>div"), function (index, items) {
                data[index] = {
                    id: $(items).attr('id'),
                    order: index
                };
            });

            $.ajax({
                url: '{{ url('/task/update-order') }}',
                type: 'PUT',
                async: true,
                data: data,
                success: function (data) {
                }

            });
        });
    }

    $(function () {
        loadItems();

        $('#add').click(function () {
            $('#taskModalLabel').text('Nova tarefa');

            var title = $('#title').val();
            var description = $('#description').val();
            var order = $('#order').val();

            if (title === '' || description === '') {
                alert('Preencha todos os campos!');
                return false;
            }

            var id = $('#id').val();

            if (id === '') {
                $.ajax({
                    url: '{{ url('/task') }}',
                    type: 'POST',
                    data: {
                        title: title,
                        description: description
                    },
                    success: function (item) {
                        clearModal();
                        loadItems();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        var error = '';
                        $.each(jqXHR.responseJSON, function (index, msg) {
                            error += msg + '\n';
                        });
                        alert(error);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ url('/task') }}/' + id,
                    type: 'PUT',
                    data: {
                        title: title,
                        description: description,
                        order: order
                    },
                    success: function (item) {
                        $('#title_' + id).text(item.title);
                        $('#description_' + id).text(item.description);
                        $('#' + id).data('order', item.order);
                    },
                    complete: function () {
                        clearModal();
                        loadItems();
                    }
                });
            }

        });

    }).on('click', '.delete', function () {
        var id = $(this).closest('.col-sm-6.col-md-4').attr('id');
        $.ajax({
            url: '{{ url('/task') }}/' + id,
            type: 'DELETE',
            success: function () {
                $(".thumbnail-sortable").sortable("refresh");
            },
            complete: function () {
                $('#' + id).remove();
                loadItems();
            }
        });
    }).on('click', '.edit', function () {
        var id = $(this).closest('.col-sm-6.col-md-4').attr('id');
        var order = $(this).closest('.col-sm-6.col-md-4').data('order');
        var title = $('#title_' + id).text();
        var description = $('#description_' + id).text();

        $('#title').val(title);
        $('#description').val(description);
        $('#id').val(id);
        $('#order').val(order);

        $('#taskModalLabel').text('Alterar tarefa');
        $('#taskModal').modal('show');

    });
</script>
</body>
</html>
