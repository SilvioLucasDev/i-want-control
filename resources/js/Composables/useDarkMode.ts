import { computed, onMounted, ref, watch } from 'vue';

export function useDarkMode() {
    const isDarkMode = ref<boolean>(false);

    const checkDarkMode = () => {
        if (localStorage.getItem('color-theme') === 'dark' || (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            isDarkMode.value = true;
        } else {
            isDarkMode.value = false;
        }
    };

    const toggleDarkMode = () => {
        isDarkMode.value = !isDarkMode.value;

        if (isDarkMode.value) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }
    };

    const themeText = computed(() => (isDarkMode.value ? 'Dark Mode' : 'Light Mode'));

    watch(isDarkMode, (newVal) => {
        if (newVal) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    });

    onMounted(() => {
        checkDarkMode();
        if (isDarkMode.value) {
            document.documentElement.classList.add('dark');
        }
    });

    return {
        isDarkMode,
        toggleDarkMode,
        themeText,
    };
}
