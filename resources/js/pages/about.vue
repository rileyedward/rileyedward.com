<script setup lang="ts">
import AboutHero from '@/components/about/about-hero.vue';
import AboutTimeline from '@/components/about/about-timeline.vue';
import AboutWidgetsSection from '@/components/about/about-widgets-section.vue';
import ProfessionalExperienceSection from '@/components/about/professional-experience-section.vue';
import AppLayout from '@/layouts/app-layout.vue';
</script>

<template>
    <app-layout page-title="About" :always-show-navbar="true">
        <about-hero />
        <professional-experience-section />
        <about-timeline />
        <about-widgets-section />
    </app-layout>
</template>
