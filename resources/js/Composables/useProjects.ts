import { useFetch, useFetchError } from '@/Composables/useFetch';
import { useToast } from '@/Composables/useToast';

import { Project } from '@/Pages/Settings/Projects.vue';

import { inject, InjectionKey, onMounted, provide, Ref, ref } from 'vue';

type ApiProject = Omit<Project, 'hourlyRate'> & { hourly_rate: string };

const PROJECTS_KEY: InjectionKey<{
    projects: Ref<Project[]>;
    addProject: (project: Project) => Promise<boolean>;
    updateProject: (project: Project) => Promise<boolean>;
    removeProject: (id: number) => Promise<boolean>;
}> = Symbol('projects');

export function provideProjects(): void {
    const { triggerToast } = useToast();
    const { handleError } = useFetchError();

    const projects: Ref<Project[]> = ref([]);

    const fetchProjects = async (): Promise<boolean> => {
        const { data, error } = await useFetch<ApiProject[]>(route('projects.get-projects-by-user'));

        if (error.value || !data.value) {
            handleError(error.value, 'Erro ao carregar projetos.');
            projects.value = [];
            return false;
        }

        projects.value = data.value.map((item) => ({
            ...item,
            hourlyRate: item.hourly_rate,
            isEditing: false,
        }));
        return true;
    };

    const addProject = async (project: Project): Promise<boolean> => {
        const { data, error } = await useFetch<ApiProject>(route('projects.store'), {
            method: 'POST',
            data: {
                name: project.name,
                hourly_rate: project.hourlyRate,
            },
        });

        if (error.value || !data.value) {
            handleError(error.value, 'Erro ao adicionar projeto.');
            return false;
        }

        projects.value.push({
            ...data.value,
            hourlyRate: data.value.hourly_rate,
            isEditing: false,
        });

        triggerToast('success', 'Projeto adicionado com sucesso!');
        return true;
    };

    const updateProject = async (project: Project): Promise<boolean> => {
        const { error } = await useFetch(route('projects.update', { project: project.id }), {
            method: 'PUT',
            data: {
                name: project.name,
                hourly_rate: project.hourlyRate,
            },
        });

        if (error.value) {
            handleError(error.value, 'Erro ao atualizar projeto.');
            return false;
        }

        const index = projects.value.findIndex((item) => item.id === project.id);
        if (index !== -1) {
            projects.value[index] = { ...project, isEditing: false };
        }

        triggerToast('success', 'Projeto atualizado com sucesso!');
        return true;
    };

    const removeProject = async (projectId: number): Promise<boolean> => {
        const { error } = await useFetch(route('projects.destroy', { project: projectId }), {
            method: 'DELETE',
        });

        if (error.value) {
            handleError(error.value, 'Erro ao remover projeto.');
            return false;
        }

        projects.value = projects.value.filter((item) => item.id !== projectId);
        triggerToast('success', 'Projeto removido com sucesso!');
        return true;
    };

    onMounted(fetchProjects);

    provide(PROJECTS_KEY, { projects, addProject, updateProject, removeProject });
}

export function useProjects() {
    const projects = inject(PROJECTS_KEY);

    if (!projects) {
        throw new Error('useProjects must be used within a provideProjects');
    }

    return projects;
}
