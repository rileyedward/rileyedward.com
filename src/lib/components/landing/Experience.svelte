<script lang="ts">
	interface IExperience {
		position: string;
		company: string;
		timeline: string;
		description: string;
		technology: string;
	}

	const experiences: IExperience[] = [
		{
			position: 'Software Engineer',
			company: 'EmpowerFresh Co.',
			timeline: 'Aug 2024 - Present',
			description:
				'At EmpowerFresh Co., I partner with Independent Retail Grocers to provide tools and real-time data, helping produce staff optimize operations, train teams, reduce food waste, and remain competitive.',
			technology: 'TypeScript, SvelteKit, PostgreSQL, Docker, AWS'
		},
		{
			position: 'Software Engineer',
			company: 'Midwestern Interactive',
			timeline: 'Nov 2021 - Jul 2024',
			description:
				'Collaborated with a team to build custom software solutions for clients in various sectors, including school lunch programs, ISPs, and big data analytics.',
			technology: 'PHP, Laravel, JavaScript, Vue, React, MySQL, Docker, AWS'
		},
		{
			position: 'Web Developer',
			company: 'Missouri State University',
			timeline: 'Jan 2020 - Nov 2021',
			description:
				'Designed, developed, and maintained web applications, providing digital solutions for the university’s community of students, faculty, and staff.',
			technology: 'C#, .NET, JavaScript, React, MsSQL'
		}
	];
</script>

<div class="max-w-4xl mx-auto py-24 px-8 flex flex-col gap-20">
	{#each experiences as experience, i}
		<div class="flex flex-col md:flex-row gap-12 bg-neutral-800 p-6 rounded-2xl">
			<div class="w-full md:w-1/2">
				<div class="text-sm font-semibold text-gray-400 mb-2 flex items-center gap-2">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-neutral-500" viewBox="0 0 20 20" fill="currentColor"><path d="M5.05 4.05a7 7 0 000 11.9 7 7 0 0010.9 0 7 7 0 00-10.9-11.9zm4.95 9.9a4 4 0 110-8 4 4 0 010 8z" /></svg>
					{experience.timeline}
				</div>
				<div class="mb-4">
					<h3 class="text-3xl font-bold text-white">{experience.position}</h3>
					<h5 class="text-xl text-violet-400 font-medium flex items-center gap-2">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-violet-400" viewBox="0 0 20 20" fill="currentColor"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 13V7h2v6H9z" /></svg>
						{experience.company}
					</h5>
				</div>
				<div class="text-gray-400 font-semibold flex flex-wrap gap-2">
					{#each experience.technology.split(', ') as tech}
						<span class="bg-neutral-700 px-2 py-1 rounded text-sm text-neutral-100">{tech}</span>
					{/each}
				</div>
			</div>
			<div class="w-full md:w-1/2">
				<p class="text-gray-200 leading-relaxed">{experience.description}</p>
			</div>
		</div>
	{/each}
</div>