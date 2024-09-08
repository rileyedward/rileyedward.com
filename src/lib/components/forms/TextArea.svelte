<script lang="ts">
	export let key: string;
	export let label: string;
	export let placeholder: string = label;
	export let value: string = '';
</script>

<div class="flex flex-col">
	<label for={key} class="block text-sm text-gray-400 mb-1">{label}</label>
	<textarea
		id={key}
		name={key}
		{placeholder}
		rows="5"
		class="w-full px-4 py-2 text-white placeholder-gray-500 bg-neutral-800 border border-neutral-700 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
		{value}
	/>
</div>
