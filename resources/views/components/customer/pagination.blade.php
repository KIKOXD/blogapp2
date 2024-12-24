@props(['posts', 'totalPosts'])

<div class="mt-8">
    <div class="flex flex-col items-center gap-4">
        <div class="text-sm pagination-text text-gray-600">
            Menampilkan {{ $posts->firstItem() ?? 0 }} - {{ $posts->lastItem() ?? 0 }} dari {{ $totalPosts }}
            postingan
        </div>
        <div class="pagination">
            {{ $posts->onEachSide(1)->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>