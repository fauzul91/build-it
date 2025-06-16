function setupCompletionButton(videoId, title, completed, link = null) {
    const completionStatus = document.getElementById('completion-status');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if (completionStatus) {
        if (completed === 'yes') {
            completionStatus.innerHTML = `
                <span class="inline-block bg-black text-white px-6 py-4 rounded-full font-semibold">
                    Video ini telah ditandai selesai
                </span>
            `;
        } else {
            completionStatus.innerHTML = `
                <button id="mark-complete-button"
                    class="bg-primary hover:opacity-90 cursor-pointer text-white px-6 py-4 rounded-full font-semibold"
                    data-id="${videoId}">
                    Tandai Selesai
                </button>
            `;

            const markButton = document.getElementById('mark-complete-button');
            markButton.addEventListener('click', function () {
                fetch(`/kelas-saya/progress/${videoId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                }).then(res => {
                    if (!res.ok) throw new Error('Gagal menandai selesai');
                    return res.json();
                }).then(() => {
                    completionStatus.innerHTML = `
                        <span class="inline-block bg-black text-white px-6 py-4 rounded-full font-semibold">
                            Video ini telah ditandai selesai
                        </span>
                    `;
                    if (link) {
                        link.dataset.completed = 'yes';
                        link.innerHTML = `✔️ ${title}`;
                    }
                }).catch(err => alert(err.message));
            });
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const videoLinks = document.querySelectorAll('.video-link');
    const iframe = document.querySelector('iframe');
    const videoTitle = document.querySelector('h2.text-xl');

    if (videoLinks.length > 0) {
        const firstLink = videoLinks[0];
        const title = firstLink.dataset.title;
        const youtubeId = firstLink.dataset.youtubeId;
        const completed = firstLink.dataset.completed;
        const videoId = firstLink.dataset.id;

        // Tampilkan video pertama
        iframe.src = `https://www.youtube.com/embed/${youtubeId}`;
        videoTitle.textContent = title;

        // Highlight video pertama
        firstLink.classList.add('bg-primary', 'text-white', 'font-bold');
        videoLinks.forEach(l => {
            if (l !== firstLink) {
                l.classList.remove('bg-primary', 'text-white', 'font-bold');
                l.classList.add('bg-light-grey', 'text-font');
            }
        });

        // Setup tombol tandai selesai pertama kali
        setupCompletionButton(videoId, title, completed, firstLink);
    }

    videoLinks.forEach(link => {
        link.addEventListener('click', function () {
            const title = this.dataset.title;
            const youtubeId = this.dataset.youtubeId;
            const completed = this.dataset.completed;
            const videoId = this.dataset.id;

            iframe.src = `https://www.youtube.com/embed/${youtubeId}`;
            videoTitle.textContent = title;

            videoLinks.forEach(l => {
                l.classList.remove('bg-primary', 'text-white', 'font-bold');
                l.classList.add('bg-light-grey', 'text-font');
            });
            this.classList.add('bg-primary', 'text-white', 'font-bold');

            setupCompletionButton(videoId, title, completed, this);
        });
    });
});