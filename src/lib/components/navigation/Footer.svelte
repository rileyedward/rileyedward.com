<script>
	import GithubIcon from '$lib/icons/GithubIcon.svelte';
	import { showContactModal } from '$lib/store';
</script>

<footer
	class="max-w-5xl mx-auto px-8 py-24 flex flex-col md:flex-row gap-4 text-center md:text-left justify-between items-center"
>
	<div>
		<h3 class="text-xl font-semibold">Riley Edward.</h3>
		<p class="text-base font-semibold">&copy; 2024. All rights reserved.</p>
	</div>

	<div class="flex items-center gap-4">
		<a href="https://github.com/rileyedward" target="_blank">
			<GithubIcon />
		</a>

		<button
			class="text-lg py-2 px-4 border border-gray-400 rounded-full bg-transparent transition duration-500 ease-in-out transform hover:bg-violet-400 hover:border-gray-500 hover:scale-105 text-white font-semibold"
			on:click|preventDefault={() => ($showContactModal = true)}
		>
			contact
		</button>
	</div>
</footer>
