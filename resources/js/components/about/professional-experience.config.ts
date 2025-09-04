import type { ProfessionalExperience } from '@/types/components/about/professional-experience';

export const professionalExperiences: ProfessionalExperience[] = [
    {
        id: 'schier-products',
        company: 'Schier Products',
        position: 'Software Engineer II',
        startDate: '2025-09',
        location: 'Shawnee, KS',
        companySize: 'medium',
        description:
            'Developing and maintaining enterprise software solutions using modern web technologies. Collaborating with cross-functional teams to design, implement, and optimize applications that drive business efficiency and enhance customer experience.',
        technologies: ['Laravel', 'PHP', 'TypeScript', 'Vue', 'PostgreSQL', 'AWS'],
    },
    {
        id: 'active-logic',
        company: 'Active Logic',
        position: 'Software Engineer',
        startDate: '2025-01',
        endDate: '2025-08',
        location: 'Kansas City, MO',
        companySize: 'small',
        description:
            'Engineered and maintained sophisticated web applications for clients utilizing cutting-edge technology stacks. Collaborated effectively with cross-functional teams to deliver robust, scalable software solutions that exceeded client expectations.',
        keyAchievements: [
            'Led critical components in the development of an innovative Document Management System platform tailored for agriculture and power tool manufacturing sectors.',
            'Planned and designed the structure for a full-stack project skeleton to use as a template starter kit internally.',
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
        description:
            'Completed full-stack development initiatives in a fast-paced startup environment, wearing multiple hats across development, DevOps, and customer success. Implemented core product features, established cloud infrastructure, and worked directly with customers to drive product adoption and improvements.',
        keyAchievements: [
            'Spearheaded the architectural redesign of data ingestion pipeline, resulting in enhanced reporting capabilities and actionable analytics for customer operations.',
            'Participated in business discussions to identify and prioritize product features, ensuring the development team was on-track to deliver on time and on budget.',
            'Conducted on-site customer visits to deliver hands-on training, gather feedback, and implement system improvements based on direct user insights.',
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
        description:
            'Spearheaded development of custom web solutions for diverse client portfolio, ensuring seamless communication and timely delivery of projects. Worked directly with clients to gather requirements, provide technical consultation, and implement innovative solutions that met their business objectives.',
        keyAchievements: [
            'Designed and developed comprehensive big data analysis and web analytics tools, ensuring data integrity and system reliability.',
            'Delivered new features and improvements to a large-scale web application used to deliver school lunches to dozens of schools across the country.',
            'Developed and maintained internal tools and admin panels for a large Louisiana-based internet service provider, improving operational efficiency.',
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
        companySize: 'small',
        description:
            'Developed and maintained web applications serving 25,000+ students and faculty at MSU. Collaborated with cross-functional teams to modernize legacy systems and enhance user experience.',
        keyAchievements: [
            'Engineered and executed a custom migration script to seamlessly transfer 50,000+ digital assets from legacy to modern CMS platform.',
            'Assisted in major improvements and upgrades to the campus shuttle tracking system used by the campus community.',
            'Upgraded the campus welcome center panel system to provide a more intuitive and user-friendly experience.',
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

    professionalExperiences.forEach((exp) => {
        const startDate = new Date(exp.startDate);
        const endDate = exp.endDate ? new Date(exp.endDate) : new Date();

        const monthsDiff = (endDate.getFullYear() - startDate.getFullYear()) * 12 + (endDate.getMonth() - startDate.getMonth());

        totalMonths += monthsDiff;
    });

    const totalYears = Math.floor(totalMonths / 12);
    const remainingMonths = totalMonths % 12;

    return { totalYears, totalMonths: remainingMonths };
};
