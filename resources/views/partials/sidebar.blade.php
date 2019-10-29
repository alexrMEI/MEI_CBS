<div class="sidebar m-2">
    <h5 class="sidebar-header">Back Office</h5>
    <ul class="list-group">
        <li class="list-group-item {{ Request::path() ==  'admin' ? 'selected' : ''  }}" >
            <a href="{{ url('/admin/') }}">
                Home
            </a>
        </li>
        <li class="list-group-item {{ Request::path() ==  'admin/users' ? 'selected' : ''  }}" >
            <a href="{{ url('/admin/users') }}">
                Users
            </a>
        </li>
        @can('edit product')
            <li class="list-group-item {{ Request::path() ==  'admin/products' ? 'selected' : ''  }}">
                <a href="{{ url('/admin/products') }}">
                    Products
                </a>
            </li>
        @endcan
        @can('edit file')
            <li class="list-group-item {{ Request::path() ==  'admin/files' ? 'selected' : ''  }}">
                <a href="{{ url('/admin/files') }}">
                    Files
                </a>
            </li>
        @endcan
        <li class="list-group-item {{ Request::path() ==  'admin/licenses' ? 'selected' : ''  }}">
            <a href="{{ url('/admin/licenses') }}">
                Licenses
            </a>
        </li>
    </ul>
</div>