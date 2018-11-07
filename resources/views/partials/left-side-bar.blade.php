<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('home.index') }}" class="site_title"><i class="fa fa-paw"></i> <span>B&K!</span></a>
        </div>

        <div class="clearfix"></div>

        <br />
        <?php
            $userRoles = (\Auth::user()->roles) ? \Auth::user()->roles->pluck('name')->toArray() : [];
        ?>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    @if(in_array('ADMIN',$userRoles))
                        <li><a><i class="fa fa-users"></i> Kundeadministration <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('customer.index') }}">Alle kunder</a></li>
                                <li><a href="{{ route('customer.create') }}">Opret kunde</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-users"></i> Afdelinger <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('department.index') }}">Alle afdelinger</a></li>
                                <li><a href="{{ route('department.create') }}">Opret afdeling</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-users"></i> Brugeradministration <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('users.index') }}">Alle brugere</a></li>
                                <li><a href="{{ route('users.create') }}">Opret bruger</a></li>
                            </ul>
                        </li>
                    @endif
                    @if(in_array('ADMIN',$userRoles) || in_array('MANAGER',$userRoles) || in_array('AGENT', $userRoles))
                        <li><a><i class="fa fa-briefcase"></i> Skadehåndtering <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('claim.index') }}">skade liste</a></li>
                            </ul>
                        </li>
                    @endif
                    @if(in_array('ADMIN',$userRoles))
                        <li><a><i class="fa fa-wrench"></i> Opsætning <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('claim-type.index') }}">Opsætning</a></li>
                                <li><a href="{{ route('claim-mechanic.index') }}">Håndvækertype</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-file-archive-o"></i> Beredskabsplan <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('category.index') }}">Hændelser</a></li>
                                <li><a href="{{ route('content.index') }}">Indhold</a></li>
                            </ul>
                        </li>

                    @endif


                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->
    </div>
</div>