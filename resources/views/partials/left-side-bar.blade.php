<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('dashboard.index') }}" class="site_title"><i class="fa fa-paw"></i> <span>B&K!</span></a>
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
                        <li><a><i class="fa fa-users"></i> User Management <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('users.index') }}">All users</a></li>
                                <li><a href="{{ route('users.create') }}">Create</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-file-archive-o"></i> Content Management <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('category.index') }}">Categories Listing</a></li>
                                <li><a href="{{ route('content.index') }}">Content Listing</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(in_array('ADMIN',$userRoles) || in_array('MANAGER',$userRoles))
                        <li><a><i class="fa fa-users"></i> Claims Management <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('claim.index') }}">Claims Listing</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->
    </div>
</div>