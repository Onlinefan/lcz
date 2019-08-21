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
                                <tr>
                                    <td>Червяков Андрей</td>
                                    <td>Ген. директор</td>
                                    <td>+7(999)123-45-67</td>
                                    <td>+7(999)123-45-67</td>
                                    <td><a href="mailto:name@email.com">name@email.com</a></td>
                                    <td>г. Москва, пр. Энергетиков, д. 123, оф. 456</td>
                                    <td>ООО "Увядшая лилия"</td>
                                </tr>
                                <tr>
                                    <td>Андреев Игорь</td>
                                    <td>Менеджер по продажам</td>
                                    <td>+7(999)123-45-67</td>
                                    <td>+7(999)123-45-67</td>
                                    <td><a href="mailto:noname@noemail.com">noname@noemail.com</a></td>
                                    <td>г. Сургут, ул. Ленина, д. 123, оф. 456</td>
                                    <td>ООО "СургутПромСтрой"</td>
                                </tr>
                                <tr>
                                    <td>Пронин Илья</td>
                                    <td>Начальник отдела продаж</td>
                                    <td>+7(999)123-45-67</td>
                                    <td>+7(999)123-45-67</td>
                                    <td><a href="mailto:default@email.com">default@email.com</a></td>
                                    <td>г. Урюпинск, пр. Стахановцев, д. 123, оф. 456</td>
                                    <td>ООО "Аленький цветочек"</td>
                                </tr>
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
