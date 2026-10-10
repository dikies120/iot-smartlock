@extends('layouts.app')

@section('title', 'Dashboard - SmartLock')

@section('content')
<div class="flex h-screen overflow-hidden bg-slate-50">

    <aside class="w-72 flex flex-col bg-slate-900 text-white transition-all duration-300 relative shadow-2xl z-20">
        <div class="h-20 flex items-center px-8 border-b border-white/10 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-blue-600/20 to-indigo-600/20"></div>
            <div class="flex items-center gap-3 relative z-10">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-300">SmartLock</h2>
            </div>
        </div>

        <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto">
            <div class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Main Menu</div>
            
            <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-xl bg-gradient-to-r from-blue-600/20 to-blue-600/5 text-blue-400 font-medium border border-blue-500/20 shadow-[0_0_15px_rgba(37,99,235,0.1)] transition-all duration-300 relative overflow-hidden group">
                <div class="absolute left-0 top-0 h-full w-1 bg-blue-500 rounded-r-md"></div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="9"></rect>
                    <rect x="14" y="3" width="7" height="5"></rect>
                    <rect x="14" y="12" width="7" height="9"></rect>
                    <rect x="3" y="16" width="7" height="5"></rect>
                </svg>
                Overview Dashboard
            </a>
            
            <a href="{{ route('smartlock.control') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-xl text-slate-300 hover:bg-white/5 hover:text-white font-medium transition-all duration-300 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 group-hover:text-indigo-400 transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
                Control Door
            </a>
        </nav>

        <div class="p-6 border-t border-white/10 bg-slate-900/50 backdrop-blur-md">
            <div class="flex items-center gap-4 mb-6">
                <div class="relative">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-600 p-[2px]">
                        <div class="w-full h-full rounded-full bg-slate-900 flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr(Auth::user()->username ?? 'U', 0, 1)) }}
                        </div>
                    </div>
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-slate-900 rounded-full shadow-sm"></div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-white truncate">{{ Auth::user()->username ?? 'Administrator' }}</p>
                    <p class="text-xs text-slate-400 truncate">System Admin</p>
                </div>
            </div>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-white/5 hover:bg-red-500/20 hover:text-red-400 text-slate-300 font-medium transition-all duration-300 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-300 group-hover:-translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-blue-100/50 to-transparent -z-10"></div>
        <div class="absolute top-[-10%] right-[-5%] w-[40rem] h-[40rem] rounded-full bg-blue-400/10 blur-[100px] -z-10"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[30rem] h-[30rem] rounded-full bg-indigo-400/10 blur-[80px] -z-10"></div>

        <header class="h-20 flex items-center justify-between px-10 border-b border-gray-200/50 bg-white/50 backdrop-blur-xl z-10 sticky top-0">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Dashboard Overview</h1>
                <p class="text-sm text-slate-500 mt-0.5">Welcome back, monitor your smart lock system here.</p>
            </div>
            
            <div class="flex items-center gap-5">
                <button class="p-2.5 rounded-full bg-white border border-gray-200 text-gray-500 hover:text-blue-600 hover:border-blue-200 hover:bg-blue-50 transition-all duration-300 relative shadow-sm">
                    <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>
                <div class="h-8 w-px bg-gray-200"></div>
                <div class="flex items-center gap-3 bg-white p-1.5 pr-4 rounded-full border border-gray-200 shadow-sm">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold shadow-md">
                        {{ strtoupper(substr(Auth::user()->username ?? 'U', 0, 1)) }}
                    </div>
                    <span class="text-sm font-semibold text-slate-700">{{ Auth::user()->username ?? 'Administrator' }}</span>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-10 pb-20 space-y-8 relative z-0">
            
            @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/20 text-green-700 px-6 py-4 rounded-xl flex items-center gap-4 animate-[fadeIn_0.5s_ease-out]">
                <div class="p-2 bg-green-500/20 rounded-lg">
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold text-green-800">Success</h4>
                    <p class="text-sm mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php $status = $doorStatus ? strtolower($doorStatus->status) : 'unknown'; @endphp
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-7 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-blue-500/10 to-transparent rounded-bl-full -z-10 transition-transform duration-500 group-hover:scale-110"></div>
                    
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-blue-50 rounded-xl text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-gray-600">Current Status</h3>
                        </div>
                        <div class="flex h-4 w-4 items-center justify-center">
                            @if($status == 'locked')
                                <span class="animate-ping absolute inline-flex h-4 w-4 rounded-full bg-green-400 opacity-40"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.8)]"></span>
                            @elseif($status == 'unlocked')
                                <span class="animate-ping absolute inline-flex h-4 w-4 rounded-full bg-red-400 opacity-40"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.8)]"></span>
                            @else
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-gray-300"></span>
                            @endif
                        </div>
                    </div>
                    
                    <div>
                        <p class="text-4xl font-extrabold text-slate-800 tracking-tight">
                            {{ $doorStatus ? ucfirst($doorStatus->status) : 'Unknown' }}
                        </p>
                        <p class="text-sm text-gray-500 mt-2 font-medium">System door status indicator</p>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-7 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-indigo-500/10 to-transparent rounded-bl-full -z-10 transition-transform duration-500 group-hover:scale-110"></div>
                    
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-gray-600">Last Action</h3>
                        </div>
                    </div>
                    
                    <div>
                        @if(count($recentLogs) > 0)
                            <p class="text-3xl font-extrabold text-slate-800 tracking-tight truncate">{{ $recentLogs[0]->action }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="px-2.5 py-0.5 rounded-md bg-indigo-50 text-indigo-700 text-xs font-semibold border border-indigo-100">
                                    {{ \Carbon\Carbon::parse($recentLogs[0]->accessed_at)->diffForHumans() }}
                                </span>
                                <p class="text-sm text-gray-500 font-medium">ago by system</p>
                            </div>
                        @else
                            <p class="text-3xl font-extrabold text-gray-300 tracking-tight">No Data</p>
                        @endif
                    </div>
                </div>

                <div class="group bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-7 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-purple-500/10 to-transparent rounded-bl-full -z-10 transition-transform duration-500 group-hover:scale-110"></div>
                    
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-purple-50 rounded-xl text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-gray-600">Total Access (Today)</h3>
                        </div>
                    </div>
                    
                    <div>
                        <p class="text-4xl font-extrabold text-slate-800 tracking-tight">{{ count($recentLogs) }}</p>
                        <p class="text-sm text-gray-500 mt-2 font-medium">Interactions recorded today</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-100 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 bg-gray-50/50">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Recent Activity Logs</h2>
                        <p class="text-sm text-gray-500 mt-1">Detailed history of all door interactions.</p>
                    </div>
                    <a href="{{ route('smartlock.control') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:from-blue-500 hover:to-indigo-500 transition-all duration-300 gap-2">
                        <span>Control Door</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-white text-gray-400 border-b border-gray-100 uppercase tracking-wider text-xs font-semibold">
                            <tr>
                                <th class="px-8 py-4">User Details</th>
                                <th class="px-8 py-4">Event Action</th>
                                <th class="px-8 py-4">Timestamp</th>
                                <th class="px-8 py-4 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 bg-white">
                            @forelse($recentLogs as $log)
                            <tr class="hover:bg-blue-50/40 transition-colors duration-200 group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-slate-100 to-slate-200 border border-slate-200 flex items-center justify-center text-slate-600 font-bold shadow-sm group-hover:border-blue-200 transition-colors">
                                            {{ strtoupper(substr($log->user ? $log->user->username : 'S', 0, 1)) }}
                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-700 block">{{ $log->user ? $log->user->username : 'System / Remote' }}</span>
                                            <span class="text-xs text-gray-400">ID: #{{ $log->id ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    @php $actionType = strtolower($log->action); @endphp
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold
                                        {{ strpos($actionType, 'unlock') !== false || strpos($actionType, 'open') !== false ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 
                                           (strpos($actionType, 'lock') !== false || strpos($actionType, 'close') !== false ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'bg-gray-100 text-gray-700 border border-gray-200') }}">
                                        @if(strpos($actionType, 'unlock') !== false || strpos($actionType, 'open') !== false)
                                            <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                                        @elseif(strpos($actionType, 'lock') !== false || strpos($actionType, 'close') !== false)
                                            <div class="w-1.5 h-1.5 rounded-full bg-indigo-500"></div>
                                        @else
                                            <div class="w-1.5 h-1.5 rounded-full bg-gray-500"></div>
                                        @endif
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-slate-600 font-medium">{{ \Carbon\Carbon::parse($log->accessed_at)->format('d M Y') }}</span>
                                        <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($log->accessed_at)->format('H:i:s A') }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <span class="inline-flex items-center justify-end gap-1.5 text-emerald-600 text-sm font-bold bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Success
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <p class="text-base font-medium text-slate-500">No activity recorded yet.</p>
                                        <p class="text-sm mt-1">Interactions with the smart lock will appear here.</p>
                                    </div>
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

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
