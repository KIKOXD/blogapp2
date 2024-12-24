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
                const notification = document.createElement('div');
                notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                notification.textContent = 'Status berhasil diubah';
                document.body.appendChild(notification);
                setTimeout(() => notification.remove(), 3000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            event.target.checked = !event.target.checked;
            alert('Gagal mengubah status');
        });
}
