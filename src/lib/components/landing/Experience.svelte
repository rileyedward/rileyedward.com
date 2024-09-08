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

<div class="max-w-4xl mx-auto py-24 px-8 flex flex-col md:flex-row gap-8 md:gap-0">
	<div class="flex flex-col gap-20">
		{#each experiences as experience}
			<div class="flex flex-col md:flex-row gap-8 md:gap-16">
				<div class="w-full md:w-1/2">
					<div class="text-base font-semibold text-gray-300 mb-4">
						{experience.timeline}
					</div>

					<div class="mb-4">
						<h3 class="text-2xl font-bold mb-1">{experience.position}</h3>
						<h5 class="text-xl text-violet-400 font-medium">
							{experience.company}
						</h5>
					</div>

					<div>
						<p class="text-gray-400 font-semibold">
							{experience.technology}
						</p>
					</div>
				</div>

				<div class="w-full md:w-1/2">
					<p class="text-gray-50 leading-loose">{experience.description}</p>
				</div>
			</div>
		{/each}
	</div>
</div>
