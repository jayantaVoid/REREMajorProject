<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                @if (auth()->user()->roles()->first()->role_name == 'Admin')
                    <li class="submenu {{ request()->routeIs('admin.home') ? 'active' : '' }}">
                        <a href="#"><i class="feather-grid"></i> <span> Dashboard</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.home') }}"
                                    class="{{ request()->routeIs('admin.home') ? 'active' : '' }}">
                                    <i class="feather-grid"></i> <span>Admin Dashboard</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="submenu {{ request()->routeIs('admin.subject-list', 'admin.subject-add') ? 'active' : '' }}">
                        <a href=""><i class="fas fa-book-reader"></i> <span> Subjects</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.subject-list') }}">Subject List</a></li>

                            <li><a href="{{ route('admin.subject-add') }}"
                                    class="{{ request()->routeIs('admin.subject-add') ? 'active' : '' }}">Subject Add</a>
                            </li>
                        </ul>
                    </li> --}}
                    {{-- <li class="submenu">
                        <a href="#"><i class="fas fa-clipboard"></i> <span> Invoices</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="invoices.html">Invoices List</a></li>
                            <li><a href="invoice-grid.html">Invoices Grid</a></li>
                            <li><a href="add-invoice.html">Add Invoices</a></li>
                            <li><a href="edit-invoice.html">Edit Invoices</a></li>
                            <li><a href="view-invoice.html">Invoices Details</a></li>
                            <li><a href="invoices-settings.html">Invoices Settings</a></li>
                        </ul>
                    </li> --}}

                    <!-- Subjects -->
                    <li class="submenu {{ request()->routeIs('admin.subject-list', 'admin.subject-add') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-book"></i> <span> Subject Tags</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.subject-list') }}"
                                    class="{{ request()->routeIs('admin.subject-list') ? 'active' : '' }}">
                                    <i class="fa fa-book"></i> <span>Subject Tag Lists</span>
                                </a>
                            </li>
                            <li><a href="{{ route('admin.subject-add') }}"
                                    class="{{ request()->routeIs('admin.subject-add') ? 'active' : '' }}">
                                    <i class="fa fa-book"></i> <span>Add Subject Tag</span>

                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="submenu {{ request()->routeIs('admin.student', 'admin.addstudent') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-graduation-cap"></i> <span> Users</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li>
                                <a href="{{ route('admin.student') }}"
                                    class="{{ request()->routeIs('admin.student') ? 'active' : '' }}">
                                    <i class="fas fa-graduation-cap"></i> <span>Users List</span>

                                </a>
                            </li>
                            <li><a href="{{ route('admin.addstudent') }}"
                                    class="{{ request()->routeIs('admin.addstudent') ? 'active' : '' }}">
                                    <i class="fas fa-graduation-cap"></i> <span>Add User</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="submenu {{ request()->routeIs('admin.exam-list','add-exam','add-question') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-clipboard-list"></i> <span> Exam</span> <span
                            class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.exam-list') }}"
                                class="{{ request()->routeIs('admin.exam-list') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> <span>Exam list</span></a>
                            </li>
                            <li><a href="{{ route('admin.add-exam') }}"
                                class="{{ request()->routeIs('admin.add-exam') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> <span>Add Exam</span></a>
                            </li>
                            <li><a href="{{ route('admin.add-question') }}"
                                class="{{ request()->routeIs('admin.add-question') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> <span>Add Question</span></a>
                            </li>
                        </ul>
                    </li>

                    <!-- level -->
                    <li class="submenu {{ request()->routeIs('admin.levels','admin.add-level') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-trophy"></i> <span> Level</span> <span
                            class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.levels') }}"
                                class="{{ request()->routeIs('admin.levels') ? 'active' : '' }}"><i class="fa fa-trophy"></i> <span>Levels</span></a>
                            </li>
                            <li><a href="{{ route('admin.add-level') }}"
                                class="{{ request()->routeIs('admin.add-level') ? 'active' : '' }}"><i class="fa fa-trophy"></i> <span>Add Level</span></a>
                            </li>
                        </ul>
                    </li>

                    {{-- <li class="active">
                        <a href="exam.html"><i class="fas fa-clipboard-list"></i> <span>Exam list</span></a>
                    </li> --}}
                    {{-- <li
                        class="submenu {{ request()->routeIs('admin.department', 'admin.department-add') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-building"></i> <span> Departments</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.department') }}"
                                    class="{{ request()->routeIs('admin.department') ? 'active' : '' }}">Department
                                    List</a></li>
                            <li><a href="{{ route('admin.department-add') }}"
                                    class="{{ request()->routeIs('admin.department-add') ? 'active' : '' }}">Department
                                    Add</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li
                        class="submenu {{ request()->routeIs('admin.semester', 'admin.semester-add') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-building"></i> <span> Semesters</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.semester') }}"
                                    class="{{ request()->routeIs('admin.semester') ? 'active' : '' }}">Semester
                                    List</a></li>
                            <li><a href="{{ route('admin.semester-add') }}"
                                    class="{{ request()->routeIs('admin.semester-add') ? 'active' : '' }}">Semester
                                    Add</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li class="submenu {{ request()->routeIs('admin.subject-list', 'admin.subject-add') ? 'active' : '' }}">
                        <a href=""><i class="fas fa-book-reader"></i> <span> Subjects</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.subject-list') }}">Subject List</a></li>

                            <li><a href="{{ route('admin.subject-add') }}"
                                    class="{{ request()->routeIs('admin.subject-add') ? 'active' : '' }}">Subject Add</a>
                            </li>
                        </ul>
                    </li> --}}
                @elseif (auth()->user()->roles()->first()->role_name == 'Student')
                    <li class="submenu {{ request()->routeIs('admin.home') ? 'active' : '' }}">
                        <a href="#"><i class="feather-grid"></i> <span> Dashboard</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.home') }}"
                                    class="{{ request()->routeIs('admin.home') ? 'active' : '' }}">Student
                                    Dashboard</a>
                            </li>
                        </ul>
                    </li>
                    <!-- exam -->
                    <li class="submenu {{ request()->routeIs('admin.student.exam-list') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-clipboard-list"></i> <span> Exam</span> <span
                            class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.student.exam-list') }}"
                                class="{{ request()->routeIs('admin.student.exam-list') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> <span>Exam list</span></a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="submenu active">
                        <a href="#"><i class="feather-grid"></i> <span> Dashboard</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.home') }}"
                                    class="{{ request()->routeIs('admin.home') ? 'active' : '' }}">Teacher
                                    Dashboard</a>
                            </li>
                        </ul>
                    </li>
                @endif



            </ul>
        </div>
    </div>
</div>
