<script lang="ts">
	import DropdownIcon from '$lib/icons/DropdownIcon.svelte';
	import GithubIcon from '$lib/icons/GithubIcon.svelte';
	import { onMount } from 'svelte';

	export let data;

	let projectSelection = 0;
	let showOverview = false;
	let showDevelopment = false;
	let showScreenshots = false;
	let selectedScreenshot = 0;

	$: selectedProject = data.projects[projectSelection];
	$: overviewLines = selectedProject.overview.split('\n');
	$: developmentLines = selectedProject.development.split('\n');

	function selectScreenshot(index: number) {
		selectedScreenshot = index;
	}
</script>

<div class="max-w-5xl mx-auto px-6 py-8">
	<div class="max-w-md grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
		{#each data.projects as project, index}
			<button
				class={`px-4 py-2 rounded-md focus:outline-none flex justify-center items-center ${
					projectSelection === index
						? 'text-white bg-violet-500'
						: 'text-white bg-neutral-800 hover:bg-neutral-700'
				}`}
				on:click={() => {
					const tabOpen = showOverview || showDevelopment || showScreenshots;

					showOverview = false;
					showDevelopment = false;
					showScreenshots = false;

					if (tabOpen) {
						setTimeout(() => {
							projectSelection = index;
						}, 500);
					} else {
						projectSelection = index;
					}
				}}
			>
				{project.title}
			</button>
		{/each}
	</div>

	<div>
		<div class="max-w-4xl flex justify-between items-center mb-4">
			<h2 class="text-3xl font-bold">{selectedProject.title}</h2>
			{#if selectedProject.github_url}
				<a href={selectedProject.github_url} target="_blank">
					<GithubIcon />
				</a>
			{/if}
		</div>
		<p class="max-w-4xl text-base text-neutral-400">{selectedProject.description}</p>
	</div>

	<div class="my-8 space-y-8">
		<button
			class="max-w-4xl w-full bg-violet-100 rounded-lg shadow-lg transition-shadow hover:shadow-xl"
			on:click={() => (showOverview = !showOverview)}
		>
			<div class="flex justify-between items-center px-6 py-4">
				<h4 class="text-lg text-left font-semibold text-violet-900">Getting Started</h4>
				<div class={`transition-transform ${showOverview ? 'rotate-180' : ''}`}>
					<DropdownIcon />
				</div>
			</div>
			<div
				class={`overflow-hidden transition-all duration-500 ease-in-out ${showOverview ? 'max-h-screen' : 'max-h-0'}`}
			>
				<div class="px-6 py-4 text-left space-y-2">
					{#each overviewLines as line}
						<p class="text-base text-neutral-600">{line}</p>
					{/each}
				</div>
			</div>
		</button>

		<button
			class="max-w-4xl w-full bg-violet-100 rounded-lg shadow-lg transition-shadow hover:shadow-xl"
			on:click={() => (showDevelopment = !showDevelopment)}
		>
			<div class="flex justify-between items-center px-6 py-4 border-neutral-200">
				<h4 class="text-lg text-left font-semibold text-violet-900">Development</h4>
				<div class={`transition-transform ${showDevelopment ? 'rotate-180' : ''}`}>
					<DropdownIcon />
				</div>
			</div>
			<div
				class={`overflow-hidden transition-all duration-100 ease-in-out ${showDevelopment ? 'max-h-screen' : 'max-h-0'}`}
			>
				<div class="px-6 py-4 text-left space-y-2">
					{#each developmentLines as line}
						<p class="text-base text-neutral-600">{line}</p>
					{/each}
				</div>
			</div>
		</button>

		<button
			class="max-w-4xl w-full bg-violet-100 rounded-lg shadow-lg transition-shadow hover:shadow-xl"
			on:click={() => (showScreenshots = !showScreenshots)}
		>
			<div class="flex justify-between items-center px-6 py-4 border-neutral-200">
				<h4 class="text-lg text-left font-semibold text-violet-900">Screenshots</h4>
				<div class={`transition-transform ${showScreenshots ? 'rotate-180' : ''}`}>
					<DropdownIcon />
				</div>
			</div>
			<div
				class={`overflow-hidden transition-all duration-300 ease-in-out ${showScreenshots ? 'max-h-screen' : 'max-h-0'}`}
			>
				<div class="px-6 py-2">
					<div class="flex flex-col items-center">
						{#if selectedProject.images.length > 1}
							<div class="flex space-x-2 mb-4">
								{#each selectedProject.images as _, index}
									<button
										class={`w-3 md:w-4 h-3 md:h-4 rounded-full ${index === selectedScreenshot ? 'bg-violet-500' : 'bg-neutral-500'}`}
										on:click|stopPropagation={() => selectScreenshot(index)}
									></button>
								{/each}
							</div>
						{/if}
						<img
							src={selectedProject.images[selectedScreenshot]}
							alt={selectedProject.title}
							class="w-full rounded-lg"
						/>
					</div>
				</div>
			</div>
		</button>
	</div>
</div>
