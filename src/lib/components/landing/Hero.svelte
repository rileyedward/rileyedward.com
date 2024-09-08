<script>
	import FlameIcon from '$lib/icons/FlameIcon.svelte';
</script>

<div class="py-12 md:py-24 min-h-[80vh] relative">
	<div
		class="max-w-4xl mx-auto px-6 py-6 md:py-12 flex flex-col md:flex-row items-center md:space-x-12 space-y-8 md:space-y-0"
	>
		<img
			src="/profile.png"
			alt="Profile"
			class="w-[200px] md:w-[300px] h-[200px] md:h-[300px] rounded-2xl object-cover shadow-lg bg-gradient-to-t from-neutral-800 via-neutral-900 to-transparent"
		/>
		<div class="text-center md:text-left max-w-lg">
			<p class="text-base font-semibold mb-2 text-neutral-200">Hi, I'm Riley! 👋🏻</p>
			<p
				class="text-2xl md:text-4xl max-w-xs md:max-w-full font-bold bg-clip-text text-transparent bg-gradient-to-r from-violet-400 to-indigo-600 mb-6"
			>
				Building full-stack applications for the web.
			</p>
			<a
				href="/projects"
				class="w-fit mx-auto text-sm md:mx-0 py-2 px-3 bg-violet-100 text-violet-600 hover:bg-violet-900 hover:text-violet-200 rounded-lg shadow-lg focus:outline-none focus:ring-4 focus:ring-violet-500 focus:ring-opacity-60 transition-all duration-200 ease-in-out flex justify-between items-center gap-2"
			>
				<FlameIcon />
				<span class="font-semibold"> my work </span>
			</a>
		</div>
	</div>
	<div class="absolute bottom-15 md:bottom-8 inset-x-0 flex justify-center">
		<div class="flex flex-col items-center space-y-2">
			<span class="text-neutral-200 text-sm">Scroll down</span>
			<svg
				class="w-10 h-10 text-neutral-200 animate-bounce"
				xmlns="http://www.w3.org/2000/svg"
				fill="none"
				viewBox="0 0 24 24"
				stroke="currentColor"
			>
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
			</svg>
		</div>
	</div>
</div>

<style>
	@keyframes bounce {
		0%,
		20%,
		50%,
		80%,
		100% {
			transform: translateY(0);
		}
		40% {
			transform: translateY(-15px);
		}
		60% {
			transform: translateY(-5px);
		}
	}

	.animate-bounce {
		animation: bounce 1.5s infinite;
	}
</style>
