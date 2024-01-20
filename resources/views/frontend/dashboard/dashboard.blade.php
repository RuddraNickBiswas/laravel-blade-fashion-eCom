{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends('frontend.layouts.master')



@section('content')
    <!-- Page Title
          ============================================= -->
    <section id="page-title">

        <div class="container clearfix">
            <h1>Account</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
          ============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">

                <div id="side-navigation" class="row">

                    <div class="col-md-6 col-lg-4">
                        <ul class="sidenav">
                            <li class="{{ request()->routeIs('profile') ? 'ui-tabs-active' : '' }}">
                                <a href="{{ route('profile') }}">
                                    <i class="icon-screen"></i>User Profile
                                    <i class="icon-chevron-right"></i>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('dashboard.order') ? 'ui-tabs-active' : '' }}">
                                <a href="{{ route('home') }}">
                                    <i class="icon-magic"></i>Invoice
                                    <i class="icon-chevron-right"></i>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('dashboard.return-order') ? 'ui-tabs-active' : '' }}">
                                <a href="{{ route('home') }}">
                                    <i class="icon-tint"></i>Unlimited Color Options
                                    <i class="icon-chevron-right"></i>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('track-order') ? 'ui-tabs-active' : '' }}">
                                <a href="{{ route('home') }}">
                                    <i class="icon-gift"></i>track order
                                    <i class="icon-chevron-right"></i>
                                </a>
                            </li>
                        </ul>

                       <form method="POST" action="{{ route('logout') }}">
                     @csrf
                   
                     <a href="#"
                     class="button"
                         onclick="event.preventDefault();
                                                this.closest('form').submit();"
                        >
                         LOGOUT
                     </a>
          
             </form>
                    </div>


                    <div class="col-md-6 col-lg-8">

                        @yield('sidebar_content')


                    </div>

                </div>

            </div>
        </div>
    </section><!-- #content end -->
 
@endsection
