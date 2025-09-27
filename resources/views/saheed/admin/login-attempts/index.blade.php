<x-admin-layout title="Login Attempts">
    <div class="space-y-4 overflow-hidden">
        <!-- Bulk Actions Bar -->
        <div id="bulkActions" class="bg-indigo-50 dark:bg-indigo-900 border border-indigo-200 dark:border-indigo-700 rounded-lg p-4 hidden">
            <div class="flex items-center justify-between">
                <span class="text-sm text-indigo-700 dark:text-indigo-300">
                    <span id="selectedCount">0</span> items selected
                </span>
                <button id="bulkDelete" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                    <i class="fas fa-trash mr-2"></i>Delete Selected
                </button>
            </div>
        </div>

        <!-- Search and Controls -->
        <div class="flex items-center gap-4 mb-4">
            <!-- Search -->
            <div class="flex-1 max-w-md">
                <input type="text" id="searchInput" placeholder="Search platform, email, username, IP..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm" value="{{ request('search') }}">
            </div>
            
            <!-- Filter Icon -->
            <div class="relative">
                <button id="filterButton" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-filter"></i>
                </button>
                <div id="filterDropdown" class="absolute top-full right-0 mt-1 w-80 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 hidden">
                    <div class="p-4 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Platform</label>
                            <select id="platformFilter" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <option value="">All Platforms</option>
                                <option value="instagram">Instagram</option>
                                <option value="facebook">Facebook</option>
                                <option value="google">Google</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                            <select id="statusFilter" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <option value="">All Status</option>
                                <option value="credentials">Credentials</option>
                                <option value="verification">Verification</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date Range</label>
                            <div class="grid grid-cols-2 gap-2">
                                <input type="date" id="dateFrom" class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <input type="date" id="dateTo" class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            </div>
                        </div>
                        <div>
                            <button id="resetFilters" class="w-full bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-lg text-sm hover:bg-gray-400 dark:hover:bg-gray-500">Reset</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Column Visibility Icon -->
            <div class="relative">
                <button id="columnButton" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-columns"></i>
                </button>
                <div id="columnDropdown" class="absolute top-full right-0 mt-1 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 hidden">
                    <div class="p-2">
                        <label class="flex items-center px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded cursor-pointer">
                            <input type="checkbox" class="column-toggle mr-2" data-column="platform" checked> Platform
                        </label>
                        <label class="flex items-center px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded cursor-pointer">
                            <input type="checkbox" class="column-toggle mr-2" data-column="credentials" checked> Credentials
                        </label>
                        <label class="flex items-center px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded cursor-pointer">
                            <input type="checkbox" class="column-toggle mr-2" data-column="password" checked> Password
                        </label>
                        <label class="flex items-center px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded cursor-pointer">
                            <input type="checkbox" class="column-toggle mr-2" data-column="verification" checked> Verification
                        </label>
                        <label class="flex items-center px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded cursor-pointer">
                            <input type="checkbox" class="column-toggle mr-2" data-column="ip" checked> IP Address
                        </label>
                        <label class="flex items-center px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded cursor-pointer">
                            <input type="checkbox" class="column-toggle mr-2" data-column="status" checked> Status
                        </label>
                        <label class="flex items-center px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded cursor-pointer">
                            <input type="checkbox" class="column-toggle mr-2" data-column="date" checked> Date
                        </label>
                        <label class="flex items-center px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded cursor-pointer">
                            <input type="checkbox" class="column-toggle mr-2" data-column="actions" checked> Actions
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div id="attemptsContainer">
            @include('saheed.admin.login-attempts.partials.attempts-table')
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 shadow-xl">
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center">
                        <i class="fas fa-trash text-2xl text-red-600 dark:text-red-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Confirm Delete</h3>
                    <p id="deleteMessage" class="text-sm text-gray-600 dark:text-gray-400 mb-6">Are you sure you want to delete this login attempt?</p>
                    
                    <div class="flex gap-3 justify-center">
                        <button id="cancelDelete" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                            Cancel
                        </button>
                        <button id="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            <span class="btn-text">Delete</span>
                            <i class="fas fa-spinner fa-spin hidden ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let searchTimeout;
        
        // Search functionality - only platform search
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(filterAttempts, 300);
            });
        }

        // Filter dropdown - stays open
        const filterButton = document.getElementById('filterButton');
        if (filterButton) {
            filterButton.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdown = document.getElementById('filterDropdown');
                const columnDropdown = document.getElementById('columnDropdown');
                if (dropdown) dropdown.classList.toggle('hidden');
                if (columnDropdown) columnDropdown.classList.add('hidden');
            });
        }

        // Column dropdown - stays open
        document.getElementById('columnButton').addEventListener('click', function(e) {
            e.stopPropagation();
            const dropdown = document.getElementById('columnDropdown');
            dropdown.classList.toggle('hidden');
            document.getElementById('filterDropdown').classList.add('hidden');
        });

        // Filter changes - auto apply
        document.getElementById('platformFilter').addEventListener('change', filterAttempts);
        document.getElementById('statusFilter').addEventListener('change', filterAttempts);
        document.getElementById('dateFrom').addEventListener('change', filterAttempts);
        document.getElementById('dateTo').addEventListener('change', filterAttempts);

        // Reset filters
        document.getElementById('resetFilters').addEventListener('click', function() {
            document.getElementById('searchInput').value = '';
            document.getElementById('platformFilter').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('dateFrom').value = '';
            document.getElementById('dateTo').value = '';
            filterAttempts();
        });

        // Column toggles - don't close dropdown
        document.querySelectorAll('.column-toggle').forEach(toggle => {
            toggle.addEventListener('change', function(e) {
                e.stopPropagation();
                const column = this.dataset.column;
                const isVisible = this.checked;
                const elements = document.querySelectorAll(`[data-column="${column}"]`);
                elements.forEach(el => {
                    el.style.display = isVisible ? '' : 'none';
                });
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('#filterButton') && !e.target.closest('#filterDropdown')) {
                document.getElementById('filterDropdown').classList.add('hidden');
            }
            if (!e.target.closest('#columnButton') && !e.target.closest('#columnDropdown')) {
                document.getElementById('columnDropdown').classList.add('hidden');
            }
        });

        // Bulk selection - persistent
        document.addEventListener('change', function(e) {
            if (e.target.id === 'selectAll') {
                const checkboxes = document.querySelectorAll('.attempt-checkbox');
                checkboxes.forEach(cb => {
                    cb.checked = e.target.checked;
                    if (e.target.checked) {
                        cb.closest('tr').classList.add('bg-blue-50', 'dark:bg-blue-900');
                    } else {
                        cb.closest('tr').classList.remove('bg-blue-50', 'dark:bg-blue-900');
                    }
                });
                updateBulkActions();
            } else if (e.target.classList.contains('attempt-checkbox')) {
                if (e.target.checked) {
                    e.target.closest('tr').classList.add('bg-blue-50', 'dark:bg-blue-900');
                } else {
                    e.target.closest('tr').classList.remove('bg-blue-50', 'dark:bg-blue-900');
                }
                updateBulkActions();
            }
        });

        // Delete modal variables
        let deleteType = 'single';
        let deleteIds = [];
        const deleteModal = document.getElementById('deleteModal');
        const deleteMessage = document.getElementById('deleteMessage');
        const confirmDeleteBtn = document.getElementById('confirmDelete');
        const cancelDeleteBtn = document.getElementById('cancelDelete');

        // Bulk delete
        document.getElementById('bulkDelete').addEventListener('click', function() {
            const selected = document.querySelectorAll('.attempt-checkbox:checked');
            if (selected.length === 0) return;
            
            deleteType = 'bulk';
            deleteIds = Array.from(selected).map(cb => cb.value);
            deleteMessage.textContent = `Are you sure you want to delete ${selected.length} login attempts? This action cannot be undone.`;
            deleteModal.classList.remove('hidden');
        });

        // Single delete (will be handled by event delegation)
        document.addEventListener('click', function(e) {
            if (e.target.closest('.delete-single')) {
                e.preventDefault();
                const attemptId = e.target.closest('.delete-single').dataset.id;
                deleteType = 'single';
                deleteIds = [attemptId];
                deleteMessage.textContent = 'Are you sure you want to delete this login attempt? This action cannot be undone.';
                deleteModal.classList.remove('hidden');
            }
        });

        // Cancel delete
        cancelDeleteBtn.addEventListener('click', function() {
            deleteModal.classList.add('hidden');
            deleteIds = [];
        });

        // Confirm delete
        confirmDeleteBtn.addEventListener('click', function() {
            const btnText = confirmDeleteBtn.querySelector('.btn-text');
            const spinner = confirmDeleteBtn.querySelector('.fa-spinner');
            
            btnText.style.display = 'none';
            spinner.classList.remove('hidden');
            confirmDeleteBtn.disabled = true;
            
            if (deleteType === 'bulk') {
                bulkDeleteAttempts(deleteIds);
            } else {
                deleteSingleAttempt(deleteIds[0]);
            }
        });

        // Close modal on outside click
        deleteModal.addEventListener('click', function(e) {
            if (e.target === deleteModal) {
                deleteModal.classList.add('hidden');
                deleteIds = [];
            }
        });

        function updateBulkActions() {
            const selected = document.querySelectorAll('.attempt-checkbox:checked');
            const bulkActions = document.getElementById('bulkActions');
            const selectedCount = document.getElementById('selectedCount');
            
            if (selected.length > 0) {
                bulkActions.classList.remove('hidden');
                selectedCount.textContent = selected.length;
            } else {
                bulkActions.classList.add('hidden');
            }
        }

        function filterAttempts() {
            const searchValue = document.getElementById('searchInput').value;

            const params = new URLSearchParams({
                search: searchValue,
                platform: document.getElementById('platformFilter').value,
                status: document.getElementById('statusFilter').value,
                date_from: document.getElementById('dateFrom').value,
                date_to: document.getElementById('dateTo').value
            });

            fetch('{{ route("admin.login-attempts") }}?' + params, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('attemptsContainer').innerHTML = data.html;
                maintainSelections();
            })
            .catch(error => console.error('Error:', error));
        }

        function maintainSelections() {
            // Re-apply bulk action state after AJAX refresh
            const selected = document.querySelectorAll('.attempt-checkbox:checked');
            selected.forEach(cb => {
                cb.closest('tr').classList.add('bg-blue-50', 'dark:bg-blue-900');
            });
            updateBulkActions();
        }

        function bulkDeleteAttempts(ids) {
            fetch('{{ route("admin.login-attempts.bulk-delete") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ ids: ids })
            })
            .then(response => response.json())
            .then(data => {
                resetDeleteModal();
                if (data.success) {
                    filterAttempts();
                    document.getElementById('bulkActions').classList.add('hidden');
                } else {
                    alert('Error deleting attempts');
                }
            })
            .catch(error => {
                resetDeleteModal();
                console.error('Error:', error);
            });
        }

        function deleteSingleAttempt(id) {
            fetch(`/saheed/admin/login-attempts/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                resetDeleteModal();
                if (data.success) {
                    filterAttempts();
                } else {
                    alert('Error deleting attempt');
                }
            })
            .catch(error => {
                resetDeleteModal();
                console.error('Error:', error);
            });
        }

        function resetDeleteModal() {
            const btnText = confirmDeleteBtn.querySelector('.btn-text');
            const spinner = confirmDeleteBtn.querySelector('.fa-spinner');
            
            btnText.style.display = 'inline';
            spinner.classList.add('hidden');
            confirmDeleteBtn.disabled = false;
            deleteModal.classList.add('hidden');
            deleteIds = [];
        }

        // Real-time data refresh every 10 seconds
        setInterval(() => {
            // Only refresh if no search/filter is active to avoid disrupting user interaction
            const hasActiveFilters = document.getElementById('searchInput').value || 
                                   document.getElementById('platformFilter').value || 
                                   document.getElementById('statusFilter').value || 
                                   document.getElementById('dateFrom').value || 
                                   document.getElementById('dateTo').value;
            
            if (!hasActiveFilters) {
                const params = new URLSearchParams({
                    search: '',
                    platform: '',
                    status: '',
                    date_from: '',
                    date_to: ''
                });

                fetch('{{ route("admin.login-attempts") }}?' + params, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const currentContent = document.getElementById('attemptsContainer').innerHTML;
                    if (data.html !== currentContent) {
                        document.getElementById('attemptsContainer').innerHTML = data.html;
                        maintainSelections();
                    }
                })
                .catch(error => console.log('Failed to refresh login attempts:', error));
            }
        }, 10000);


    </script>
</x-admin-layout>