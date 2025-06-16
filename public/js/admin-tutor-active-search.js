document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-tutor');
    const tutorList = document.getElementById('tutor-list');

    searchInput.addEventListener('input', function () {
        const query = this.value.trim();

        fetch(`/admin/tutor-aktif/search?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                tutorList.innerHTML = '';

                if (data.length === 0) {
                    tutorList.innerHTML = '<p class="p-8">Belum ada tutor yang aktif.</p>';
                    return;
                }

                data.forEach(tutor => {
                    const user = tutor.user;
                    const github = tutor.github_url ? `
                        <div class="flex items-center gap-3 p-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <img src="/assets/images/icons/github.svg" alt="GitHub Icon" class="w-5 h-5 flex-shrink-0">
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-gray-700 truncate">GitHub</p>
                                <a href="${tutor.github_url}" target="_blank"
                                   class="text-blue-600 hover:text-blue-800 hover:underline text-xs flex items-center">
                                    Buka profil
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            </div>
                        </div>` : '';

                    const linkedin = tutor.linkedin_url ? `
                        <div class="flex items-center gap-3 p-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <img src="/assets/images/icons/linkedin.svg" alt="LinkedIn Icon" class="w-5 h-5 flex-shrink-0">
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-gray-700 truncate">LinkedIn</p>
                                <a href="${tutor.linkedin_url}" target="_blank"
                                   class="text-blue-600 hover:text-blue-800 hover:underline text-xs flex items-center">
                                    Buka profil
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            </div>
                        </div>` : '';

                    const portofolio = tutor.portofolio ? `
                        <div class="flex items-center gap-3 p-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <img src="/assets/images/icons/portfolio.svg" alt="Portfolio Icon" class="w-5 h-5 flex-shrink-0">
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-gray-700 truncate">Portofolio</p>
                                <a href="/storage/${tutor.portofolio}" target="_blank"
                                   class="text-blue-600 hover:text-blue-800 hover:underline text-xs flex items-center">
                                    Lihat PDF
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            </div>
                        </div>` : '';

                    const tutorCard = `
                        <div class="flex flex-col md:flex-row items-start md:items-center w-full justify-between p-6 gap-6 border-b border-gray-200 last:border-b-0">
                            <div class="flex items-start gap-4 w-full md:w-auto">
                                <img src="/assets/images/icons/user.svg" alt="User Icon" class="w-16 h-16 rounded-full flex-shrink-0">
                                <div class="flex-1 min-w-0">
                                    <h1 class="text-xl font-semibold text-gray-800 break-words">${user.name}</h1>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 mt-4">
                                        ${github}
                                        ${linkedin}
                                        ${portofolio}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    tutorList.insertAdjacentHTML('beforeend', tutorCard);
                });
            })
            .catch(error => {
                tutorList.innerHTML = `<p class="p-8 text-red-500">Terjadi kesalahan saat mencari tutor.</p>`;
                console.error('Fetch error:', error);
            });
    });
});