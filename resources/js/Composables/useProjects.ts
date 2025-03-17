import { useToast } from '@/Composables/useToast';

import { Project } from '@/Pages/Settings/Projects.vue';

import axios from 'axios';
import { inject, InjectionKey, onMounted, provide, Ref, ref } from 'vue';

const PROJECTS_KEY: InjectionKey<{
    projects: Ref<Project[]>;
    addProject: (project: Project) => Promise<boolean>;
    updateProject: (project: Project) => Promise<void>;
    removeProject: (id: number) => Promise<void>;
}> = Symbol('projects');

export function provideProjects(): void {
    const { triggerToast } = useToast();
    const projects: Ref<Project[]> = ref([]);

    const fetchProjects = async () => {
        try {
            const { data } = await axios.get('/projects');
            projects.value = data.data.map((item: any) => ({
                ...item,
                hourlyRate: item.hourly_rate,
                isEditing: false,
            }));
        } catch (error) {
            triggerToast('error', 'Erro ao carregar projetos.');
            projects.value = [];
        }
    };

    const addProject = async (project: Project): Promise<boolean> => {
        try {
            const { data } = await axios.post('/projects', {
                type: project.type,
                hourly_rate: project.hourlyRate,
            });

            projects.value.push({
                ...data.data,
                hourlyRate: data.data.hourly_rate,
                isEditing: false,
            });

            triggerToast('success', 'Projeto adicionado com sucesso!');
            return true;
        } catch (error) {
            handleApiError(error, 'Erro ao adicionar projeto.');
            return false;
        }
    };

    const updateProject = async (project: Project): Promise<void> => {
        try {
            await axios.put(`/projects/${project.id}`, {
                type: project.type,
                hourly_rate: project.hourlyRate,
            });

            const index = projects.value.findIndex((item) => item.id === project.id);
            if (index !== -1) {
                projects.value[index] = { ...project, isEditing: false };
            }

            triggerToast('success', 'Projeto atualizado com sucesso!');
        } catch (error) {
            handleApiError(error, 'Erro ao atualizar projeto.');
        }
    };

    const removeProject = async (projectId: number): Promise<void> => {
        try {
            await axios.delete(`/projects/${projectId}`);

            projects.value = projects.value.filter((item) => item.id !== projectId);
            triggerToast('success', 'Projeto removido com sucesso!');
        } catch (error) {
            handleApiError(error, 'Erro ao remover projeto.');
        }
    };

    const handleApiError = (error: any, defaultMessage: string) => {
        if (axios.isAxiosError(error) && error.response) {
            if (error.response.status === 422) {
                const errors = error.response.data?.errors;

                if (errors && typeof errors === 'object') {
                    const allErrors: string[] = Object.values(errors).flatMap((err) => (Array.isArray(err) ? err : [String(err)]));

                    allErrors.forEach((errorMessage) => {
                        triggerToast('error', errorMessage);
                    });
                } else {
                    triggerToast('error', error.response.data?.message || 'Erro de validação.');
                }
            } else {
                triggerToast('error', error.response.data?.message || defaultMessage);
            }
        } else {
            triggerToast('error', defaultMessage);
        }
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
