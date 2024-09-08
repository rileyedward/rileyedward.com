<script lang="ts">
	import Modal from '$lib/components/global/Modal.svelte';
	import { globalAlert, showContactModal } from '$lib/store';
	import FormErrors from './forms/FormErrors.svelte';
	import TextArea from './forms/TextArea.svelte';
	import TextInput from './forms/TextInput.svelte';

	let formErrors: { message: string }[] = [];

	const handleSubmit = async (event: Event) => {
		const form = event.target as HTMLFormElement;
		const formData = new FormData(form);

		const response = await fetch('/api/contact', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify(Object.fromEntries(formData))
		});

		if (response.ok) {
			$globalAlert = 'Message sent successfully!';
			form.reset();
			$showContactModal = false;
		} else if (response.status === 422) {
			formErrors = await response.json();
		} else {
			$globalAlert = 'An error occurred while sending your message. Please try again later.';
		}
	};
</script>

<Modal bind:show={$showContactModal} close={() => ($showContactModal = false)}>
	<div>
		<div class="mb-2">
			<h3 class="text-2xl font-medium mb-1">Want to reach out?</h3>
			<p class="max-w-2xl text-neutral-300 mb-6">
				While I'm not looking for any new opportunities at the moment, my inbox is always open.
				Whether you have a question or just want to say hi, I'll try my best to get back to you!
			</p>
		</div>

		<form class="space-y-6" on:submit|preventDefault={handleSubmit}>
			<TextInput key="name" label="Name" />
			<TextInput key="email" label="Email" />
			<TextArea key="message" label="How can I help you?" placeholder="Message..." />

			<FormErrors errors={formErrors} />

			<div class="flex justify-end items-center">
				<button
					type="submit"
					class="w-fit py-1 px-6 bg-violet-500 text-white font-bold rounded-md shadow-md hover:bg-violet-400 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-opacity-50 transition duration-150 ease-in-out"
				>
					Send
				</button>
			</div>
		</form>
	</div>
</Modal>
