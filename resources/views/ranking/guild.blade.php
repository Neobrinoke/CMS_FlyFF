@extends('base')

@section('title', trans('trans/title.guild_ranking'))

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
                        <th>@lang('trans/ranking.guild.name')</th>
                        <th>@lang('trans/ranking.guild.lvl')</th>
                        <th>@lang('trans/ranking.guild.members')</th>
                        <th>@lang('trans/ranking.guild.leader')</th>
                        <th>@lang('trans/ranking.guild.logo')</th>
                        <th>@lang('trans/ranking.guild.created_at')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guilds as $guild)
                        <tr onclick="window.location = '{{ route('guild.show', [$guild]) }}'">
                            <td>{{ current_iteration($guilds, $loop) }}</td>
                            <td>{{ $guild->m_szGuild }}</td>
                            <td>{{ $guild->m_nLevel }}</td>
                            <td>
                                <div class="ui teal progress" data-value="{{ $guild->members->count() }}" data-total="{{ $guild->getMaxMembersCount() }}">
                                    <div class="bar">
                                    </div>
                                </div>
                            </td>
                            <td>{{ $guild->leader->m_szName }}</td>
                            <td>
                                @if($guild->hasLogo())
                                    <img class="ui image" src="{{ $guild->getLogo() }}"/>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $guild->CreateTime->toDateString() }}</td>
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