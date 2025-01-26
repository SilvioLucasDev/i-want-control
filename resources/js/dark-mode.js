export function applyDarkMode() {
    var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    var themeToggleText = document.getElementById('theme-toggle-text');
    var themeToggleCheckbox = document.getElementById('theme-toggle-checkbox');

    var themeToggleDarkIconMobile = document.getElementById('theme-toggle-dark-icon-mobile');
    var themeToggleLightIconMobile = document.getElementById('theme-toggle-light-icon-mobile');
    var themeToggleTextMobile = document.getElementById('theme-toggle-text-mobile');
    var themeToggleCheckboxMobile = document.getElementById('theme-toggle-checkbox-mobile');

    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
        themeToggleCheckbox.checked = true;
        themeToggleCheckboxMobile.checked = true;
        themeToggleDarkIcon.classList.add('hidden');
        themeToggleLightIcon.classList.remove('hidden');
        themeToggleDarkIconMobile.classList.add('hidden');
        themeToggleLightIconMobile.classList.remove('hidden');
        themeToggleText.textContent = 'Dark Mode';
        themeToggleTextMobile.textContent = 'Dark Mode';
    } else {
        document.documentElement.classList.remove('dark');
        themeToggleCheckbox.checked = false;
        themeToggleCheckboxMobile.checked = false;
        themeToggleDarkIcon.classList.remove('hidden');
        themeToggleLightIcon.classList.add('hidden');
        themeToggleDarkIconMobile.classList.remove('hidden');
        themeToggleLightIconMobile.classList.add('hidden');
        themeToggleText.textContent = 'Light Mode';
        themeToggleTextMobile.textContent = 'Light Mode';
    }

    themeToggleCheckbox.addEventListener('change', function () {
        updateTheme(themeToggleCheckbox.checked);
    });

    themeToggleCheckboxMobile.addEventListener('change', function () {
        updateTheme(themeToggleCheckboxMobile.checked);
    });

    function updateTheme(isDarkMode) {
        if (isDarkMode) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
            themeToggleDarkIcon.classList.add('hidden');
            themeToggleLightIcon.classList.remove('hidden');
            themeToggleDarkIconMobile.classList.add('hidden');
            themeToggleLightIconMobile.classList.remove('hidden');
            themeToggleText.textContent = 'Dark Mode';
            themeToggleTextMobile.textContent = 'Dark Mode';
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
            themeToggleDarkIcon.classList.remove('hidden');
            themeToggleLightIcon.classList.add('hidden');
            themeToggleDarkIconMobile.classList.remove('hidden');
            themeToggleLightIconMobile.classList.add('hidden');
            themeToggleText.textContent = 'Light Mode';
            themeToggleTextMobile.textContent = 'Light Mode';
        }
        themeToggleCheckbox.checked = isDarkMode;
        themeToggleCheckboxMobile.checked = isDarkMode;
    }
}
