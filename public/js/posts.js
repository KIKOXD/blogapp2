// Tambahkan di awal file
document.addEventListener('DOMContentLoaded', function () {
    // Create notification container if not exists
    if (!document.getElementById('notification-container')) {
        const container = document.createElement('div');
        container.id = 'notification-container';
        container.className = 'fixed top-4 right-4 z-50 flex flex-col gap-2';
        document.body.appendChild(container);
    }
});

// Functions for modal
function openModal(imageSrc, imageAlt) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    modalImg.src = imageSrc;
    modalImg.alt = imageAlt;
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

// Bulk actions handling
function handleBulkAction() {
    const action = document.getElementById('bulk-action').value;
    const selectedPosts = Array.from(document.getElementsByClassName('post-checkbox'))
        .filter(cb => cb.checked)
        .map(cb => cb.value);

    if (selectedPosts.length === 0) {
        showNotification('Silakan pilih minimal satu postingan', 'error');
        return;
    }

    let url, message, confirmMessage;

    switch (action) {
        case 'delete':
            url = '/admin/posts/bulk-delete';
            message = 'menghapus';
            confirmMessage = 'Apakah Anda yakin ingin menghapus semua postingan yang dipilih?';
            break;
        default:
            showNotification('Pilih aksi yang valid', 'error');
            return;
    }

    if (!confirm(confirmMessage)) {
        return;
    }

    const formData = new FormData();
    selectedPosts.forEach(postId => {
        formData.append('posts[]', postId);
    });

    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
    formData.append('_method', action === 'delete' ? 'DELETE' : 'PATCH');

    fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                setTimeout(() => window.location.reload(), 1500);
            } else {
                showNotification(data.message || 'Terjadi kesalahan', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan saat ' + message + ' postingan', 'error');
        });
}

// Notification handling
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `transform transition-all duration-300 ease-out scale-95 opacity-0 
        ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} 
        text-white px-6 py-3 rounded-lg shadow-lg mb-4`;
    notification.textContent = message;

    const container = document.getElementById('notification-container');
    container.appendChild(notification);

    setTimeout(() => {
        notification.classList.remove('scale-95', 'opacity-0');
        notification.classList.add('scale-100', 'opacity-100');
    }, 10);

    setTimeout(() => {
        notification.classList.add('scale-95', 'opacity-0');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Status toggle handling
function toggleStatus(postId) {
    fetch(`/admin/posts/${postId}/toggle-status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Status berhasil diubah');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            event.target.checked = !event.target.checked;
            showNotification('Gagal mengubah status', 'error');
        });
}

// Filter and sort handling
let sortDirection = 'desc';

function sortByDate() {
    const currentUrl = new URL(window.location.href);
    sortDirection = sortDirection === 'desc' ? 'asc' : 'desc';
    currentUrl.searchParams.set('sort', 'date');
    currentUrl.searchParams.set('direction', sortDirection);
    window.location.href = currentUrl.toString();
}

function applyFilters() {
    const form = document.querySelector('form');
    form.submit();
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function () {
    // Modal click outside
    document.getElementById('imageModal').addEventListener('click', function (e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Select all checkbox
    document.getElementById('select-all').addEventListener('change', function () {
        const checkboxes = document.getElementsByClassName('post-checkbox');
        for (let checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });
});
