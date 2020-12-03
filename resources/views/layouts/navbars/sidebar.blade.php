<div class="sidebar">
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-bar-32"></i>
                    <p>Dashboard</p>
                </a>
            </li>


            <li>
                <a data-toggle="collapse" href="#dmform" {{ $section == 'dmform' ? 'aria-expanded=true' : '' }}>
                    <i class="tim-icons icon-bank" ></i>
                    <span class="nav-link-text">DM Forms</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse {{ $section == 'dmform' ? 'show' : '' }}" id="dmform">
                    <ul class="nav pl-4">

                        <li @if ($pageSlug == 'dmaddreturns') class="active " @endif>
                            <a href="{{ route('dmaddreturns.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>Add/Return</p>
                            </a>
                        </li>

                        <li @if ($pageSlug == 'dmform') class="active " @endif>
                            <a href="{{ route('dmform.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>Deduct/Issued</p>
                            </a>
                        </li>

                        
                    </ul>
                </div>
            
            <li>
                <a data-toggle="collapse" href="#inventory" {{ $section == 'inventory' ? 'aria-expanded=true' : '' }}>
                    <i class="tim-icons icon-app"></i>
                    <span class="nav-link-text">Inventory</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse {{ $section == 'inventory' ? 'show' : '' }}" id="inventory">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'products') class="active " @endif>
                            <a href="{{ route('products.index') }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>Products</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'categories') class="active " @endif>
                            <a href="{{ route('categories.index') }}">
                                <i class="tim-icons icon-tag"></i>
                                <p>Categoríes</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'purposes') class="active " @endif>
                            <a href="{{ route('purposes.index') }}">
                                <i class="tim-icons icon-tag"></i>
                                <p>Purpose</p>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>

            <li @if ($pageSlug == 'customers') class="active " @endif>
                <a href="{{ route('customers.index') }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Customers</p>
                </a>
            </li>

            

            


            


            <li>
                <a data-toggle="collapse" href="#users" {{ $section == 'users' ? 'aria-expanded=true' : '' }}>
                    <i class="tim-icons icon-badge" ></i>
                    <span class="nav-link-text">Users</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse {{ $section == 'users' ? 'aria-expanded=true' : '' }}" id="users">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-badge"></i>
                                <p>My profile</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users-list') class="active " @endif>
                            <a href="{{ route('users.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>Manage Users</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users-create') class="active " @endif>
                            <a href="{{ route('users.create')  }}">
                                <i class="tim-icons icon-simple-add"></i>
                                <p>New user</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
