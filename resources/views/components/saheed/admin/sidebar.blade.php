<aside id="adminSidebar" class="sidebar collapsed">
    <style>
        .sidebar::-webkit-scrollbar {
            display: none;
        }

        .sidebar {
            -ms-overflow-style: none;
            scrollbar-width: none;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1200;
            width: 250px;
            height: 100vh;
            background: white;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            overflow-x: hidden;
            transform: translateX(-100%);
        }

        .sidebar.active {
            transform: translateX(0);
            width: 16rem;
        }

        @media (min-width: 768px) {
            .sidebar {
                transform: translateX(0);
                width: 70px;
            }
            .sidebar:not(.collapsed) {
                width: 250px;
            }
            .sidebar.active {
                width: auto;
            }
        }

        .sidebar.collapsed {
            width: 70px;
        }

        body.sidebar-open {
            overflow: hidden;
        }

        body.sidebar-open::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1100;
            pointer-events: auto;
        }

        .app-brand {
            display: flex;
            align-items: center;
            padding: 1rem 1rem 1rem 1.5rem;
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
            gap: 10px;
            height: 60px;
            box-sizing: border-box;
        }

        .sidebar.collapsed .app-brand {
            justify-content: center;
            padding: 1rem 0;
            gap: 0;
        }

        .app-logo {
            height: 32px;
            width: 32px;
            object-fit: contain;
            margin: 0 auto;
        }

        .sidebar:not(.collapsed) .app-logo {
            margin: 0;
        }

        .app-name {
            font-size: 1.1rem;
            font-weight: 600;
            white-space: nowrap;
            transition: opacity 0.3s ease;
            color: #111827;
        }

        .sidebar.collapsed .app-name {
            opacity: 0;
            width: 0;
        }

        .nav-content {
            flex: 1;
            padding: 0.5rem 1rem 1rem;
            display: flex;
            flex-direction: column;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
            transition: all 0.3s ease;
            color: #4b5563;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .sidebar.collapsed .nav-item {
            justify-content: center;
            padding: 0.75rem 0;
        }

        .nav-item:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .nav-item.dashboard.active {
            background-color: rgba(99, 102, 241, 0.1);
            color: #6366F1;
        }
        .nav-item.users.active {
            background-color: rgba(34, 197, 94, 0.1);
            color: #22C55E;
        }
        .nav-item.admins.active {
            background-color: rgba(239, 68, 68, 0.1);
            color: #EF4444;
        }
        .nav-item.roles.active {
            background-color: rgba(168, 85, 247, 0.1);
            color: #A855F7;
        }
        .nav-item.packages.active {
            background-color: rgba(234, 179, 8, 0.1);
            color: #EAB308;
        }
        .nav-item.transactions.active {
            background-color: rgba(59, 130, 246, 0.1);
            color: #3B82F6;
        }
        .nav-item.settings.active {
            background-color: rgba(107, 114, 128, 0.1);
            color: #6B7280;
        }

        .nav-icon.dashboard { color: #6366F1; }
        .nav-icon.users { color: #22C55E; }
        .nav-icon.admins { color: #EF4444; }
        .nav-icon.roles { color: #A855F7; }
        .nav-icon.packages { color: #EAB308; }
        .nav-icon.transactions { color: #3B82F6; }
        .nav-icon.settings { color: #6B7280; }

        .nav-icon {
            font-size: 1.1rem;
            min-width: 24px;
            text-align: center;
            margin-right: 12px;
        }

        .sidebar.collapsed .nav-icon {
            margin-right: 0;
        }

        .nav-text {
            transition: opacity 0.3s ease;
            white-space: nowrap;
        }

        .sidebar.collapsed .nav-text {
            opacity: 0;
            width: 0;
        }

        .admin-promo {
            padding: 1rem;
            background: white;
            border-top: 1px solid #e5e7eb;
            min-height: 72px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar.collapsed .admin-promo {
            padding: 0.5rem;
        }

        .sidebar.collapsed .admin-promo .flex {
            justify-content: center;
        }

        .sidebar.collapsed .admin-promo .flex > div:last-child {
            display: none;
        }

        .admin-text {
            font-size: 0.85rem;
            text-align: center;
            line-height: 1.4;
            font-weight: 600;
            color: #374151;
        }

        .sidebar.collapsed .admin-text {
            display: none;
        }

        .logout-button {
            background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            text-align: center;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .logout-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .sidebar.collapsed .logout-button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar.collapsed .nav-item {
            position: relative;
        }

        .admin-tooltip {
            position: fixed;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 600;
            white-space: nowrap;
            z-index: 9999;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.2s ease-out;
            pointer-events: none;
        }

        .admin-tooltip.show {
            opacity: 1;
            transform: translateX(0);
        }

        .admin-tooltip::before {
            content: '';
            position: absolute;
            left: -6px;
            top: 50%;
            transform: translateY(-50%);
            border: 6px solid transparent;
        }

        .admin-tooltip.dashboard {
            background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);
        }
        .admin-tooltip.dashboard::before {
            border-right-color: #6366F1;
        }

        .admin-tooltip.users {
            background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);
        }
        .admin-tooltip.users::before {
            border-right-color: #22C55E;
        }

        .admin-tooltip.admins {
            background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
        }
        .admin-tooltip.admins::before {
            border-right-color: #EF4444;
        }

        .admin-tooltip.roles {
            background: linear-gradient(135deg, #A855F7 0%, #9333EA 100%);
        }
        .admin-tooltip.roles::before {
            border-right-color: #A855F7;
        }

        .admin-tooltip.packages {
            background: linear-gradient(135deg, #EAB308 0%, #CA8A04 100%);
        }
        .admin-tooltip.packages::before {
            border-right-color: #EAB308;
        }

        .admin-tooltip.transactions {
            background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
        }
        .admin-tooltip.transactions::before {
            border-right-color: #3B82F6;
        }

        .admin-tooltip.settings {
            background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);
        }
        .admin-tooltip.settings::before {
            border-right-color: #6B7280;
        }

        .dark .sidebar {
            background-color: #1f2937;
        }

        .dark .app-brand,
        .dark .admin-promo {
            background-color: #1f2937;
            border-top-color: #374151;
        }

        .dark .app-name {
            color: white;
        }

        .dark .nav-item {
            color: #9ca3af;
        }

        .dark .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .dark .admin-text {
            color: #9ca3af;
        }
    </style>

    <div class="sidebar-content">
        <div class="app-brand">
            <i class="fas fa-shield-halved text-indigo-600 text-xl flex-shrink-0"></i>
            <span class="app-name">Admin Panel</span>
        </div>

        <div class="nav-content">
            <a href="{{ route('admin.dashboard') }}" class="nav-item dashboard {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" data-tooltip="Dashboard">
                <i class="nav-icon fas fa-tachometer-alt dashboard"></i>
                <span class="nav-text">Dashboard</span>
            </a>
            <a href="{{ route('admin.login-attempts') }}" class="nav-item admins {{ request()->routeIs('admin.login-attempts') ? 'active' : '' }}" data-tooltip="Login Attempts">
                <i class="nav-icon fas fa-shield-alt admins"></i>
                <span class="nav-text">Login Attempts</span>
            </a>
        </div>

        <div class="admin-promo">
            <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 w-full hover:bg-gray-50 dark:hover:bg-gray-700 p-2 rounded-md transition-colors">
                <div class="w-10 h-10 rounded-full flex-shrink-0 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm">
                    {{ strtoupper(substr(auth('admin')->user()->name, 0, 1) . (strpos(auth('admin')->user()->name, ' ') ? substr(auth('admin')->user()->name, strpos(auth('admin')->user()->name, ' ') + 1, 1) : '')) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ auth('admin')->user()->name }}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth('admin')->user()->email }}</div>
                </div>
            </a>
        </div>
    </div>
</aside>


