export interface ProfessionalExperience {
    id: string;
    company: string;
    position: string;
    startDate: string;
    endDate?: string;
    location: string;
    companySize: 'startup' | 'small' | 'medium' | 'large' | 'enterprise';
    description: string;
    keyAchievements?: string[] | null;
    technologies: string[];
}

export interface ExperienceMetrics {
    totalYears: number;
    companiesWorkedAt: number;
    projectsDelivered?: number;
}
