@extends('backend.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables/dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables/dataTables.tableTools.css') }}">
    
@stop

@section('content')

<div id="main-content">
    @include('backend.layouts.alert')
            <div class="page-title"> <i class="icon-custom-left"></i>
                <h3 class="pull-left"><strong>Prestamos</strong></h3>
                <a href="javascript:void(0)" id="rent" class="btn btn-success pull-right m-t-10">Nuevo prestamo</a>

                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-blue">
                            <h3 class="panel-title"><strong>Lista</strong> de prestamos</h3>

                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive table-blue filter-right">

                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover table-dynamic no-sort">
                                        <thead>
                                            <tr>   
                                                <th>Estudiante</th>  
                                                <th>Libro</th>                                             
                                                <th>Estado</th>
                                                <th>Prestado</th>
                                                <th>Devolver</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($prestamos as $key => $prestamo)      
                                            <tr>
                                                <td>{{ $prestamo->student->name }}</td>
                                                <td>{{ $prestamo->book->name }}</td>
                                                <td>{{ $prestamo->getStatus() }}</td>
                                                <td>{{ $prestamo->getHumanDate() }}</td>
                                                <td>
                                                    @if($prestamo->status == 'on')
                                                    <a href="/devolver/{{ $prestamo->id }}?p=true" class="btn btn-info">Devolver</a>
                                                    @else
                                                    {{ $prestamo->getHumanDate('updated_at') }}
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach                                           
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

               
            </div>
        </div>


        <div class="modal" id="modal-rent">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="/prestar" method="POST">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel"><strong>Realizar prestamo</strong> </h4>
                        </div>
                        <div class="modal-body ">   

                            <div class="row">
                                <div class="col-md-6" align="center">
                                    <h3>Estudiante:</h3>
                                    <select name="student_id" id="">
                                        <?php $students = Student::all(); ?>
                                        @foreach($students as $student)
                                        <option value="{{$student->id}}">{{$student->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6" align="center">
                                    <h3>Libro:</h3>
                                    <select name="book_id" id="">
                                        <?php $books = Book::availables()->get(); ?>
                                        @foreach ($books as $book)
                                        <option value="{{$book->id}}">{{$book->name}}</option>
                                        @endforeach
                                    </select>
                                </div>                    
                            </div>                



                        </div>        
                        <div class="modal-footer text-center">
                            @if((count($students)>0) && (count($books)>0))
                            <button type="submit" class="btn btn-success">Guardar</button>
                            @else
                            <h5>No hay estudiantes o libros para realizar un prestamo.</h5>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

@stop

@section('javascript')
    <script src="{{ asset('/assets/plugins/bootstrap-switch/bootstrap-switch.js') }}"></script>
    <script src="{{ asset('/assets/plugins/bootstrap-progressbar/bootstrap-progressbar.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables/dynamic/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables/dataTables.tableTools.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables/table.editable.js') }}"></script>
    <script src="{{ asset('/assets/js/table_dynamic.js') }}"></script>


    <script>
$(document).on("ready", function(){
    /* Filtrado */
    $("#modal-rent").modal();
    $("#modal-rent").modal('hide');

    $("#rent").on("click", function(){
        $("#modal-rent").modal();
    });

});
</script>
@stop