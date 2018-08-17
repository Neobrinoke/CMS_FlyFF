@extends('base')

@section('title', trans('title.guild_ranking'))

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header"><i class="sort amount up icon"></i>@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            <table class="ui single line selectable table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('ranking.guild.name')</th>
                        <th>@lang('ranking.guild.lvl')</th>
                        <th>@lang('ranking.guild.members')</th>
                        <th>@lang('ranking.guild.leader')</th>
                        <th>@lang('ranking.guild.logo')</th>
                        <th>@lang('ranking.guild.created_at')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guilds as $guild)
                        <tr onclick="window.location = '{{ route('guild.show', [$guild]) }}'">
                            <td>{{ current_iteration($guilds, $loop) }}</td>
                            <td>{{ $guild->m_szGuild }}</td>
                            <td>{{ $guild->m_nLevel }}</td>
                            <td>
                                <div class="ui teal progress popup_element" data-content="{{ $guild->members->count() }} / {{ $guild->max_members_count }}" data-value="{{ $guild->members->count() }}" data-total="{{ $guild->max_members_count }}">
                                    <div class="bar"></div>
                                </div>
                            </td>
                            <td>{{ $guild->leader->m_szName }}</td>
                            <td>
                                @if($guild->has_logo)
                                    <img class="ui image" src="{{ $guild->logo }}">
                                @else
                                    -
                                @endif
                            </td>
                            <td><time datetime="{{ $guild->CreateTime }}">{{ $guild->CreateTime }}</time></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7">
                            {{ $guilds->appends(request()->except('page'))->links() }}
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

<?php /** @var \App\Model\Character\Guild $guild */ ?>