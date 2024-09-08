<script lang="ts">
	import { fly } from 'svelte/transition';
	import MenuIcon from '$lib/icons/MenuIcon.svelte';
	import { goto } from '$app/navigation';
	import { showContactModal } from '$lib/store';

	let mobileMenuOpen: boolean = false;

	$: textColor = mobileMenuOpen ? 'text-black' : 'text-white';

	const redirectTo = (url: string) => {
		goto(url);
		mobileMenuOpen = false;
	};
</script>

<nav class="relative flex justify-between items-center px-8 py-6 z-40">
	<div class="z-50">
		<h1
			class={`text-2xl font-bold transition-colors ease-in-out hover:text-violet-500 ${textColor}`}
		>
			<button on:click|preventDefault={() => redirectTo('/')}>
				Riley Edward
				<span class="text-violet-600">.</span>
			</button>
		</h1>
	</div>

	<div class="z-50">
		<button on:click={() => (mobileMenuOpen = !mobileMenuOpen)}>
			<MenuIcon {textColor} />
		</button>
	</div>

	{#if mobileMenuOpen}
		<div class="fixed inset-0 bg-white px-8 py-24" transition:fly={{ y: 10, duration: 300 }}>
			<ul class="flex flex-col gap-8">
				<li class="text-black font-normal hover:font-semibold space-y-6">
					<button class="flex items-center gap-4" on:click={() => redirectTo('/projects')}>
						Projects
					</button>
				</li>
				<li class="text-black font-normal hover:font-semibold space-y-6">
					<button class="flex items-center gap-4" on:click={() => redirectTo('/blog')}>
						Blog
					</button>
				</li>
			</ul>

			<hr class="border-1 border-gray-200 my-8" />

			<div>
				<button
					class="w-fit py-1 px-6 bg-violet-600 text-white hover:font-semibold rounded-md shadow-md hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-opacity-50 transition duration-150 ease-in-out"
					on:click={() => ($showContactModal = true)}
				>
					contact
				</button>
			</div>
		</div>
	{/if}
</nav>

<style>
	.fade-slide-enter {
		opacity: 0;
		transform: translateY(10px);
	}

	.fade-slide-enter-active {
		opacity: 1;
		transform: translateY(0);
		transition:
			opacity 300ms ease-in-out,
			transform 300ms ease-in-out;
	}

	.fade-slide-leave {
		opacity: 1;
		transform: translateY(0);
	}

	.fade-slide-leave-active {
		opacity: 0;
		transform: translateY(10px);
		transition:
			opacity 300ms ease-in-out,
			transform 300ms ease-in-out;
	}
</style>
