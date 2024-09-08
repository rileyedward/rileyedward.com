<script lang="ts">
	import { page } from '$app/stores';
	import { showContactModal } from '$lib/store';

	$: pathname = $page.url.pathname;
</script>

<nav>
	<div class="max-w-5xl mx-auto flex justify-between items-center px-8 py-6">
		<div class="flex items-center gap-24">
			<h1 class="text-2xl font-bold">
				<a href="/" class="hover:text-violet-500">
					Riley Edward
					<span class="text-violet-500">.</span>
				</a>
			</h1>

			<ul class="flex items-center gap-12">
				<li
					class={`font-light text-sm hover:font-semibold ${pathname.includes('/projects') ? 'text-violet-500' : 'hover:text-violet-500'}`}
				>
					<a href="/projects"> Projects </a>
				</li>
				<li
					class={`font-light text-sm hover:font-semibold ${pathname.includes('/blog') ? 'text-violet-500' : 'hover:text-violet-500'}`}
				>
					<a href="/blog"> Blog </a>
				</li>
			</ul>
		</div>

		<div class="flex items-center gap-8">
			<button
				class="w-full py-1 px-6 bg-violet-500 text-white hover:font-semibold rounded-md shadow-md hover:bg-violet-400 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-opacity-50 transition duration-150 ease-in-out"
				on:click={() => ($showContactModal = true)}
			>
				contact
			</button>
		</div>
	</div>
</nav>
