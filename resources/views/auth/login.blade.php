@extends('layout.app')

@section('title', 'login — dev.log')

@section('content')
<div class="min-h-[calc(100vh-4rem)] flex items-center justify-center px-6 pt-16">
    <div class="w-full max-w-md p-8 bg-surface/50 backdrop-blur-md rounded-xl border border-border shadow-2xl relative overflow-hidden">

        <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-neonGreen/50 to-transparent"></div>

        <div class="text-center mb-8">
            <div class="font-mono font-bold text-xl tracking-tight mb-2">
                <span class="text-neonGreen">~</span><span class="text-textPrimary">/auth-login</span>
            </div>
            <p class="text-xs font-mono text-textSecondary">Restricted access. Please authenticate.</p>
        </div>

        <div id="error-container" class="{{ session('error') ? '' : 'hidden' }} mb-5 p-3 rounded-lg bg-red-950/30 border border-red-500/30 font-mono text-[11px] text-red-400">
            <span class="text-red-500">[ERROR]</span>
            <span id="error-message">
                @if(session('error'))
                {{ session('error') }}
                @endif
            </span>
        </div>

        <form id="credentials-login-form" class="space-y-4 mb-6">
            <div>
                <label for="email" class="block font-mono text-[11px] text-textSecondary uppercase tracking-wider mb-1.5">> user_email</label>
                <input type="email" id="email" name="email" required placeholder="name@domain.com"
                    class="w-full bg-bg/40 border border-border rounded-lg px-3 py-2.5 font-mono text-xs text-textPrimary placeholder:text-textSecondary/40 focus:outline-none focus:border-neonGreen focus:ring-1 focus:ring-neonGreen/30 transition">
            </div>

            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <label for="password" class="block font-mono text-[11px] text-textSecondary uppercase tracking-wider">> access_key</label>
                    <a href="/password/reset" class="font-mono text-[10px] text-textSecondary hover:text-neonGreen transition">forgot_key?</a>
                </div>
                <input type="password" id="password" name="password" required placeholder="••••••••"
                    class="w-full bg-bg/40 border border-border rounded-lg px-3 py-2.5 font-mono text-xs text-textPrimary placeholder:text-textSecondary/40 focus:outline-none focus:border-neonGreen focus:ring-1 focus:ring-neonGreen/30 transition">
            </div>

            <button type="submit"
                class="w-full py-2.5 font-mono text-xs font-bold rounded-lg border border-neonGreen/50 text-neonGreen bg-neonGreen/5 hover:bg-neonGreen hover:text-bg active:scale-[0.99] transition duration-200">
                EXECUTE_AUTH
            </button>
        </form>

        <div class="relative flex py-2 items-center mb-4">
            <div class="flex-grow border-t border-border/40"></div>
            <span class="flex-shrink mx-3 font-mono text-[10px] text-textSecondary/50 uppercase tracking-widest">OR_USE_PROVIDER</span>
            <div class="flex-grow border-t border-border/40"></div>
        </div>

        <div class="space-y-3">
            <button type="button" onclick="handleOAuthLogin('github', event)"
                class="w-full py-2.5 px-4 flex items-center justify-center gap-3 font-mono text-xs rounded-lg border border-border text-textPrimary bg-bg/40 hover:bg-bg/80 hover:border-textSecondary active:scale-[0.99] transition duration-200">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                </svg>
                CONNECT_VIA_GITHUB
            </button>

            <button type="button" onclick="handleOAuthLogin('google', event)"
                class="w-full py-2.5 px-4 flex items-center justify-center gap-3 font-mono text-xs rounded-lg border border-border text-textPrimary bg-bg/40 hover:bg-bg/80 hover:border-textSecondary active:scale-[0.99] transition duration-200">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                    <path d="M12.24 10.285V14.4h6.887c-.275 1.565-1.88 4.604-6.887 4.604-4.33 0-7.866-3.577-7.866-8s3.536-8 7.866-8c2.46 0 4.105 1.025 5.047 1.926l3.227-3.107C18.216 1.094 15.42 0 12.24 0c-6.63 0-12 5.37-12 12s5.37 12 12 12c6.923 0 11.52-4.869 11.52-11.726 0-.788-.085-1.39-.189-1.989H12.24z" />
                </svg>
                CONNECT_VIA_GOOGLE
            </button>
        </div>

        <div id="loading-state" class="hidden mt-5 text-center font-mono text-xs text-neonGreen animate-pulse">
            > INITIATING_FLOW...
        </div>

        <div class="mt-6 text-center border-t border-border/50 pt-4 flex justify-between items-center px-1">
            <a href="/" class="font-mono text-[11px] text-textSecondary hover:text-neonGreen transition">
                &larr; back_to_home
            </a>
        </div>

    </div>
</div>

@vite('resources/js/auth.js')
@endsection