<div class="sidebar" >
    <nav class="sidebar-nav">

        <ul class="nav">
            @can('full_menu')
            <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    Dashboard
                </a>
            </li>
            @endcan
            @can('user_access')
            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="nav-dropdown-items">
                    @can('permission_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.permissions.index') }}"
                           class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-unlock-alt nav-icon">

                            </i>
                            {{ trans('cruds.permission.title') }}
                        </a>
                    </li>
                    @endcan
                    @can('role_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.roles.index') }}"
                           class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-briefcase nav-icon">

                            </i>
                            {{ trans('cruds.role.title') }}
                        </a>
                    </li>
                    @endcan
                    @can('user_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}"
                           class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-user nav-icon">

                            </i>
                            {{ trans('cruds.user.title') }}
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('full_menu')
            <!--li class="nav-item">
                <a href="{{ route('admin.disciplines.index') }}"
                    class="nav-link {{ request()->is('admin/disciplines') || request()->is('admin/disciplines/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-book-open nav-icon">

                    </i>
                    Category
                </a>
            </li-->
            @endcan
            @can('full_menu')
            <li class="nav-item">
                <a href="{{ route('admin.institutions.index') }}"
                   class="nav-link {{ request()->is('admin/institutions') || request()->is('admin/institutions/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-university nav-icon">

                    </i>
                    {{ trans('cruds.institution.title') }}
                </a>
            </li>
            @endcan

            @can('permission_access')
            <li class="nav-item">
                <a href="{{ route('admin.course-category.index') }}"
                   class="nav-link {{ request()->is('admin/course-category') || request()->is('admin/course-category/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                    </i>
                    Course Categories
                </a>
            </li>
            @endcan
            @can('full_menu')
            <li class="nav-item">
                <a href="{{ route('admin.course-period.index') }}"
                   class="nav-link {{ request()->is('admin/course-period') || request()->is('admin/course-period/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-briefcase nav-icon">

                    </i>
                    Course Periods
                </a>
            </li>
            @endcan
            @can('full_menu')
            <li class="nav-item">
                <a href="{{ route('admin.course-manager.index') }}"
                   class="nav-link {{ request()->is('admin/course-manager') || request()->is('admin/course-manager/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-user nav-icon">

                    </i>
                    Course Manager
                </a>
            </li>
            @endcan

            @can('course_access')
            <li class="nav-item">
                <a href="{{ route('admin.courses.index') }}"
                   class="nav-link {{ request()->is('admin/courses') || request()->is('admin/courses/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-certificate nav-icon">

                    </i>
                    Scholarship
                </a>
            </li>
            @endcan
            @can('enrollment_access')
            <li class="nav-item">
                <a href="{{ route('admin.enrollments.index') }}"
                   class="nav-link {{ request()->is('admin/enrollments') || request()->is('admin/enrollments/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-highlighter nav-icon">

                    </i>
                    Applications
                </a>
            </li>
            @endcan
            @can('enrollment_access')
            <li class="nav-item">
                <a href="{{ route('admin.mode-of-payment.index') }}"
                   class="nav-link {{ request()->is('admin/mode-of-payment') || request()->is('admin/mode-of-payment/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-money nav-icon">

                    </i>
                    Payment Details
                </a>
            </li>
            @endcan
            @can('enrollment_access')
            <li class="nav-item">
                <a href="{{ route('admin.document.manager') }}"
                   class="nav-link {{ request()->is('admin/document-manager') || request()->is('admin/document-manager/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-file-archive-o nav-icon">

                    </i>
                   Documents Folder
                </a>
            </li>
            @endcan
            <!--li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li-->
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
