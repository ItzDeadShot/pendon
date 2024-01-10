<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      Pen<span>Don</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Resource Management</li>
        <li class="nav-item {{ active_class(['admin/users']) }}">
            <a href="{{ url('/users') }}" class="nav-link">
                <i class="link-icon" data-feather="user"></i>
                <span class="link-title">User Management</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['admin/users']) }}">
            <a href="{{ route('items.index') }}" class="nav-link">
                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Item Management</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['admin/users']) }}">
            <a href="{{ route('requests.index') }}" class="nav-link">
                <i class="link-icon" data-feather="gift"></i>
                <span class="link-title">Request Management</span>
            </a>
        </li>
    </ul>
  </div>
</nav>
