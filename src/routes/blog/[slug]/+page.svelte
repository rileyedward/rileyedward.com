<script lang="ts">
	import { marked } from 'marked';

	export let data;

	$: htmlContent = marked(data.post.content);
</script>

<div class="max-w-5xl mx-auto px-8 py-8">
	<div class="max-w-4xl">
		<div>
			<h1 class="text-2xl font-bold mb-1">
				{data.post.title}
			</h1>
			<p class="text-sm text-violet-400 mb-4">
				Published on {new Date(data.post.published_at).toLocaleDateString()}
			</p>
		</div>

		<hr class="border-t border-violet-300 mb-4" />

		<div class="markdown-body">
			{@html htmlContent}
		</div>
	</div>
</div>

<style>
	.markdown-body {
		background-color: transparent;
	}
</style>
