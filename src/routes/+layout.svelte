<script lang="ts">
	import '../app.css';
	import '../markdown.css';
	import Navbar from '$lib/components/navigation/Navbar.svelte';
	import MobileNavbar from '$lib/components/navigation/MobileNavbar.svelte';
	import ContactModal from '$lib/components/ContactModal.svelte';
	import GlobalAlerts from '$lib/components/GlobalAlerts.svelte';
	import Footer from '$lib/components/navigation/Footer.svelte';
</script>

<div>
	<div class="hidden md:block">
		<Navbar />
	</div>

	<div class="block md:hidden">
		<MobileNavbar />
	</div>

	<div>
		<div class="min-h-[70vh]">
			<slot />
		</div>

		<Footer />
	</div>

	<ContactModal />
	<GlobalAlerts />
</div>
