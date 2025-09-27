<x-admin-layout title="Profile">
    <div class="p-4 sm:p-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start mb-6">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl mb-4 sm:mb-0">
                            {{ strtoupper(substr($admin->name, 0, 1) . (strpos($admin->name, ' ') ? substr($admin->name, strpos($admin->name, ' ') + 1, 1) : '')) }}
                        </div>
                        <div class="sm:ml-4 text-center sm:text-left">
                            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white">Profile Settings</h1>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Manage your account information</p>
                        </div>
                    </div>

                    <div id="success-message" class="hidden mb-4 p-3 bg-green-100 dark:bg-green-900 border border-green-200 dark:border-green-700 rounded-md">
                        <p class="text-sm text-green-800 dark:text-green-200"></p>
                    </div>

                    <div class="space-y-6">
                        <!-- Name Field -->
                        <div class="profile-field" data-field="name">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                            <div class="relative">
                                <input type="text" class="field-input w-full px-3 py-2 pr-12 sm:pr-16 border border-gray-300 dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white text-sm sm:text-base" value="{{ $admin->name }}" readonly>
                                <button class="edit-btn absolute right-1 sm:right-2 top-1/2 transform -translate-y-1/2 px-1 sm:px-2 py-1 text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                    Edit
                                </button>
                                <button class="save-btn hidden absolute right-1 sm:right-2 top-1/2 transform -translate-y-1/2 px-1 sm:px-2 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">
                                    Save
                                </button>
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="profile-field" data-field="email">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                            <div class="relative">
                                <input type="email" class="field-input w-full px-3 py-2 pr-12 sm:pr-16 border border-gray-300 dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white text-sm sm:text-base" value="{{ $admin->email }}" readonly>
                                <button class="edit-btn absolute right-1 sm:right-2 top-1/2 transform -translate-y-1/2 px-1 sm:px-2 py-1 text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                    Edit
                                </button>
                                <button class="save-btn hidden absolute right-1 sm:right-2 top-1/2 transform -translate-y-1/2 px-1 sm:px-2 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">
                                    Save
                                </button>
                            </div>
                        </div>

                        <!-- Current Password Field -->
                        <div class="profile-field" data-field="current_password">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current Password</label>
                            <div class="relative">
                                <input type="password" class="field-input w-full px-3 py-2 pr-8 sm:pr-10 border border-gray-300 dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white text-sm sm:text-base" value="••••••••" readonly>
                                <button type="button" class="eye-btn absolute right-1 sm:right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 p-1">
                                    <i class="fas fa-eye text-sm"></i>
                                </button>
                            </div>
                        </div>

                        <!-- New Password Field -->
                        <div class="profile-field" data-field="password">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">New Password</label>
                            <div class="relative">
                                <input type="password" class="field-input w-full px-3 py-2 pr-12 sm:pr-16 border border-gray-300 dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white text-sm sm:text-base" placeholder="Enter new password" readonly>
                                <button class="edit-btn absolute right-1 sm:right-2 top-1/2 transform -translate-y-1/2 px-1 sm:px-2 py-1 text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                    Edit
                                </button>
                                <button class="save-btn hidden absolute right-1 sm:right-2 top-1/2 transform -translate-y-1/2 px-1 sm:px-2 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.profile-field').forEach(field => {
            const editBtn = field.querySelector('.edit-btn');
            const saveBtn = field.querySelector('.save-btn');
            const input = field.querySelector('.field-input');
            const eyeBtn = field.querySelector('.eye-btn');
            const fieldName = field.dataset.field;

            // Eye button functionality for current password
            if (eyeBtn) {
                eyeBtn.addEventListener('click', () => {
                    const icon = eyeBtn.querySelector('i');
                    if (input.type === 'password') {
                        input.type = 'text';
                        input.value = '{{ $admin->actual_password ?? "admin123" }}';
                        icon.className = 'fas fa-eye-slash';
                    } else {
                        input.type = 'password';
                        input.value = '••••••••';
                        icon.className = 'fas fa-eye';
                    }
                });
            }

            if (editBtn) {
                editBtn.addEventListener('click', () => {
                    input.readOnly = false;
                    input.classList.remove('bg-gray-50', 'dark:bg-gray-700');
                    input.classList.add('bg-white', 'dark:bg-gray-800');
                    input.focus();
                    editBtn.classList.add('hidden');
                    saveBtn.classList.remove('hidden');
                });
            }

            if (saveBtn) {
                saveBtn.addEventListener('click', () => {
                    const value = input.value.trim();
                    if (!value) {
                        alert('Please enter a value');
                        return;
                    }

                    fetch('/saheed/admin/profile/update-field', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            field: fieldName,
                            value: value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showSuccessMessage(data.message);
                            input.readOnly = true;
                            input.classList.add('bg-gray-50', 'dark:bg-gray-700');
                            input.classList.remove('bg-white', 'dark:bg-gray-800');
                            saveBtn.classList.add('hidden');
                            editBtn.classList.remove('hidden');
                            
                            if (fieldName === 'password') {
                                input.value = '';
                                input.placeholder = 'Enter new password';
                            }
                        } else {
                            alert(data.message || 'Error updating field');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error updating field');
                    });
                });
            }
        });

        // Handle Enter key for saving
        document.querySelectorAll('.field-input').forEach(input => {
            input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && !input.readOnly) {
                    const saveBtn = input.closest('.profile-field').querySelector('.save-btn');
                    if (saveBtn && !saveBtn.classList.contains('hidden')) {
                        saveBtn.click();
                    }
                }
            });
        });

        function showSuccessMessage(message) {
            const successDiv = document.getElementById('success-message');
            const messageP = successDiv.querySelector('p');
            messageP.textContent = message;
            successDiv.classList.remove('hidden');
            setTimeout(() => {
                successDiv.classList.add('hidden');
            }, 3000);
        }
    </script>
</x-admin-layout>