document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('search-course');
    const courseList = document.getElementById('course-list');

    if (!input || !courseList) return;

    input.addEventListener('keyup', function () {
        const query = this.value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/admin/course-active/search?q=${query}`, {
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
                html = `<p class="p-8 text-gray-500">Tidak ada course ditemukan.</p>`;
            } else {
                data.forEach(course => {
                    html += `
                        <div class="flex items-center w-full justify-between p-8 gap-4 border-b border-gray-200">
                            <div class="flex items-center gap-4">
                                <img src="/storage/${course.thumbnail ?? 'default-placeholder.png'}" class="w-30 h-20 rounded-xl object-cover border-2 border-gray-300">
                                <div class="flex flex-col w-full max-w-xs">
                                    <h1 class="text-xl font-semibold break-words text-left">${course.name}</h1>
                                    <p class="text-font text-left opacity-70">${course.category_name ?? 'Kategori'}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <a href="/admin/courses/${course.id}" class="flex items-center px-6 py-3 text-white bg-font rounded-full hover:opacity-90 transition-colors">
                                    <span class="font-medium">Detail</span>
                                </a>
                            </div>
                        </div>
                    `;
                });
            }

            courseList.innerHTML = html;
        })
        .catch(error => {
            console.error('Error fetching courses:', error);
            courseList.innerHTML = `<p class="p-8 text-red-500">Gagal memuat course.</p>`;
        });
    });
});
