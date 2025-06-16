document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('search-category');
    const categoryList = document.getElementById('category-list');

    if (!input || !categoryList) return;

    input.addEventListener('keyup', function () {
        const query = this.value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/admin/categories/search?q=${query}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            let html = '';

            if (data.length === 0) {
                html = `<p class="p-8 text-gray-500">Tidak ada kategori ditemukan.</p>`;
            } else {
                data.forEach(category => {
                    html += `
                        <div class="flex items-center w-full justify-between p-8 gap-4 border-b border-gray-200">
                            <div class="flex items-center gap-4">
                                <img src="/assets/images/photos/category-course.png" class="w-16 h-auto rounded-full">
                                <div class="flex flex-col w-full max-w-xs">
                                    <h1 class="text-xl font-semibold break-words text-left">${category.name}</h1>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <a href="/admin/categories/${category.id}/edit" class="flex items-center px-6 py-3 text-white bg-primary rounded-full hover:opacity-90 transition-colors">
                                    <span class="font-medium">Edit</span>
                                </a>
                                <form action="/admin/categories/${category.id}" method="POST" class="delete-category-form">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="flex items-center px-6 py-3 text-white bg-[#FF0000] rounded-full hover:opacity-90 transition-colors">
                                        <span class="font-medium">Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    `;
                });
            }

            categoryList.innerHTML = html;

            if (typeof attachDeleteSwal === 'function') {
                attachDeleteSwal();
            }
        })
        .catch(error => {
            console.error('Error fetching categories:', error);
            categoryList.innerHTML = `<p class="p-8 text-red-500">Gagal memuat kategori.</p>`;
        });
    });
});
