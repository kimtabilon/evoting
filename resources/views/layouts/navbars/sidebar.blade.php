<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('SSC') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('Voting Dashboard') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'rules') class="active " @endif>
                <a href="{{ route('rules')  }}">
                    <i class="tim-icons icon-app"></i>
                    <p>{{ __('Rules') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'students') class="active " @endif>
                <a href="{{ route('students')  }}">
                    <i class="tim-icons icon-badge"></i>
                    <p>{{ __('Students') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'candidates') class="active " @endif>
                <a href="{{ route('candidates')  }}">
                    <i class="tim-icons icon-user-run"></i>
                    <p>{{ __('Candidates') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'votes') class="active " @endif>
                <a href="{{ route('votes')  }}">
                    <i class="tim-icons icon-molecule-40"></i>
                    <p>{{ __('Votes') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'task') class="active " @endif>
                <a href="{{ route('task')  }}">
                    <i class="tim-icons icon-controller"></i>
                    <p>{{ __('Task') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'profile') class="active " @endif>
                <a href="{{ route('profile.edit')  }}">
                    <i class="tim-icons icon-lock-circle"></i>
                    <p>{{ __('Account') }}</p>
                </a>
            </li>
            <!-- <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="false">
                    <i class="tim-icons icon-atom" ></i>
                    <span class="nav-link-text" >{{ __('Templates') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('User Profile') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('User Management') }}</p>
                            </a>
                        </li>

                        <li @if ($pageSlug == 'icons') class="active " @endif>
                            <a href="{{ route('pages.icons') }}">
                                <i class="tim-icons icon-atom"></i>
                                <p>{{ __('Icons') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'maps') class="active " @endif>
                            <a href="{{ route('pages.maps') }}">
                                <i class="tim-icons icon-pin"></i>
                                <p>{{ __('Maps') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'notifications') class="active " @endif>
                            <a href="{{ route('pages.notifications') }}">
                                <i class="tim-icons icon-bell-55"></i>
                                <p>{{ __('Notifications') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'tables') class="active " @endif>
                            <a href="{{ route('pages.tables') }}">
                                <i class="tim-icons icon-puzzle-10"></i>
                                <p>{{ __('Table List') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'typography') class="active " @endif>
                            <a href="{{ route('pages.typography') }}">
                                <i class="tim-icons icon-align-center"></i>
                                <p>{{ __('Typography') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'rtl') class="active " @endif>
                            <a href="{{ route('pages.rtl') }}">
                                <i class="tim-icons icon-world"></i>
                                <p>{{ __('RTL Support') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> -->
            
        </ul>
    </div>
</div>
