import { defineConfigWithVueTs, vueTsConfigs } from '@vue/eslint-config-typescript';
import eslintConfigPrettier from 'eslint-config-prettier/flat';
import pluginVue from 'eslint-plugin-vue';

export default [
    ...defineConfigWithVueTs(pluginVue.configs['flat/essential'], vueTsConfigs.recommended, { ignores: ['vendor', 'node_modules', 'public', 'bootstrap/ssr', 'tailwind.config.js'] }),
    eslintConfigPrettier,
    { rules: { 'vue/multi-word-component-names': 'off', 'no-undef': 'off', '@typescript-eslint/no-explicit-any': 'off' } },
];
