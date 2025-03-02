import { inject, InjectionKey, provide, Ref, ref } from 'vue';

const EDIT_MODE_KEY: InjectionKey<{
    isEditing: Ref<boolean>;
    toggleEditMode: () => void;
}> = Symbol('editMode');

export function provideEditMode(): void {
    const isEditing = ref(false);

    const toggleEditMode = (): void => {
        isEditing.value = !isEditing.value;
    };

    provide(EDIT_MODE_KEY, { isEditing, toggleEditMode });
}

export function useEditMode() {
    const editMode = inject(EDIT_MODE_KEY);

    if (!editMode) {
        throw new Error('useEditMode must be used within a provideEditMode');
    }

    return editMode;
}
