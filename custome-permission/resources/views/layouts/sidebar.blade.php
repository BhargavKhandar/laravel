<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @php
            $PermissionUser = App\Http\Controllers\Permissioncontroller::getpermission('users', Auth::user()->role_id);
            $PermissionRole = App\Http\Controllers\Permissioncontroller::getpermission('roles', Auth::user()->role_id);
            $PermissionCategory = App\Http\Controllers\Permissioncontroller::getpermission(
                'categories',
                Auth::user()->role_id,
            );
            $PermissionSubCategory = App\Http\Controllers\Permissioncontroller::getpermission(
                'sub-categories',
                Auth::user()->role_id,
            );
            $PermissionProduct = App\Http\Controllers\Permissioncontroller::getpermission(
                'products',
                Auth::user()->role_id,
            );
            $PermissionSetting = App\Http\Controllers\Permissioncontroller::getpermission(
                'settings',
                Auth::user()->role_id,
            );
        @endphp
        <li class="nav-item">
            <a class="nav-link @if (Request::segment(2) != 'dashboard') collapsed @endif" href="{{ route('panel.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @if (!empty($PermissionUser))
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) != 'user') collapsed @endif" href="{{ route('user') }}">
                    <i class="bi bi-person"></i>
                    <span>User</span>
                </a>
            </li>
        @endif
        @if (!empty($PermissionRole))
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) != 'role') collapsed @endif" href="{{ route('role') }}">
                    <i class="bi bi-envelope"></i>
                    <span>Role</span>
                </a>
            </li>
        @endif
        @if (!empty($PermissionCategory))
            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="bi bi-envelope"></i>
                    <span>Category</span>
                </a>
            </li>
        @endif
        @if (!empty($PermissionSubCategory))
            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="bi bi-envelope"></i>
                    <span>Sub Category</span>
                </a>
            </li>
        @endif
        @if (!empty($PermissionProduct))
            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="bi bi-envelope"></i>
                    <span>Product</span>
                </a>
            </li>
        @endif
        @if (!empty($PermissionSetting))
            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="bi bi-envelope"></i>
                    <span>Setting</span>
                </a>
            </li>
        @endif
    </ul>

</aside><!-- End Sidebar-->
