@extends('back.layout')
@section('content')
    <h1>liste des pages</h1>
    <a href="{{route('admin.page.new') }}" ><i class="fas fa-plus"></i> Ajouter une page</a>
    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Slug</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
                <tr>
                    <td>{{$page->title}}</td>
                    <td>{{$page->slug}}</td>
                    <td><a  href="{{route('admin.page.edit', $page->id) }}" ><i class="fa fa-pen"
                            title="{{ __("Éditer") }}"></i></a>
                        <a  href="{{route('admin.page.delete', $page->id) }}"><i class="fa fa-trash"
                            title="{{ __("Supprimer") }}"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection