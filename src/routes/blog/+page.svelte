<script lang="ts">
	import Fuse from 'fuse.js';

	export let data;

	let search = '';

	$: filteredPosts =
		search.length >= 3
			? new Fuse(data.posts, {
					keys: ['title', 'description']
				})
					.search(search)
					.map((result) => result.item)
			: data.posts;
</script>

<div class="max-w-5xl mx-auto px-8 py-8">
	<div class="flex flex-col">
		<input
			type="text"
			name="search"
			placeholder="Search..."
			bind:value={search}
			class="w-full max-w-md px-4 py-2 text-white placeholder-gray-500 bg-neutral-800 border border-neutral-700 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent"
		/>
	</div>

	<div class="w-full max-w-4xl space-y-6 my-8">
		{#each filteredPosts as post}
			<div
				class="w-full bg-neutral-800 hover:bg-neutral-700 shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105"
			>
				<a href={`blog/${post.slug}`} class="block p-6">
					<h2
						class="text-lg md:text-2xl font-bold text-white mb-2 hover:text-violet-400 transition-colors"
					>
						{post.title}
					</h2>
					<p class="text-violet-400 text-sm mb-2">
						{new Date(post.published_at).toLocaleDateString()}
					</p>
					<p class="text-sm md:text-base text-gray-300">{post.description}</p>
				</a>
			</div>
		{/each}
	</div>
</div>
