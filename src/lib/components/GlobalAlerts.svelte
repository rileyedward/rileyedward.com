<script lang="ts">
	import { globalAlert } from '$lib/store';
</script>

{#if $globalAlert}
	<div
		class="max-w-2xl fixed bottom-0 right-0 z-50 flex items-center justify-center px-4 py-6 sm:items-start sm:justify-end pointer-events-auto transition-opacity duration-300"
	>
		<div
			class="max-w-sm w-full bg-violet-400 text-white text-sm rounded-lg shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
		>
			<div class="p-4 flex items-center">
				<div class="flex-1">
					<p class="font-semibold">
						{$globalAlert}
					</p>
				</div>
				<button
					class="ml-4 flex-shrink-0 text-white"
					on:click|preventDefault={() => ($globalAlert = null)}
				>
					<span class="text-lg font-semibold"> X </span>
				</button>
			</div>
		</div>
	</div>
{/if}
