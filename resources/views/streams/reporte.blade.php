@extends('app')

@section('htmlheader_title')
    Reporte de Streams IPTV
@endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@php
    use Jenssegers\Date\Date;
    Date::setLocale('es');
@endphp

@section('main-content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Canales con problemas</h3>
        </div>

        <div class="box-body">
            <table id="tabla_data" class="table table-bordered table-striped ">
                <thead>
                <tr>
                    <th>ID#</th>
                    <th>Stream ID</th>
                    <th>Logo</th>
                    <th>Nombre Canal</th>
                    <th>Caidas por día</th>
                </tr>
                </thead>
                <tbody>
                @foreach($registros as $row)
                    @php
                        //$fecha = Date::createFromFormat('Y-m-d H:i:s', $row->fecha);
                        $servidores = $row->Servidores;
                        $contador = 0;
                        foreach($servidores as $item) {
                            $contador++;
                        }
                    @endphp
                    <tr data-toggle="modal" data-target="#modal-{{ $row->id }}">
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->stream_id }}</td>
                        <td>@if ($row->Stream->stream_icon) <img src="{{ $row->Stream->stream_icon }}" class="imagen"/> @endif </td>
                        <td>{{ str_replace('[0]', '', $row->Stream->stream_display_name) }}</td>
                        <td>{{ $contador }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @foreach ($registros as $item)
        <div class="modal fade" id="modal-{{ $item->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">
                            Reporte de Servidores
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <table id="tabla_data" class="table table-bordered table-striped ">
                                <thead>
                                <tr>
                                    <th>Stream Sys ID</th>
                                    <th>Caido</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($item->Servidores as $row)
                                    @php
                                        $fecha = Date::createFromFormat('Y-m-d H:i:s', $row->fecha);
                                    @endphp
                                    <tr>
                                        <td>{{ $row->streams_sys_id }}</td>
                                        <td>{{ $fecha->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    @endforeach
@endsection


<!-- Script for this page -->
@section('javascripts')
    <!-- DataTables -->
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
   $(function () {

      $.fn.dataTableExt.sErrMode = 'none';

      $('#tabla_data thead th').each( function () {
         var title = $('#tabla_data tfoot th').eq( $(this).index() ).text();
      } );

      var table = $('#tabla_data').DataTable({
         "bProcessing": false,
         "paging": true,
         "info": true,
         "autoWidth": false,
         "order": [[ 0, "desc" ]],
         "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
               "sFirst":    "Primero",
               "sLast":     "Último",
               "sNext":     "Siguiente",
               "sPrevious": "Anterior"
            },
            "oAria": {
               "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
               "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
         }
      });
   });
   //------------------------------------------------------------
   $("#clientes").addClass('active');
   $("#view_clientes").addClass('active');
   //------------------------------------------------------------
   $('#confirm-delete').on('show.bs.modal', function(e) {
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
   });
   </script>
@endsection