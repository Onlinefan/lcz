@extends('layouts.app')
@section('page-title')
    Реестр договоров
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
                                    <th colspan="7" style="text-align: center;">Реестр доходных договоров</th>
                                    <th colspan="9" style="text-align: center;">Договор</th>
                                    <th colspan="5" style="text-align: center;">Статус выставленных документов</th>
                                    <th colspan="5" style="text-align: center;">Статус обслуживания</th>
                                    <th colspan="5" style="text-align: center;">Финансовый статус</th>
                                </tr>
                                <tr>
                                    <th>№</th>
                                    <th>Код проекта</th>
                                    <th>Федеральный округ</th>
                                    <th>Менеджер проекта</th>
                                    <th>Регион</th>
                                    <th>Проект</th>
                                    <th>Контрагент</th>

                                    <th>Тип договора</th>
                                    <th>Статья договора</th>
                                    <th>№ договора</th>
                                    <th>Дата договора</th>
                                    <th>Дата окончания договора</th>
                                    <th>Статус подписания</th>
                                    <th>Статус оригинала</th>
                                    <th>Наличие оригинала</th>
                                    <th>Обслуживание</th>

                                    <th>Платежный документ</th>
                                    <th>№ платежного документа</th>
                                    <th>Дата платежного документа</th>
                                    <th>Сумма платежного документа</th>
                                    <th>Скан платежного документа</th>

                                    <th>Платежный документ</th>
                                    <th>№ платежного документа</th>
                                    <th>Дата платежного документа</th>
                                    <th>Сумма платежного документа</th>
                                    <th>Скан платежного документа</th>

                                    <th>Сумма по договору</th>
                                    <th>Объём выполненных обязательств ВСЕГО, руб.</th>
                                    <th>Объём оплаченных  работ ВСЕГО, руб.</th>
                                    <th>Сумма будущих поступлений по договору, руб.</th>
                                    <th>Затраты по проекту</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>ABCD</td>
                                    <td><span class="label label-secondary">СЗФО</span></td>
                                    <td>Иванов И.</td>
                                    <td>Северо-Запад</td>
                                    <td>Текст</td>
                                    <td>ООО "Рога и Копыта"</td>

                                    <td><span class="label label-secondary">Электронный</span></td>
                                    <td>123</td>
                                    <td>12345</td>
                                    <td>12.12.2018</td>
                                    <td>16.12.2018</td>
                                    <td>Подписан</td>
                                    <td><span class="label label-secondary">Оригинален</span></td>
                                    <td>Есть</td>
                                    <td>Есть</td>

                                    <td>1234</td>
                                    <td>12345</td>
                                    <td>12.12.2018</td>
                                    <td>100500.00</td>
                                    <td><a href="#">Скан 1</a></td>

                                    <td>2345</td>
                                    <td>23456</td>
                                    <td>16.12.2018</td>
                                    <td>100600.00</td>
                                    <td><a href="#">Скан 2</a></td>

                                    <td>2560.00</td>
                                    <td>12560.00</td>
                                    <td>1678.00</td>
                                    <td>5673.00</td>
                                    <td>234789.00</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>BCDE</td>
                                    <td><span class="label label-secondary">ЦФО</span></td>
                                    <td>Петров П.</td>
                                    <td>Центральный</td>
                                    <td>Текст</td>
                                    <td>ООО "Рога и Копыта"</td>

                                    <td><span class="label label-secondary">Бумажный</span></td>
                                    <td>456</td>
                                    <td>456789</td>
                                    <td>08.01.2019</td>
                                    <td>01.09.2019</td>
                                    <td>Не подписан</td>
                                    <td><span class="label label-secondary">Не оригинален</span></td>
                                    <td>Нет</td>
                                    <td>Нет</td>

                                    <td>4567</td>
                                    <td>23451</td>
                                    <td>01.01.2019</td>
                                    <td>7675.00</td>
                                    <td><a href="#">Скан 3</a></td>

                                    <td>6536</td>
                                    <td>58798</td>
                                    <td>01.07.2019</td>
                                    <td>8765.00</td>
                                    <td><a href="#">Скан 4</a></td>

                                    <td>58787.00</td>
                                    <td>76576.00</td>
                                    <td>3554.00</td>
                                    <td>5464.00</td>
                                    <td>656898.00</td>
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
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                    pageLength: 25,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'Contracts'},
                        //{extend: 'pdf', title: 'Contracts'},

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
