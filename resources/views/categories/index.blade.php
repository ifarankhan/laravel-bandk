@extends('layouts.app-admin')

@section('content')
    <ul class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}">{{ getTranslation('dashboard') }}</a></li>
        <li><a href="{{ route('category.index') }}">{{ getTranslation('categories') }}</a></li>
    </ul>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Categories Lists</h2>
                    <a href="{{ route('category.create') }}" class="btn btn-danger pull-right">Opret skade</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div>
                    <div id="tree-container"></div>
                    {{--<table id="datatable1" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Parent</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr id="content_{{ $category->id }}">
                                <td>{{ $category->title }}</td>
                                <td>{{ ($category->parent) ? $category->parent->title :  ''}}</td>
                                <td>
                                    <a href="{{ route('category.edit', ['id'=> $category->id]) }}" class="btn btn-success">Edit</a>
                                    <button data-id="{{ $category->id }}" data-url="{{ route('category.delete', ['id'=> $category->id]) }}" class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>--}}
                </div>
            </div>
        </div>
    </div>

    <div id="delete-model" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Category:</h4>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete the category?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="delete">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="{{ asset('/admin/js/themes/default/style.min.css') }}" />
{{--    <link href="{{ asset('/admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ asset('/admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ asset('/admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ asset('/admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ asset('/admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }} " rel="stylesheet">--}}
@endsection

@section('js')
  {{--  <script src="{{ asset('/admin/vendors/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-buttons/js/buttons.flash.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-buttons/js/buttons.html5.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-buttons/js/buttons.print.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }} "></script>
    <script src="{{ asset('/admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }} "></script>--}}
    {{--<script src="{{ asset('/admin//js/jquery.min.js') }}"></script>--}}
    <script src="{{ asset('/admin//js/jstree.min.js') }}"></script>
    <script src="{{ asset('/admin//js/jstree.state.js') }}"></script>
    <script src="{{ asset('/admin//js/jstree.contextmenu.js') }}"></script>
    <script src="{{ asset('/admin//js/jstree.wholerow.js') }}"></script>
    <script>
        var contextMenu = function customMenu(node) {
            // The default set of all items
            var items = {

                deleteItem: {
                    label: "Delete",
                    action: function (node) { return { deleteItem: this.remove(node) }; },
                    "separator_after": true
                }
            };

            if ($(node).hasClass("folder")) {
                // Delete the "delete" menu item
                delete items.deleteItem;
            }

            return items;
        }

        var getMenu = function (node) {
            console.log(node);
            var tree = $('#tree-container').jstree(true);
            var items = {
                'create': {
                    label: "Create",
                    "action": function (obj) {
                        $node = tree.create_node(node);
                        tree.edit($node);

                    }
                },
                'rename': {
                    label: "Rename",
                    "action": function (obj) {
                        tree.edit(node);
                    }
                },
                "Remove": {
                    "separator_before": false,
                    "separator_after": false,
                    "label": "Remove",
                    action: function (obj) {
                        var modal = $("div#delete-model");
                        modal.modal('show');
                        $("button#delete").click(function () {
                            $.get("{{ route('category.remove') }}", {'id': node.id})
                                .fail(function () {
                                    node.instance.refresh();
                                })
                                .success(function () {
                                    tree.delete_node(node);
                                });
                        });
                    }
                }
            }
            return items;
        };

        $('#tree-container').jstree({
            'core' : {
                'data' : {
                    'url' : "{{ route('category.all') }}",
                    'data' : function (node) {
                        return { 'id' : node.id };
                    },
                    "dataType" : "json"
                },
                'check_callback' : true,
                'themes' : {
                    'responsive' : true
                }
            },
            "contextmenu" : { "items" : getMenu},
            'plugins' : ['state','contextmenu','wholerow'],
        }).on('create_node.jstree', function (e, data) {
            $.get("{{ route('category.create-json') }}", { 'id' : data.node.parent, 'position' : data.position, 'text' : data.node.text })
                .done(function (d) {
                    /*console.log(d);
                    d = jQuery.parseJSON(d);
                    console.log(d);*/
                    data.instance.set_id(data.node, d.id);
                    //data.instance.refresh();
                })
                .fail(function () {
                    data.instance.refresh();
                });
        }).on('rename_node.jstree', function (e, data) {
            $.get("{{ route('category.update') }}", { 'id' : data.node.id, 'text' : data.text })
                .fail(function () {
                    data.instance.refresh();
                });
        });
    </script>

@endsection