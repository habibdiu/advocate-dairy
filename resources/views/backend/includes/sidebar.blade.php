<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ url('/') }}" class="sidebar-brand">
            Adv<span>Diaries</span>
        </a>
        <div class="sidebar-toggler ">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
                <li class="nav-item nav-category">Admin</li>
                <!--  Dashboard  -->
                <li class="nav-item {{ $data['active_menu'] == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link ">
                        <i class="fa-solid fa-chart-line"></i>
                        <span class="link-title">Dashboard</span>
                    </a>
                </li>
                <!--   Students   -->
                <li
                    class="nav-item {{ $data['active_menu'] == 'advocate_add' || $data['active_menu'] == 'advocate_edit' || $data['active_menu'] == 'advocate_list' ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#advocate" role="button" aria-expanded="false"
                        aria-controls="advocate">
                        <i class="fa-regular fa-user"></i>
                        <span class="link-title">Advocates Manage</span>
                        <i class="fa-solid fa-chevron-down link-arrow"></i>
                    </a>
                    <div class="collapse" id="advocate">
                        <ul class="nav sub-menu">
                            <li class="nav-item ">
                                <a href="{{ route('admin.advocate.add') }}"
                                    class="nav-link {{ $data['active_menu'] == 'advocate_add' ? 'active' : '' }}">Advocate
                                    Add</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.advocate.list') }}"
                                    class="nav-link {{ $data['active_menu'] == 'advocate_list' ? 'active' : '' }}">Advocate List</a>
                            </li>
                        </ul>
                    </div>
                </li>






                <!--   Messages   -->
                <li
                    class="nav-item {{ $data['active_menu'] == 'message_add' || $data['active_menu'] == 'message_edit' || $data['active_menu'] == 'message_list' ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#message" role="button" aria-expanded="false"
                        aria-controls="message">
                        <i class="fa-regular fa-user"></i>
                        <span class="link-title">Manage Messages</span>
                        <i class="fa-solid fa-chevron-down link-arrow"></i>
                    </a>
                    <div class="collapse" id="message">
                        <ul class="nav sub-menu">
                            <li class="nav-item ">
                                <a href="{{ route('admin.message.add') }}"
                                    class="nav-link {{ $data['active_menu'] == 'message_add' ? 'active' : '' }}">Message
                                    Add</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.message.list') }}"
                                    class="nav-link {{ $data['active_menu'] == 'message_list' ? 'active' : '' }}">Message List</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Students --}}
                <li
                    class="nav-item {{ $data['active_menu'] == 'student_add' || $data['active_menu'] == 'student_edit' || $data['active_menu'] == 'student_list' ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#student" role="button" aria-expanded="false"
                        aria-controls="student">
                        <i class="fa-regular fa-user"></i>
                        <span class="link-title">Manage students</span>
                        <i class="fa-solid fa-chevron-down link-arrow"></i>
                    </a>
                    <div class="collapse" id="student">
                        <ul class="nav sub-menu">
                            <li class="nav-item ">
                                <a href="{{ route('admin.student.add') }}"
                                    class="nav-link {{ $data['active_menu'] == 'student_add' ? 'active' : '' }}">student
                                    Add</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.student.list') }}"
                                    class="nav-link {{ $data['active_menu'] == 'student_list' ? 'active' : '' }}">student List</a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                
        </ul>
</nav>

<!-- partial -->
