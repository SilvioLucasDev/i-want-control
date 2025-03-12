import { Project } from '@/Pages/Settings/Projects.vue';
import axios from 'axios';
import { inject, InjectionKey, onMounted, provide, Ref, ref } from 'vue';

const PROJECT_METHOD_KEY: InjectionKey<{
    isProjects: Ref<Project[]>;
    addProjects: (project: Project) => void;
    fetchProjects: () => void
}> = Symbol('projectType');

export function provideProjectMethod(): void {
    const isProjects: Ref<Project[]> = ref([]);

    const addProjects = (project: Project): void => {
        isProjects.value.push(project);
    };

    const fetchProjects = async () => {
        try {
            const { data } = await axios.get('/projects');
            isProjects.value = data.data;
        } catch (error) {
            isProjects.value = [];
        }
    };

    provide(PROJECT_METHOD_KEY, { isProjects, addProjects, fetchProjects });
}

export function useProjectType() {
    const projectMethod = inject(PROJECT_METHOD_KEY);

    if (!projectMethod) {
        throw new Error('useProjectType must be used within a provideProjectMethod');
    }

    return projectMethod;
}
