import { Project } from '@/Pages/Settings/Projects.vue';
import axios from 'axios';
import { inject, InjectionKey, onMounted, provide, Ref, ref } from 'vue';

const PROJECTS_KEY: InjectionKey<{
    projects: Ref<Project[]>;
    addProject: (project: Project) => void;
}> = Symbol('projects');

export function provideProjects(): void {
    const projects: Ref<Project[]> = ref([]);

    const addProject = (project: Project): void => {
        projects.value.push(project);
    };

    // TODO :: MELHORAR ISSO, TALVEZ VIRAR UM COMPONENT DE FETCH QUE SUBA UM POPUP DE ERRO E ETC
    const fetchProjects = async () => {
        try {
            const { data } = await axios.get('/projects');
            projects.value = data.data;
        } catch (error) {
            projects.value = [];
        }
    };

    onMounted(fetchProjects);

    provide(PROJECTS_KEY, { projects, addProject });
}

export function useProjects() {
    const projects = inject(PROJECTS_KEY);

    if (!projects) {
        throw new Error('useProjects must be used within a provideProjects');
    }

    return projects;
}
