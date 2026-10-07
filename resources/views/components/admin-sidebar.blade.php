<aside class="admin-sidebar" id="adminSidebar">
    <ul class="sidebar-menu">
        <li class="menu-header">Main</li>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        <li class="menu-header">Content</li>
        <li>
            <a href="{{ route('admin.pages.index') }}" class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> Pages
            </a>
        </li>
        <li>
            <a href="{{ route('admin.news.index') }}" class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                <i class="bi bi-newspaper"></i> News & Events
            </a>
        </li>
        <li>
            <a href="{{ route('admin.publications.index') }}" class="{{ request()->routeIs('admin.publications.*') ? 'active' : '' }}">
                <i class="bi bi-journal-bookmark"></i> Publications
            </a>
        </li>
        <li>
            <a href="{{ route('admin.info-library.index') }}" class="{{ request()->routeIs('admin.info-library.*') ? 'active' : '' }}">
                <i class="bi bi-folder2-open"></i> Info Library
            </a>
        </li>
        <li>
            <a href="{{ route('admin.hero-slides.index') }}" class="{{ request()->routeIs('admin.hero-slides.*') ? 'active' : '' }}">
                <i class="bi bi-images"></i> Hero Slides
                @php $activeSlides = App\Models\HeroSlide::where('is_active', true)->count(); @endphp
                @if($activeSlides > 0)<span class="badge ms-auto" style="background: var(--fct-accent); color: #1C1C1C; font-size: 10px;">{{ $activeSlides }} active</span>@endif
            </a>
        </li>
        <li>
            <a href="{{ route('admin.advertisements.index') }}" class="{{ request()->routeIs('admin.advertisements.*') ? 'active' : '' }}">
                <i class="bi bi-badge-ad"></i> Advertisements
            </a>
        </li>
        <li>
            <a href="{{ route('admin.gallery.index') }}" class="{{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                <i class="bi bi-camera"></i> Media Gallery
            </a>
        </li>
        <li>
            <a href="{{ route('admin.team-members.index') }}" class="{{ request()->routeIs('admin.team-members.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Team Members
            </a>
        </li>

        <li class="menu-header">Communication</li>
        <li>
            <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="bi bi-envelope"></i> Contacts 
                @php $unread = App\Models\Contact::where('is_read', false)->count(); @endphp
                @if($unread > 0)<span class="badge bg-danger ms-auto">{{ $unread }}</span>@endif
            </a>
        </li>

        <li class="menu-header">Users</li>
        <li>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Users
            </a>
        </li>
        <li>
            <a href="{{ route('admin.roles.index') }}" class="{{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                <i class="bi bi-shield-lock"></i> Roles
            </a>
        </li>

        <li class="menu-header">System</li>
        <li>
            <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i> Settings
            </a>
        </li>
        @if(\Illuminate\Support\Facades\Route::has('admin.office-locations.index'))
        <li>
            <a href="{{ route('admin.office-locations.index') }}" class="{{ request()->routeIs('admin.office-locations.*') ? 'active' : '' }}">
                <i class="bi bi-geo-alt"></i> Office Locations
            </a>
        </li>
        @endif

        <li>
            <a href="{{ route('admin.reports.visitors') }}" class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart"></i> Reports
            </a>
        </li>
    </ul>
</aside>