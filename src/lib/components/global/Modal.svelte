<script>
	export let show = false;
	export let close = () => {};

	const handleClose = () => {
		if (typeof close === 'function') close();
	};
</script>

{#if show}
	<div class="fixed inset-0 z-50 overflow-y-auto">
		<div
			class="fixed inset-0 bg-[#18181B] bg-opacity-50 transition-opacity"
			on:click={handleClose}
			aria-hidden="true"
		></div>
		<div class="flex items-start justify-center min-h-screen p-4 pt-20">
			<div
				class="bg-neutral-800 text-white rounded-lg shadow-lg transform transition-all w-full sm:max-w-3xl"
			>
				<button
					type="button"
					class="absolute top-3 right-3 text-gray-400 hover:text-gray-200"
					on:click|preventDefault={handleClose}
					aria-label="Close Modal"
				>
					<svg
						class="w-6 h-6"
						fill="none"
						stroke="currentColor"
						viewBox="0 0 24 24"
						xmlns="http://www.w3.org/2000/svg"
					>
						<path
							stroke-linecap="round"
							stroke-linejoin="round"
							stroke-width="2"
							d="M6 18L18 6M6 6l12 12"
						></path>
					</svg>
				</button>
				<div class="px-6 py-10">
					<slot />
				</div>
			</div>
		</div>
	</div>
{/if}
