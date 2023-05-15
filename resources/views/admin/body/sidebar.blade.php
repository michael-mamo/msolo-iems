@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp
@if(Auth::User()->isactive == '1')
<!-- Admin side bar -->
<!-- <aside id="sidebarToggle" class="main-sidebar elevation-4"> -->
<aside class="main-sidebar dark-mode elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">IEMS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="search" aria-label="search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <li class="nav-item">
          <a href="{{route('dashboard')}}" class="nav-link {{ ($route == 'dashboard')?'active':''}}">
            <i class="nav-icon fas fa-home"></i>
            <p>
             My Dashboard
            </p>
          </a>
        </li>
        @if(Auth::User()->role == 'Admin')
      <li class="nav-item">
          <a href="{{route('adminDashboard')}}" class="nav-link {{ ($route == 'adminDashboard')?'active':''}}">
            <i class="nav-icon fas fa-building"></i>
            <p>
              Admin Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item ">
          <a href="#" class="nav-link {{ ($prefix == '/configuration')?'active':''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Configuration
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <!-- <li class="nav-item">
              <a href="{{route('role.view')}}" class="nav-link {{ ($route == 'role.view')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Role</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="{{ route('user.view') }}" class="nav-link {{ ($route == 'user.view')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('usertype.view') }}" class="nav-link {{ ($route == 'usertype.view')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>User type</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('expenseType.view') }}" class="nav-link {{ ($route == 'expenseType.view')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Expense Type</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('incomeType.view') }}" class="nav-link {{ ($route == 'incomeType.view')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Income Type</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('savingType.view') }}" class="nav-link {{ ($route == 'savingType.view')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Saving Type</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('liabilityType.view')}}" class="nav-link {{ ($route == 'liabilityType.view')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Liability Type</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('receivableType.view')}}" class="nav-link {{ ($route == 'receivableType.view')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Receivable Type</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('tutorial.view') }}" class="nav-link {{ ($route == 'tutorial.view')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Tutorial</p>
              </a>
            </li>
          </ul>
        </li>
        @endif
        <li class="nav-item">
          <a href="{{route('myIncome.view')}}" class="nav-link {{ ($route == 'myIncome.view')?'active':''}}">
            <i class="nav-icon fas fa-donate"></i>
            <p>
              My Income
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('myExpense.view')}}" class="nav-link {{ ($route == 'myExpense.view')?'active':''}}">
            <i class="nav-icon fas fa-coins"></i>
            <p>
              My Expense
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('myLiability.view')}}" class="nav-link {{ ($route == 'myLiability.view')?'active':''}}">
            <i class="nav-icon fas fa-minus"></i>
            <p>
              My Liability
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('myReceivable.view')}}" class="nav-link {{ ($route == 'myReceivable.view')?'active':''}}">
            <i class="nav-icon fas fa-plus"></i>
            <p>
              My Receivable
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('mySaving.view')}}" class="nav-link {{ ($route == 'mySaving.view')?'active':''}}">
            <i class="nav-icon fas fa-piggy-bank"></i>
            <p>
              Savings
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('report.view')}}" class="nav-link {{ ($route == 'report.view')?'active':''}}">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Report
            </p>
          </a>
        </li>
        @if(Auth::User()->role == 'User')
        <li class="nav-item">
          <a href="{{route('contact.contactadmin')}}" class="nav-link {{ ($route == 'contact.contactadmin')?'active':''}}">
            <i class="nav-icon fas fa-comments"></i>
            <p>
              Contact Admin
            </p>
          </a>
        </li>
        @endif
        @if(Auth::User()->role == 'Admin')
        <li class="nav-item">
          <a href="{{route('contact.contactuser')}}" class="nav-link {{ ($route == 'contact.contactuser')?'active':''}}">
            <i class="nav-icon fas fa-comments"></i>
            <p>
              Contact Users
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('feedback.view')}}" class="nav-link {{ ($route == 'feedback.view')?'active':''}}">
            <i class="nav-icon fas fa-book"></i>
            <p>
              View Feedbacks
            </p>
          </a>
        </li>
        @endif
        <!-- <li class="nav-item">
          <a href="{{route('help.tutorial')}}" class="nav-link {{ ($route == 'help.tutorial')?'active':''}}">
            <i class="nav-icon fas fa-question-circle"></i>
            <p>
              Help
            </p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="{{route('profile.view')}}" class="nav-link {{ ($route == 'profile.view')?'active':''}}">
            <i class="nav-icon fas fa-user"></i>
            <p>
              My Profile
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('developer.view')}}" class="nav-link {{ ($route == 'developer.view')?'active':''}}">
            <i class="nav-icon fas fa-laptop"></i>
            <p>
              Developer
            </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
@endif
