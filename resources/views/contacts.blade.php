@extends('layouts.app')
@section('page-title')
    Контакты
@endsection
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>Идентификатор клиента/ФИО</th>
                                    <th>Должность</th>
                                    <th>Телефон</th>
                                    <th>Мобильный телефон</th>
                                    <th>E-mail</th>
                                    <th>Адрес</th>
                                    <th>Организация</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td>{{$contact->fio}}</td>
                                        <td>{{$contact->position}}</td>
                                        <td>{{$contact->work_number}}</td>
                                        <td>{{$contact->mobile_number}}</td>
                                        <td><a href="mailto:name@email.com">{{$contact->email}}</a></td>
                                        <td>{{$contact->address}}</td>
                                        <td>{{$contact->company}}</td>
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

    <!-- Page-Level Scripts -->
    <script>
        window.addEventListener('DOMContentLoaded', function(){
            $(document).ready(function(){
                $('.dataTables-example').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json'
                    },
                    pageLength: 25,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'Contacts'},
                        //{extend: 'pdf', title: 'Contacts'},

                        {extend: 'print',
                            customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                            }
                        }
                    ]
                });
            });
        });
    </script>

@endsection
