@extends('inspinia::layouts.main')

@if (auth()->check())
    @section('user-avatar', 'https://www.gravatar.com/avatar/' . md5(auth()->user()->email) . '?d=mm')
    @section('user-name', auth()->user()->second_name . ' ' . auth()->user()->first_name . ' ' . auth()->user()->patronymic)
@endif

@section('breadcrumbs')
    @include('inspinia::layouts.main-panel.breadcrumbs', [
        'breadcrumbs' => []
    ])
@endsection

@section('sidebar-menu')

    <ul class="nav metismenu" id="side-menu" style="padding-left:0px;">
        @if (auth()->user()->role !== 'Оператор')
            @foreach ([
                [
                    'route'=> 'home',
                    'icon'=> 'home',
                    'name'=> 'Главная',
                ],
                [
                    'route'=> 'projects',
                    'icon'=> 'tasks',
                    'name'=> 'Проекты',
                ],
                [
                    'route'=> 'accounts',
                    'icon'=> 'users',
                    'name'=> 'Аккаунты',
                ],
                [
                    'route'=> 'summary',
                    'icon'=> 'calculator',
                    'name'=> 'Сводная по проектам',
                ],
                [
                    'route'=> 'statuses',
                    'icon'=> 'newspaper-o',
                    'name'=> 'Проекты на РП',
                ],
                [
                    'route'=> 'contracts',
                    'icon'=> 'handshake-o',
                    'name'=> 'Реестр договоров',
                ],
                [
                    'route'=> 'contacts',
                    'icon'=> 'fax',
                    'name'=> 'Контакты',
                ],
                [
                    'route'=> 'production_plan',
                    'icon'=> 'industry',
                    'name'=> 'План производства',
                ],
                [
                    'route'=> 'openings',
                    'icon'=> 'address-card-o',
                    'name'=> 'Реестр ЛОП',
                ],
                [
                    'route'=> 'create-project',
                    'icon'=> 'tasks',
                    'name'=> 'Создание проекта',
                ],
                [
                    'route'=> 'funds',
                    'icon'=> 'bank',
                    'name'=> 'ДДС по контракту',
                ],
                [
                    'route'=> 'letters',
                    'icon'=> 'envelope-o',
                    'name'=> 'Письма',
                ],
            ] as $menu_item)
                <li class="{{ (request()->is($menu_item['route'])) ? 'active' : '' }}">
                    <a href="{{ route($menu_item['route']) }}"><i class="fa fa-{{ $menu_item['icon'] }}"></i> <span
                            class="nav-label">{{ $menu_item['name'] }}</span></a>
                </li>
            @endforeach
        @else
            @foreach ([
                [
                    'route'=> 'home2',
                    'icon'=> 'home',
                    'name'=> 'Главная',
                ],
                [
                    'route'=> 'contracts',
                    'icon'=> 'handshake-o',
                    'name'=> 'Реестр договоров',
                ],
                [
                    'route'=> 'contacts',
                    'icon'=> 'fax',
                    'name'=> 'Контакты',
                ],
                [
                    'route'=> 'production_plan',
                    'icon'=> 'industry',
                    'name'=> 'План производства',
                ],
                [
                    'route'=> 'create-project',
                    'icon'=> 'tasks',
                    'name'=> 'Создание проекта',
                ],
            ] as $menu_item)
                <li class="{{ (request()->is($menu_item['route'])) ? 'active' : '' }}">
                    <a href="{{ route($menu_item['route']) }}"><i class="fa fa-{{ $menu_item['icon'] }}"></i> <span
                            class="nav-label">{{ $menu_item['name'] }}</span></a>
                </li>
            @endforeach
        @endif
    </ul>
@endsection
