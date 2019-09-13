@extends('inspinia::layouts.main')

@if (auth()->check())
@section('user-avatar', 'https://www.gravatar.com/avatar/' . md5(auth()->user()->email) . '?d=mm')
@section('user-name', auth()->user()->second_name . ' ' . auth()->user()->first_name . ' ' . auth()->user()->patronymic)
@endif

@section('breadcrumbs')
@include('inspinia::layouts.main-panel.breadcrumbs', [
  'breadcrumbs' => [
    //(object) [ 'title' => 'Home', 'url' => route('home') ]
  ]
])
@endsection

@section('sidebar-menu')

  <ul class="nav metismenu" id="side-menu" style="padding-left:0px;">
    @foreach (array(
      array(
        'route'=> 'home',
        'icon'=> 'home',
        'name'=> 'Главная',
      ),
      array(
        'route'=> 'projects',
        'icon'=> 'tasks',
        'name'=> 'Проекты',
      ),
      array(
        'route'=> 'accounts',
        'icon'=> 'users',
        'name'=> 'Аккаунты',
      ),
      array(
        'route'=> 'summary',
        'icon'=> 'calculator',
        'name'=> 'Сводная по проектам',
      ),
      array(
        'route'=> 'statuses',
        'icon'=> 'newspaper-o',
        'name'=> 'Проекты на РП',
      ),
      array(
        'route'=> 'contracts',
        'icon'=> 'handshake-o',
        'name'=> 'Реестр договоров',
      ),
      array(
        'route'=> 'contacts',
        'icon'=> 'fax',
        'name'=> 'Контакты',
      ),
      array(
        'route'=> 'production_plan',
        'icon'=> 'industry',
        'name'=> 'План производства',
      ),
      array(
        'route'=> 'openings',
        'icon'=> 'address-card-o',
        'name'=> 'Реестр ЛОП',
      ),
      array(
        'route'=> 'home2',
        'icon'=> 'home',
        'name'=> 'Главная',
      ),
      array(
        'route'=> 'progress',
        'icon'=> 'cog',
        'name'=> 'Статус реализации проекта',
      ),
      array(
        'route'=> 'create-project',
        'icon'=> 'tasks',
        'name'=> 'Создание проекта',
      ),
      array(
        'route'=> 'funds',
        'icon'=> 'bank',
        'name'=> 'ДДС по контракту',
      ),
      array(
        'route'=> 'letters',
        'icon'=> 'envelope-o',
        'name'=> 'Письма',
      ),
    ) as $menu_item)
      <li class="{{ (request()->is($menu_item['route'])) ? 'active' : '' }}">
        <a href="{{ route($menu_item['route']) }}"><i class="fa fa-{{ $menu_item['icon'] }}"></i> <span class="nav-label">{{ $menu_item['name'] }}</span></a>
      </li>
    @endforeach
  </ul>
@endsection
