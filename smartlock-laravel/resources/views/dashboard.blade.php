@extends('layouts.app')

@section('title', 'Dashboard - SmartLock')

@section('content')
<div class="flex h-screen overflow-hidden">

    <aside class="w-64 flex flex-col bg-white border-r border-gray-200">
        <div class="h-16 flex items-center px-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">SmartLock</h2>
        </div>

        <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-md bg-gray-100 text-gray-900 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="9"></rect>
                    <rect x="14" y="3" width="7" height="5"></rect>
                    <rect x="14" y="12" width="7" height="9"></rect>
                    <rect x="3" y="16" width="7" height="5"></rect>
                </svg>
                Dashboard
            </a>
            
            <a href="{{ route('smartlock.control') }}" class="flex items-center gap-3 px-3 py-2 rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
                Control Door
            </a>
        </nav>

        <div class="p-4 border-t border-gray-200">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-md text-gray-600 hover:bg-red-50 hover:text-red-700 font-medium transition-colors text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>


    <main class="flex-1 flex flex-col h-screen overflow-hidden">

        <header class="h-16 flex items-center justify-between px-8 bg-white border-b border-gray-200">
            <h1 class="text-xl font-semibold text-gray-800">Overview</h1>
            
            <div class="flex items-center gap-3">
                <div class="flex flex-col text-right">
                    <span class="text-sm font-medium text-gray-900">{{ Auth::user()->username ?? 'User' }}</span>
                    <span class="text-xs text-gray-500">Administrator</span>
                </div>
                <div class="w-9 h-9 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold text-sm">
                    {{ strtoupper(substr(Auth::user()->username ?? 'U', 0, 1)) }}
                </div>
            </div>
        </header>


        <div class="flex-1 overflow-y-auto p-8 space-y-6">
            

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-gray-500">Door Status</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                    @php $status = $doorStatus ? strtolower($doorStatus->status) : 'unknown'; @endphp
                    <div class="flex items-center justify-between">
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $doorStatus ? ucfirst($doorStatus->status) : 'Unknown' }}
                        </p>
                        <span class="flex h-3 w-3">
                            @if($status == 'locked')
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                            @elseif($status == 'unlocked')
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                            @else
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-gray-300"></span>
                            @endif
                        </span>
                    </div>
                </div>


                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-gray-500">Last Action</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div>
                        @if(count($recentLogs) > 0)
                            <p class="text-2xl font-bold text-gray-900">{{ $recentLogs[0]->action }}</p>
                            <p class="text-sm text-gray-500 mt-1">{{ \Carbon\Carbon::parse($recentLogs[0]->accessed_at)->diffForHumans() }}</p>
                        @else
                            <p class="text-2xl font-bold text-gray-400">No Data</p>
                        @endif
                    </div>
                </div>


                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-gray-500">Total Access Today</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ count($recentLogs) }}</p>
                    </div>
                </div>
            </div>


            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-base font-semibold text-gray-900">Recent Access Logs</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-gray-500 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 font-medium">User</th>
                                <th class="px-6 py-3 font-medium">Action</th>
                                <th class="px-6 py-3 font-medium">Time</th>
                                <th class="px-6 py-3 font-medium text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($recentLogs as $log)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 font-medium">
                                            {{ strtoupper(substr($log->user ? $log->user->username : 'S', 0, 1)) }}
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $log->user ? $log->user->username : 'System/Unknown' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php $actionType = strtolower($log->action); @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                        {{ strpos($actionType, 'unlock') !== false ? 'bg-blue-50 text-blue-700' : 
                                           (strpos($actionType, 'lock') !== false ? 'bg-indigo-50 text-indigo-700' : 'bg-gray-100 text-gray-700') }}">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-500">
                                    {{ \Carbon\Carbon::parse($log->accessed_at)->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="inline-flex items-center text-green-700 text-sm font-medium">
                                        Success
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                    No recent activity found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</div>
@endsection
