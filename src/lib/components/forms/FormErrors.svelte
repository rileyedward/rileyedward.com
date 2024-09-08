<script lang="ts">
	export let errors: { message: string }[] = [];
</script>

{#if errors.length > 0}
	<div role="alert" class="bg-red-100 border border-red-400 text-red-700 p-3 rounded-md">
		<ul>
			{#each errors as error}
				<li>{error.message}</li>
			{/each}
		</ul>
	</div>
{/if}
