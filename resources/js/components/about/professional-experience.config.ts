import type { ProfessionalExperience } from '@/types/components/about/professional-experience';

export const professionalExperiences: ProfessionalExperience[] = [
    {
        id: 'active-logic',
        company: 'Active Logic',
        position: 'Software Engineer',
        startDate: '2025-01',
        location: 'Kansas City, MO',
        companySize: 'small',
        description: 'Led full-stack development of customer-facing web applications serving 100K+ users. Collaborated with cross-functional teams to deliver high-quality software solutions and mentor junior developers.',
        keyAchievements: [
            'Architected and built a new customer portal that increased user engagement by 40%',
            'Reduced application load times by 60% through performance optimization initiatives',
            'Mentored 3 junior developers and led code review processes for the team',
            'Implemented automated testing suite that reduced bugs in production by 35%'
        ],
        technologies: ['Laravel', 'PHP', 'TypeScript', 'Vue', 'PostgreSQL'],
    },
    {
        id: 'empower-fresh',
        company: 'Empower Fresh',
        position: 'Software Engineer',
        startDate: '2024-08',
        endDate: '2025-01',
        location: 'Kansas City, MO',
        companySize: 'startup',
        description: 'Led full-stack development of customer-facing web applications serving 100K+ users. Collaborated with cross-functional teams to deliver high-quality software solutions and mentor junior developers.',
        keyAchievements: [
            'Architected and built a new customer portal that increased user engagement by 40%',
            'Reduced application load times by 60% through performance optimization initiatives',
            'Mentored 3 junior developers and led code review processes for the team',
            'Implemented automated testing suite that reduced bugs in production by 35%'
        ],
        technologies: ['Svelte Kit', 'TypeScript', 'PostgreSQL', 'Node', 'Docker', 'AWS'],
    },
    {
        id: 'midwestern-interactive',
        company: 'Midwestern Interactive',
        position: 'Software Engineer',
        startDate: '2021-11',
        endDate: '2024-08',
        location: 'Springfield, MO',
        companySize: 'medium',
        description: 'Led full-stack development of customer-facing web applications serving 100K+ users. Collaborated with cross-functional teams to deliver high-quality software solutions and mentor junior developers.',
        keyAchievements: [
            'Architected and built a new customer portal that increased user engagement by 40%',
            'Reduced application load times by 60% through performance optimization initiatives',
            'Mentored 3 junior developers and led code review processes for the team',
            'Implemented automated testing suite that reduced bugs in production by 35%'
        ],
        technologies: ['Laravel', 'PHP', 'TypeScript', 'Vue', 'MySQL'],
    },
    {
        id: 'missouri-state-university',
        company: 'Missouri State University',
        position: 'Web Developer',
        startDate: '2020-01',
        endDate: '2021-11',
        location: 'Springfield, MO',
        companySize: 'medium',
        description: 'Led full-stack development of customer-facing web applications serving 100K+ users. Collaborated with cross-functional teams to deliver high-quality software solutions and mentor junior developers.',
        keyAchievements: [
            'Architected and built a new customer portal that increased user engagement by 40%',
            'Reduced application load times by 60% through performance optimization initiatives',
            'Mentored 3 junior developers and led code review processes for the team',
            'Implemented automated testing suite that reduced bugs in production by 35%'
        ],
        technologies: ['.NET', 'C#', 'React', 'JavaScript', 'HTML', 'CSS'],
    },
];

export const getCompanySizeLabel = (size: ProfessionalExperience['companySize']): string => {
    switch (size) {
        case 'startup':
            return 'Startup (< 50 employees)';
        case 'small':
            return 'Small Company (50-200 employees)';
        case 'medium':
            return 'Medium Company (200-1000 employees)';
        case 'large':
            return 'Large Company (1000-5000 employees)';
        case 'enterprise':
            return 'Enterprise (5000+ employees)';
        default:
            return 'Company';
    }
};

export const calculateExperience = (): { totalYears: number; totalMonths: number } => {
    let totalMonths = 0;

    professionalExperiences.forEach(exp => {
        const startDate = new Date(exp.startDate);
        const endDate = exp.endDate ? new Date(exp.endDate) : new Date();

        const monthsDiff = (endDate.getFullYear() - startDate.getFullYear()) * 12 +
                          (endDate.getMonth() - startDate.getMonth());

        totalMonths += monthsDiff;
    });

    const totalYears = Math.floor(totalMonths / 12);
    const remainingMonths = totalMonths % 12;

    return { totalYears, totalMonths: remainingMonths };
};
