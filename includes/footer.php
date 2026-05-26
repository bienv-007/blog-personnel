</main>
<footer class="border-top mt-5 py-4">
    <div class="container text-center text-muted small">
        &copy; <?= date('Y') ?> Blog personnel - Projet PHP POO
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (() => {
        const themeButton = document.querySelector('[data-theme-toggle]');
        const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
        const themes = ['auto', 'light', 'dark'];
        const labels = {
            auto: 'Thème automatique',
            light: 'Thème clair',
            dark: 'Thème sombre'
        };

        const applyTheme = (theme) => {
            const resolvedTheme = theme === 'auto'
                ? (mediaQuery.matches ? 'dark' : 'light')
                : theme;

            document.documentElement.dataset.themePreference = theme;
            document.documentElement.dataset.bsTheme = resolvedTheme;

            if (themeButton) {
                themeButton.setAttribute('aria-label', labels[theme]);
                themeButton.setAttribute('title', labels[theme]);
            }
        };

        const getSavedTheme = () => localStorage.getItem('theme-preference') || 'auto';

        applyTheme(getSavedTheme());

        themeButton?.addEventListener('click', () => {
            const currentTheme = getSavedTheme();
            const nextTheme = themes[(themes.indexOf(currentTheme) + 1) % themes.length];
            localStorage.setItem('theme-preference', nextTheme);
            applyTheme(nextTheme);
        });

        mediaQuery.addEventListener('change', () => {
            if (getSavedTheme() === 'auto') {
                applyTheme('auto');
            }
        });
    })();
</script>
</body>
</html>
